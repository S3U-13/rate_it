<?php

namespace App\Http\Controllers;

use App\Models\AboveComment;
use App\Models\Assessment01Score;
use App\Models\Assessment02Score;
use App\Models\AssessmentAcknowledgement;
use App\Models\Comments;
use App\Models\Criterion;
use App\Models\EvaluationComponent;
use App\Models\SummarizePart01;
use App\Models\SummarizePart02;
use App\Models\SummarizePart03;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Carbon\Carbon;

class AboveController extends Controller
{
    //
    public function index()
    {
        $now = Carbon::now('Asia/Bangkok');
        $currentYear = $now->year;
        $currentMonth = $now->month;

        if ($currentMonth >= 10) {
            // ช่วง ต.ค. - ธ.ค.
            $startRound1 = Carbon::create($currentYear, 10, 1)->startOfDay();
            $endRound1   = Carbon::create($currentYear + 1, 3, 31)->endOfDay();

            $startRound2 = Carbon::create($currentYear + 1, 4, 1)->startOfDay();
            $endRound2   = Carbon::create($currentYear + 1, 9, 30)->endOfDay();
        } else {
            // ช่วง ม.ค. - ก.ย.
            $startRound1 = Carbon::create($currentYear - 1, 10, 1)->startOfDay();
            $endRound1   = Carbon::create($currentYear, 3, 31)->endOfDay();

            $startRound2 = Carbon::create($currentYear, 4, 1)->startOfDay();
            $endRound2   = Carbon::create($currentYear, 9, 30)->endOfDay();
        }

        $evaluationRound = null;
        $startDate = null;
        $endDate = null;

        if ($now->between($startRound1, $endRound1)) {
            $evaluationRound = 1;
        } elseif ($now->between($startRound2, $endRound2)) {
            $evaluationRound = 2;
        }

        $user = Auth::user();

        if ($user->tier_num !== 11) {
            abort(403, 'คุณไม่มีสิทธิ์เข้าถึงหน้านี้'); // ส่งกลับข้อผิดพลาด 403
        }


        $personals = User::whereNotIn('tier_num', [4, 11, 12]) // 1 = รองผู้อำนวยการ
            ->where('role',  'user')
            ->whereHas('Summarize01', function ($query) use ($evaluationRound) {
                // ตรวจสอบว่าใน personalSignature มีข้อมูลที่ตรงกับ round ที่เป็น 1 หรือ 2
                $query->whereIn('round', [1, 2]) // ตรวจสอบว่า round เป็น 1 หรือ 2
                    ->where('round', $evaluationRound); // ตรวจสอบว่า round เป็นค่าใน $evaluationRound
            })
            ->whereDoesntHave('AboveSummarize', function ($query) use ($user, $evaluationRound) {
                $query->where('above_num', $user->id)
                    ->where('round', $evaluationRound); // ใช้ evaluationRound
            })
            ->get()
            ->filter(function ($personal) use ($evaluationRound) {
                return $personal->round = $evaluationRound; // ใช้ Accessor
            });
        $hasCompletedEvaluation = $personals->isEmpty();
        return view('page.capacity_rate_it.above.index', compact('personals', 'hasCompletedEvaluation', 'evaluationRound', 'now'));
    }

    public function create($id)
    {
        Carbon::setLocale('th');
        $now = Carbon::now('Asia/Bangkok');

        // รอบ 1: 1 ต.ค. ปีนี้ ถึง 31 มี.ค. ปีหน้า
        $startRound1 = Carbon::create($now->year, 10, 1);
        $endRound1   = Carbon::create($now->year + 1, 3, 31)->endOfDay();

        // รอบ 2: 1 เม.ย. ปีหน้า ถึง 30 ก.ย. ปีหน้า
        $startRound2 = Carbon::create($now->year + 1, 4, 1);
        $endRound2   = Carbon::create($now->year + 1, 9, 30)->endOfDay();

        $evaluationRound = null;

        if ($now->between($startRound1, $endRound1)) {
            $evaluationRound = 1;
        } elseif ($now->between($startRound2, $endRound2)) {
            $evaluationRound = 2;
        }

        $personal = User::findOrFail($id);
        $summarize_01 = SummarizePart01::where('personal_num', $personal->id)
            ->where('round', $evaluationRound)->get();
        $summarize_02 = SummarizePart02::where('personal_num', $personal->id)
            ->where('round', $evaluationRound)->get();
        $summarize_03 = SummarizePart03::where('personal_num', $personal->id)
            ->where('round', $evaluationRound)->get();
        $assessment_01 = Assessment01Score::where('personal_num', $personal->id)
            ->where('round', $evaluationRound)->get();
        $assessment_02 = Assessment02Score::where('personal_num', $personal->id)
            ->where('round', $evaluationRound)->get();

        $evaluation_component = EvaluationComponent::all();
        $criterion_choice = Criterion::all();
        $comment_choice = Comments::all();
        $assessment_acknowledgement_choice = AssessmentAcknowledgement::pluck('assessment_acknowledgement_name', 'id')->toArray();
        // dd( $summarize_03);
        return view('page.capacity_rate_it.above.create', compact(
            'personal',
            'summarize_01',
            'summarize_02',
            'summarize_03',
            'criterion_choice',
            'assessment_acknowledgement_choice',
            'comment_choice',
            'evaluation_component',
            'assessment_01',
            'assessment_02',
            'evaluationRound',
        ));
    }

    public function create_full_time($id)
    {
        Carbon::setLocale('th');
        $now = Carbon::now('Asia/Bangkok');

        // รอบ 1: 1 ต.ค. ปีนี้ ถึง 31 มี.ค. ปีหน้า
        $startRound1 = Carbon::create($now->year, 10, 1);
        $endRound1   = Carbon::create($now->year + 1, 3, 31)->endOfDay();

        // รอบ 2: 1 เม.ย. ปีหน้า ถึง 30 ก.ย. ปีหน้า
        $startRound2 = Carbon::create($now->year + 1, 4, 1);
        $endRound2   = Carbon::create($now->year + 1, 9, 30)->endOfDay();

        $evaluationRound = null;

        if ($now->between($startRound1, $endRound1)) {
            $evaluationRound = 1;
        } elseif ($now->between($startRound2, $endRound2)) {
            $evaluationRound = 2;
        }

        $personal = User::findOrFail($id);
        $summarize_01 = SummarizePart01::where('personal_num', $personal->id)
            ->where('round', $evaluationRound)->get();
        $summarize_02 = SummarizePart02::where('personal_num', $personal->id)
            ->where('round', $evaluationRound)->get();
        $summarize_03 = SummarizePart03::where('personal_num', $personal->id)
            ->where('round', $evaluationRound)->get();
        $assessment_01 = Assessment01Score::where('personal_num', $personal->id)
            ->where('round', $evaluationRound)->get();
        $assessment_02 = Assessment02Score::where('personal_num', $personal->id)
            ->where('round', $evaluationRound)->get();

        $evaluation_component = EvaluationComponent::all();
        $criterion_choice = Criterion::all();
        $comment_choice = Comments::all();
        $assessment_acknowledgement_choice = AssessmentAcknowledgement::pluck('assessment_acknowledgement_name', 'id')->toArray();
        return view('page.capacity_rate_it.above.create_full_time_employee', compact(
            'personal',
            'summarize_01',
            'summarize_02',
            'summarize_03',
            'criterion_choice',
            'assessment_acknowledgement_choice',
            'comment_choice',
            'evaluation_component',
            'assessment_01',
            'assessment_02',
            'evaluationRound',
        ));
    }
    public function create_general_government($id)
    {
        Carbon::setLocale('th');
        $now = Carbon::now('Asia/Bangkok');

        // รอบ 1: 1 ต.ค. ปีนี้ ถึง 31 มี.ค. ปีหน้า
        $startRound1 = Carbon::create($now->year, 10, 1);
        $endRound1   = Carbon::create($now->year + 1, 3, 31)->endOfDay();

        // รอบ 2: 1 เม.ย. ปีหน้า ถึง 30 ก.ย. ปีหน้า
        $startRound2 = Carbon::create($now->year + 1, 4, 1);
        $endRound2   = Carbon::create($now->year + 1, 9, 30)->endOfDay();

        $evaluationRound = null;

        if ($now->between($startRound1, $endRound1)) {
            $evaluationRound = 1;
        } elseif ($now->between($startRound2, $endRound2)) {
            $evaluationRound = 2;
        }

        $personal = User::findOrFail($id);
        $personal_round_1 = SummarizePart01::where('personal_num', $personal->id)->where('round', 1)->get();
        $summarize_01 = SummarizePart01::where('personal_num', $personal->id)
            ->where('round', $evaluationRound)->get();
        $summarize_02 = SummarizePart02::where('personal_num', $personal->id)
            ->where('round', $evaluationRound)->get();
        $summarize_03 = SummarizePart03::where('personal_num', $personal->id)
            ->where('round', $evaluationRound)->get();
        $assessment_01 = Assessment01Score::where('personal_num', $personal->id)
            ->where('round', $evaluationRound)->get();
        $assessment_02 = Assessment02Score::where('personal_num', $personal->id)
            ->where('round', $evaluationRound)->get();

        $evaluation_component = EvaluationComponent::all();
        $criterion_choice = Criterion::all();
        $comment_choice = Comments::all();
        $assessment_acknowledgement_choice = AssessmentAcknowledgement::pluck('assessment_acknowledgement_name', 'id')->toArray();
        return view('page.capacity_rate_it.above.create_general_government_employee', compact(
            'personal',
            'summarize_01',
            'summarize_02',
            'summarize_03',
            'criterion_choice',
            'assessment_acknowledgement_choice',
            'comment_choice',
            'evaluation_component',
            'assessment_01',
            'assessment_02',
            'evaluationRound',
            'personal_round_1',
        ));
    }
    public function create_ministry_of_public_health($id)
    {
        Carbon::setLocale('th');
        $now = Carbon::now('Asia/Bangkok');

        // รอบ 1: 1 ต.ค. ปีนี้ ถึง 31 มี.ค. ปีหน้า
        $startRound1 = Carbon::create($now->year, 10, 1);
        $endRound1   = Carbon::create($now->year + 1, 3, 31)->endOfDay();

        // รอบ 2: 1 เม.ย. ปีหน้า ถึง 30 ก.ย. ปีหน้า
        $startRound2 = Carbon::create($now->year + 1, 4, 1);
        $endRound2   = Carbon::create($now->year + 1, 9, 30)->endOfDay();

        $evaluationRound = null;

        if ($now->between($startRound1, $endRound1)) {
            $evaluationRound = 1;
        } elseif ($now->between($startRound2, $endRound2)) {
            $evaluationRound = 2;
        }

        $personal = User::findOrFail($id);
        $summarize_01 = SummarizePart01::where('personal_num', $personal->id)
            ->where('round', $evaluationRound)->get();
        $summarize_02 = SummarizePart02::where('personal_num', $personal->id)
            ->where('round', $evaluationRound)->get();
        $summarize_03 = SummarizePart03::where('personal_num', $personal->id)
            ->where('round', $evaluationRound)->get();
        $assessment_01 = Assessment01Score::where('personal_num', $personal->id)
            ->where('round', $evaluationRound)->get();
        $assessment_02 = Assessment02Score::where('personal_num', $personal->id)
            ->where('round', $evaluationRound)->get();

        $evaluation_component = EvaluationComponent::all();
        $criterion_choice = Criterion::all();
        $comment_choice = Comments::all();
        $assessment_acknowledgement_choice = AssessmentAcknowledgement::pluck('assessment_acknowledgement_name', 'id')->toArray();
        return view('page.capacity_rate_it.above.create_ministry_of_public_health_employee', compact(
            'personal',
            'summarize_01',
            'summarize_02',
            'summarize_03',
            'criterion_choice',
            'assessment_acknowledgement_choice',
            'comment_choice',
            'evaluation_component',
            'assessment_01',
            'assessment_02',
            'evaluationRound',
        ));
    }
    public function create_temporary($id)
    {
        Carbon::setLocale('th');
        $now = Carbon::now('Asia/Bangkok');

        // รอบ 1: 1 ต.ค. ปีนี้ ถึง 31 มี.ค. ปีหน้า
        $startRound1 = Carbon::create($now->year, 10, 1);
        $endRound1   = Carbon::create($now->year + 1, 3, 31)->endOfDay();

        // รอบ 2: 1 เม.ย. ปีหน้า ถึง 30 ก.ย. ปีหน้า
        $startRound2 = Carbon::create($now->year + 1, 4, 1);
        $endRound2   = Carbon::create($now->year + 1, 9, 30)->endOfDay();

        $evaluationRound = null;

        if ($now->between($startRound1, $endRound1)) {
            $evaluationRound = 1;
        } elseif ($now->between($startRound2, $endRound2)) {
            $evaluationRound = 2;
        }

        $personal = User::findOrFail($id);
        $summarize_01 = SummarizePart01::where('personal_num', $personal->id)
            ->where('round', $evaluationRound)->get();
        $summarize_02 = SummarizePart02::where('personal_num', $personal->id)
            ->where('round', $evaluationRound)->get();
        $summarize_03 = SummarizePart03::where('personal_num', $personal->id)
            ->where('round', $evaluationRound)->get();
        $assessment_01 = Assessment01Score::where('personal_num', $personal->id)
            ->where('round', $evaluationRound)->get();
        $assessment_02 = Assessment02Score::where('personal_num', $personal->id)
            ->where('round', $evaluationRound)->get();

        $evaluation_component = EvaluationComponent::all();
        $criterion_choice = Criterion::all();
        $comment_choice = Comments::all();
        $assessment_acknowledgement_choice = AssessmentAcknowledgement::pluck('assessment_acknowledgement_name', 'id')->toArray();
        return view('page.capacity_rate_it.above.create_temporary_employee', compact(
            'personal',
            'summarize_01',
            'summarize_02',
            'summarize_03',
            'criterion_choice',
            'assessment_acknowledgement_choice',
            'comment_choice',
            'evaluation_component',
            'assessment_01',
            'assessment_02',
            'evaluationRound',
        ));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            //summarize_part_01
            'personal_num' => 'required',
            'above_comment_num' => 'required',
            'above_comment_detail' => 'nullable',
            'above_comment_detail_1' => 'nullable',
            'above_comment_detail_2' => 'nullable',
            'above_comment_detail_3' => 'nullable',
            'above_signature' => [
                'nullable' => '',
                'string' => '',
                'regex:/^data:image\/(png|jpg|jpeg);base64,/i'
            ],
            'round' => 'required',
            'above_date' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->route('page.capacity_rate_it.above.index')->with('error', 'เกิดข้อผิดพลาด กรุณาลองใหม่');
        }
        $aboveSignaturePath = $this->saveSignatureImage($request->above_signature, 'above');

        try {

            AboveComment::create([
                'personal_num' => $request->personal_num,
                'above_comment_num' => $request->above_comment_num,
                'above_comment_detail' => $request->above_comment_detail,
                'above_comment_detail_1' => $request->above_comment_detail_1,
                'above_comment_detail_2' => $request->above_comment_detail_2,
                'above_comment_detail_3' => $request->above_comment_detail_3,
                'above_signature' => $aboveSignaturePath,
                'above_date' => $request->above_date,
                'above_num' => Auth::id(),
                'round' => $request->round,
            ]);

            return redirect()->route('page.capacity_rate_it.above.index')->with('success', 'เพิ่มเเบบสรุปผลการปฏิบัติราชการสำเร็จ!');
        } catch (\Throwable $th) {
            //throw $th;
            Log::error('Error occurred while storing data: ' . $th->getMessage());

            return redirect()->route('page.capacity_rate_it.above.index')->with('error', 'เพิ่มเเบบสรุปผลการปฏิบัติราชการไม่สำเร็จ!');
        }
    }
    private function saveSignatureImage($base64Image, $prefix)
    {
        if (!$base64Image) {
            return null;
        }

        // ✅ ตรวจสอบว่าเป็น Base64 จริงไหม
        if (preg_match('/^data:image\/(\w+);base64,/', $base64Image, $matches)) {
            $imageType = $matches[1]; // ประเภทไฟล์ (png, jpg ฯลฯ)
            $base64Image = substr($base64Image, strpos($base64Image, ',') + 1); // เอาเฉพาะข้อมูล Base64
            $base64Image = base64_decode($base64Image);

            // ✅ ตั้งชื่อไฟล์ (random + timestamp)
            $fileName = time() . '_' . Str::random(10) . '.' . $imageType;

            // ✅ กำหนดโฟลเดอร์ตามประเภทลายเซ็น
            $folder = "{$prefix}"; // เช่น /signatures/personal, /signatures/witness, /signatures/evaluator
            $filePath = "{$folder}/{$fileName}";

            // ✅ บันทึกไฟล์ลง storage
            Storage::disk('public')->put($filePath, $base64Image);

            return $filePath;
        }

        return null;
    }
}

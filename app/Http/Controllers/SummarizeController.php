<?php

namespace App\Http\Controllers;

use App\Models\Assessment01Score;
use App\Models\Assessment02Score;
use App\Models\AssessmentAcknowledgement;
use App\Models\Comments;
use App\Models\Criterion;
use App\Models\EvaluationComponent;
use App\Models\EvaluationComponentFullTime;
use App\Models\SummarizePart01;
use App\Models\SummarizePart02;
use App\Models\SummarizePart03;
use App\Models\User;
use App\Models\WagePromotion;
use App\Models\WagePromotionOnePointFive;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Carbon\Carbon;

class SummarizeController extends Controller
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

        if ($now->between($startRound1, $endRound1)) {
            $evaluationRound = 1;
        } elseif ($now->between($startRound2, $endRound2)) {
            $evaluationRound = 2;
        }

        $user = Auth::user();

        if ($user->tier_num !== 4) {
            abort(403, 'คุณไม่มีสิทธิ์เข้าถึงหน้านี้'); // ส่งกลับข้อผิดพลาด 403
        }

        $personals = User::where('group_num', $user->group_num)
            ->whereNotIn('tier_num', [4, 11, 12])
            ->where('role',  'user')
            ->whereDoesntHave('Summarize01', function ($query) use ($user, $evaluationRound) {
                $query->where('evaluator_num', $user->id)
                    ->where('round', $evaluationRound); // ใช้ evaluationRound
            })
            ->get()
            ->filter(function ($personal) use ($evaluationRound) {
                return $personal->round == $evaluationRound; // ใช้ Accessor
            });

        $hasCompletedEvaluation = $personals->isEmpty();
        return view('page.capacity_rate_it.summarize.index', compact('personals', 'hasCompletedEvaluation', 'evaluationRound', 'now'));
    }

    public function create($id)
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

        if ($now->between($startRound1, $endRound1)) {
            $evaluationRound = 1;
        } elseif ($now->between($startRound2, $endRound2)) {
            $evaluationRound = 2;
        }
        $personal = User::findOrFail($id);
        $evaluation_component = EvaluationComponent::all();
        $criterion_choice = Criterion::all();
        $assessment_acknowledgement_choice = AssessmentAcknowledgement::all();
        $comment_choice = Comments::all();
        $assessment_01 = Assessment01Score::where('personal_num', $personal->id)
            ->where('round', $evaluationRound)->get();
        $assessment_02 = Assessment02Score::where('personal_num', $personal->id)
            ->where('round', $evaluationRound)->get();

        return view('page.capacity_rate_it.summarize.create', compact('personal', 'assessment_01', 'assessment_02', 'evaluation_component', 'criterion_choice', 'assessment_acknowledgement_choice', 'comment_choice', 'evaluationRound'));
    }

    public function create_full_time($id)
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

        if ($now->between($startRound1, $endRound1)) {
            $evaluationRound = 1;
        } elseif ($now->between($startRound2, $endRound2)) {
            $evaluationRound = 2;
        }
        $personal = User::findOrFail($id);
        $evaluation_component = EvaluationComponentFullTime::all();
        $criterion_choice = Criterion::all();
        $assessment_acknowledgement_choice = AssessmentAcknowledgement::all();
        $comment_choice = Comments::all();
        $wage_promotion = WagePromotion::all();
        $wage_promotion_1_5 = WagePromotionOnePointFive::all();
        $assessment_01 = Assessment01Score::where('personal_num', $personal->id)
            ->where('round', $evaluationRound)->get();
        $assessment_02 = Assessment02Score::where('personal_num', $personal->id)
            ->where('round', $evaluationRound)->get();

        return view('page.capacity_rate_it.summarize.create_full_time_employee', compact('personal', 'assessment_01', 'assessment_02', 'evaluation_component', 'criterion_choice', 'assessment_acknowledgement_choice', 'comment_choice', 'wage_promotion', 'evaluationRound', 'wage_promotion_1_5'));
    }
    public function create_general_government($id)
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

        if ($now->between($startRound1, $endRound1)) {
            $evaluationRound = 1;
        } elseif ($now->between($startRound2, $endRound2)) {
            $evaluationRound = 2;
        }
        $personal = User::findOrFail($id);
        $evaluation_component = EvaluationComponent::all();
        $criterion_choice = Criterion::all();
        $assessment_acknowledgement_choice = AssessmentAcknowledgement::all();
        $comment_choice = Comments::all();

        $personal_round_1 = SummarizePart01::where('personal_num', $personal->id)->where('round', 1)->get();

        $assessment_01 = Assessment01Score::where('personal_num', $personal->id)
            ->where('round', $evaluationRound)->get();
        $assessment_02 = Assessment02Score::where('personal_num', $personal->id)
            ->where('round', $evaluationRound)->get();

        return view('page.capacity_rate_it.summarize.create_general_government_employee', compact('personal', 'assessment_01', 'assessment_02', 'evaluation_component', 'criterion_choice', 'assessment_acknowledgement_choice', 'comment_choice', 'evaluationRound', 'personal_round_1'));
    }
    public function create_ministry_of_public_health($id)
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

        if ($now->between($startRound1, $endRound1)) {
            $evaluationRound = 1;
        } elseif ($now->between($startRound2, $endRound2)) {
            $evaluationRound = 2;
        }
        $personal = User::findOrFail($id);
        $evaluation_component = EvaluationComponent::all();
        $criterion_choice = Criterion::all();
        $assessment_acknowledgement_choice = AssessmentAcknowledgement::all();
        $comment_choice = Comments::all();
        $assessment_01 = Assessment01Score::where('personal_num', $personal->id)
            ->where('round', $evaluationRound)->get();
        $assessment_02 = Assessment02Score::where('personal_num', $personal->id)
            ->where('round', $evaluationRound)->get();

        return view('page.capacity_rate_it.summarize.create_ministry_of_public_health_employee', compact('personal', 'assessment_01', 'assessment_02', 'evaluation_component', 'criterion_choice', 'assessment_acknowledgement_choice', 'comment_choice', 'evaluationRound'));
    }
    public function create_temporary($id)
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

        if ($now->between($startRound1, $endRound1)) {
            $evaluationRound = 1;
        } elseif ($now->between($startRound2, $endRound2)) {
            $evaluationRound = 2;
        }
        $personal = User::findOrFail($id);
        $evaluation_component = EvaluationComponent::all();
        $criterion_choice = Criterion::all();
        $assessment_acknowledgement_choice = AssessmentAcknowledgement::all();
        $comment_choice = Comments::all();
        $assessment_01 = Assessment01Score::where('personal_num', $personal->id)
            ->where('round', $evaluationRound)->get();
        $assessment_02 = Assessment02Score::where('personal_num', $personal->id)
            ->where('round', $evaluationRound)->get();

        return view('page.capacity_rate_it.summarize.create_temporary_employee', compact('personal', 'assessment_01', 'assessment_02', 'evaluation_component', 'criterion_choice', 'assessment_acknowledgement_choice', 'comment_choice', 'evaluationRound'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            //summarize_part_01
            'personal_num' => 'required',
            'current_responsibilities' => 'nullable|array',
            'evaluation_component_num' => 'required|array',
            'points' => 'required|array',
            'points_multiply' => 'required|array',
            'total_points' => 'required',
            'criterion_num' => 'required',
            'wage_promotion_num' => 'nullable',
            'wage_promotion_detail' => 'nullable',
            'wage_promotion_num_1_5' => 'nullable',
            'wage_promotion_detail_1_5' => 'nullable',
            'round' => 'required',
            //summarize_part_02
            'skill_to_dev' => 'nullable|array',
            'dev_method' => 'nullable|array',
            'dev_time' => 'nullable|array',
            'evaluator_comment' => 'nullable',
            //summarize_part_03
            'assessment_acknowledgement_num' => 'required|array',
            'evaluation_date' => 'required',
            'evaluator_signature' => [
                'nullable',
                'string',
                'regex:/^data:image\/(png|jpg|jpeg);base64,/i'
            ],
        ]);

        if ($validator->fails()) {
            return redirect()->route('page.capacity_rate_it.above.index')->with('error', 'เกิดข้อผิดพลาด กรุณาลองใหม่');
        }
        $personalSignaturePath = $this->saveSignatureImage($request->personal_signature, 'personal');
        $witnessSignaturePath = $this->saveSignatureImage($request->witness_signature, 'witness');
        $evaluatorSignaturePath = $this->saveSignatureImage($request->evaluator_signature, 'evaluator');

        try {
            SummarizePart01::create([
                'personal_num' => $request->personal_num,
                'current_responsibilities' => json_encode($request->current_responsibilities),
                'evaluation_component_num' => json_encode($request->evaluation_component_num),
                'points' => json_encode($request->points),
                'points_multiply' => json_encode($request->points_multiply),
                'total_points' => $request->total_points,
                'criterion_num' => $request->criterion_num,
                'wage_promotion_num' => $request->wage_promotion_num,
                'wage_promotion_detail' => $request->wage_promotion_detail,
                'wage_promotion_num_1_5' => $request->wage_promotion_num_1_5,
                'wage_promotion_detail_1_5' => $request->wage_promotion_detail_1_5,
                'evaluator_num' => Auth::id(),
                'round' => $request->round,
            ]);
            SummarizePart02::create([
                'personal_num' => $request->personal_num,
                'skill_to_dev' => json_encode($request->skill_to_dev, JSON_UNESCAPED_UNICODE),
                'dev_method' => json_encode($request->dev_method, JSON_UNESCAPED_UNICODE),
                'dev_time' => json_encode($request->dev_time, JSON_UNESCAPED_UNICODE),
                'evaluator_comment' => $request->evaluator_comment,
                'evaluator_num' => Auth::id(),
                'round' => $request->round,
            ]);
            SummarizePart03::create([
                'personal_num' => $request->personal_num,
                'assessment_acknowledgement_num' => json_encode($request->assessment_acknowledgement_num),
                'evaluation_date' => $request->evaluation_date,
                'evaluator_num' => Auth::id(),
                'evaluator_signature' => $evaluatorSignaturePath,
                'round' => $request->round,
            ]);

            return redirect()->route('page.capacity_rate_it.summarize.index')->with('success', 'เพิ่มเเบบสรุปผลการปฏิบัติราชการสำเร็จ!');
        } catch (\Throwable $th) {
            //throw $th;
            Log::error('Error occurred while storing data: ' . $th->getMessage());

            return redirect()->route('page.capacity_rate_it.summarize.index')->with('error', 'เกิดข้อผิดพลาด กรุณาลองใหม่');
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
            $folder = "/signatures/{$prefix}"; // เช่น /signatures/personal, /signatures/witness, /signatures/evaluator
            $filePath = "/storage/{$folder}/{$fileName}";

            // ✅ บันทึกไฟล์ลง storage
            Storage::disk('public')->put($filePath, $base64Image);

            return $filePath;
        }

        return null;
    }
}

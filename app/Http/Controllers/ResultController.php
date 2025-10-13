<?php

namespace App\Http\Controllers;

use App\Models\AboveComment;
use App\Models\Assessment01Score;
use App\Models\Assessment02Score;
use App\Models\AssessmentAcknowledgement;
use App\Models\Comments;
use App\Models\Criterion;
use App\Models\EvaluationComponent;
use App\Models\FurtherComment;
use App\Models\PersonalSignature;
use App\Models\SummarizePart01;
use App\Models\SummarizePart02;
use App\Models\SummarizePart03;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\WitnessSignature;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ResultController extends Controller
{
    //
    public function index()
    {
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

        $user = Auth::user();

        $personals = User::where('id', $user->id)
            ->where('group_num', $user->group_num)
            ->where('role', 'user') // แสดงเฉพาะผู้ใช้ที่มี role 'user'
            ->whereHas('Summarize01', function ($query) use ($evaluationRound) {
                // ตรวจสอบว่าใน Summarize01 มีข้อมูลที่ตรงกับ round ที่เป็น 1 หรือ 2
                $query->whereIn('round', [1, 2]) // ตรวจสอบว่า round เป็น 1 หรือ 2
                    ->where('round', $evaluationRound); // ตรวจสอบว่า round เป็นค่าใน $evaluationRound
            })
            ->get();

        $personalsWithoutSignatures = User::where('id', $user->id)
            ->where('group_num', $user->group_num)
            ->whereDoesntHave('personalSignature', function ($query) use ($evaluationRound) {
                $query->where('round', $evaluationRound); // ตรวจสอบว่าไม่ได้ลงนามในรอบนี้
            })
            ->get();

        $hasCompletedEvaluation = $personals->isEmpty();
        return view('page.result.index', compact('personals', 'hasCompletedEvaluation', 'evaluationRound', 'now', 'personalsWithoutSignatures'));
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
        $summarize_01 = SummarizePart01::where('personal_num', $personal->id)->where('round', $evaluationRound)->get();
        $summarize_02 = SummarizePart02::where('personal_num', $personal->id)->where('round', $evaluationRound)->get();
        $summarize_03 = SummarizePart03::where('personal_num', $personal->id)->where('round', $evaluationRound)->get();
        $above = AboveComment::where('personal_num', $personal->id)->where('round', $evaluationRound)->get();
        $further = FurtherComment::where('personal_num', $personal->id)->where('round', $evaluationRound)->get();
        $personal_signature = PersonalSignature::where('personal_num', $personal->id)->where('round', $evaluationRound)->get();
        $witness_signature = WitnessSignature::where('personal_num', $personal->id)->where('round', $evaluationRound)->get();
        $assessment_01 = Assessment01Score::where('personal_num', $personal->id)->where('round', $evaluationRound)->get();
        $assessment_02 = Assessment02Score::where('personal_num', $personal->id)->where('round', $evaluationRound)->get();
        $evaluation_component = EvaluationComponent::all();
        $criterion_choice = Criterion::all();
        $assessment_acknowledgement_choice = AssessmentAcknowledgement::pluck('assessment_acknowledgement_name', 'id')->toArray();
        $comment_choice = Comments::all();
        // dd( $summarize_03);
        return view('page.result.create', compact(
            'personal',
            'summarize_01',
            'summarize_02',
            'summarize_03',
            'above',
            'further',
            'personal_signature',
            'witness_signature',
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
        $summarize_01 = SummarizePart01::where('personal_num', $personal->id)->where('round', $evaluationRound)->get();
        $summarize_02 = SummarizePart02::where('personal_num', $personal->id)->where('round', $evaluationRound)->get();
        $summarize_03 = SummarizePart03::where('personal_num', $personal->id)->where('round', $evaluationRound)->get();
        $above = AboveComment::where('personal_num', $personal->id)->where('round', $evaluationRound)->get();
        $further = FurtherComment::where('personal_num', $personal->id)->where('round', $evaluationRound)->get();
        $personal_signature = PersonalSignature::where('personal_num', $personal->id)->where('round', $evaluationRound)->get();
        $witness_signature = WitnessSignature::where('personal_num', $personal->id)->where('round', $evaluationRound)->get();
        $assessment_01 = Assessment01Score::where('personal_num', $personal->id)->where('round', $evaluationRound)->get();
        $assessment_02 = Assessment02Score::where('personal_num', $personal->id)->where('round', $evaluationRound)->get();
        $evaluation_component = EvaluationComponent::all();
        $criterion_choice = Criterion::all();
        $assessment_acknowledgement_choice = AssessmentAcknowledgement::pluck('assessment_acknowledgement_name', 'id')->toArray();
        $comment_choice = Comments::all();
        // dd( $summarize_03);
        return view('page.result.create_full_time_employee', compact(
            'personal',
            'summarize_01',
            'summarize_02',
            'summarize_03',
            'above',
            'further',
            'personal_signature',
            'witness_signature',
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
        $summarize_01 = SummarizePart01::where('personal_num', $personal->id)->where('round', $evaluationRound)->get();
        $summarize_02 = SummarizePart02::where('personal_num', $personal->id)->where('round', $evaluationRound)->get();
        $summarize_03 = SummarizePart03::where('personal_num', $personal->id)->where('round', $evaluationRound)->get();
        $above = AboveComment::where('personal_num', $personal->id)->where('round', $evaluationRound)->get();
        $further = FurtherComment::where('personal_num', $personal->id)->where('round', $evaluationRound)->get();
        $personal_signature = PersonalSignature::where('personal_num', $personal->id)->where('round', $evaluationRound)->get();
        $witness_signature = WitnessSignature::where('personal_num', $personal->id)->where('round', $evaluationRound)->get();
        $assessment_01 = Assessment01Score::where('personal_num', $personal->id)->where('round', $evaluationRound)->get();
        $assessment_02 = Assessment02Score::where('personal_num', $personal->id)->where('round', $evaluationRound)->get();
        $evaluation_component = EvaluationComponent::all();
        $criterion_choice = Criterion::all();
        $assessment_acknowledgement_choice = AssessmentAcknowledgement::pluck('assessment_acknowledgement_name', 'id')->toArray();
        $comment_choice = Comments::all();
        // dd( $summarize_03);
        return view('page.result.create_general_government_employee', compact(
            'personal',
            'summarize_01',
            'summarize_02',
            'summarize_03',
            'above',
            'further',
            'personal_signature',
            'witness_signature',
            'criterion_choice',
            'assessment_acknowledgement_choice',
            'comment_choice',
            'evaluation_component',
            'assessment_01',
            'assessment_02',
            'evaluationRound',
            'personal_round_1',
            'evaluationRound',
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
        $summarize_01 = SummarizePart01::where('personal_num', $personal->id)->where('round', $evaluationRound)->get();
        $summarize_02 = SummarizePart02::where('personal_num', $personal->id)->where('round', $evaluationRound)->get();
        $summarize_03 = SummarizePart03::where('personal_num', $personal->id)->where('round', $evaluationRound)->get();
        $above = AboveComment::where('personal_num', $personal->id)->where('round', $evaluationRound)->get();
        $further = FurtherComment::where('personal_num', $personal->id)->where('round', $evaluationRound)->get();
        $personal_signature = PersonalSignature::where('personal_num', $personal->id)->where('round', $evaluationRound)->get();
        $witness_signature = WitnessSignature::where('personal_num', $personal->id)->where('round', $evaluationRound)->get();
        $assessment_01 = Assessment01Score::where('personal_num', $personal->id)->where('round', $evaluationRound)->get();
        $assessment_02 = Assessment02Score::where('personal_num', $personal->id)->where('round', $evaluationRound)->get();
        $evaluation_component = EvaluationComponent::all();
        $criterion_choice = Criterion::all();
        $assessment_acknowledgement_choice = AssessmentAcknowledgement::pluck('assessment_acknowledgement_name', 'id')->toArray();
        $comment_choice = Comments::all();
        // dd( $summarize_03);
        return view('page.result.create_ministry_of_public_health_employee', compact(
            'personal',
            'summarize_01',
            'summarize_02',
            'summarize_03',
            'above',
            'further',
            'personal_signature',
            'witness_signature',
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
        $summarize_01 = SummarizePart01::where('personal_num', $personal->id)->where('round', $evaluationRound)->get();
        $summarize_02 = SummarizePart02::where('personal_num', $personal->id)->where('round', $evaluationRound)->get();
        $summarize_03 = SummarizePart03::where('personal_num', $personal->id)->where('round', $evaluationRound)->get();
        $above = AboveComment::where('personal_num', $personal->id)->where('round', $evaluationRound)->get();
        $further = FurtherComment::where('personal_num', $personal->id)->where('round', $evaluationRound)->get();
        $personal_signature = PersonalSignature::where('personal_num', $personal->id)->where('round', $evaluationRound)->get();
        $witness_signature = WitnessSignature::where('personal_num', $personal->id)->where('round', $evaluationRound)->get();
        $assessment_01 = Assessment01Score::where('personal_num', $personal->id)->where('round', $evaluationRound)->get();
        $assessment_02 = Assessment02Score::where('personal_num', $personal->id)->where('round', $evaluationRound)->get();
        $evaluation_component = EvaluationComponent::all();
        $criterion_choice = Criterion::all();
        $assessment_acknowledgement_choice = AssessmentAcknowledgement::pluck('assessment_acknowledgement_name', 'id')->toArray();
        $comment_choice = Comments::all();
        // dd( $summarize_03);
        return view('page.result.create_temporary_employee', compact(
            'personal',
            'summarize_01',
            'summarize_02',
            'summarize_03',
            'above',
            'further',
            'personal_signature',
            'witness_signature',
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
            'personal_signature' => [
                'nullable' => '',
                'string' => '',
                'regex:/^data:image\/(png|jpg|jpeg);base64,/i'
            ],
            'round' => 'required',
            'personal_date' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->route('page.capacity_rate_it.above.index')->with('error', 'เกิดข้อผิดพลาด กรุณาลองใหม่');
        }
        $personalSignaturePath = $this->saveSignatureImage($request->personal_signature, 'personal');

        try {

            PersonalSignature::create([
                'personal_num' =>  Auth::id(),
                'personal_signature' => $personalSignaturePath,
                'personal_date' => $request->personal_date,
                'round' => $request->round,
            ]);

            return redirect()->route('page.result.index')->with('success', 'เพิ่มเเบบสรุปผลการปฏิบัติราชการสำเร็จ!');
        } catch (\Throwable $th) {
            //throw $th;
            Log::error('Error occurred while storing data: ' . $th->getMessage());

            return redirect()->route('page.result.index')->with('error', 'เกิดข้อผิดพลาด กรุณาลองใหม่');
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

    public function show($id)
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
        $summarize_01 = SummarizePart01::where('personal_num', $personal->id)->where('round', $evaluationRound)->get();
        $summarize_02 = SummarizePart02::where('personal_num', $personal->id)->where('round', $evaluationRound)->get();
        $summarize_03 = SummarizePart03::where('personal_num', $personal->id)->where('round', $evaluationRound)->get();
        $above = AboveComment::where('personal_num', $personal->id)->where('round', $evaluationRound)->get();
        $further = FurtherComment::where('personal_num', $personal->id)->where('round', $evaluationRound)->get();
        $personal_signature = PersonalSignature::where('personal_num', $personal->id)->where('round', $evaluationRound)->get();
        $witness_signature = WitnessSignature::where('personal_num', $personal->id)->where('round', $evaluationRound)->get();
        $assessment_01 = Assessment01Score::where('personal_num', $personal->id)->where('round', $evaluationRound)->get();
        $assessment_02 = Assessment02Score::where('personal_num', $personal->id)->where('round', $evaluationRound)->get();
        $evaluation_component = EvaluationComponent::all();
        $criterion_choice = Criterion::all();
        $assessment_acknowledgement_choice = AssessmentAcknowledgement::all();
        $comment_choice = Comments::all();
        $assessment_acknowledgement_choice = AssessmentAcknowledgement::pluck('assessment_acknowledgement_name', 'id')->toArray();
        return view('page.result.show', compact(
            'personal',
            'summarize_01',
            'summarize_02',
            'summarize_03',
            'above',
            'further',
            'personal_signature',
            'witness_signature',
            'criterion_choice',
            'assessment_acknowledgement_choice',
            'comment_choice',
            'evaluation_component',
            'assessment_01',
            'assessment_02',
            'assessment_acknowledgement_choice',
        ));
    }
    public function show_full_time($id)
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
        $summarize_01 = SummarizePart01::where('personal_num', $personal->id)->where('round', $evaluationRound)->get();
        $summarize_02 = SummarizePart02::where('personal_num', $personal->id)->where('round', $evaluationRound)->get();
        $summarize_03 = SummarizePart03::where('personal_num', $personal->id)->where('round', $evaluationRound)->get();
        $above = AboveComment::where('personal_num', $personal->id)->where('round', $evaluationRound)->get();
        $further = FurtherComment::where('personal_num', $personal->id)->where('round', $evaluationRound)->get();
        $personal_signature = PersonalSignature::where('personal_num', $personal->id)->where('round', $evaluationRound)->get();
        $witness_signature = WitnessSignature::where('personal_num', $personal->id)->where('round', $evaluationRound)->get();
        $assessment_01 = Assessment01Score::where('personal_num', $personal->id)->where('round', $evaluationRound)->get();
        $assessment_02 = Assessment02Score::where('personal_num', $personal->id)->where('round', $evaluationRound)->get();
        $evaluation_component = EvaluationComponent::all();
        $criterion_choice = Criterion::all();
        $assessment_acknowledgement_choice = AssessmentAcknowledgement::all();
        $comment_choice = Comments::all();
        $assessment_acknowledgement_choice = AssessmentAcknowledgement::pluck('assessment_acknowledgement_name', 'id')->toArray();
        return view('page.result.show_full_time_employee', compact(
            'personal',
            'summarize_01',
            'summarize_02',
            'summarize_03',
            'above',
            'further',
            'personal_signature',
            'witness_signature',
            'criterion_choice',
            'assessment_acknowledgement_choice',
            'comment_choice',
            'evaluation_component',
            'assessment_01',
            'assessment_02',
            'assessment_acknowledgement_choice',
        ));
    }
    public function show_general_government($id)
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
        $summarize_01 = SummarizePart01::where('personal_num', $personal->id)->where('round', $evaluationRound)->get();
        $summarize_02 = SummarizePart02::where('personal_num', $personal->id)->where('round', $evaluationRound)->get();
        $summarize_03 = SummarizePart03::where('personal_num', $personal->id)->where('round', $evaluationRound)->get();
        $above = AboveComment::where('personal_num', $personal->id)->where('round', $evaluationRound)->get();
        $further = FurtherComment::where('personal_num', $personal->id)->where('round', $evaluationRound)->get();
        $personal_signature = PersonalSignature::where('personal_num', $personal->id)->where('round', $evaluationRound)->get();
        $witness_signature = WitnessSignature::where('personal_num', $personal->id)->where('round', $evaluationRound)->get();
        $assessment_01 = Assessment01Score::where('personal_num', $personal->id)->where('round', $evaluationRound)->get();
        $assessment_02 = Assessment02Score::where('personal_num', $personal->id)->where('round', $evaluationRound)->get();
        $evaluation_component = EvaluationComponent::all();
        $criterion_choice = Criterion::all();
        $assessment_acknowledgement_choice = AssessmentAcknowledgement::all();
        $comment_choice = Comments::all();
        $assessment_acknowledgement_choice = AssessmentAcknowledgement::pluck('assessment_acknowledgement_name', 'id')->toArray();
        return view('page.result.show_general_government_employee', compact(
            'personal',
            'summarize_01',
            'summarize_02',
            'summarize_03',
            'above',
            'further',
            'personal_signature',
            'witness_signature',
            'criterion_choice',
            'assessment_acknowledgement_choice',
            'comment_choice',
            'evaluation_component',
            'assessment_01',
            'assessment_02',
            'assessment_acknowledgement_choice',
            'evaluationRound',
            'personal_round_1',
        ));
    }
    public function show_ministry_of_public_health($id)
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
        $summarize_01 = SummarizePart01::where('personal_num', $personal->id)->where('round', $evaluationRound)->get();
        $summarize_02 = SummarizePart02::where('personal_num', $personal->id)->where('round', $evaluationRound)->get();
        $summarize_03 = SummarizePart03::where('personal_num', $personal->id)->where('round', $evaluationRound)->get();
        $above = AboveComment::where('personal_num', $personal->id)->where('round', $evaluationRound)->get();
        $further = FurtherComment::where('personal_num', $personal->id)->where('round', $evaluationRound)->get();
        $personal_signature = PersonalSignature::where('personal_num', $personal->id)->where('round', $evaluationRound)->get();
        $witness_signature = WitnessSignature::where('personal_num', $personal->id)->where('round', $evaluationRound)->get();
        $assessment_01 = Assessment01Score::where('personal_num', $personal->id)->where('round', $evaluationRound)->get();
        $assessment_02 = Assessment02Score::where('personal_num', $personal->id)->where('round', $evaluationRound)->get();
        $evaluation_component = EvaluationComponent::all();
        $criterion_choice = Criterion::all();
        $assessment_acknowledgement_choice = AssessmentAcknowledgement::all();
        $comment_choice = Comments::all();
        $assessment_acknowledgement_choice = AssessmentAcknowledgement::pluck('assessment_acknowledgement_name', 'id')->toArray();
        return view('page.result.show_ministry_of_public_health_employee', compact(
            'personal',
            'summarize_01',
            'summarize_02',
            'summarize_03',
            'above',
            'further',
            'personal_signature',
            'witness_signature',
            'criterion_choice',
            'assessment_acknowledgement_choice',
            'comment_choice',
            'evaluation_component',
            'assessment_01',
            'assessment_02',
            'assessment_acknowledgement_choice',
        ));
    }
    public function show_temporary($id)
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
        $summarize_01 = SummarizePart01::where('personal_num', $personal->id)->where('round', $evaluationRound)->get();
        $summarize_02 = SummarizePart02::where('personal_num', $personal->id)->where('round', $evaluationRound)->get();
        $summarize_03 = SummarizePart03::where('personal_num', $personal->id)->where('round', $evaluationRound)->get();
        $above = AboveComment::where('personal_num', $personal->id)->where('round', $evaluationRound)->get();
        $further = FurtherComment::where('personal_num', $personal->id)->where('round', $evaluationRound)->get();
        $personal_signature = PersonalSignature::where('personal_num', $personal->id)->where('round', $evaluationRound)->get();
        $witness_signature = WitnessSignature::where('personal_num', $personal->id)->where('round', $evaluationRound)->get();
        $assessment_01 = Assessment01Score::where('personal_num', $personal->id)->where('round', $evaluationRound)->get();
        $assessment_02 = Assessment02Score::where('personal_num', $personal->id)->where('round', $evaluationRound)->get();
        $evaluation_component = EvaluationComponent::all();
        $criterion_choice = Criterion::all();
        $assessment_acknowledgement_choice = AssessmentAcknowledgement::all();
        $comment_choice = Comments::all();
        $assessment_acknowledgement_choice = AssessmentAcknowledgement::pluck('assessment_acknowledgement_name', 'id')->toArray();
        return view('page.result.show_temporary_employee', compact(
            'personal',
            'summarize_01',
            'summarize_02',
            'summarize_03',
            'above',
            'further',
            'personal_signature',
            'witness_signature',
            'criterion_choice',
            'assessment_acknowledgement_choice',
            'comment_choice',
            'evaluation_component',
            'assessment_01',
            'assessment_02',
            'assessment_acknowledgement_choice',
        ));
    }
}

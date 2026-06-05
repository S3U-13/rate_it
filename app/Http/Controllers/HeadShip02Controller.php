<?php

namespace App\Http\Controllers;

use App\Models\Assessment02Score;
use App\Models\MainQuestion;
use App\Models\OtherQuestion;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class HeadShip02Controller extends Controller
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
            ->whereDoesntHave('assessment02', function ($query) use ($user, $evaluationRound) {
                $query->where('user_num', $user->id)
                    ->where('round', $evaluationRound); // ใช้ evaluationRound
            })
            ->get()
            ->filter(function ($personal) use ($evaluationRound) {
                return $personal->round == $evaluationRound; // ใช้ Accessor
            });

        $hasCompletedEvaluation = $personals->isEmpty();
        return view('page.capacity_rate_it.assessment_02.index', compact('personals', 'hasCompletedEvaluation', 'evaluationRound', 'now'));
    }

    public function create($id)
    {
        $personal = User::findOrFail($id);
        $MainQuestion = MainQuestion::all();
        $OtherQuestion = OtherQuestion::all();
        return view('page.capacity_rate_it.assessment_02.create', compact('MainQuestion', 'OtherQuestion', 'personal'));
    }

    public function store(Request $request)
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

        $validator = Validator::make($request->all(), [
            'personal_num' => 'required',
            'main_question_num' => 'required|array',
            'other_question_num' => 'required|array',
            'main_score' => 'required|array',
            'other_score' => 'required|array',
        ]);

        if ($validator->fails()) {
            return redirect()->route('page.capacity_rate_it.above.index')->with('error', 'เกิดข้อผิดพลาด กรุณาลองใหม่');
        }

        try {

            $multiply = 20;
            $total_main_score = array_sum($request->main_score);
            $total_other_score = array_sum($request->other_score);
            $total_score = $total_main_score + $total_other_score;
            $points = $total_score * $multiply;

            Assessment02Score::create([
                'personal_num' => $request->personal_num,
                'main_question_num' => json_encode($request->main_question_num),
                'other_question_num' => json_encode($request->other_question_num),
                'main_score' => json_encode($request->main_score),
                'other_score' => json_encode($request->other_score),
                'total_score' => $total_score,
                'points' =>  $points,
                'user_num' => Auth::id(),
                'round' => $evaluationRound,
            ]);
            return redirect()->route('page.capacity_rate_it.assessment_02.index')->with('success', 'ประเมินคะเเนนสำเร็จ!');
        } catch (\Throwable $th) {
            //throw $th;
            Log::error('Error occurred while storing data: ' . $th->getMessage());

            return redirect()->route('page.capacity_rate_it.assessment_02.index')->with('error', 'เกิดข้อผิดพลาด กรุณาลองใหม่');
        }
    }
}

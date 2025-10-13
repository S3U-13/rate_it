<?php

namespace App\Http\Controllers;

use App\Models\Assessment01Score;
use App\Models\OtherQuestion;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class HeadShip01Controller extends Controller
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

        if ($user->tier_num !== 4) {
            abort(403, 'คุณไม่มีสิทธิ์เข้าถึงหน้านี้'); // ส่งกลับข้อผิดพลาด 403
        }

        $groupMembers = User::where('group_num', $user->group_num)
            ->where('id', '!=', $user->id)
            ->get();

        $personals = User::where('group_num', $user->group_num)
            ->whereNotIn('tier_num', [4, 11, 12])
            ->where('role',  'user')
            ->whereDoesntHave('assessment01', function ($query) use ($user, $evaluationRound) {
                $query->where('user_num', $user->id)
                    ->where('round', $evaluationRound); // ใช้ evaluationRound
            })
            ->get()
            ->filter(function ($personal) use ($evaluationRound) {
                return $personal->round = $evaluationRound; // ใช้ Accessor
            });

        $hasCompletedEvaluation = $personals->isEmpty();

        return view('page.capacity_rate_it.assessment_01.index', compact('personals', 'hasCompletedEvaluation', 'evaluationRound', 'now'));
    }

    public function create($id)
    {
        $personal = User::findOrFail($id);
        $OtherQuestion = OtherQuestion::all();
        return view('page.capacity_rate_it.assessment_01.create', compact('OtherQuestion', 'personal'));
    }

    public function store(Request $request)
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

        $validator = Validator::make($request->all(), [
            'personal_num' => 'required',
            'other_question_num' => 'required|array',
            'other_score' => 'required|array',
        ]);

        if ($validator->fails()) {
            return redirect()->route('page.capacity_rate_it.above.index')->with('error', 'เกิดข้อผิดพลาด กรุณาลองใหม่');
        }

        try {

            $multiply = 20;
            $total_score = array_sum($request->other_score);
            $points = $total_score * $multiply;

            Assessment01Score::create([
                'personal_num' => $request->personal_num,
                'other_question_num' => json_encode($request->other_question_num),
                'other_score' => json_encode($request->other_score),
                'total_score' => $total_score,
                'points' =>  $points,
                'user_num' => Auth::id(),
                'round' => $evaluationRound,
            ]);
            return redirect()->route('page.capacity_rate_it.assessment_01.index')->with('success', 'ประเมินคะเเนนสำเร็จ!');
        } catch (\Throwable $th) {
            //throw $th;
            Log::error('Error occurred while storing data: ' . $th->getMessage());

            return redirect()->route('page.capacity_rate_it.assessment_01.index')->with('error', 'เกิดข้อผิดพลาด กรุณาลองใหม่');
        }
    }
}

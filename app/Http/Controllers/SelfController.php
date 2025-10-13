<?php

namespace App\Http\Controllers;

use App\Models\MainQuestion;
use App\Models\OtherQuestion;
use App\Models\SelfScore;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class SelfController extends Controller
{
    //
    public function index()
    {
        $now = Carbon::now('Asia/Bangkok');
        $startRound1 = Carbon::create($now->year - 1, 10, 1); // 1 ตุลาคม ปีนี้
        $endRound1 = Carbon::create($now->year, 3, 31); // 31 มีนาคม ปีหน้า

        $startRound2 = Carbon::create($now->year, 4, 1); // 1 เมษายน ปีนี้
        $endRound2 = Carbon::create($now->year, 9, 30); // 30 กันยายน ปีนี้

        $evaluationRound = null;
        if ($now->between($startRound1, $endRound1)) {
            $evaluationRound = 1;
        } elseif ($now->between($startRound2, $endRound2)) {
            $evaluationRound = 2;
        }

        $user = Auth::user();

        $personals = User::where('id', $user->id)
            ->where('group_num', $user->group_num)
            ->whereDoesntHave('selfIts', function ($query) use ($user, $evaluationRound) {
                $query->where('personal_num', $user->id)
                    ->where('round', $evaluationRound); // ใช้ evaluationRound
            })
            ->get()
            ->filter(function ($personal) use ($evaluationRound) {
                return $personal->round === $evaluationRound; // ใช้ Accessor
            });
        $hasCompletedEvaluation = $personals->isEmpty();
        return view('page.capacity_rate_it.self_rate_it.index', compact('personals', 'hasCompletedEvaluation', 'evaluationRound', 'now'));
    }

    public function create($id)
    {
        $personal = User::findOrFail($id);
        $MainQuestion = MainQuestion::all();
        $OtherQuestion = OtherQuestion::all();
        return view('page.capacity_rate_it.self_rate_it.create', compact('MainQuestion', 'OtherQuestion', 'personal'));
    }

    public function store(Request $request)
    {
        $now = Carbon::now('Asia/Bangkok');
        $startRound1 = Carbon::create($now->year - 1, 10, 1); // 1 ตุลาคม ปีนี้
        $endRound1 = Carbon::create($now->year, 3, 31); // 31 มีนาคม ปีหน้า

        $startRound2 = Carbon::create($now->year, 4, 1); // 1 เมษายน ปีนี้
        $endRound2 = Carbon::create($now->year, 9, 30); // 30 กันยายน ปีนี้


        // $startRound1 = Carbon::create($now->year, 1, 1); // เริ่ม 1 มกราคม
        // $endRound1 = Carbon::create($now->year, 6, 30); // จบ 30 มิถุนายน
        // $startRound2 = Carbon::create($now->year, 7, 1); // เริ่ม 1 กรกฎาคม
        // $endRound2 = Carbon::create($now->year, 12, 31); // จบ 31 ธันวาคม

        $evaluationRound = null;
        if ($now->between($startRound1, $endRound1)) {
            $evaluationRound = 1;
        } elseif ($now->between($startRound2, $endRound2)) {
            $evaluationRound = 2;
        }

        $validator = Validator::make($request->all(), [
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

            SelfScore::create([
                'personal_num' => Auth::id(),
                'main_question_num' => json_encode($request->main_question_num),
                'other_question_num' => json_encode($request->other_question_num),
                'main_score' => json_encode($request->main_score),
                'other_score' => json_encode($request->other_score),
                'total_score' => $total_score,
                'points' =>  $points,
                'round' => $evaluationRound,
            ]);
            return redirect()->route('page.capacity_rate_it.self_rate_it.index')->with('success', 'ประเมินคะเเนนสำเร็จ!');
        } catch (\Throwable $th) {
            //throw $th;
            Log::error('Error occurred while storing data: ' . $th->getMessage());

            return redirect()->route('page.capacity_rate_it.self_rate_it.index')->with('error', 'เกิดข้อผิดพลาด กรุณาลองใหม่');
        }
    }
}

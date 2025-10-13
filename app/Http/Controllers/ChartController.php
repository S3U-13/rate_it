<?php

namespace App\Http\Controllers;

use App\Models\Criterion;
use App\Models\Group;
use App\Models\SummarizePart01;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;


class ChartController extends Controller
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
        $startDate = null;
        $endDate = null;

        if ($now->between($startRound1, $endRound1)) {
            $evaluationRound = 1;
        } elseif ($now->between($startRound2, $endRound2)) {
            $evaluationRound = 2;
        }


        // ส่งข้อมูลไปยัง view
        $criterionNumbers = SummarizePart01::distinct()->pluck('criterion_num'); // ดึงค่า criterion_num ทั้งหมดที่มี
        $groupNumbers = SummarizePart01::join('users', 'summarize_part_01.personal_num', '=', 'users.id')
            ->distinct()
            ->pluck('users.group_num');
        $criterionCounts = [];

        foreach ($criterionNumbers as $num) {
            $criterionCounts[$num] = SummarizePart01::where('criterion_num', $num)
                ->where('round', $evaluationRound)
                ->count();
        }

        $criterion_num_count_by_group_num = [];

        foreach ($groupNumbers as $groupNum) {
            foreach ($criterionNumbers as $num) {
                $criterion_num_count_by_group_num[$groupNum][$num] = SummarizePart01::with('criterion')
                    ->whereHas('personal', function ($query) use ($groupNum) {
                        $query->where('group_num', $groupNum); // ใช้ค่า group_num ที่ดึงมาจากฐานข้อมูล
                    })->where('criterion_num', $num)
                    ->where('round', $evaluationRound)
                    ->count();
            }
        }
        $groups = Group::all();
        $criterion = Criterion::all();

        $criterion_num_count_by_group_num = [];

        foreach ($groups as $group) {
            $userCount = User::where('group_num', $group->id)
                ->where('role', 'user')
                ->whereNotIn('tier_num', [4, 11, 12])->count(); // นับจำนวน user ของกลุ่มนี้
            foreach ($criterion as $crit) {
                $criterion_num_count_by_group_num[$group->group_name]['user_count'] = $userCount;
                $criterion_num_count_by_group_num[$group->group_name]['criteria'][$crit->id] = SummarizePart01::whereHas('personal', function ($query) use ($group) {
                    $query->where('group_num', $group->id);
                })->where('criterion_num', $crit->id)
                    ->where('round', $evaluationRound)
                    ->count();
            }
        }

        // ตรวจสอบว่ากำหนดช่วงเวลาถูกต้องหรือไม่
        if (!$evaluationRound) {
            return view('admin.index', [
                'criterionCounts' => [],
                'criterion_num_count_by_group_num' => [],
                'groupNumbers' => [],
                'groups' => Group::all(),
                'criterion' => Criterion::all(),
                'results' => [],
                'evaluationRound' => null, // เพิ่มเพื่อเช็กใน view
            ]);
        }

        // ดึงข้อมูลกลุ่ม
        $User = Auth::user();
        $groups = Group::all();
        // เก็บผลลัพธ์แยกรอบและแยกตามกลุ่ม
        $results = [];

        foreach ($groups as $group) {
            // คำนวณคะแนนรวมของผู้ใช้ในแต่ละกลุ่ม
            $PersonalScores = SummarizePart01::selectRaw('SUM(total_points) as total_points_sum')
                ->whereHas('personal', function ($query) use ($group) {
                    $query->where('group_num', $group->id); // ใช้เงื่อนไข group_num จาก users table
                })
                ->whereNotNull('round') // ห้าม round เป็น null
                ->where('round', $evaluationRound) // ต้องตรงกับค่าที่ต้องการ
                ->first();

            // นับจำนวน user ในแต่ละ group_num
            $TotalUser = User::where('group_num', $group->id)
                ->where('role', 'user')
                ->whereNotIn('tier_num', [4, 11, 12])
                ->count();

            // คำนวณคะแนนเฉลี่ย
            $totalScoreSum = $PersonalScores ? $PersonalScores->total_points_sum : 0;
            $AverageTotalScoreGroupByUser = ($TotalUser > 0) ? number_format($totalScoreSum / $TotalUser, 2) : 0;

            // บันทึกผลลัพธ์โดยใช้ group_name เป็น key
            $results[$evaluationRound][$group->group_name] = [
                'startDate' => $startDate,
                'endDate' => $endDate,
                'totalScoreSum' => $totalScoreSum,
                'TotalUser' => $TotalUser,
                'AverageTotalScoreGroupByUser' => $AverageTotalScoreGroupByUser,
            ];
        }

        return view('admin.index', compact(
            'criterionCounts',
            'criterion_num_count_by_group_num',
            'groupNumbers',
            'groups',
            'criterion',
            'results',
        ));
    }
}

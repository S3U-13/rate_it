<?php

namespace App\Http\Controllers;

use App\Models\AboveComment;
use App\Models\Assessment01Score;
use App\Models\Assessment02Score;
use App\Models\FurtherComment;
use App\Models\PersonalScore;
use App\Models\PersonalSignature;
use App\Models\SelfScore;
use App\Models\SummarizePart01;
use App\Models\SummarizePart02;
use App\Models\SummarizePart03;
use App\Models\User;
use App\Models\WitnessSignature;
use App\Models\Group;
use App\Models\JobPosition;
use App\Models\JobType;
use App\Models\Tier;
use App\Models\WorkAffiliation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class PersonalController extends Controller
{
    //
    public function index(Request $request)
    {
        $entries = $request->input('entries', 10);
        $query = $request->input('query');
        $personals = User::when($query, function ($q) use ($query) {
            $q->where('id', 'like', '%' . $query . '%')
                ->orWhere('name', 'like', '%' . $query . '%')
                ->orWhere('user_name', 'like', '%' . $query . '%');
        })->paginate($entries);
        return view('admin.personal.index', compact('personals', 'entries'));
    }

    public function create_user()
    {
        $group = Group::all();
        $job_position = JobPosition::all();
        $job_type = JobType::all();
        $tier = Tier::all();
        $work_affiliation = WorkAffiliation::all();
        return view('admin.personal.create', compact('group', 'job_position', 'job_type', 'tier', 'work_affiliation'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make(request()->all(), [
            'name' => 'required|string|max:255',
            'user_name' => 'required|string|unique:users',
            'password' => 'required|min:8|confirmed',
            'group_num' => 'required',
            'job_position_num' => 'required',
            'job_type_num' => 'required',
            'tier_num' => 'required',
            'work_affiliation_num' => 'required',
            'contract_start_date' => 'nullable',
            'end_date_of_employment_contract' => 'nullable',
            'wages' => 'nullable',
            'role' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->route('page.capacity_rate_it.above.index')->with('error', 'เกิดข้อผิดพลาด กรุณาลองใหม่');
        }
        try {
            User::create([
                'name' => $request->name,
                'user_name' => $request->user_name,
                'password' => Hash::make($request->password),
                'role' => $request->role, // ค่าเริ่มต้นคือ user
                'group_num' => $request->group_num,
                'job_position_num' => $request->job_position_num,
                'job_type_num' => $request->job_type_num,
                'tier_num' => $request->tier_num,
                'work_affiliation_num' => $request->work_affiliation_num,
                'contract_start_date' => $request->contract_start_date,
                'end_date_of_employment_contract' => $request->end_date_of_employment_contract,
                'wages' => $request->wages,

            ]);
            return redirect()->route('admin.personal.index')->with('success', 'เพิ่มผู้ใช้สำเร็จ');
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->route('admin.personal.index')->with('error', 'เกิดข้อผิดพลาด กรุณาลองใหม่');
        }
    }

    public function edit_user($id)
    {
        $user = User::findOrFail($id);
        $group = Group::all();
        $job_position = JobPosition::all();
        $job_type = JobType::all();
        $tier = Tier::all();
        $work_affiliation = WorkAffiliation::all();
        return view('admin.personal.edit', compact('group', 'job_position', 'job_type', 'tier', 'work_affiliation', 'user'));
    }

    public function update_user(Request $request, $id)
    {

        $validator = Validator::make(request()->all(), [
            'name' => 'required|string|max:255',
            'user_name' => 'required|string|unique:users,user_name,' . $id,
            'password' => 'nullable|min:8|confirmed',
            'group_num' => 'required',
            'job_position_num' => 'required',
            'job_type_num' => 'required',
            'tier_num' => 'required',
            'work_affiliation_num' => 'required',
            'contract_start_date' => 'nullable',
            'end_date_of_employment_contract' => 'nullable',
            'wages' => 'nullable',
            'role' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->route('page.capacity_rate_it.above.index')->with('error', 'เกิดข้อผิดพลาด กรุณาลองใหม่');
        }

        try {
            $user = User::findOrFail($id);

            $updateData = [
                'name' => $request->name,
                'user_name' => $request->user_name,
                'role' => $request->role,
                'group_num' => $request->group_num,
                'job_position_num' => $request->job_position_num,
                'job_type_num' => $request->job_type_num,
                'tier_num' => $request->tier_num,
                'work_affiliation_num' => $request->work_affiliation_num,
                'contract_start_date' => $request->contract_start_date,
                'end_date_of_employment_contract' => $request->end_date_of_employment_contract,
                'wages' => $request->wages,
            ];

            if (!empty($request->password)) {
                $updateData['password'] = Hash::make($request->password);
            }
            $user->update($updateData);
            return redirect()->route('admin.personal.index')->with('success', 'เเก้ไขผู้ใช้สำเร็จ');
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->route('admin.personal.index')->with('error', 'เกิดข้อผิดพลาด กรุณาลองใหม่');
        }
    }

    public function updateRound()
    {
        try {
            // อัปเดตคอลัมน์ round ที่มีค่าเป็น 1 และ 2 ให้เป็น null
            PersonalScore::whereIn('round', [1, 2])
                ->update(['round' => null]);
            SelfScore::whereIn('round', [1, 2])
                ->update(['round' => null]);
            Assessment01Score::whereIn('round', [1, 2])
                ->update(['round' => null]);
            Assessment02Score::whereIn('round', [1, 2])
                ->update(['round' => null]);
            SummarizePart01::whereIn('round', [1, 2])
                ->update(['round' => null]);
            SummarizePart02::whereIn('round', [1, 2])
                ->update(['round' => null]);
            SummarizePart03::whereIn('round', [1, 2])
                ->update(['round' => null]);
            PersonalSignature::whereIn('round', [1, 2])
                ->update(['round' => null]);
            WitnessSignature::whereIn('round', [1, 2])
                ->update(['round' => null]);
            AboveComment::whereIn('round', [1, 2])
                ->update(['round' => null]);
            FurtherComment::whereIn('round', [1, 2])
                ->update(['round' => null]);

            return redirect()->route('admin.personal.index')->with('success', 'เริ่มรอบการประเมินใหม่ สำเร็จ!');
        } catch (\Exception $e) {
            return redirect()->route('admin.personal.index')->with('error', 'เกิดข้อผิดพลาดในการเริ่มรอบการประเมินใหม่');
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\OtherQuestion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SetOtherQuestionController extends Controller
{
    //
    public function index(Request $request)
    {
        $entries = $request->input('entries', 10); // จำนวนต่อหน้า
        $other_questions = OtherQuestion::paginate($entries);
        return view('admin.set_other_question.index', compact('other_questions','entries'));
    }

    public function create()
    {
        return view('admin.set_other_question.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'other_question_name' => 'required',
            'other_question_multiply' => 'required',
        ]);

        if ($validator->fails()) {
              return redirect()->route('page.capacity_rate_it.above.index')->with('error', 'เกิดข้อผิดพลาด กรุณาลองใหม่');
        }

        try {
            OtherQuestion::create([
                'other_question_name' => $request->other_question_name,
                'other_question_multiply' => $request->other_question_multiply,
            ]);
            return redirect()->route('admin.set_other_question.index')->with('success', 'เพิ่มข้อมูลสำเร็จ');
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->route('admin.set_other_question.index')->with('error', 'เพิ่มข้อมูลไม่สำเร็จ');
        }
    }

    public function edit($id)
    {
        $other_question = OtherQuestion::findOrFail($id);
        return view('admin.set_other_question.edit', compact('other_question'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'other_question_name' => 'required',
            'other_question_status' => 'required',
            'other_question_multiply' => 'required',
        ]);

        if ($validator->fails()) {
              return redirect()->route('page.capacity_rate_it.above.index')->with('error', 'เกิดข้อผิดพลาด กรุณาลองใหม่');
        }

        try {
            $otherQuestion = OtherQuestion::findOrFail($id);
            // อัปเดตข้อมูล
            $otherQuestion->update([
                'other_question_name' => $request->other_question_name,
                'other_question_status' => $request->other_question_status,
                'other_question_multiply' => $request->other_question_multiply,
            ]);
            return redirect()->route('admin.set_other_question.index')->with('success', 'เพิ่มข้อมูลสำเร็จ');
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->route('admin.set_other_question.index')->with('error', 'เพิ่มข้อมูลไม่สำเร็จ');
        }
    }
}

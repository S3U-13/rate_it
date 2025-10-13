<?php

namespace App\Http\Controllers;

use App\Models\MainQuestion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use function Laravel\Prompts\error;

class SetMainQuestionController extends Controller
{
    //
    public function index(Request $request)
    {
        $entries = $request->input('entries', 10); // จำนวนต่อหน้า
        $main_questions = MainQuestion::paginate($entries);
        return view('admin.set_main_question.index', compact('main_questions', 'entries'));
    }

    public function create()
    {
        return view('admin.set_main_question.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'main_question_name' => 'required',
            'main_question_multiply' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->route('page.capacity_rate_it.above.index')->with('error', 'เกิดข้อผิดพลาด กรุณาลองใหม่');
        }

        try {
            MainQuestion::create([
                'main_question_name' => $request->main_question_name,
                'main_question_multiply' => $request->main_question_multiply,
            ]);
            return redirect()->route('admin.set_main_question.index')->with('success', 'เพิ่มข้อมูลสำเร็จ');
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->route('admin.set_main_question.index')->with('error', 'เพิ่มข้อมูลไม่สำเร็จ');
        }
    }

    public function edit($id)
    {
        $main_question = MainQuestion::findOrFail($id);
        return view('admin.set_main_question.edit', compact('main_question'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'main_question_name' => 'required',
            'main_question_status' => 'required',
            'main_question_multiply' => 'required',
        ]);

        if ($validator->fails()) {
             return redirect()->route('page.capacity_rate_it.above.index')->with('error', 'เกิดข้อผิดพลาด กรุณาลองใหม่');
        }

        try {
            $mainQuestion = MainQuestion::findOrFail($id);
            // อัปเดตข้อมูล
            $mainQuestion->update([
                'main_question_name' => $request->main_question_name,
                'main_question_status' => $request->main_question_status,
                'main_question_multiply' => $request->main_question_multiply,
            ]);
            return redirect()->route('admin.set_main_question.index')->with('success', 'เพิ่มข้อมูลสำเร็จ');
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->route('admin.set_main_question.index')->with('error', 'เพิ่มข้อมูลไม่สำเร็จ');
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Indicator;
use App\Models\MainQuestion;
use App\Models\OtherQuestion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SetIndicatorController extends Controller
{
    public function index(Request $request)
    {
        $entries = $request->input('entries', 10); // จำนวนต่อหน้า
        $indicators = Indicator::paginate($entries); // ไม่ต้องใส่เงื่อนไขค้นหา
        return view('admin.set_indicator.index', compact('indicators', 'entries'));
    }
    public function create()
    {
        $main_question = MainQuestion::all();
        $other_question = OtherQuestion::all();
        return view('admin.set_indicator.create', compact('main_question', 'other_question'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'indicator_name' => 'required',
            'main_question_num' => 'nullable',
            'other_question_num' => 'nullable',
        ]);

        if ($validator->fails()) {
            return redirect()->route('page.capacity_rate_it.above.index')->with('error', 'เกิดข้อผิดพลาด กรุณาลองใหม่');
        }

        try {
            Indicator::create([
                'indicator_name' => $request->indicator_name,
                'main_question_num' => $request->main_question_num,
                'other_question_num' => $request->other_question_num,
            ]);
            return redirect()->route('admin.set_indicator.index')->with('success', 'เพิ่มข้อมูลสำเร็จ');
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->route('admin.set_indicator.index')->with('error', 'เพิ่มข้อมูลไม่สำเร็จ');
        }
    }

    public function edit($id)
    {
        $indicator = Indicator::findOrFail($id);
        $main_question = MainQuestion::all();
        $other_question = OtherQuestion::all();
        return view('admin.set_indicator.edit', compact('indicator', 'main_question', 'other_question'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'indicator_name' => 'required',
            'main_question_num' => 'nullable',
            'other_question_num' => 'nullable',
            'indicator_status' => 'required',
        ]);

        if ($validator->fails()) {
              return redirect()->route('page.capacity_rate_it.above.index')->with('error', 'เกิดข้อผิดพลาด กรุณาลองใหม่');
        }

        try {
            $Indicator = Indicator::findOrFail($id);
            // อัปเดตข้อมูล
            $Indicator->update([
                'indicator_name' => $request->indicator_name,
                'main_question_num' => $request->main_question_num,
                'other_question_num' => $request->other_question_num,
                'indicator_status' => $request->indicator_status,
            ]);
            return redirect()->route('admin.set_indicator.index')->with('success', 'เพิ่มข้อมูลสำเร็จ');
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->route('admin.set_indicator.index')->with('error', 'เพิ่มข้อมูลไม่สำเร็จ');
        }
    }
}

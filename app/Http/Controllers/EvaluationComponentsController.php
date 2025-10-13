<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\EvaluationComponent;
use App\Models\EvaluationComponentFullTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EvaluationComponentsController extends Controller
{
    //
    public function index()
    {
        $EvaluationComponentGenerals = EvaluationComponent::all();
        $EvaluationComponentFullTimes = EvaluationComponentFullTime::all();
        return view('admin.evaluation_components.index', compact('EvaluationComponentGenerals', 'EvaluationComponentFullTimes'));
    }
    public function create_general()
    {
        return view('admin.evaluation_components.create_general');
    }
    public function create_full_time()
    {
        return view('admin.evaluation_components.create_full_time');
    }
    public function store_general(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'component_name' => 'required',
            'weight_score' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->route('page.capacity_rate_it.above.index')->with('error', 'เกิดข้อผิดพลาด กรุณาลองใหม่');
        }

        try {
            EvaluationComponent::create([
                'component_name' => $request->component_name,
                'weight_score' => $request->weight_score,
            ]);
            return redirect()->route('admin.evaluation_components.index')->with('success', 'เพิ่มองค์ประกอบการ
ประเมินสำเร็จ');
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->route('admin.evaluation_components.index')->with('error', 'เพิ่มองค์ประกอบการ
ประเมินไม่สำเร็จ');
        }
    }
    public function store_full_time(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'component_name' => 'required',
            'weight_score' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->route('page.capacity_rate_it.above.index')->with('error', 'เกิดข้อผิดพลาด กรุณาลองใหม่');
        }

        try {
            EvaluationComponentFullTime::create([
                'component_name' => $request->component_name,
                'weight_score' => $request->weight_score,
            ]);
            return redirect()->route('admin.evaluation_components.index')->with('success', 'เพิ่มองค์ประกอบการ
ประเมินสำเร็จ');
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->route('admin.evaluation_components.index')->with('error', 'เพิ่มองค์ประกอบการ
ประเมินไม่สำเร็จ');
        }
    }
    public function edit_general($id)
    {
        $EvaluationComponentGeneral = EvaluationComponent::findOrFail($id);
        return view('admin.evaluation_components.edit_general', compact('EvaluationComponentGeneral'));
    }
    public function edit_full_time($id)
    {
        $EvaluationComponentFullTime = EvaluationComponentFullTime::findOrFail($id);
        return view('admin.evaluation_components.edit_full_time', compact('EvaluationComponentFullTime'));
    }
    public function update_general(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'component_name' => 'required',
            'component_status' => 'required',
            'weight_score' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->route('page.capacity_rate_it.above.index')->with('error', 'เกิดข้อผิดพลาด กรุณาลองใหม่');
        }
        try {
            $evaluationComponentGeneral = EvaluationComponent::findOrFail($id);

            $evaluationComponentGeneral->update([
                'component_name' => $request->component_name,
                'component_status' => $request->component_status,
                'weight_score' => $request->weight_score,
            ]);
            return redirect()->route('admin.evaluation_components.index')->with('success', 'เเก้ไของค์ประกอบการ
ประเมินสำเร็จ');
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->route('admin.evaluation_components.index')->with('success', 'เเก้องค์ประกอบการ
ประเมินไม่โสำเร็จ');
        }
    }
    public function update_full_time(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'component_name' => 'required',
            'component_status' => 'required',
            'weight_score' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->route('page.capacity_rate_it.above.index')->with('error', 'เกิดข้อผิดพลาด กรุณาลองใหม่');
        }
        try {
            $evaluationComponentFullTime = EvaluationComponentFullTime::findOrFail($id);

            $evaluationComponentFullTime->update([
                'component_name' => $request->component_name,
                'component_status' => $request->component_status,
                'weight_score' => $request->weight_score,
            ]);
            return redirect()->route('admin.evaluation_components.index')->with('success', 'เเก้ไของค์ประกอบการ
ประเมินสำเร็จ');
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->route('admin.evaluation_components.index')->with('success', 'เเก้องค์ประกอบการ
ประเมินไม่โสำเร็จ');
        }
    }
}

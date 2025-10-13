@extends('layouts.admin')

@section('title')
    แก้ไของค์ประกอบการประเมิน(ลูกจ้างประจำ)
@endsection

@section('content')
    <div class="p-4 sm:ml-64">
        <div class="mt-14 max-w-3xl mx-auto">
            <h1 class="pt-6 text-2xl font-semibold text-gray-800">แก้ไของค์ประกอบ(ลูกจ้างประจำ)</h1>
            <div class="bg-white rounded-lg shadow-xl mt-6 border border-gray-200 p-6">
                <form action="{{ route('admin.evaluation_components.update_full_time', $EvaluationComponentFullTime->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="space-y-6">
                        <!-- Field คำถาม -->
                        <div>
                            <label for="component_name" class="block text-sm font-medium text-gray-700">
                                คำถาม
                            </label>
                            <input type="text" name="component_name" id="component_name"
                                value="{{ $EvaluationComponentFullTime->component_name }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                placeholder="กรอกหัวข้อองค์ประกอบการประเมิน" />
                        </div>

                        <!-- Field สถานะ -->
                        <div>
                            <span class="block text-sm font-medium text-gray-700">สถานะ</span>
                            <div class="mt-2 flex items-center space-x-6">
                                <label class="inline-flex items-center">
                                    <input type="radio" name="component_status" value="on"
                                        {{ $EvaluationComponentFullTime->component_status === 'on' ? 'checked' : '' }}
                                        class="form-radio text-indigo-600">
                                    <span class="ml-2">ทำงาน</span>
                                </label>
                                <label class="inline-flex items-center">
                                    <input type="radio" name="component_status" value="off"
                                        {{ $EvaluationComponentFullTime->component_status === 'off' ? 'checked' : '' }}
                                        class="form-radio text-indigo-600">
                                    <span class="ml-2">ไม่ทำงาน</span>
                                </label>
                            </div>
                        </div>

                        <!-- Field น้ำหนัก (ตัวคูณ) -->
                        <div>
                            <label for="weight_score" class="block text-sm font-medium text-gray-700">
                                น้ำหนัก (ตัวคูณ)
                            </label>
                            <input type="text" name="weight_score" id="weight_score"
                                value="{{ $EvaluationComponentFullTime->weight_score }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                placeholder="กรอกน้ำหนัก" />
                        </div>
                    </div>

                    <!-- ปุ่ม Submit -->
                    <div class="mt-8">
                        <button type="submit"
                            class="w-full inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-[#138f3c] hover:bg-green-700">
                            ยืนยัน
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@extends('layouts.admin')

@section('title')
    other question edit
@endsection

@section('content')
    <div class="p-4 sm:ml-64">
        <div class="mt-14 max-w-3xl mx-auto">
            <h1 class="pt-6 text-2xl font-semibold text-gray-800">แก้ไขคำถามอื่นๆ</h1>
            <div class="bg-white rounded-lg shadow-xl mt-6 border border-gray-200 p-6 shadow-xl">
                <form action="{{ route('admin.set_other_question.update', $other_question->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="space-y-6">
                        <!-- Field คำถาม -->
                        <div>
                            <label for="other_question_name" class="block text-sm font-medium text-gray-700">
                                คำถาม
                            </label>
                            <input type="text" name="other_question_name" id="other_question_name"
                                value="{{ $other_question->other_question_name }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                placeholder="กรอกคำถาม" />
                        </div>

                        <!-- Field สถานะ -->
                        <div>
                            <span class="block text-sm font-medium text-gray-700">สถานะ</span>
                            <div class="mt-2 flex items-center space-x-6">
                                <label class="inline-flex items-center">
                                    <input type="radio" name="other_question_status" value="on"
                                        {{ $other_question->other_question_status === 'on' ? 'checked' : '' }}
                                        class="form-radio text-indigo-600">
                                    <span class="ml-2">ทำงาน</span>
                                </label>
                                <label class="inline-flex items-center">
                                    <input type="radio" name="other_question_status" value="off"
                                        {{ $other_question->other_question_status === 'off' ? 'checked' : '' }}
                                        class="form-radio text-indigo-600">
                                    <span class="ml-2">ไม่ทำงาน</span>
                                </label>
                            </div>
                        </div>

                        <!-- Field น้ำหนัก (ตัวคูณ) -->
                        <div>
                            <label for="other_question_multiply" class="block text-sm font-medium text-gray-700">
                                น้ำหนัก (ตัวคูณ)
                            </label>
                            <input type="text" name="other_question_multiply" id="other_question_multiply"
                                value="{{ $other_question->other_question_multiply }}"
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

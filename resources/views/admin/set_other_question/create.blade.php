@extends('layouts.admin')

@section('title')
    other question create
@endsection

@section('content')
    <div class="p-4 sm:ml-64">
        <div class=" mt-14 max-w-3xl mx-auto">
            <h1 class="pt-6 text-2xl">เพิ่มคำคามอื่นๆ</h1>
            <div class="bg-white rounded-lg shadow-xl mt-6 max-w-3xl mx-auto border border-gray-200 shadow-xl">

                <form action="{{ route('admin.set_other_question.store') }}" method="POST" class="px-6 py-8">
                    @csrf
                    <div class="grid grid-cols-1 gap-6">
                        <div>
                            <label for="other_question_name" class="block text-sm font-medium text-gray-700">
                                คำถาม
                            </label>
                            <input type="text" name="other_question_name" id="other_question_name" placeholder="กรอกคำถาม"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" />
                        </div>
                        <div>
                            <label for="other_question_multiply" class="block text-sm font-medium text-gray-700">
                                น้ำหนัก (ตัวคูณ)
                            </label>
                            <input type="text" name="other_question_multiply" id="other_question_multiply"
                                placeholder="กรอกน้ำหนัก"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" />
                        </div>
                    </div>
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

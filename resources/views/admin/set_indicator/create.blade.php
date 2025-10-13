@extends('layouts.admin')

@section('title')
    indicator create
@endsection

@section('content')
    <div class="p-4 sm:ml-64">
        <div class=" mt-14 max-w-3xl mx-auto">
            <h1 class="pt-6 text-2xl">เพิ่มคำคามอื่นๆ</h1>
            <div class="bg-white rounded-lg shadow-xl mt-6 max-w-3xl mx-auto border border-gray-200 shadow-xl">

                <form action="{{ route('admin.set_indicator.store') }}" method="POST" class="px-6 py-8">
                    @csrf
                    <div class="grid grid-cols-1 gap-6">
                        <div>
                            <label for="indicator_name" class="block text-sm font-medium text-gray-700">
                                คำถาม
                            </label>
                            <input type="text" name="indicator_name" id="indicator_name" placeholder="กรอกคำถาม"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" />
                        </div>
                        <div class="flex justify-between">
                            <div>
                                <label for="main_question_num" class="block text-sm font-medium text-gray-700">
                                    ผูกคำถามหลัก
                                </label>
                                <select name="main_question_num"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                    <option value="">ไม่ผูก</option>
                                    @foreach ($main_question as $main)
                                        <option value="{{ $main->id }}">{{ $main->main_question_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label for="other_question_num" class="block text-sm font-medium text-gray-700">
                                    ผูกคำถามอื่นๆ
                                </label>
                                <select name="other_question_num"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                    <option value="">ไม่ผูก</option>
                                    @foreach ($other_question as $other)
                                        <option value="{{ $other->id }}">{{ $other->other_question_name }}</option>
                                    @endforeach
                                </select>
                            </div>
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

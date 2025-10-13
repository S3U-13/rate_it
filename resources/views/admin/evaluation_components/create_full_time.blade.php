@extends('layouts.admin')

@section('title')
    เพิ่มองค์ประกอบ(ลูกจ้างประจำ)
@endsection

@section('content')
    <div class="p-4 sm:ml-64">
        <div class=" mt-14 max-w-3xl mx-auto">
            <h1 class="pt-6 text-2xl">เพิ่มองค์ประกอบ(ลูกจ้างประจำ)</h1>
            <div class="bg-white rounded-lg shadow-xl mt-6 max-w-3xl mx-auto border border-gray-200 shadow-xl">

                <form action="{{ route('admin.evaluation_components.store_full_time') }}" method="POST" class="px-6 py-8">
                    @csrf
                    <div class="grid grid-cols-1 gap-6">
                        <div>
                            <label for="component_name" class="block text-sm font-medium text-gray-700">
                                หัวข้อองค์ประกอบการประเมิน
                            </label>
                            <input type="text" name="component_name" id="component_name"
                                placeholder="กรอกหัวข้อองค์ประกอบการประเมิน"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" />
                        </div>
                        <div>
                            <label for="weight_score" class="block text-sm font-medium text-gray-700">
                                น้ำหนัก (ตัวคูณ)
                            </label>
                            <input type="text" name="weight_score" id="weight_score" placeholder="กรอกน้ำหนัก"
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

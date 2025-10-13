@extends('layouts.admin')

@section('title')
    evaluation components
@endsection

@section('content')
    <div class="p-2 sm:ml-64">
        <div class="pt-2 rounded-lg shadow-xl mt-12 pb-4">
            @if (session('success'))
                <div
                    class="bg-green-100 text-green-700 text-center p-4 rounded-md shadow-sm flex justify-between items-center">
                    <div><i class="bi bi-check-circle-fill"></i> {{ session('success') }}</div>
                    <button type="button" class="text-green-700 hover:text-green-900"
                        onclick="this.parentElement.style.display='none';">
                        &times;
                    </button>
                </div>
            @elseif(session('error'))
                <div class="bg-red-100 text-red-700 text-center p-4 rounded-md shadow-sm flex justify-between items-center">
                    <div><i class="bi bi-check-circle-fill"></i> {{ session('error') }}</div>
                    <button type="button" class="text-red-700 hover:text-red-900"
                        onclick="this.parentElement.style.display='none';">
                        &times;
                    </button>
                </div>
            @endif
            <div class="flex flex-col md:flex-row">
                <div class="w-full md:w-1/2 p-4">
                    <!-- ปุ่มเพิ่มคำถามอื่นๆ -->
                    <div class="flex justify-end mb-4">
                        <a href="{{ route('admin.evaluation_components.create_general') }}"
                            class="bg-green-500 hover:bg-green-700 text-white font-medium py-2 px-4 rounded-lg transition duration-200">
                            เพิ่มองค์ประกอบการประเมิน
                        </a>
                    </div>

                    <!-- ตารางแสดงรายการ -->
                    <div class="bg-white shadow-md rounded-lg overflow-hidden">
                        <!-- Header ของตาราง -->
                        <div class="bg-[#138f3c] text-white text-center py-3">
                            <h5 class="text-lg font-semibold">📋องค์ประกอบทั่วไป</h5>
                        </div>

                        <div class="overflow-x-auto">
                            <table class="min-w-full border border-gray-300">
                                <thead class="bg-[#138f3c] text-white text-center">
                                    <tr>
                                        <th class="px-4 py-2 border w-1/10">ลำดับ</th>
                                        <th class="px-4 py-2 border w-3/7">องค์ประกอบการประเมิน</th>
                                        <th class="px-4 py-2 border w-1/10">สถานะ</th>
                                        <th class="px-4 py-2 border w-1/6">น้ำหนัก (ตัวคูณ)</th>
                                        <th class="px-4 py-2 border w-3/6">การดำเนินการ</th>
                                    </tr>
                                </thead>
                                <tbody class="text-center">
                                    @foreach ($EvaluationComponentGenerals as $item)
                                        <tr class="border hover:bg-gray-100">
                                            <td class="px-4 py-2 border">{{ $loop->iteration }}</td>
                                            <td class="px-4 py-2 text-left border">{{ $item->component_name }}</td>
                                            <td class="px-4 py-2 text-left border">{{ $item->component_status }}</td>
                                            <td class="px-4 py-2 text-left border">
                                                {{ $item->weight_score }}
                                            </td>
                                            <td class="px-4 py-2 border">
                                                <div class="flex justify-center space-x-2">
                                                    <a href="{{ route('admin.evaluation_components.edit_general', $item->id) }}"
                                                        class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded-md text-sm transition duration-200">
                                                        <i class="bi bi-pencil-square"></i> แก้ไข
                                                    </a>
                                                    <a href="#"
                                                        class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded-md text-sm transition duration-200">
                                                        <i class="bi bi-trash"></i> ลบ
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="w-full md:w-1/2 p-4">
                    <!-- ปุ่มเพิ่มคำถามอื่นๆ -->
                    <div class="flex justify-end mb-4">
                        <a href="{{ route('admin.evaluation_components.create_full_time') }}"
                            class="bg-green-500 hover:bg-green-700 text-white font-medium py-2 px-4 rounded-lg transition duration-200">
                            เพิ่มองค์ประกอบการประเมิน(ลูกจ้างประจำ)
                        </a>
                    </div>

                    <!-- ตารางแสดงรายการ -->
                    <div class="bg-white shadow-md rounded-lg overflow-hidden">
                        <!-- Header ของตาราง -->
                        <div class="bg-[#138f3c] text-white text-center py-3">
                            <h5 class="text-lg font-semibold">📋องค์ประกอบ(ลูกจ้างประจำ)</h5>
                        </div>

                        <div class="overflow-x-auto">
                            <table class="min-w-full border border-gray-300">
                                <thead class="bg-[#138f3c] text-white text-center">
                                    <tr>
                                        <th class="px-4 py-2 border w-1/10">ลำดับ</th>
                                        <th class="px-4 py-2 border w-3/7">องค์ประกอบการประเมิน</th>
                                        <th class="px-4 py-2 border w-1/10">สถานะ</th>
                                        <th class="px-4 py-2 border w-1/6">น้ำหนัก (ตัวคูณ)</th>
                                        <th class="px-4 py-2 border w-3/6">การดำเนินการ</th>
                                    </tr>
                                </thead>
                                <tbody class="text-center">
                                    @foreach ($EvaluationComponentFullTimes as $item)
                                        <tr class="border hover:bg-gray-100">
                                            <td class="px-4 py-2 border">{{ $loop->iteration }}</td>
                                            <td class="px-4 py-2 text-left border">{{ $item->component_name }}</td>
                                            <td class="px-4 py-2 text-left border">{{ $item->component_status }}</td>
                                            <td class="px-4 py-2 text-left border">
                                                {{ $item->weight_score }}
                                            </td>
                                            <td class="px-4 py-2 border">
                                                <div class="flex justify-center space-x-2">
                                                    <a href="{{ route('admin.evaluation_components.edit_full_time', $item->id) }}"
                                                        class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded-md text-sm transition duration-200">
                                                        <i class="bi bi-pencil-square"></i> แก้ไข
                                                    </a>
                                                    <a href="#"
                                                        class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded-md text-sm transition duration-200">
                                                        <i class="bi bi-trash"></i> ลบ
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

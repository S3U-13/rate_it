@extends('layouts.admin')

@section('title')
    indicator index
@endsection

@section('content')
    <div class="p-2 sm:ml-64">
        <div class="pt-2 rounded-lg shadow-xl mt-14 pb-4">
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

            <div class="container mx-auto p-4">
                <!-- ปุ่มเพิ่มคำถามอื่นๆ -->
                <div class="flex justify-end mb-4">
                    <a href="{{ route('admin.set_indicator.create') }}"
                        class="bg-green-500 hover:bg-green-700 text-white font-medium py-2 px-4 rounded-lg transition duration-200">
                        เพิ่มคำถามอื่นๆ
                    </a>
                </div>

                <!-- ตารางแสดงรายการ -->
                <div class="bg-white shadow-md rounded-lg overflow-hidden">
                    <!-- Header ของตาราง -->
                    <div class="bg-[#138f3c] text-white text-center py-3">
                        <h5 class="text-lg font-semibold">📋 หัวหน้าประเมินส่วนที่ 2</h5>
                    </div>

                    <div class="overflow-x-auto">

                        <div class="text-[#707c8a] p-2">
                            <form class="flex gap-2 items-center" method="GET" action="{{ url()->current() }}">
                                <p>Show</p>
                                <select name="entries" class="border p rounded-lg" onchange="this.form.submit()">
                                    <option value="10" {{ request('entries') == 10 ? 'selected' : '' }}>10</option>
                                    <option value="25" {{ request('entries') == 25 ? 'selected' : '' }}>25</option>
                                    <option value="50" {{ request('entries') == 50 ? 'selected' : '' }}>50</option>
                                    <option value="100" {{ request('entries') == 100 ? 'selected' : '' }}>100
                                    </option>
                                </select>
                                <p>entries</p>
                            </form>
                        </div>

                        <table class="min-w-full border border-gray-300">
                            <thead class="bg-[#138f3c] text-white text-center">
                                <tr>
                                    <th class="px-4 py-2 border w-1/10">ลำดับ</th>
                                    <th class="px-4 py-2 border w-3/7">คำถาม</th>
                                    <th class="px-4 py-2 border w-1/10">สถานะ</th>
                                    <th class="px-4 py-2 border w-1/6">หมวดคำถามหลัก</th>
                                    <th class="px-4 py-2 border w-3/6">หมวดคำถามอื่น</th>
                                    <th class="px-4 py-2 border w-3/6">การดำเนินการ</th>
                                </tr>
                            </thead>
                            <tbody class="text-center">
                                @foreach ($indicators as $item)
                                    <tr class="border hover:bg-gray-100">
                                        <td class="px-4 py-2 border">
                                            {{ ($indicators->currentPage() - 1) * $indicators->perPage() + $loop->iteration }}
                                        </td>
                                        <td class="px-4 py-2 text-left border">{{ $item->indicator_name }}</td>
                                        <td class="px-4 py-2 text-left border">{{ $item->indicator_status }}</td>
                                        <td class="px-4 py-2 text-left border">
                                            {{ $item->mainQuestion->main_question_name ?? 'ไม่มีหมวดที่ผูกไว้' }}
                                        </td>
                                        <td class="px-4 py-2 text-left border">
                                            {{ $item->otherQuestion->other_question_name ?? 'ไม่มีหมวดที่ผูกไว้' }}
                                        </td>
                                        <td class="px-4 py-2 border">
                                            <div class="flex justify-center space-x-2">
                                                <a href="{{ route('admin.set_indicator.edit', $item->id) }}"
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
                        <div class="flex justify-between items-center mt-4 p-2">
                            <p class="text-[#006622] ml-[1rem]">
                                จำนวนข้อมูลในหน้าปัจจุบัน: {{ $indicators->count() }} |
                                แสดงข้อมูลจาก: {{ $indicators->firstItem() }} ถึง {{ $indicators->lastItem() }} |
                                จำนวนข้อมูลทั้งหมด: {{ $indicators->total() }}
                            </p>

                            <div class="flex gap-2 mr-[1rem]">
                                <!-- ปุ่มย้อนกลับ -->
                                @if ($indicators->previousPageUrl())
                                    <a href="{{ $indicators->appends(['entries' => $entries])->previousPageUrl() }}"
                                        class="p-2 bg-gray-100 text-gray-500 rounded-lg hover:scale-105 hover:bg-gray-200 shadow-xl">
                                        ย้อนกลับ
                                    </a>
                                @endif

                                <!-- ปุ่มถัดไป -->
                                @if ($indicators->nextPageUrl())
                                    <a href="{{ $indicators->appends(['entries' => $entries])->nextPageUrl() }}"
                                        class="p-2 bg-gray-100 text-gray-500 rounded-lg hover:bg-gray-200 shadow-xl">
                                        ถัดไป
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

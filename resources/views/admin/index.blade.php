@extends('layouts.admin')

@section('title')
    Admin Dashboard
@endsection

@section('content')
    <div class="p-2 sm:ml-64 mt-2">
        <div class="pt-2 mt-14 pb-4 pl-2">
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
            @elseif(session('message'))
                <div
                    class="bg-green-100 text-green-700 text-center p-4 rounded-md shadow-sm flex justify-between items-center">
                    <div><i class="bi bi-check-circle-fill"></i> {{ session('message') }}</div>
                    <button type="button" class="text-green-700 hover:text-green-900"
                        onclick="this.parentElement.style.display='none';">
                        &times;
                    </button>
                </div>
            @endif
            <div class="flex gap-4">
                <div>
                    <div class="mb-4 p-2 border border-gray-200 shadow-lg rounded-lg w-[65rem]">
                        <h1 class="text-2xl">จำนวนทั้งหมด</h1>
                        <div class="mt-2 flex justify-between pb-2 pl-[1rem]">
                            <div class="w-[11rem] p-2 border border-gray-200 shadow-lg rounded-lg">
                                <h1 class="text-center">เกณฑ์ดีเด่น
                                    {{ isset($criterionCounts[1]) ? $criterionCounts[1] : '0' }} คน</h1>
                            </div>
                            <div class="w-[11rem] p-2 border border-gray-200 shadow-lg rounded-lg">
                                <h1 class="text-center">เกณฑ์ดีมาก
                                    {{ isset($criterionCounts[2]) ? $criterionCounts[2] : '0' }} คน</h1>
                            </div>
                            <div class="w-[11rem] p-2 border border-gray-200 shadow-lg rounded-lg">
                                <h1 class="text-center">เกณฑ์ดี
                                    {{ isset($criterionCounts[3]) ? $criterionCounts[3] : '0' }} คน</h1>
                            </div>
                            <div class="w-[11rem] p-2 border border-gray-200 shadow-lg rounded-lg">
                                <h1 class="text-center">เกณฑ์พอใช้
                                    {{ isset($criterionCounts[4]) ? $criterionCounts[4] : '0' }} คน</h1>
                            </div>
                            <div class="w-[14rem] p-2 border border-gray-200 shadow-lg rounded-lg">
                                <h1 class="text-center">เกณฑ์ต้องปรับปรุง
                                    {{ isset($criterionCounts[5]) ? $criterionCounts[5] : '0' }} คน</h1>
                            </div>
                        </div>
                    </div>
                    <div class="p-2 border border-gray-200 shadow-lg rounded-lg w-[65rem] h-[44.3rem] overflow-auto">
                        <h1 class="text-2xl">จำนวนเเยกตามกลุ่ม</h1>
                        <table class="border border-gray-400 mt-2">
                            <thead>
                                <tr class="border-b border-gray-400 bg-[#138f3c]">
                                    <th class="p-1 border-r border-gray-400 text-white">ชื่อกลุ่มงาน</th>
                                    @foreach ($criterion as $crit)
                                        <th class="p-1 w-[7rem] border-r border-gray-400 text-white">
                                            {{ $crit->criterion_name }}</th>
                                    @endforeach
                                    <th class="p-1 border-r border-gray-400 w-[8rem] text-white">บุคลกรทั้งหมด
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($criterion_num_count_by_group_num as $groupName => $data)
                                    <tr>
                                        @if ($loop->index >= 1)
                                            {{-- แสดงตั้งแต่ index 1 ขึ้นไป (ID 2 ขึ้นไป) --}}
                                            <td class=" border-r p-1 border-b border-gray-400 bg-gray-200">
                                                {{ $groupName }}
                                            </td>
                                            @foreach ($data['criteria'] as $criterionId => $count)
                                                <td class="p-1 text-right border-r border-b border-gray-400">
                                                    {{ $count }}
                                                    คน</td>
                                            @endforeach
                                            <td class="text-right p-1 border-b border-gray-400"> {{ $data['user_count'] }}
                                                คน
                                            </td>
                                        @endif
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="">
                    <div class="w-[35rem] h-[52rem] border border-gray-200 shadow-lg rounded-lg mb-4 p-2">
                        <h1 class="text-center">กราฟสรุปผล (ตามรอบ)</h1>
                        @include('layouts.bar_chart_by_group_num_round_1')
                    </div>
                    {{--  <div class="w-[35rem] h-[25rem] border border-gray-200 shadow-lg rounded-lg p-2">
                        <h1 class="text-center">รอบที่ 2 </h1>
                        @include('layouts.bar_chart_by_group_num_round_2')
                    </div>  --}}
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection

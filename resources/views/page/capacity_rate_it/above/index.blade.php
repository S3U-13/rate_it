@extends('layouts.user')

@section('title')
    ความเห็นของผู้บังคับบัญชาเหนือขึ้นไป
@endsection

@section('content')
    @php
        $thaiYear = $now->year + 543; // แปลง ค.ศ. เป็น พ.ศ.
        $thaiNumbers = strtr($thaiYear, [
            '0' => '๐',
            '1' => '๑',
            '2' => '๒',
            '3' => '๓',
            '4' => '๔',
            '5' => '๕',
            '6' => '๖',
            '7' => '๗',
            '8' => '๘',
            '9' => '๙',
        ]);
    @endphp
    @if (session('success'))
        <div class="bg-green-100 text-green-700 text-center p-4 rounded-md shadow-sm flex justify-between items-center">
            <div><i class="bi bi-check-circle-fill"></i> {{ session('success') }}</div>
            <button type="button" class="text-green-700 hover:text-green-900"
                onclick="this.parentElement.style.display='none';">
                &times;
            </button>
        </div>
    @elseif(session('error'))
        <div class="bg-red-100 text-red-700 text-center p-4 rounded-md shadow-sm flex justify-between items-center">
            <div><i class="bi bi-check-circle-fill"></i> {{ session('error') }}</div>
            <button type="button" class="text-red-700 hover:text-red-900" onclick="this.parentElement.style.display='none';">
                &times;
            </button>
        </div>
    @endif
    <div class="container mx-auto mt-4 p-4">
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <div class="bg-[#138f3c] text-white text-center py-3">
                @if ($evaluationRound == 1)
                    <h5 class="text-lg font-semibold">📋 ความเห็นของผู้บังคับบัญชาเหนือขึ้นไป รอบที่ ๑ ประจำปี
                        {{ $thaiNumbers }}</h5>
                @elseif($evaluationRound == 2)
                    <h5 class="text-lg font-semibold">📋 ความเห็นของผู้บังคับบัญชาเหนือขึ้นไป รอบที่ ๒ ประจำปี
                        {{ $thaiNumbers }}</h5>
                @endif
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full border border-gray-300">
                    <thead class="bg-[#138f3c] text-white text-center">
                        <tr>
                            <th class="px-4 py-2 w-1/6 border">ลำดับ</th>
                            <th class="px-4 py-2 w-2/6 border">รายชื่อบุคลากรในองค์กร</th>
                            <th class="px-4 py-2 w-1/6 border">หมวด/แผนก</th>
                            <th class="px-4 py-2 w-1/6 border">ตำเเหน่ง</th>
                            <th class="px-4 py-2 w-3/6 border">การดำเนินการ</th>
                        </tr>
                    </thead>

                    <tbody class="text-center">
                        @if ($personals->isEmpty() && !$hasCompletedEvaluation)
                            <tr>
                                <td colspan="4" class="px-4 py-6 text-red-600 text-lg font-semibold border">
                                    <i class="bi bi-exclamation-circle-fill text-3xl"></i><br>
                                    ไม่มีข้อมูลบุคลากรในกลุ่มของคุณ
                                </td>
                            </tr>
                        @elseif ($hasCompletedEvaluation)
                            @if ($evaluationRound == 1)
                                <tr>
                                    <td colspan="5" class="px-4 py-6 border">
                                        <div class="bg-green-100 text-green-700 p-4 rounded-md">
                                            <i class="bi bi-emoji-smile-fill text-3xl"></i><br>
                                            ขอบคุณสำหรับการทำแบบประเมินใน รอบที่ ๑ ประจำปี {{ $thaiNumbers }} 🎉<br>
                                            คุณประเมินครบทุกคนแล้วในรอบนี้! <span
                                                class="text-red-500">หรือยังไม่มีผู้ลงนาม</span>
                                        </div>
                                    </td>
                                </tr>
                            @elseif($evaluationRound == 2)
                                <tr>
                                    <td colspan="5" class="px-4 py-6 border">
                                        <div class="bg-green-100 text-green-700 p-4 rounded-md">
                                            <i class="bi bi-emoji-smile-fill text-3xl"></i><br>
                                            ขอบคุณสำหรับการทำแบบประเมินใน รอบที่ 2 ประจำปี {{ $thaiNumbers }} 🎉<br>
                                            คุณประเมินครบทุกคนแล้วในรอบนี้! <span
                                                class="text-red-500">หรือยังไม่มีผู้ลงนาม</span>
                                        </div>
                                    </td>
                                </tr>
                            @endif
                        @else
                            @foreach ($personals as $item)
                                <tr class="border hover:bg-gray-100">
                                    <td class="px-4 py-2 border border-[#138f3c]">{{ $loop->iteration }}</td>
                                    <td class="px-4 py-2 text-left border border-[#138f3c]">{{ $item->name }}</td>
                                    <td class="px-4 py-2 text-left border border-[#138f3c]">{{ $item->group->group_name }}</td>
                                    <td class="px-4 py-2 text-left border border-[#138f3c]">{{ $item->JobPosition->job_position_name }}</td>
                                    <td class="px-4 py-2 border border-[#138f3c]">
                                        @switch($item->job_type_num)
                                            @case(1)
                                                <a href="{{ route('page.capacity_rate_it.above.create', $item->id) }}"
                                                    class="bg-[#138f3c] text-white px-3 py-1 rounded-md text-sm hover:bg-green-700">
                                                    <i class="bi bi-pencil-square"></i> ลงความเห็น
                                                </a>
                                            @break

                                            @case(2)
                                                <a href="{{ route('page.capacity_rate_it.above.create_full_time_employee', $item->id) }}"
                                                    class="bg-[#138f3c] text-white px-3 py-1 rounded-md text-sm hover:bg-green-700">
                                                    <i class="bi bi-pencil-square"></i> ลงความเห็น
                                                </a>
                                            @break

                                            @case(3)
                                                <a href="{{ route('page.capacity_rate_it.above.create_general_government_employee', $item->id) }}"
                                                    class="bg-[#138f3c] text-white px-3 py-1 rounded-md text-sm hover:bg-green-700">
                                                    <i class="bi bi-pencil-square"></i> ลงความเห็น
                                                </a>
                                            @break

                                            @case(4)
                                                <a href="{{ route('page.capacity_rate_it.above.create_ministry_of_public_health_employee', $item->id) }}"
                                                    class="bg-[#138f3c] text-white px-3 py-1 rounded-md text-sm hover:bg-green-700">
                                                    <i class="bi bi-pencil-square"></i> ลงความเห็น
                                                </a>
                                            @break

                                            @case(5)
                                                <a href="{{ route('page.capacity_rate_it.above.create_temporary_employee', $item->id) }}"
                                                    class="bg-[#138f3c] text-white px-3 py-1 rounded-md text-sm hover:bg-green-700">
                                                    <i class="bi bi-pencil-square"></i> ลงความเห็น
                                                </a>
                                            @break
                                        @endswitch
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

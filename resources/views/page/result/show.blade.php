@extends('layouts.user')

@section('title')
    เเบบสรุปการประเมินการปฏิบัติราชการตามรายชื่อบุคลากร
@endsection

@section('content')
    @php
        $date01 = \Carbon\Carbon::parse($personal_signature->first()->personal_date ?? null);
        $date02 = \Carbon\Carbon::parse($summarize_03->first()->evaluation_date ?? null);
        $date03 = \Carbon\Carbon::parse($above->first()->above_date ?? null);
        $date04 = \Carbon\Carbon::parse($further->first()->further_date ?? null);
        $date05 = \Carbon\Carbon::parse($witness_signature->first()->witness_date ?? null);
        $thaiYear01 = $date01->year + 543; // แปลง ค.ศ. เป็น พ.ศ.
        $thaiMonthShort01 = $date01->translatedFormat('M'); // ชื่อเดือนแบบย่อภาษาไทย
        $thaiYear02 = $date02->year + 543; // แปลง ค.ศ. เป็น พ.ศ.
        $thaiMonthShort02 = $date02->translatedFormat('M'); // ชื่อเดือนแบบย่อภาษาไทย
        $thaiYear03 = $date03->year + 543; // แปลง ค.ศ. เป็น พ.ศ.
        $thaiMonthShort03 = $date03->translatedFormat('M'); // ชื่อเดือนแบบย่อภาษาไทย
        $thaiYear04 = $date04->year + 543; // แปลง ค.ศ. เป็น พ.ศ.
        $thaiMonthShort04 = $date04->translatedFormat('M'); // ชื่อเดือนแบบย่อภาษาไทย
        $thaiYear05 = $date05->year + 543; // แปลง ค.ศ. เป็น พ.ศ.
        $thaiMonthShort05 = $date05->translatedFormat('M'); // ชื่อเดือนแบบย่อภาษาไทย
        $dayThai01 = $date01->format('j'); // วันที่ (ไม่ใช่เลขไทย)
        $dayThai02 = $date02->format('j'); // วันที่ (ไม่ใช่เลขไทย)
        $dayThai03 = $date03->format('j'); // วันที่ (ไม่ใช่เลขไทย)
        $dayThai04 = $date04->format('j'); // วันที่ (ไม่ใช่เลขไทย)
        $dayThai05 = $date05->format('j'); // วันที่ (ไม่ใช่เลขไทย)

        // แปลงวันที่ให้เป็นเลขไทย
        $thaiNumbers = [
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
        ];
        $dayThai01 = strtr($dayThai01, $thaiNumbers); // แปลงวันที่เป็นเลขไทย
        $dayThai02 = strtr($dayThai02, $thaiNumbers); // แปลงวันที่เป็นเลขไทย
        $dayThai03 = strtr($dayThai03, $thaiNumbers); // แปลงวันที่เป็นเลขไทย
        $dayThai04 = strtr($dayThai04, $thaiNumbers); // แปลงวันที่เป็นเลขไทย
        $dayThai05 = strtr($dayThai05, $thaiNumbers); // แปลงวันที่เป็นเลขไทย
        $thaiYear01 = strtr($thaiYear01, $thaiNumbers); // แปลงวันที่เป็นเลขไทย
        $thaiYear02 = strtr($thaiYear02, $thaiNumbers); // แปลงวันที่เป็นเลขไทย
        $thaiYear03 = strtr($thaiYear03, $thaiNumbers); // แปลงวันที่เป็นเลขไทย
        $thaiYear04 = strtr($thaiYear04, $thaiNumbers); // แปลงวันที่เป็นเลขไทย
        $thaiYear05 = strtr($thaiYear05, $thaiNumbers); // แปลงวันที่เป็นเลขไทย
    @endphp
    <div class="w-full max-w-screen-lg h-full border border-gray-300 mx-auto rounded-lg overflow-hidden shadow-2xl">
        <h1 class="pt-[2rem] pb-[2rem] text-center bg-[#138f3c] text-white text-xl">หน้าที่ 1</h1>
        <div class="pl-[3rem] pr-[2rem]">
            <div class="px-4 md:px-16 lg:px-24 xl:px-32">
                <h1 class="font-bold mt-6 text-xl text-left md:text-left">เเบบสรุปการประเมินการปฏิบัติราชการ</h1>
                <h1 class="font-bold mt-2 text-left md:text-left">ส่วนที่ ๑ ข้อมูลของผู้รับการประเมิน</h1>
                <div class="rounded-lg overflow-hidden shadow-md border border-gray-400 mt-2">
                    <div class="flex flex-col md:flex-row md:justify-between bg-[#138f3c] text-white p-4">
                        <p>รอบการประเมิน</p>
                        @php
                            // กำหนดปีไทย (เพิ่ม +543)
                            $yearNow = now('Asia/Bangkok')->year + 543;
                            $nextYear = $yearNow + 1;
                        @endphp
                        <div>
                            @if ($summarize_01->first()->round ?? null == '1')
                                <span class="ml-[2rem]">รอบที่ ๑</span>
                                <span class="ml-[1rem]">๑ ตุลาคม {{ toThaiNumber($nextYear) }} ถึง ๓๑ มีนาคม
                                    {{ toThaiNumber($nextYear) }}</span>
                            @elseif($summarize_01->first()->round ?? null == '2')
                                <span class="ml-[2rem]">รอบที่ ๒</span>
                                <span class="ml-[1rem]">๑ เมษายน {{ toThaiNumber($nextYear) }} ถึง ๓๐ มีนาคม
                                    {{ toThaiNumber($nextYear) }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="bg-gray-100 p-4">
                        <div class="mb-2">
                            <h1 class="text-gray-600 inline">ชื่อผู้รับการประเมิน:</h1>
                            <span class="text-gray-900 font-bold ml-2">{{ $personal->name }}</span>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <div class="mb-2">
                                    <h1 class="text-gray-600 inline">ตำเเหน่ง:</h1>
                                    <span
                                        class="text-gray-900 font-bold ml-2">{{ $personal->JobPosition->job_position_name }}</span>
                                </div>
                                <div class="mb-2">
                                    <h1 class="text-gray-600 inline">ระดับตำเเหน่ง:</h1>
                                    <span class="text-gray-900 font-bold ml-2">{{ $personal->Tier->tier_name }}</span>
                                </div>
                            </div>
                            <div>
                                <div class="mb-2">
                                    <h1 class="text-gray-600 inline">ประเภทตำเเหน่ง:</h1>
                                    <span
                                        class="text-gray-900 font-bold ml-2">{{ $personal->JobType->job_type_name }}</span>
                                </div>
                                <div class="mb-2">
                                    <h1 class="text-gray-600 inline">สังกัด/งาน:</h1>
                                    <span
                                        class="text-gray-900 font-bold ml-2">{{ $personal->WorkAffiliation->work_affiliation_name }}</span>
                                </div>
                            </div>
                        </div>

                        <div class="mb-2">
                            <h1 class="text-gray-600 inline">ฝ่าย/กลุ่มงาน:</h1>
                            <span class="text-gray-900 font-bold ml-2">{{ $personal->Group->group_name }}</span>
                        </div>

                        <div class="flex flex-col md:flex-row md:justify-between mb-2">
                            <h1 class="text-gray-900 font-bold">โรงพยาบาลพระปกเกล้า</h1>
                            <h1 class="text-gray-900 font-bold pr-[11rem]">สำนักงานสาธารณสุขจังหวัดจันทบุรี</h1>
                        </div>

                        <div class="mb-2">
                            <h1 class="text-gray-600 inline">ผู้บังคับบัญชา/ผู้ประเมิน:</h1>
                            <span
                                class="text-gray-900 font-bold ml-2">{{ $summarize_01->first()->evaluator->name ?? null }}</span>
                        </div>

                        <div class="mb-2">
                            <h1 class="text-gray-600 inline">ตำเเหน่ง:</h1>
                            <span
                                class="text-gray-900 font-bold ml-2">{{ $summarize_01->first()->evaluator->JobPosition->job_position_name ?? null }}
                                {{ $summarize_01->first()->evaluator->Tier->tier_name ?? null }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="pl-[4rem] pr-[3rem]">
            <h1 class="font-bold mt-4">ส่วนที่ ๒ การสรุปผลการประเมิน</h1>
            <div class="rounded-lg overflow-hidden mt-2 shadow-lg">
                <table class="border w-full">
                    <thead>
                        <tr class="bg-[#138f3c] text-white">
                            <th class="border-r p-2">
                                องค์ประกอบการประเมิน
                            </th>
                            <th class="border-r p-2">
                                คะเเนน<br>
                                (ก)
                            </th>
                            <th class="border-r p-2">
                                น้ำหนัก<br>
                                (ข)
                            </th>
                            <th class="p-2">
                                รวมคะเเนน <br>
                                (ก)x(ข)
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            function toThaiNumber($number)
                            {
                                $thaiNumbers = [
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
                                ];
                                return strtr($number, $thaiNumbers);
                            }
                            $total_points = []; // สร้างอาร์เรย์เก็บค่าคูณทั้งหมด
                        @endphp

                        @foreach ($evaluation_component as $index => $component)
                            <tr class="border-t">
                                <td class="border-r pl-2 p-1">
                                    <input type="hidden" name="evaluation_component_num[]" value="{{ $component->id }}">
                                    {{ $component->component_name }}
                                </td>
                                <td class="border-r pl-2 text-center p-1">
                                    @php
                                        $score = null;
                                        if ($index == 0) {
                                            $score = $assessment_01->first() ?? null; // แถวแรกใช้ assessment_01
                                        } elseif ($index == 1) {
                                            $score = $assessment_02->first() ?? null; // แถวที่สองใช้ assessment_02
                                        }
                                        $points_multiply = $score ? $score->points * $component->weight_score : 0;
                                        $total_points[] = $points_multiply; // เก็บค่าคำนวณแต่ละแถว
                                    @endphp
                                    {{ toThaiNumber($score ? $score->points : '-') }}
                                </td>
                                <td class="border-r pl-2 text-center p-1">
                                    {{ toThaiNumber($component->weight_score ?? 'ยังไม่มีข้อมูล') }}
                                </td>
                                <td class="border-r pl-2 text-center p-1">
                                    {{ toThaiNumber($points_multiply) ?? 'ยังไม่มีข้อมูล' }}
                                </td>
                            </tr>
                        @endforeach

                        <tr class="border-t">
                            <td class="bg-[#138f3c]"></td>
                            <td class="border-r pl-2 text-center bg-[#138f3c] text-white">
                                <p>รวม</p>
                            </td>
                            <td class="border-r pl-2 text-center bg-gray-200">
                                ๑๐๐%
                            </td>
                            <td class="border-r pl-2 text-center bg-gray-200">
                                @php
                                    $total_point = array_sum($total_points); // หาผลรวมของค่าที่เก็บไว้
                                @endphp
                                <input type="hidden" name="total_points" value="{{ $total_point }}">
                                {{ toThaiNumber($total_point) }}%
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>


            <h1 class="font-bold text-gray-900 mt-2">ระดับผลการประเมิน</h1>
            <div
                class="grid grid-rows-1 lg:grid-cols-5 gap-4 md:gap-6 lg:gap-8 xl:gap-10 bg-gray-100 p-4 rounded-lg border border-gray-300 shadow-md">
                <h1 class="pl-2 text-gray-900 font-bold"><span class="text-gray-600">อยู่ในเกณฑ์ :</span>
                    {{ $summarize_01->first()->criterion->criterion_name ?? 'ยังไม่มีข้อมูล' }}</h1 </div>


            </div>
        </div>

        <div class="pl-[4rem] pr-[3rem]">
            <h1 class="font-bold mt-4">ส่วนที่ ๓ การสรุปผลการประเมิน</h1>
            <div class="mt-2 rounded-lg overflow-hidden shadow-lg bg-[#138f3c]">
                <table class="border w-full">
                    <thead>
                        <tr class="bg-[#138f3c] text-white">
                            <th class="border-r w-[16rem] p-2 text-left pr-[4.5rem]">
                                ความรู้/ทักษะ/สมรรถนะที่ต้องได้รับการพัฒนา</th>
                            <th class="border-r w-[44rem]">วิธีการพัฒนา</th>
                            <th class="border-r w-[20rem]">ช่วงเวลาที่ต้องการการพัฒนา</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($summarize_02 as $value_table_02)
                            @php
                                $skill_to_dev = json_decode($value_table_02->skill_to_dev, true) ?? [];
                                $dev_method = json_decode($value_table_02->dev_method, true) ?? [];
                                $dev_time = json_decode($value_table_02->dev_time, true) ?? [];

                                // หา max count ของ array เพื่อป้องกัน index error
                                $maxCount = max(count($skill_to_dev), count($dev_method), count($dev_time));
                            @endphp

                            @for ($i = 0; $i < $maxCount; $i++)
                                <tr class="border-t bg-gray-100">
                                    <td class="border-r p-1">
                                        {{ $skill_to_dev[$i] ?? '-' }} {{-- ถ้าไม่มีข้อมูลให้แสดง "-" --}}
                                    </td>
                                    <td class="border-r p-1">
                                        {{ $dev_method[$i] ?? '-' }}
                                    </td>
                                    <td class=" p-1">
                                        {{ $dev_time[$i] ?? '-' }}
                                    </td>
                                </tr>
                            @endfor
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
        <div class="pl-[4rem] pr-[3rem]">
            <h1 class="font-bold mt-4">ส่วนที่ ๔ : ความเห็นของผู้บังคับบัญชาเหนือขึ้นไป</h1>
            <div class="border-r border-l border-b mt-2 rounded-lg overflow-hidden shadow-md">
                <h1 class="font-bold text-white bg-[#138f3c] pt-2 pb-2 pl-2">ผูู้รับการประเมิน</h1>
                <div class="flex justify-between mt-2 pr-12 pb-4">
                    <h1 class="pl-2">ได้รับทราบผลการประเมินเเละเเผนพัฒนา</h1>
                    <div>
                        <div class="flex gap-4 items-center">
                            <div class="flex gap-4 items-center">
                                <span>ลงชื่อ</span>
                                @if ($personal_signature->first() && !empty($personal_signature->first()->personal_signature))
                                    <img class="w-[8rem] h-[3rem]"
                                        src="{{ asset('storage/' . $personal_signature->first()->personal_signature) }}"
                                        alt="ลายเซ็น">
                                @endif
                            </div>
                        </div>
                        <h1 class="text-center">({{ $personal->name }})</h1>
                        <div class="flex gap-2">
                            <h1>ตำเเหน่ง</h1>
                            <span>{{ $personal->JobPosition->job_position_name }}{{ $personal->Tier->tier_name }}</span>
                        </div>
                        <label>วันที่</label>
                        {{ $dayThai01 }} {{ $thaiMonthShort01 }} {{ $thaiYear01 }}
                    </div>
                </div>
            </div>
            <div class="border-r border-l border-b mt-2 rounded-lg overflow-hidden shadow-md">
                <h1 class="font-bold text-white bg-[#138f3c] pt-2 pb-2 pl-2">ผู้ประเมิน</h1>
                <div class="pt-2 pb-2">

                    @php
                        $assessmentNums = json_decode(
                            $summarize_03->first()->assessment_acknowledgement_num ?? '[]',
                            true,
                        );
                    @endphp

                    @foreach ($assessmentNums as $num)
                        <span
                            class="pl-2">{{ $assessment_acknowledgement_choice[$num] ?? 'ยังไม่มีการประเมิน' }}</span><br>
                    @endforeach
                    <div class="pl-3 text-gray-900">
                        <label>เมื่่อวันที่</label>
                        {{ $dayThai01 }} {{ $thaiMonthShort01 }} {{ $thaiYear01 }}
                    </div>
                    <div class="flex justify-end pr-5">
                        <div>
                            <div class="w-[20rem] pl-[4.5rem]">
                                <div class="flex gap-2">
                                    <div class="flex gap-4 items-center">
                                        <span>ลงชื่อ</span>
                                        @if ($summarize_03->first() && !empty($summarize_03->first()->evaluator_signature))
                                            <img class="w-[8rem] h-[3rem]"
                                                src="{{ asset('storage/' . $summarize_03->first()->evaluator_signature ?? null) }}"
                                                alt="ลายเซ็น">
                                        @endif
                                    </div>
                                </div>
                                <div class="">
                                    <h1 class="pl-[3rem]">
                                        ({{ $summarize_03->first()->evaluator->name ?? 'ยังไม่มีข้อมูล' }})</h1
                                        class="text-center">
                                    <div class="flex gap-2">
                                        <h1>ตำเเหน่ง</h1>
                                        <span>{{ $summarize_03->first()->evaluator->JobPosition->job_position_name ?? null }}{{ $summarize_03->first()->evaluator->Tier->tier_name ?? 'ยังไม่มีข้อมูล' }}</span>
                                    </div>
                                    <label>วันที่</label>
                                    {{ $dayThai02 }} {{ $thaiMonthShort02 }} {{ $thaiYear02 }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="pl-4 mt-2 border-t">
                        <div class="flex">
                            <div class="pt-2">
                                <span>เเต่ผู้รับการประเมินไม่ลงนามรับทราบ</span><br>
                                <span>โดยมี</span>
                                {{ $witness_signature->first()->witness->name ?? 'ยังไม่มีพยาน' }}
                                <span>เป็นพยาน</span>
                            </div>
                        </div>
                        <div class="flex justify-end pr-12">
                            <div>
                                <div class="flex gap-4 items-center">
                                    <span>ลงชื่อ</span>
                                    @if ($witness_signature->first() && !empty($witness_signature->first()->witness_signature))
                                        <img class="w-[8rem] h-[3rem]"
                                            src="{{ asset('storage/' . $witness_signature->first()->witness_signature) }}"
                                            alt="ลายเซ็น">
                                    @endif
                                </div>
                                <div class="">
                                    <h1 class="pl-[3rem]">
                                        ({{ $witness_signature->first()->witness->name ?? 'ยังไม่ข้อมูล' }})</h1
                                        class="text-center">
                                    <div class="flex gap-2">
                                        <h1>ตำเเหน่ง</h1>
                                        <span>{{ $witness_signature->first()->witness->JobPosition->job_position_name ?? null }}{{ $witness_signature->first()->witness->Tier->tier_name ?? 'ยังไม่ข้อมูล' }}</span>
                                    </div>
                                    <label>วันที่</label>
                                    {{ $dayThai05 }} {{ $thaiMonthShort05 }} {{ $thaiYear05 }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="pl-[3rem] pr-[2rem] mt-4">
            <h1 class="pt-[2rem] text-center">หน้าที่ ๒</h1>
            <h1 class="font-bold mt-4 px-4 md:px-16">ส่วนที่ ๕ ความเห็นผู้บังคับบัญชาเหนือขึ้นไป</h1>
            <div class="px-4 md:px-16">
                <div class="border mt-2 rounded-lg overflow-hidden">
                    <h1 class="font-bold bg-[#138f3c] py-4 px-4 text-white mb-2">
                        ผู้บังคับบัญชาเหนือขึ้นไป
                    </h1>
                    <span class="px-4 text-gray-900">ความเห็นของผู้บังคับบัญชาเหนือขึ้นไป</span>

                    <div class="flex flex-col md:flex-row justify-between px-4 pb-4">
                        <!-- ส่วนความคิดเห็น -->
                        @if ($above->first() && !empty($above->first()->above_comment_num === 1))
                            <div class="md:w-2/3 mt-2">
                                <span>{{ $above->first()->comments->comment_name ?? 'ยังไม่มีข้อมูล' }}</span><br>
                            </div>
                        @elseif($above->first() && !empty($above->first()->above_comment_num === 2))
                            <div class="md:w-2/3 mt-2">
                                <span>{{ $above->first()->comments->comment_name ?? 'ยังไม่มีข้อมูล' }}</span><br>
                                <span>ดังนี้</span>
                                <div class="border rounded p-2 mb-2 md:w-[25rem] h-[6rem]">
                                    {{ $above->first()->above_comment_detail ?? 'ยังไม่มีข้อมูล' }}
                                </div>
                            </div>
                        @endif


                        <!-- ส่วนลายเซ็นและข้อมูล -->
                        <div class=" md:w-1/3 mt-4 ml-[8rem]">
                            <div class="flex gap-4 items-center mt-2">
                                <span>ลงชื่อ</span>
                                @if ($above->first() && !empty($above->first()->above_signature))
                                    <img class="w-[8rem] h-[3rem]"
                                        src="{{ asset('storage/' . $above->first()->above_signature) }}" alt="ลายเซ็น">
                                @endif
                            </div>
                            <h1 class="pl-12">({{ $above->first()->above->name ?? 'ยังไม่มีข้อมูล' }})</h1>
                            <div class="flex gap-2 justify-none md:justify-start">
                                <h1>ตำแหน่ง</h1>
                                <span>{{ $above->first()->above->JobPosition->job_position_name ?? null }}{{ $above->first()->above->Tier->tier_name ?? 'ยังไม่มีข้อมูล' }}</span>
                            </div>
                            <div class="text-left md:text-left">
                                <label>วันที่</label>
                                {{ $dayThai03 }} {{ $thaiMonthShort03 }} {{ $thaiYear03 }}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="border mt-2 rounded-lg overflow-hidden">
                    <h1 class="font-bold bg-[#138f3c] py-4 px-4 text-white mb-2">
                        ผู้บังคับบัญชาเหนือขึ้นไปอีกชั้นหนึ่ง (ถ้ามี)
                    </h1>
                    <span class="px-4 text-gray-900">ความเห็นของผู้บังคับบัญชาเหนือขึ้นไป</span>

                    <div class="flex flex-col md:flex-row justify-between px-4 pb-4">
                        <!-- ส่วนความคิดเห็น -->
                        @if ($further->first() && !empty($further->first()->further_comment_num === 1))
                            <div class="md:w-2/3 mt-2">
                                <span>{{ $further->first()->comments->comment_name ?? 'ยังไม่มีข้อมูล' }}</span><br>
                            </div>
                        @elseif ($further->first() && !empty($further->first()->further_comment_num === 2))
                            <div class="md:w-2/3 mt-2">
                                <span>{{ $further->first()->comments->comment_name ?? 'ยังไม่มีข้อมูล' }}</span><br>
                                <span>ดังนี้</span>
                                <div class="border rounded p-2 mb-2 md:w-[25rem] h-[6rem]">
                                    {{ $further->first()->further_comment_detail ?? 'ยังไม่มีข้อมูล' }}
                                </div>
                            </div>
                        @endif


                        <!-- ส่วนลายเซ็นและข้อมูล -->
                        <div class=" md:w-1/3 mt-4 ml-[8rem]">
                            <div class="flex gap-4 items-center mt-2">
                                <span>ลงชื่อ</span>
                                @if ($further->first() && !empty($further->first()->further_signature))
                                    <img class="w-[8rem] h-[3rem]"
                                        src="{{ asset('storage/' . $further->first()->further_signature) }}"
                                        alt="ลายเซ็น">
                                @endif
                            </div>
                            <h1 class="pl-12">({{ $further->first()->further->name ?? 'ยังไม่มีข้อมูล' }})</h1>
                            <div class="flex gap-2 justify-none md:justify-start">
                                <h1>ตำแหน่ง</h1>
                                <span>{{ $further->first()->further->JobPosition->job_position_name ?? null }}{{ $further->first()->further->Tier->tier_name ?? 'ยังไม่มีข้อมูล' }}</span>
                            </div>
                            <div class="text-left md:text-left">
                                <label>วันที่</label>
                                {{ $dayThai04 }} {{ $thaiMonthShort04 }} {{ $thaiYear04 }}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-4 mb-6 ">
                    <div class="text-gray-900 border-gray-400 border rounded-lg overflow-hidden shadow-md">
                        <h1 class="font-bold bg-[#138f3c] text-white pt-4 pb-4 pl-4">คำชี้เเจง</h1>
                        <div class="p-2 text-sm">
                            <h1 class="text-lg">เเบบสรุปผลการประเมินผลการปฏิบัติราชการ ประกอบด้วย</h1>
                            <h1 class="pl-2"><span class="pr-6">ส่วนที่ ๑ </span><ins class="pr-2">
                                    ข้อมูลของผู้รับการประเมิน
                                </ins>
                                เพื่อระบุรายละเอียดที่เกี่ยวข้องกับตัวผู้รับการประเมิน</h1>
                            <h1 class="pl-2"><span class="pr-6">ส่วนที่ ๒ </span><ins class="pr-2">
                                    สรุปผลการประเมิน
                                </ins> ใช้กรอกค่าคะเเนนการประเมินในองค์ประกอบด้านสัมฤทธิ์ของงาน
                                องค์ประกอบด้านพฟติกรรมการปฏิบัติราชการเเละน้ำหนักของทั้งสององค์ประกอบ ในเเบบสรุปส่วนที่
                                ๒
                                นี้
                                ยังใช้สำหรับคำนวณคะเเนนผลการปฏิบัติราชการรวมด้วย</h1>
                            <h1 class="pl-2">-
                                สำหรับคะเเนนองค์ประกอบด้านผลสัมฤทธิ์ของงานให้นำมาจากเเบบประเมินสัมฤทธิ์ของงาน
                                โดยให้เเนบท้ายเเบบสรุปฉบับนี้</h1>
                            <h1 class="pl-2">-
                                สำหรับคะแนนองค์กรประกอบด้านพฤติกรรมการปฏิบัติราชการให้นำมาจากเเบบประเมินสมรรถนะ
                                โดยให้เเนบท้ายเเบบสรุปฉบับนี้</h1>
                            <h1 class="pl-2"><span class="pr-6">ส่วนที่ ๓</span><ins class="pr-2">
                                    เเผนพัฒนาการปฏิบัติการรายบุคคล
                                </ins>
                                ผู้ประเมินเเละผู้รับการประเมินร่วมกันจัดทำเเบบเเผนพัฒนาผลการปฏิบัติราชการ</h1>
                            <h1 class="pl-2"><span class="pr-6">ส่วนที่ ๔</span><ins class="pr-2">
                                    การรับทราบผลการประเมิน
                                </ins> ผู้รับการประเมินลงนามรับทราบผลการประเมิน</h1>
                            <h1 class="pl-2"><span class="pr-6">ส่วนที่ ๓</span><ins class="pr-2">
                                    ความเห็นของผู้บังคับบัญชาเหนือขึ้นไป
                                </ins>
                                ความเห็นของผู้บังคับบัญชาเหนือขึ้นไปกลั่นกรองผลการประเมิน เเผนพัฒนาผลการปฏิบัติราชการ
                                เเละให้ความเห็น คำว่า "ผู้บังคับบัญชาเหนือขึ้นไป" สำหรับผู้ประเมินตามข้อ ๒ (๙) หมายถึง
                                หัวหน้าส่วนราชการประจำจังหวัดผู้บังคับบัญชาของผู้รับการประเมิน
                            </h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

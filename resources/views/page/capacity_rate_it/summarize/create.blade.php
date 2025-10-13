@extends('layouts.user')

@section('title')
    เพิ่มเเบบสรุปผลการประเมินผลการปฏิบัติราชการ
@endsection

@section('content')
    <div class="w-full max-w-screen-lg h-full border border-gray-300 mx-auto rounded-lg overflow-hidden shadow-2xl">
        <form action="{{ route('page.capacity_rate_it.summarize.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <h1 class="pt-[2rem] pb-[2rem] text-center bg-[#138f3c] text-white text-xl">📋
                หน้าเพิ่มเเบบสรุปการประเมินการปฏิบัติราชการ (หัวหน้า) </h1>
            <div class="pl-[3rem] pr-[3rem]">
                <div class="px-4 md:px-16 lg:px-24 xl:px-32">
                    <h1 class="font-bold mt-6 text-xl text-center md:text-left">เเบบสรุปการประเมินการปฏิบัติงานราชการ</h1>
                    <h1 class="font-bold mt-2 text-center md:text-left">ส่วนที่ ๑ ข้อมูลของผู้รับการประเมิน</h1>

                    <div class="rounded-lg overflow-hidden shadow-md border border-gray-400 mt-2">
                        <div class="flex flex-col md:flex-row md:justify-between bg-[#138f3c] text-white p-4">
                            <p class="text-lg">รอบการประเมิน</p>
                            @php
                                // กำหนดปีไทย (เพิ่ม +543)
                                $yearNow = now('Asia/Bangkok')->year + 543;
                                $nextYear = $yearNow + 1;
                            @endphp

                            <div class="pr-4">
                                <div class="flex items-center">
                                    <input type="radio" name="round" value="1" id="round1"
                                        {{ $evaluationRound === 1 ? 'checked' : '' }}>
                                    <span class="ml-2 md:ml-4">รอบที่ ๑</span>
                                    <span class="ml-4">๑ ตุลาคม {{ toThaiNumber($nextYear) }} ถึง ๓๑ มีนาคม
                                        {{ toThaiNumber($nextYear) }}</span>
                                </div>

                                <div class="flex items-center mt-2">
                                    <input type="radio" name="round" value="2" id="round2"
                                        {{ $evaluationRound === 2 ? 'checked' : '' }}>
                                    <span class="ml-2 md:ml-4">รอบที่ ๒</span>
                                    <span class="ml-4">๑ เมษายน {{ toThaiNumber($nextYear) }} ถึง ๓๐ กันยายน
                                        {{ toThaiNumber($nextYear) }}</span>
                                </div>
                            </div>
                            <script>
                                let today = new Date();
                                let month = today.getMonth() + 1;
                                let yearBE = today.getFullYear() + 543;

                                let baseYear = month >= 10 ? yearBE : yearBE - 1;
                                let nextYear = baseYear + 1;
                                let round2Year = nextYear;

                                function toThaiNumber(num) {
                                    return num.toString().replace(/[0-9]/g, (d) => "๐๑๒๓๔๕๖๗๘๙" [d]);
                                }

                                document.getElementById("year1").innerText = toThaiNumber(baseYear);
                                document.getElementById("year2").innerText = toThaiNumber(nextYear);
                                document.getElementById("year3").innerText = toThaiNumber(nextYear);
                                document.getElementById("year4").innerText = toThaiNumber(round2Year);

                                if ((month >= 10 && month <= 12) || (month >= 1 && month <= 3)) {
                                    document.getElementById("round1").checked = true;
                                } else if (month >= 4 && month <= 9) {
                                    document.getElementById("round2").checked = true;
                                }
                            </script>
                        </div>

                        <div class="bg-gray-100 p-4">
                            <input type="hidden" name="personal_num" value="{{ $personal->id }}">

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

                            <div class="flex flex-col md:flex-row md:justify-between">
                                <h1 class="text-gray-900 font-bold">โรงพยาบาลพระปกเกล้า</h1>
                                <h1 class="text-gray-900 font-bold pr-[10.5rem]">สำนักงานสาธารณสุขจังหวัดจันทบุรี</h1>
                            </div>

                            <div class="mb-2">
                                <h1 class="text-gray-600 inline">ผู้งบังคับบัญชา/ผู้ประเมิน:</h1>
                                <span class="text-gray-900 font-bold ml-2">{{ Auth::user()->name }}</span>
                            </div>

                            <div class="mb-2">
                                <h1 class="text-gray-600 inline">ตำเเหน่ง:</h1>
                                <span
                                    class="text-gray-900 font-bold ml-2">{{ Auth::user()->JobPosition->job_position_name }}
                                    {{ Auth::user()->Tier->tier_name }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <script>
                    let today = new Date();
                    let month = today.getMonth() + 1;
                    let yearBE = today.getFullYear() + 543;

                    let baseYear = month >= 10 ? yearBE : yearBE - 1;
                    let nextYear = baseYear + 1;
                    let round2Year = nextYear;

                    function toThaiNumber(num) {
                        return num.toString().replace(/[0-9]/g, (d) => "๐๑๒๓๔๕๖๗๘๙" [d]);
                    }

                    document.getElementById("year1").innerText = toThaiNumber(baseYear);
                    document.getElementById("year2").innerText = toThaiNumber(nextYear);
                    document.getElementById("year3").innerText = toThaiNumber(nextYear);
                    document.getElementById("year4").innerText = toThaiNumber(round2Year);

                    if ((month >= 10 && month <= 12) || (month >= 1 && month <= 3)) {
                        document.getElementById("round1").checked = true;
                    } else if (month >= 4 && month <= 9) {
                        document.getElementById("round2").checked = true;
                    }
                </script>

            </div>

            <div class="pl-[4rem] pr-[4rem]">
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
                                        <input type="hidden" name="evaluation_component_num[]"
                                            value="{{ $component->id }}">
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
                                        <input type="hidden" name="points[]" value="{{ $score->points ?? null }}">
                                        {{ toThaiNumber($score ? $score->points : '-') }}
                                    </td>
                                    <td class="border-r pl-2 text-center p-1">
                                        {{ toThaiNumber($component->weight_score ?? null) }}
                                    </td>
                                    <td class="border-r pl-2 text-center p-1">
                                        <input type="hidden" name="points_multiply[]" value="{{ $points_multiply }}">
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
                                        $total_point = round(array_sum($total_points)); // หาผลรวมของค่าที่เก็บไว้
                                    @endphp
                                    <input type="hidden" name="total_points" value="{{ $total_point }}">
                                    {{ toThaiNumber($total_point) }}%
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>


                <h1 class="font-bold text-gray-900 mt-2">ระดับผลการประเมิน</h1>
                @php
                    // หาเกณฑ์ที่ตรงกับคะแนน
                    if ($total_point > 90) {
                        $selected_criterion = $criterion_choice->where('criterion_name', 'ดีเด่น')->first()->id ?? null;
                    } elseif ($total_point > 80) {
                        $selected_criterion = $criterion_choice->where('criterion_name', 'ดีมาก')->first()->id ?? null;
                    } elseif ($total_point > 70) {
                        $selected_criterion = $criterion_choice->where('criterion_name', 'ดี')->first()->id ?? null;
                    } elseif ($total_point > 60) {
                        $selected_criterion = $criterion_choice->where('criterion_name', 'พอใช้')->first()->id ?? null;
                    } else {
                        $selected_criterion =
                            $criterion_choice->where('criterion_name', 'ต้องปรับปรุง')->first()->id ?? null;
                    }
                @endphp

                <div
                    class="grid grid-rows-1 lg:grid-cols-5 gap-4 md:gap-6 lg:gap-8 xl:gap-10 bg-gray-100 p-4 rounded-lg border border-gray-300 shadow-md">
                    @foreach ($criterion_choice as $choice)
                        <div class="flex items-center">
                            <input type="radio" name="criterion_num" value="{{ $choice->id }}"
                                {{ $selected_criterion == $choice->id ? 'checked' : '' }}>
                            <span class="pl-2 text-gray-900 font-bold">{{ $choice->criterion_name }}</span>
                        </div>
                    @endforeach
                </div>


            </div>

            <div class="pl-[4rem] pr-[4rem]">
                <h1 class="font-bold mt-4">ส่วนที่ ๓ การสรุปผลการประเมิน</h1>
                <div class="mt-2 rounded-lg overflow-hidden shadow-lg bg-[#138f3c]" x-data="{
                    rows: [{ skill: '', method: '', time: '' }],
                    addRow() {
                        this.rows.push({ skill: '', method: '', time: '' });
                    },
                    removeRow(index) {
                        this.rows.splice(index, 1);
                    }
                }">
                    <table class="border w-full">
                        <thead>
                            <tr class="bg-[#138f3c] text-white">
                                <th class="border-r w-[16rem] p-2 text-left pr-[4.5rem]">
                                    ความรู้/ทักษะ/สมรรถนะที่ต้องได้รับการพัฒนา</th>
                                <th class="border-r w-[44rem]">วิธีการพัฒนา</th>
                                <th class="border-r w-[20rem]">ช่วงเวลาที่ต้องการการพัฒนา</th>
                                <th class="w-[5rem]">จัดการ</th>
                            </tr>
                        </thead>
                        <tbody>
                            <template x-for="(row, index) in rows" :key="index">
                                <tr class="border-t">
                                    <td class="border-r bg-gray-100">
                                        <input type="text" name="skill_to_dev[]"
                                            class="pl-2 p-1 w-full bg-gray-100 h-[2.5rem]" x-model="row.skill">
                                    </td>
                                    <td class="border-r bg-gray-100">
                                        <input type="text" name="dev_method[]"
                                            class="pl-2 p-1 w-full bg-gray-100 h-[2.5rem]" x-model="row.method">
                                    </td>
                                    <td class="border-r bg-gray-100">
                                        <input type="text" name="dev_time[]"
                                            class="pl-2 p-1 w-full bg-gray-100 h-[2.5rem]" x-model="row.time">
                                    </td>
                                    <td class="bg-gray-100 flex justify-center h-[2.5rem] items-center">
                                        <button type="button" @click="removeRow(index)"
                                            class="w-[4rem] h-[2rem] text-white text-sm bg-[#fc3d69] rounded-lg hover:bg-[#bd2649]">
                                            ลบ
                                        </button>
                                    </td>
                                </tr>
                            </template>
                        </tbody>
                    </table>

                    <!-- ปุ่มเพิ่มแถว -->
                    <div class="flex justify-end pr-2 mb-2">
                        <button type="button" @click="addRow()"
                            class="mt-2 p-1 bg-white text-[#138f3c] rounded text-sm hover:bg-gray-200 border border-white">
                            เพิ่มแถว
                        </button>
                    </div>
                </div>
            </div>
            <div class="pl-[4rem] pr-[4rem]">
                <h1 class="font-bold mt-4">ส่วนที่ ๔ : ความเห็นของผู้บังคับบัญชาเหนือขึ้นไป</h1>
                <div class="border-r border-l border-b mt-2 rounded-lg overflow-hidden shadow-md">
                    <h1 class="font-bold text-white bg-[#138f3c] pt-2 pb-2 pl-2">ผู้ประเมิน</h1>
                    <div class="p-2">

                        @foreach ($assessment_acknowledgement_choice as $assessment_acknowledgement)
                            <div>
                                <input type="checkbox" name="assessment_acknowledgement_num[]"
                                    value="{{ $assessment_acknowledgement->id }}" required>
                                <label
                                    class="text-gray-900 pl-2">{{ $assessment_acknowledgement->assessment_acknowledgement_name }}</label>
                            </div>
                        @endforeach

                        <div class="flex justify-end pr-6">
                            <div>
                                <div class="flex gap-2">


                                    <div x-data="{
                                        showSignaturePad: false,
                                        signatureUrl: '',
                                        saveSignature() {
                                            let canvas = document.getElementById('signatureCanvas');
                                            let signatureUrl = canvas.toDataURL('image/png'); // แปลงเป็น Base64
                                            this.signatureUrl = signatureUrl;
                                            this.showSignaturePad = false; // ปิด popup
                                        }
                                    }" class="mb-2">



                                        <!-- แสดงลายเซ็นที่บันทึก -->
                                        <div class="flex gap-2 items-center mt-2">
                                            <span class="text-gray-900">ลงชื่อ</span>
                                            <template x-if="signatureUrl">
                                                <img :src="signatureUrl" alt="ลายเซ็น" class="w-32 h-10 border p-1">
                                            </template>
                                            <button type="button" @click="showSignaturePad = true" id="add_signature"
                                                class="p-1 bg-blue-500 text-white text-sm rounded hover:bg-blue-700">
                                                เพิ่มลายเซ็น
                                            </button>
                                        </div>

                                        <input type="hidden" name="evaluator_signature" x-model="signatureUrl">
                                        <!-- Modal สำหรับ Signature Pad -->
                                        <div x-show="showSignaturePad" x-transition.opacity x-cloak
                                            class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center">
                                            <div class="bg-white p-5 rounded-lg shadow-lg w-96">
                                                <h2 class="text-lg font-bold mb-2">ลงลายเซ็น</h2>

                                                <!-- Signature Pad -->
                                                <canvas id="signatureCanvas" class="border w-full h-40"></canvas>

                                                <!-- ปุ่มล้าง / บันทึก -->
                                                <div class="flex justify-between mt-3">
                                                    <button type="button" id="clear"
                                                        class="px-3 py-1 bg-gray-300 rounded hover:bg-gray-400">ล้างลายเซ็น</button>
                                                    <button type="button" @click="saveSignature()"
                                                        class="px-3 py-1 bg-green-500 text-white rounded hover:bg-green-600">บันทึก</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Script สำหรับ Signature Pad -->
                                    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
                                    <script>
                                        document.addEventListener("DOMContentLoaded", function() {
                                            let canvas = document.getElementById("signatureCanvas");
                                            let ctx = canvas.getContext("2d");
                                            let isDrawing = false;

                                            // ปรับขนาด Canvas
                                            function resizeCanvas() {
                                                canvas.width = canvas.offsetWidth;
                                                canvas.height = 160;
                                                ctx.fillStyle = "white";
                                                ctx.fillRect(0, 0, canvas.width, canvas.height);
                                            }

                                            resizeCanvas(); // เรียกใช้ตอนโหลด

                                            canvas.addEventListener("mousedown", (e) => {
                                                isDrawing = true;
                                                ctx.beginPath();
                                                ctx.moveTo(e.offsetX, e.offsetY);
                                            });

                                            canvas.addEventListener("mousemove", (e) => {
                                                if (isDrawing) {
                                                    ctx.lineTo(e.offsetX, e.offsetY);
                                                    ctx.stroke();
                                                }
                                            });

                                            canvas.addEventListener("mouseup", () => {
                                                isDrawing = false;
                                            });

                                            document.getElementById("clear").addEventListener("click", () => {
                                                ctx.clearRect(0, 0, canvas.width, canvas.height);
                                                resizeCanvas(); // รีเซ็ต Canvas
                                            });

                                            // ✅ บันทึกลายเซ็น
                                            window.saveSignature = function() {
                                                let signatureUrl = canvas.toDataURL("image/png"); // แปลงเป็น Base64
                                                let alpineData = document.querySelector("[x-data]").__x.$data;
                                                alpineData.signatureUrl = signatureUrl;
                                                alpineData.showSignaturePad = false; // ปิด popup
                                            }
                                        });
                                    </script>

                                </div>
                                <div class="">
                                    <h1 class="text-center text-gray-900">({{ Auth::user()->name }})</h1
                                        class="text-center">
                                    <div class="flex gap-2 mb-2">
                                        <h1 class="text-gray-900">ตำเเหน่ง</h1>
                                        <span>{{ Auth::user()->JobPosition->job_position_name }}{{ Auth::user()->Tier->tier_name }}</span>
                                    </div>
                                    <label class="text-gray-900">วันที่</label>
                                    <input type="date" name="evaluation_date" class="rounded pl-4 p-1 mb-2" required>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex justify-end pr-16 pt-4">
                <button type="submit"
                    class="p-1 border bg-[#138f3c] text-white rounded-lg w-[5rem] hover:bg-green-700">บันทึก</button>
            </div>

            <div class="pl-[4rem] pr-[4rem] mt-6 mb-6 ">
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
                            องค์ประกอบด้านพฟติกรรมการปฏิบัติราชการเเละน้ำหนักของทั้งสององค์ประกอบ ในเเบบสรุปส่วนที่ ๒ นี้
                            ยังใช้สำหรับคำนวณคะเเนนผลการปฏิบัติราชการรวมด้วย</h1>
                        <h1 class="pl-2">- สำหรับคะเเนนองค์ประกอบด้านผลสัมฤทธิ์ของงานให้นำมาจากเเบบประเมินสัมฤทธิ์ของงาน
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
        </form>
    </div>
@endsection

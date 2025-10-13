<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
    <title>Document</title>
</head>

<body>
    <div class="w-[80rem] h-[120rem] border mx-auto">
        <h1 class="pt-[2rem] text-center">หน้าที่ 1</h1>
        <div class="pl-[4rem]">
            <h1>เเบบสรุปการประเมินการปฏิบัติราชการ</h1>
            <h1>ส่วนที่ ๑ ข้อมูลของผู้รับการประเมิน</h1>
            <div class="flex gap-[9rem]">
                <p>รอบการประเมิน</p>
                <div>
                    <div>
                        <input type="radio" name="round">
                        <span class="ml-[2rem]">รอบที่ ๑</span>
                        <span class="ml-[4rem]">๑ ตุลาคม ๒๕๖๖ ถึง ๓๑ มีนาคม ๒๕๖๗</span>
                    </div>
                    <div>
                        <input type="radio" name="round">
                        <span class="ml-[2rem]">รอบที่ ๒</span>
                        <span class="ml-[4rem]">๑ เมษายน ๒๕๖๗ ถึง ๓๐ มีนาคม ๒๕๖๗</span>
                    </div>
                </div>
            </div>
            <h1 class="font-bold">ชื่อผู้รับการประเมิน <span>-----</span></h1>
            <h1 class="font-bold">ตำเเหน่ง <span>-----</span></h1>
            <h1 class="font-bold">สังกัด/งาน <span>-----</span></h1>
            <h1 class="font-bold">ฝ่าย/กลุ่มงาน <span>-----</span></h1>
            <h1 class="font-bold">โรงพยาบาลพระปกเกล้า</h1>
            <h1 class="font-bold">สำนักงานสาธารณสุขจังหวัดจันทบุรี</h1>
            <h1 class="font-bold">ผู้งบังคับบัญชา/ผู้ประเมิน <span>-----</span></h1>
            <h1 class="font-bold">ตำเเหน่ง <span>-----</span></h1>
        </div>

        <div class="pl-[4rem] pr-[2rem]">
            <h1>ส่วนที่ ๒ การสรุปผลการประเมิน</h1>
            <table class="border w-full">
                <thead>
                    <tr>
                        <th class="border-r">
                            องค์ประกอบการประเมิน
                        </th>
                        <th class="border-r">
                            คะเเนน
                            (ก)
                        </th>
                        <th class="border-r">
                            น้ำหนัก
                            (ข)
                        </th>
                        <th>
                            รวมคะเเนน
                            (ก)x(ข)
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="border-t">
                        <td class="border-r">
                            องค์ประกอบ ๑ ผลสัมฤทธิ์ของงาน
                        </td>
                        <td class="border-r">

                        </td>
                        <td class="border-r">

                        </td>
                        <td>

                        </td>
                    </tr>
                    <tr class="border-t">
                        <td class="border-r">
                            องค์ประกอบ ๒ พฤติกรรมการปฏิบัติราชการ(สมรรถนะ)
                        </td>
                        <td class="border-r">

                        </td>
                        <td class="border-r">

                        </td>
                        <td>

                        </td>
                    </tr>
                    <tr class="border-t">
                        <td class="border-r">
                            องค์ประกอบอื่น ๆ (ถ้ามี)
                        </td>
                        <td class="border-r">

                        </td>
                        <td class="border-r">

                        </td>
                        <td>

                        </td>
                    </tr>
                    <tr class="border-t">
                        <td>

                        </td>
                        <td class="border-r">
                            <p class="text-center">รวม</p>
                        </td>
                        <td class="border-r">

                        </td>
                        <td>

                        </td>
                    </tr>
                </tbody>
            </table>
            <h1>ระดับผลการประเมิน</h1>
            <div class="flex gap-[8rem] pl-[4rem]">
                <div>
                    <input type="radio" name="criterion">
                    <span>ดีเด่น</span>
                </div>
                <div> <input type="radio" name="criterion">
                    <span>ดีมาก</span>
                </div>
                <div>
                    <input type="radio" name="criterion">
                    <span>ดี</span>
                </div>
                <div> <input type="radio" name="criterion">
                    <span>พอใช้</span>
                </div>
                <div> <input type="radio" name="criterion">
                    <span>ต้องปรับปรุง</span>
                </div>
            </div>
        </div>

        <div class="pl-[4rem] pr-[2rem]">
            <h1>ส่วนที่ ๓ การสรุปผลการประเมิน</h1>
            <table class="border w-full">
                <thead>
                    <tr>
                        <th class="border-r w-[16rem] p-2 text-left pr-[4.5rem]">
                            ความรู้/ทักษะ/สมรรถนะที่ต้องได้รับการพัฒนา</th>
                        <th class="border-r w-[44rem]">วิธีการพัฒนา</th>
                        <th>ช่วงเวลาที่ต้องการการพัฒนา</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="border-t">
                        <td class="border-r">------</td>
                        <td class="border-r">------</td>
                        <td class="">------</td>
                    </tr>
                    <tr class="border-t">
                        <td class="border-r">------</td>
                        <td class="border-r">------</td>
                        <td class="">------</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="pl-[4rem] pr-[2rem]">
            <h1>ส่วนที่ ๔ : ความเห็นของผู้บังคับบัญชาเหนือขึ้นไป</h1>
            <div class="border p-2">
                <h1>ผูู้รับการประเมิน</h1>
                <div class="flex justify-between">
                    <h1>ได้รับทราบผลการประเมินเเละเเผนพัฒนา</h1>
                    <div>
                        <h1>ลงชื่อ.................................</h1>
                        <span>(นายมานะ รัตนะธรรมเจริญ)</span><br>
                        <span>ตำเเหน่ง พยาบาลวิชาชีพเชี่ยวชาญ</span>
                        <h1>วันที่ก.................................</h1>
                    </div>
                </div>
            </div>
            <div class="border-r border-l border-b p-2">
                <h1>ผู้รับการประเมิน</h1>
                <div> <input type="checkbox" name="checkbox" id="">
                    <span>ได้เเจ้งผลการประเมินเเละผู้รับผลการประเมินรับทราบ</span>
                </div>
                <div> <input type="checkbox" name="checkbox" id="">
                    <span>ได้เเจ้งผลการประเมินเมื่่อวันที่...........................ลงชื่อ...............................</span>
                </div>
                <div class="flex">
                    <div class="pt-[1.5rem]">
                        <span>เเต่ผู้รับการประเมินไม่ลงนามรับทราบ</span><br>
                        <span>โดยมี................................................เป็นพยาน</span>
                    </div>
                    <div class="ml-[20rem]">
                        <span>(นางกรรณิกา อำพนธ์)</span><br>
                        <span>ตำเเหน่ง พยาบาลวิชาชีพเชี่ยวชาญ</span><br>
                        <span>วันที่................................................</span>
                    </div>
                </div>
                <div class="ml-[10rem]">
                    <span>ลงชื่อ..........................................................พยาน</span><br>
                    <span>ตำเเหน่ง..........................................................</span><br>
                    <span>วันที่..........................................................</span>
                </div>
            </div>
        </div>

        <div>
            <h1 class="pt-[2rem] text-center">หน้าที่ ๒</h1>
            <h1 class="pl-[4rem]">ส่วนที่ ๕ ความเห็นผู้บังคับบัญชาเหนือขึ้นไป</h1>
            <div class="pl-[4rem] pr-[2rem]">
                <div class="border p-2">
                    <h1>ผู้บังคับบัญชาเหนือขึ้นไป</h1>
                    <div class="pl-[4rem]">
                        <input type="checkbox" name="checkbox" id="">
                        <span>เห็นด้วย กับผลการประเมิน</span>
                    </div>
                    <div class="flex justify-between pl-[4rem]">
                        <div>
                            <input type="checkbox" name="checkbox" id="">
                            <span>มีความเห็นต่าง ดังนี้..................</span>
                        </div>
                        <div>
                            <span>ชื่อ..............................</span><br>
                            <span>ตำเเหน่ง..........................</span><br>
                            <span>วันที่.............................</span>
                        </div>
                    </div>
                </div>
                <div class="border-r border-l border-b p-2">
                    <h1>ผู้บังคับบัญชาเหนือขึ้นไปอีกชั้นหนึ่ง (ถ้ามี)</h1>
                    <div class="pl-[4rem]">
                        <input type="checkbox" name="checkbox" id="">
                        <span>เห็นด้วย กับผลการประเมิน</span>
                    </div>
                    <div class="flex justify-between pl-[4rem]">
                        <div>
                            <input type="checkbox" name="checkbox" id="">
                            <span>มีความเห็นต่าง ดังนี้..................</span>
                        </div>
                        <div>
                            <span>ชื่อ..............................</span><br>
                            <span>ตำเเหน่ง..........................</span><br>
                            <span>วันที่.............................</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="pl-[4rem] pr-[2rem]">
                <h1>คำชี้เเจง</h1>
                <h1>เเบบสรุปผลการประเมินผลการปฏิบัติราชการ ประกอบด้วย</h1>
                <h1><span>ส่วนที่ ๑</span> ข้อมูลของผู้รับการประเมิน
                    เพื่อระบุรายละเอียดที่เกี่ยวข้องกับตัวผู้รับการประเมิน</h1>
                <h1><span>ส่วนที่ ๒</span> สรุปผลการประเมิน ใช้กรอกค่าคะเเนนการประเมินในองค์ประกอบด้านสัมฤทธิ์ของงาน
                    องค์ประกอบด้านพฟติกรรมการปฏิบัติราชการเเละน้ำหนักของทั้งสององค์ประกอบ ในเเบบสรุปส่วนที่ ๒ นี้
                    ยังใช้สำหรับคำนวณคะเเนนผลการปฏิบัติราชการรวมด้วย</h1>
                <h1>-สำหรับคะเเนนองค์ประกอบด้านผลสัมฤทธิ์ของงานให้นำมาจากเเบบประเมินสัมฤทธิ์ของงาน
                    โดยให้เเนบท้ายเเบบสรุปฉบับนี้</h1>
                <h1>-สำหรับคะแนนองค์กรประกอบด้านพฤติกรรมการปฏิบัติราชการให้นำมาจากเเบบประเมินสมรรถนะ
                    โดยให้เเนบท้ายเเบบสรุปฉบับนี้</h1>
                    <h1><span>ส่วนที่ ๓</span> เเผนพัฒนาการปฏิบัติการรายบุคคล
                        ผู้ประเมินเเละผู้รับการประเมินร่วมกันจัดทำเเบบเเผนพัฒนาผลการปฏิบัติราชการ</h1>
                        <h1><span>ส่วนที่ ๔</span> การรับทราบผลการประเมิน ผู้รับการประเมินลงนามรับทราบผลการประเมิน</h1>
                            <h1><span>ส่วนที่ ๓</span> ความเห็นของผู้บังคับบัญชาเหนือขึ้นไป
                                ความเห็นของผู้บังคับบัญชาเหนือขึ้นไปกลั่นกรองผลการประเมิน เเผนพัฒนาผลการปฏิบัติราชการ
                                เเละให้ความเห็น คำว่า "ผู้บังคับบัญชาเหนือขึ้นไป" สำหรับผู้ประเมินตามข้อ ๒ (๙) หมายถึง
                                หัวหน้าส่วนราชการประจำจังหวัดผู้บังคับบัญชาของผู้รับการประเมิน
                            </h1>
            </div>

        </div>
    </div>
</body>

</html>
{{--  <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
    <title>Document</title>
    <script src="https://cdn.jsdelivr.net/npm/signature_pad"></script>
</head>

<body>
    <div class="w-[80rem] h-full border mx-auto">
        <h1 class="pt-[2rem] text-center">หน้าที่ 1</h1>
        <div class="pl-[4rem]">
            <h1>เเบบสรุปการประเมินการปฏิบัติราชการ</h1>
            <h1>ส่วนที่ ๑ ข้อมูลของผู้รับการประเมิน</h1>
            <div class="flex gap-[9rem]">
                <p>รอบการประเมิน</p>
                <div>
                    <div>
                        <input type="radio" name="round">
                        <span class="ml-[2rem]">รอบที่ ๑</span>
                        <span class="ml-[4rem]">๑ ตุลาคม ๒๕๖๖ ถึง ๓๑ มีนาคม ๒๕๖๗</span>
                    </div>
                    <div>
                        <input type="radio" name="round">
                        <span class="ml-[2rem]">รอบที่ ๒</span>
                        <span class="ml-[4rem]">๑ เมษายน ๒๕๖๗ ถึง ๓๐ มีนาคม ๒๕๖๗</span>
                    </div>
                </div>
            </div>
            <div class="mb-2 flex gap-4">
                <h1 class="font-bold">ชื่อผู้รับการประเมิน</h1>
                <span>{{ $personal->name }}</span>
            </div>
            <div class="flex gap-[9rem]">
                <div class="mb-2">
                    <div class="flex gap-4 mb-2">
                        <h1 class="font-bold">ตำเเหน่ง </h1>
                        <span>{{ $personal->JobPosition->job_position_name }}</span>
                    </div>
                    <div class="flex gap-4">
                        <h1 class="font-bold">ระดับตำเเหน่ง </h1>
                        <span>{{ $personal->Tier->tier_name }}</span>
                    </div>
                </div>
                <div class="mb-2">
                    <div class="flex gap-4 mb-2">
                        <h1 class="font-bold">ประเภทตำเเหน่ง </h1>
                        <span>{{ $personal->JobType->job_type_name }}</span>
                    </div>
                    <div class="flex gap-4">
                        <h1 class="font-bold">สังกัด/งาน </h1>
                        <span>{{ $personal->WorkAffiliation->work_affiliation_name }}</span>
                    </div>
                </div>
            </div>

            <div class="mb-2 flex gap-4">
                <h1 class="font-bold">ฝ่าย/กลุ่มงาน </h1>
                <span>{{ $personal->Group->group_name }}</span>
            </div>
            <div class="mb-2 flex gap-[10rem]">
                <h1 class="font-bold">โรงพยาบาลพระปกเกล้า</h1>
                <h1 class="font-bold">สำนักงานสาธารณสุขจังหวัดจันทบุรี</h1>
            </div>
            <div class="mb-2 flex gap-4">
                <h1 class="font-bold" for="">ผู้งบังคับบัญชา/ผู้ประเมิน </h1>
                <span>{{ Auth::user()->name }}</span>
            </div>
            <div class="flex gap-4 mb-2">
                <h1 class="font-bold">ตำเเหน่ง </h1>
                <span>{{ Auth::user()->JobPosition->job_position_name }}{{ Auth::user()->Tier->tier_name }}</span>
            </div>
        </div>

        <div class="pl-[4rem] pr-[2rem]">
            <h1>ส่วนที่ ๒ การสรุปผลการประเมิน</h1>
            <table class="border w-full">
                <thead>
                    <tr>
                        <th class="border-r">
                            องค์ประกอบการประเมิน
                        </th>
                        <th class="border-r">
                            คะเเนน
                            (ก)
                        </th>
                        <th class="border-r">
                            น้ำหนัก
                            (ข)
                        </th>
                        <th>
                            รวมคะเเนน
                            (ก)x(ข)
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $total_points = []; // สร้างอาร์เรย์เก็บค่าคูณทั้งหมด
                    @endphp

                    @foreach ($evaluation_component as $index => $component)
                        <tr class="border-t">
                            <td class="border-r pl-2">
                                {{ $component->component_name }}
                            </td>
                            <td class="border-r pl-2 text-center">
                                @php
                                    $score = null;
                                    if ($index == 0) {
                                        $score = $assessment_01->first(); // แถวแรกใช้ assessment_01
                                    } elseif ($index == 1) {
                                        $score = $assessment_02->first(); // แถวที่สองใช้ assessment_02
                                    }
                                    $points_multiply = $score ? $score->points * $component->weight_score : 0;
                                    $total_points[] = $points_multiply; // เก็บค่าคำนวณแต่ละแถว
                                @endphp

                                {{ $score ? $score->points : '-' }}
                            </td>
                            <td class="border-r pl-2 text-center">
                                {{ $component->weight_score }}
                            </td>
                            <td class="border-r pl-2 text-center">
                                {{ $points_multiply }}
                            </td>
                        </tr>
                    @endforeach

                    <tr class="border-t">
                        <td></td>
                        <td class="border-r pl-2 text-center">
                            <p>รวม</p>
                        </td>
                        <td class="border-r pl-2 text-center">
                            ๑๐๐%
                        </td>
                        <td class="border-r pl-2 text-center">
                            @php
                                $total_point = array_sum($total_points); // หาผลรวมของค่าที่เก็บไว้
                            @endphp

                            {{ $total_point }}
                        </td>
                    </tr>
                </tbody>
            </table>

            <h1>ระดับผลการประเมิน</h1>
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

            <div class="flex gap-[8rem] pl-[4rem]">
                @foreach ($criterion_choice as $choice)
                    <div>
                        <input type="radio" name="criterion_num" value="{{ $choice->id }}"
                            {{ $selected_criterion == $choice->id ? 'checked' : '' }}>
                        <span>{{ $choice->criterion_name }}</span>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="pl-[4rem] pr-[2rem]">
            <h1>ส่วนที่ ๓ การสรุปผลการประเมิน</h1>
            <table class="border w-full">
                <thead>
                    <tr>
                        <th class="border-r w-[16rem] p-2 text-left pr-[4.5rem]">
                            ความรู้/ทักษะ/สมรรถนะที่ต้องได้รับการพัฒนา</th>
                        <th class="border-r w-[44rem]">วิธีการพัฒนา</th>
                        <th>ช่วงเวลาที่ต้องการการพัฒนา</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="border-t">
                        <td class="border-r">
                            <input type="text" class="bg-blue-100 pl-2 p-1 w-full">
                        </td>
                        <td class="border-r">
                            <input type="text" class="bg-blue-100 pl-2 p-1 w-full">
                        </td>
                        <td class="">
                            <input type="text" class="bg-blue-100 pl-2 p-1 w-full">
                        </td>
                    </tr>
                    <tr class="border-t">
                        <td class="border-r">
                            <input type="text" class="bg-blue-100 pl-2 p-1 w-full">
                        </td>
                        <td class="border-r">
                            <input type="text" class="bg-blue-100 pl-2 p-1 w-full">
                        </td>
                        <td class="">
                            <input type="text" class="bg-blue-100 pl-2 p-1 w-full">
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="pl-[4rem] pr-[2rem]">
            <h1>ส่วนที่ ๔ : ความเห็นของผู้บังคับบัญชาเหนือขึ้นไป</h1>
            <div class="border p-2">
                <h1>ผูู้รับการประเมิน</h1>
                <div class="flex justify-between">
                    <h1>ได้รับทราบผลการประเมินเเละเเผนพัฒนา</h1>
                    <div>
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
                                <span>ลงชื่อ</span>
                                <template x-if="signatureUrl">
                                    <img :src="signatureUrl" alt="ลายเซ็น" class="w-32 h-10 border p-1">
                                </template>
                                <button @click="showSignaturePad = true" id="add_signature"
                                    class="p-1 bg-blue-500 text-white text-sm rounded">
                                    เพิ่มลายเซ็น
                                </button>
                            </div>


                            <!-- Modal สำหรับ Signature Pad -->
                            <div x-show="showSignaturePad" x-transition.opacity x-cloak
                                class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center">
                                <div class="bg-white p-5 rounded-lg shadow-lg w-96">
                                    <h2 class="text-lg font-bold mb-2">ลงลายเซ็น</h2>

                                    <!-- Signature Pad -->
                                    <canvas id="signatureCanvas" class="border w-full h-40"></canvas>

                                    <!-- ปุ่มล้าง / บันทึก -->
                                    <div class="flex justify-between mt-3">
                                        <button id="clear"
                                            class="px-3 py-1 bg-gray-300 rounded">ล้างลายเซ็น</button>
                                        <button @click="saveSignature()"
                                            class="px-3 py-1 bg-green-500 text-white rounded">บันทึก</button>
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


                        <h1 class="text-center">({{ $personal->name }})</h1>
                        <div class="flex gap-2">
                            <h1>ตำเเหน่ง</h1>
                            <span>{{ $personal->JobPosition->job_position_name }}{{ $personal->Tier->tier_name }}</span>
                        </div>
                        <label>วันที่</label>
                        <input type="date" class="bg-blue-100 rounded pl-2 p-1">
                    </div>
                </div>
            </div>
            <div class="border-r border-l border-b p-2">
                <h1>ผู้ประเมิน</h1>
                @foreach ($assessment_acknowledgement_choice as $assessment_acknowledgement)
                    <div>
                        <input type="checkbox" name="assessment_acknowledgement_num"
                            value="{{ $assessment_acknowledgement->id }}">
                        <label>{{ $assessment_acknowledgement->assessment_acknowledgement_name }}</label>
                    </div>
                @endforeach

                <div class="flex gap-2 ">
                    <div>
                        <label>เมื่่อวันที่</label>
                        <input type="date" class="bg-blue-100 rounded pl-2 p-1 ">
                    </div>

                    <div>
                        <div class="flex gap-2">

                            <div x-data="{
                                showSignaturePad2: false,
                                signatureUrl2: '',
                                saveSignature2() {
                                    let canvas = document.getElementById('signatureCanvas2');
                                    let signatureUrl = canvas.toDataURL('image/png'); // แปลงเป็น Base64
                                    this.signatureUrl2 = signatureUrl;
                                    this.showSignaturePad2 = false; // ปิด popup
                                }
                            }" class="mb-2 flex items-center gap-2">

                                <!-- แสดงลายเซ็นที่บันทึก -->
                                <label>ลงชื่อ</label>
                                <div class="flex gap-2 items-center mt-2">
                                    <template x-if="signatureUrl2">
                                        <img :src="signatureUrl2" alt="ลายเซ็น" class="w-32 h-10 border p-1">
                                    </template>
                                    <button @click="showSignaturePad2 = true" id="add_signature2"
                                        class="p-1 bg-blue-500 text-white text-sm rounded">
                                        เพิ่มลายเซ็น
                                    </button>
                                </div>

                                <!-- Modal สำหรับ Signature Pad -->
                                <div x-show="showSignaturePad2" x-transition.opacity x-cloak
                                    class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center">
                                    <div class="bg-white p-5 rounded-lg shadow-lg w-96">
                                        <h2 class="text-lg font-bold mb-2">ลงลายเซ็น</h2>

                                        <!-- Signature Pad -->
                                        <canvas id="signatureCanvas2" class="border w-full h-40"></canvas>

                                        <!-- ปุ่มล้าง / บันทึก -->
                                        <div class="flex justify-between mt-3">
                                            <button id="clear2"
                                                class="px-3 py-1 bg-gray-300 rounded">ล้างลายเซ็น</button>
                                            <button @click="saveSignature2()"
                                                class="px-3 py-1 bg-green-500 text-white rounded">บันทึก</button>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <!-- Script สำหรับ Signature Pad -->
                            <script>
                                document.addEventListener("DOMContentLoaded", function() {
                                    let canvas = document.getElementById("signatureCanvas2");
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

                                    document.getElementById("clear2").addEventListener("click", () => {
                                        ctx.clearRect(0, 0, canvas.width, canvas.height);
                                        resizeCanvas(); // รีเซ็ต Canvas
                                    });

                                    // ✅ บันทึกลายเซ็น
                                    window.saveSignature2 = function() {
                                        let signatureUrl = canvas.toDataURL("image/png"); // แปลงเป็น Base64
                                        let alpineData = document.querySelector("[x-data]").__x.$data;
                                        alpineData.signatureUrl2 = signatureUrl;
                                        alpineData.showSignaturePad2 = false; // ปิด popup
                                    }
                                });
                            </script>
                            <br>
                        </div>
                        <div class="">
                            <h1 class="text-center">({{ Auth::user()->name }})</h1 class="text-center">
                            <div class="flex gap-2">
                                <h1>ตำเเหน่ง</h1>
                                <span>{{ Auth::user()->JobPosition->job_position_name }}{{ Auth::user()->Tier->tier_name }}</span>
                            </div>
                            <label>วันที่</label>
                            <input type="date" class="bg-blue-100 rounded pl-2 p-1 mb-2">
                        </div>
                    </div>
                </div>

                <div class="flex justify-between">
                    <div class="">
                        <span>เเต่ผู้รับการประเมินไม่ลงนามรับทราบ</span><br>
                        <label>โดยมี</label>
                        <input type="text" class="bg-blue-100 rounded pl-2 p-1">
                        <label>เป็นพยาน</label>
                    </div>
                </div>
                <div class="ml-[10rem]">
                    <label>ลงชื่อ</label><br>
                    <input type="text" name="" class="bg-blue-100 rounded pl-2 p-1 mb-2">
                    <label>พยาน</label><br>
                    <label>ตำเเหน่ง</label>
                    <input type="text" name="" class="bg-blue-100 rounded pl-2 p-1 mb-2"><br>
                    <label>วันที่</label>
                    <input type="date" name="" class="bg-blue-100 rounded pl-2 p-1 mb-2">
                </div>
            </div>
        </div>

        <div>
            <h1 class="pt-[2rem] text-center">หน้าที่ ๒</h1>
            <h1 class="pl-[4rem]">ส่วนที่ ๕ ความเห็นผู้บังคับบัญชาเหนือขึ้นไป</h1>
            <div class="pl-[4rem] pr-[2rem]">
                <div class="border p-2">
                    <h1>ผู้บังคับบัญชาเหนือขึ้นไป</h1>
                    @foreach ($comment_choice as $comment)
                        <div class="pl-[4rem]">
                            <input type="radio" name="above_comment_num" value="{{ $comment->id }}">
                            <span>{{ $comment->comment_name }}</span>
                        </div>
                    @endforeach
                    <div class="flex justify-between pl-[4rem]">
                        <div>
                            <span>ดังนี้</span><br>
                            <textarea name="" class="bg-blue-100 rounded pl-2 p-1 mb-2 w-[25rem] h-[6rem]"></textarea>
                        </div>
                        <div>
                            <span>ลงชื่อ</span>
                            <input type="text" name="" class="bg-blue-100 rounded pl-2 p-1 mb-2"><br>
                            <span>ตำเเหน่ง</span>
                            <input type="text" name="" class="bg-blue-100 rounded pl-2 p-1 mb-2"><br>
                            <span>วันที่</span>
                            <input type="text" name="" class="bg-blue-100 rounded pl-2 p-1 mb-2">
                        </div>
                    </div>
                </div>
                <div class="border-r border-l border-b p-2">
                    <h1>ผู้บังคับบัญชาเหนือขึ้นไปอีกชั้นหนึ่ง (ถ้ามี)</h1>
                    @foreach ($comment_choice as $comment)
                        <div class="pl-[4rem]">
                            <input type="radio" name="further_comment_num" value="{{ $comment->id }}">
                            <span>{{ $comment->comment_name }}</span>
                        </div>
                    @endforeach
                    <div class="flex justify-between pl-[4rem]">
                        <div>
                            <span>ดังนี้</span><br>
                            <textarea name="" class="bg-blue-100 rounded pl-2 p-1 mb-2 w-[25rem] h-[6rem]"></textarea>
                        </div>
                        <div>
                            <span>ลงชื่อ</span>
                            <input type="text" name="" class="bg-blue-100 rounded pl-2 p-1 mb-2"><br>
                            <span>ตำเเหน่ง</span>
                            <input type="text" name="" class="bg-blue-100 rounded pl-2 p-1 mb-2"><br>
                            <span>วันที่</span>
                            <input type="text" name="" class="bg-blue-100 rounded pl-2 p-1 mb-2">
                        </div>
                    </div>
                </div>
            </div>
            <div class="pl-[4rem] pr-[2rem]">
                <h1>คำชี้เเจง</h1>
                <h1>เเบบสรุปผลการประเมินผลการปฏิบัติราชการ ประกอบด้วย</h1>
                <h1><span>ส่วนที่ ๑</span> ข้อมูลของผู้รับการประเมิน
                    เพื่อระบุรายละเอียดที่เกี่ยวข้องกับตัวผู้รับการประเมิน</h1>
                <h1><span>ส่วนที่ ๒</span> สรุปผลการประเมิน ใช้กรอกค่าคะเเนนการประเมินในองค์ประกอบด้านสัมฤทธิ์ของงาน
                    องค์ประกอบด้านพฟติกรรมการปฏิบัติราชการเเละน้ำหนักของทั้งสององค์ประกอบ ในเเบบสรุปส่วนที่ ๒ นี้
                    ยังใช้สำหรับคำนวณคะเเนนผลการปฏิบัติราชการรวมด้วย</h1>
                <h1>-สำหรับคะเเนนองค์ประกอบด้านผลสัมฤทธิ์ของงานให้นำมาจากเเบบประเมินสัมฤทธิ์ของงาน
                    โดยให้เเนบท้ายเเบบสรุปฉบับนี้</h1>
                <h1>-สำหรับคะแนนองค์กรประกอบด้านพฤติกรรมการปฏิบัติราชการให้นำมาจากเเบบประเมินสมรรถนะ
                    โดยให้เเนบท้ายเเบบสรุปฉบับนี้</h1>
                <h1><span>ส่วนที่ ๓</span> เเผนพัฒนาการปฏิบัติการรายบุคคล
                    ผู้ประเมินเเละผู้รับการประเมินร่วมกันจัดทำเเบบเเผนพัฒนาผลการปฏิบัติราชการ</h1>
                <h1><span>ส่วนที่ ๔</span> การรับทราบผลการประเมิน ผู้รับการประเมินลงนามรับทราบผลการประเมิน</h1>
                <h1><span>ส่วนที่ ๓</span> ความเห็นของผู้บังคับบัญชาเหนือขึ้นไป
                    ความเห็นของผู้บังคับบัญชาเหนือขึ้นไปกลั่นกรองผลการประเมิน เเผนพัฒนาผลการปฏิบัติราชการ
                    เเละให้ความเห็น คำว่า "ผู้บังคับบัญชาเหนือขึ้นไป" สำหรับผู้ประเมินตามข้อ ๒ (๙) หมายถึง
                    หัวหน้าส่วนราชการประจำจังหวัดผู้บังคับบัญชาของผู้รับการประเมิน
                </h1>
            </div>

        </div>
    </div>
    {{--  <div class="mt-4">


        <input type="hidden" name="signature" id="signatureData">
        <script>
            var canvas = document.getElementById('signatureCanvas');
            var signaturePad = new SignaturePad(canvas);

            document.getElementById('clear').addEventListener('click', function() {
                signaturePad.clear();
            });

            document.getElementById('save').addEventListener('click', function() {
                if (signaturePad.isEmpty()) {
                    alert("กรุณาเซ็นชื่อก่อนบันทึก");
                } else {
                    var signatureData = signaturePad.toDataURL(); // ได้ภาพลายเซ็นเป็น base64
                    document.getElementById('signatureData').value = signatureData;
                }
            });
        </script>
    </div>

{</body>

</html>
  --}}

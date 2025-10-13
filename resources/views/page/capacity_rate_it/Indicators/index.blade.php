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
    <div class="w-[95rem] mx-auto">
        <div class="flex justify-between">
            <div class="mt-[2rem]">
                <h1 class="font-bold">ส่วนที่ ๒ การสรุปผลการประเมิน</h1>
                <h1><span>ชื่อผู้รับการประเมิน</span></h1>
                <h1><span>ชื่อผู้บังคับบัญชา/ผู้ประเมิน</span></h1>
            </div>
            <div class="mt-[2rem]">
                <div>
                    <label for="">รอบการประเมิน</label>
                    <span>รอบที่ ๑</span>
                    <input type="radio" name="round">
                    <span>รอบที่ ๒</span>
                    <input type="radio" name="round">
                </div>
                <h1>ลงนาม</h1>
                <h1>ลงนาม</h1>
            </div>
        </div>
        <table class="w-full border mx-auto mb-[2rem] mt-[1rem]">
            <thead>
                <tr>
                    <th class="border-r w-[35rem] p-2" rowspan="2">ตัวชี้วัด</th>
                    <th class="w-[30rem] border-r p-2" colspan="5">คะเเนนตามระดับค่าเป้าหมาย</th>
                    <th class="border-r p-2">คะเเนน(ก)</th>
                    <th class="border-r p-2">น้ำหนัก(ข)</th>
                    <th>คะเเนนรวม(ค)</th>
                </tr>
                <tr class="border-b">
                    <th class="border-t border-r w-[5rem] p-2">๑</th>
                    <th class="border-t border-r w-[5rem] p-2">๒</th>
                    <th class="border-t border-r w-[5rem] p-2">๓</th>
                    <th class="border-t border-r w-[5rem] p-2">๔</th>
                    <th class="border-t border-r w-[5rem] p-2">๕</th>
                    <th class="border-t border-r p-2">( ก )</th>
                    <th class="border-t border-r p-2">( ข )</th>
                    <th class="border-t border-r p-2">( ค = ก x ข ) </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($groupedIndicators as $mainQuestionNum => $otherQuestionsGroup)
                    @foreach ($otherQuestionsGroup as $otherQuestionNum => $indicators)
                        <tr class="border-b p-2">
                            <td class="border-r p-2">{{ $otherQuestionNum }}.
                                {{ $indicators->first()->otherQuestion->other_question_name ?? 'N/A' }}

                                @foreach ($indicators as $indicator)
                                    <div class="pl-6 p-2">
                                        - {{ $indicator->indicator_name }}
                                    </div>
                                @endforeach

                            </td>
                            {{--  @if($indicator->other_question_num === 3)

                            @else

                            @endif  --}}
                            <td class="border-r p-2 text-center align-top">
                                <๖๐ </td>
                            <td class="border-r p-2 text-center align-top"> ๖๑-๗๐ </td>
                            <td class="border-r p-2 text-center align-top"> ๗๑-๘๐ </td>
                            <td class="border-r p-2 text-center align-top"> ๘๑-๙๐ </td>
                            <td class="border-r p-2 text-center align-top"> ๙๑-๑๐๐</td>
                            <td class="border-r p-2 text-center align-top">{{$indicator->otherQuestion->other_question_multiply}}</td>
                            <td class="border-r p-2 text-center align-top"></td>
                            <td class="border-r p-2 text-center align-top"></td>
                        </tr>
                    @endforeach
                @endforeach
                <tr class="border-t">
                    <td class="text-center border-r p-2" colspan="7"> รวม</td>
                    <td class="border-r pl-4 p-1"> (ข) = ๑๐๐%</td>
                    <td class=" pl-4 p-1"> (ค) = </td>
                </tr>
                <tr class="border-t">
                    <td class="text-left border-r p-2" colspan="7"> เเปลงคะเเนนรวม (ค) ข้างต้น
                        เป็นคะเเนนการประเมินผลสัมฤทธิ์ของงานที่มีฐานคะเเนนเต็มเป็น ๑๐๐ คะเเนน (โดยนำ ๒๐ มาคูณ)</td>
                    <td class="border-r pl-4 p-1"></td>
                    <td class=" pl-4 p-1"> (ค x ๒๐) = </td>
                </tr>
            </tbody>
        </table>

    </div>
</body>

</html>

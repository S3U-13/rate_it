@extends('layouts.user')

@section('title')
    ประเมินตัวเอง
@endsection

@section('content')
    <form action="{{ route('page.capacity_rate_it.self_rate_it.store') }}" method="POST"
        class="w-full max-w-4xl mx-auto p-6 bg-white shadow-lg rounded-lg border-gray-200 border">
        @csrf
        <input type="hidden" name="personal_num" value="{{ $personal->id }}">

        <div class="text-center bg-[#138f3c] text-white py-4 rounded-t-lg">
            <h4 class="text-xl font-semibold">📝 แบบประเมินความพึงพอใจ</h4>
        </div>

        <!-- ข้อมูลส่วนตัว -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 my-4">
            <div class="p-4 bg-gray-100 rounded-lg shadow">
                <h6 class="text-gray-600">ชื่อผู้ถูกประเมิน:</h6>
                <h5 class="text-gray-900 font-semibold">{{ $personal->name }}</h5>
            </div>
            <div class="p-4 bg-gray-100 rounded-lg shadow">
                <h6 class="text-gray-600">กลุ่ม:</h6>
                <h5 class="text-gray-900 font-semibold">{{ $personal->group->group_name }}</h5>
            </div>
        </div>

        <!-- ตารางแบบประเมิน -->
        <div class="overflow-x-auto">
            <table class="w-full border-collapse border border-gray-300 text-center text-sm">
                <thead class="bg-[#138f3c] text-white">
                    <tr>
                        <th class="p-2 border">ข้อ</th>
                        <th class="p-2 border">คำถาม</th>
                        <th class="p-2 border">ดีมาก (5)</th>
                        <th class="p-2 border">ดี (4)</th>
                        <th class="p-2 border">ปานกลาง (3)</th>
                        <th class="p-2 border">ต่ำ (2)</th>
                        <th class="p-2 border">ต่ำมาก (1)</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="bg-gray-200">
                        <td colspan="7" class="p-2 font-bold text-left">สมรรถนะหลัก</td>
                    </tr>
                    @php
                        $choiceMain = 1;
                    @endphp
                    @foreach ($MainQuestion as $index => $item)
                        @if ($item->main_question_status === 'on')
                            <tr class="border">
                                <td class="p-2 border">{{ $choiceMain++ }}</td>
                                <input type="hidden" name="main_question_num[]" value="{{ $item->id }}">
                                <td class="p-2 border text-left">{{ $item->main_question_name }}</td>
                                @php $multiplyFactor = $item->main_question_multiply ?: 1; @endphp
                                @for ($score = 5; $score >= 1; $score--)
                                    <td class="p-2 border">
                                        <input type="radio" name="main_score[{{ $index }}]"
                                            value="{{ $score * $multiplyFactor }}">
                                    </td>
                                @endfor
                            </tr>
                        @endif
                    @endforeach

                    <tr class="bg-gray-200">
                        <td colspan="7" class="p-2 font-bold text-left">สมรรถนะอื่นๆตามที่ส่วนราชการกำหนด</td>
                    </tr>
                    @php
                        $choiceOther = 1;
                    @endphp
                    @foreach ($OtherQuestion as $index => $item)
                        @if ($item->other_question_status === 'on')
                            <tr class="border">
                                <td class="p-2 border">{{ $choiceOther++ }}</td>
                                <input type="hidden" name="other_question_num[]" value="{{ $item->id }}">
                                <td class="p-2 border text-left">{{ $item->other_question_name }}</td>
                                @php $multiplyFactor = $item->other_question_multiply ?: 1; @endphp
                                @for ($score = 5; $score >= 1; $score--)
                                    <td class="p-2 border">
                                        <input type="radio" name="other_score[{{ $index }}]"
                                            value="{{ $score * $multiplyFactor }}">
                                    </td>
                                @endfor
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- ปุ่มส่งแบบประเมิน -->
        <div class="text-right mt-6">
            <button type="submit"
                class="bg-[#138f3c] hover:bg-green-700 text-white font-bold py-2 px-6 rounded-lg shadow-md">ส่งแบบประเมิน</button>
        </div>
    </form>
@endsection

@extends('layouts.user')

@section('title')
    หน้าประเเมินคะเเนน
@endsection

@section('content')
<form action="{{ route('page.capacity_rate_it.assessment_01.store') }}" method="POST" class="w-full max-w-4xl mx-auto p-6 bg-white shadow-lg rounded-lg border border-gray-200">
    @csrf
    <input type="hidden" name="personal_num" value="{{ $personal->id }}">

    <div class="text-center bg-[#138f3c] text-white py-4 rounded-t-lg">
        <h4 class="text-lg font-bold">📝 แบบประเมินความพึงพอใจ</h4>
    </div>

    <div class="p-6">
        <!-- ข้อมูลส่วนตัว -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
            <div class="bg-gray-100 p-4 rounded-lg shadow-sm">
                <h6 class="text-gray-600">ชื่อผู้ถูกประเมิน:</h6>
                <h5 class="text-gray-900 font-semibold">{{ $personal->name }}</h5>
            </div>
            <div class="bg-gray-100 p-4 rounded-lg shadow-sm">
                <h6 class="text-gray-600">กลุ่ม:</h6>
                <h5 class="text-gray-900 font-semibold">{{ $personal->group->group_name }}</h5>
            </div>
        </div>

        <!-- ตารางแบบประเมิน -->
        <div class="overflow-x-auto">
            <table class="w-full border-collapse border border-gray-300 text-center">
                <thead class="bg-[#138f3c] text-white">
                    <tr>
                        <th class="border border-gray-300 px-4 py-2">ข้อ</th>
                        <th class="border border-gray-300 px-4 py-2">คำถาม</th>
                        <th class="border border-gray-300 px-4 py-2">ดีมาก (5)</th>
                        <th class="border border-gray-300 px-4 py-2">ดี (4)</th>
                        <th class="border border-gray-300 px-4 py-2">ปานกลาง (3)</th>
                        <th class="border border-gray-300 px-4 py-2">ต่ำ (2)</th>
                        <th class="border border-gray-300 px-4 py-2">ต่ำมาก (1)</th>
                        <th class="border border-gray-300 px-4 py-2">ค่าน้ำหนัก</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $choiceOther = 1;
                    @endphp
                    @foreach ($OtherQuestion as $index => $item)
                    @if ($item->other_question_status === 'on')
                    <tr class="border border-gray-300">
                        <td class="border border-gray-300 px-4 py-2">{{ $choiceOther++ }}</td>
                        <input type="hidden" name="other_question_num[]" value="{{ $item->id }}">
                        <td class="border border-gray-300 px-4 py-2 text-left">{{ $item->other_question_name }}</td>
                        @php $multiplyFactor = $item->other_question_weight ?: 1; @endphp
                        @for ($score = 5; $score >= 1; $score--)
                            <td class="border border-gray-300 px-4 py-2">
                                <input type="radio" name="other_score[{{ $index }}]"
                                       value="{{ $score * $multiplyFactor }}" required>
                            </td>
                        @endfor
                        <td class="border border-gray-300 px-4 py-2">{{ $item->other_question_weight }}</td>
                    </tr>
                    @endif
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- ปุ่มส่งแบบประเมิน -->
        <div class="text-right mt-6">
            <button type="submit" class="bg-[#138f3c] hover:bg-green-700 text-white font-bold py-2 px-6 rounded-lg shadow-lg">
                ส่งแบบประเมิน
            </button>
        </div>
    </div>
</form>

@endsection

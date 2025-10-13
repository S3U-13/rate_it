@extends('layouts.admin')

@section('title')
    profile
@endsection

@section('content')
    <div class="p-2 sm:ml-64">
        <div class="pt-2 rounded-lg mt-14 pb-4">
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
           <div class="border border-[#006622] w-[400px] h-auto mx-auto mt-10 rounded-lg shadow-xl md:w-[440px]">
        <div class="text-center mt-4">
            <h1 class="text-3xl">โรงพยาบาลพระปกเกล้า</h1>
            <h1 class="text-">สำนักงานสาธารณสุขจังหวัดจันทบุรี</h1>
        </div>

        <div>
            <img class="w-36 h-36  border border-[#006622] rounded-full mx-auto mt-6"
                src="{{ optional(Auth::user()->Profile)->user_pic
                    ? asset('storage/profile/' . Auth::user()->Profile->user_pic)
                    : 'https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_960_720.png' }}"
                alt="">

            @if (optional(Auth::user()->Profile)->user_pic == null)
                <div class="bg-[#006622] p-1 rounded-lg hover:bg-[#014719] mx-auto mt-4 w-[5rem] text-center">
                    <a class="text-white text-sm" href="{{ url('admin/profile/create') }}">เพิ่มโปรไฟล์</a>
                </div>
            @else
                <div class="bg-[#006622] p-1 rounded-lg hover:bg-[#014719] mx-auto mt-4 w-[6rem] text-center">
                    <a class="text-white text-sm" href="{{ route('admin.profile.edit', Auth::user()->id) }}">แก้ไขโปรไฟล์</a>
                </div>
            @endif
        </div>

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
        @endphp

        <div class="flex flex-col justify-center mt-6 gap-8 pl-6 md:flex-row md:h-[300px] md:w-[380px] md:ml-[20px]">
            <div class="space-y-5">
                <div>
                    <span class="font-bold">ชื่อ</span>
                    <h1 class="text-sm">{{ Auth::user()->name }}</h1>
                </div>
                <div>
                    <span class="font-bold">วันเริ่มสัญญา</span>
                    <h1 class="text-sm">
                        {{ toThaiNumber(\Carbon\Carbon::parse(Auth::user()->contract_start_date)->locale('th')->addYears(543)->isoFormat('D MMMM YYYY')) }}
                    </h1>
                </div>
                <div>
                    <span class="font-bold">หน่วยงาน</span>
                    <h1 class="text-sm">{{ Auth::user()->Group->group_name }}</h1>
                </div>
                <div>
                    <span class="font-bold">ตำแหน่ง</span>
                    <h1 class="text-sm">{{ Auth::user()->JobPosition->job_position_name }}</h1>
                </div>
            </div>

            <div class="space-y-5">
                <div>
                    <span class="font-bold">ค่าจ้าง</span>
                    <h1 class="text-sm">{{ Auth::user()->wages }}</h1>
                </div>
                <div>
                    <span class="font-bold">วันสิ้นสุดสัญญาจ้าง</span>
                    <h1 class="text-sm">
                        {{ toThaiNumber(\Carbon\Carbon::parse(Auth::user()->end_date_of_employment_contract)->locale('th')->addYears(543)->isoFormat('D MMMM YYYY')) }}
                    </h1>
                </div>
                <div>
                    <span class="font-bold">สังกัด</span>
                    <h1 class="text-sm">{{ Auth::user()->WorkAffiliation->work_affiliation_name }}</h1>
                </div>
                <div>
                    <span class="font-bold">ระดับตำแหน่ง:</span>
                    <h1 class="text-sm">{{ Auth::user()->Tier->tier_name }}</h1>
                </div>
            </div>
        </div>
    </div>
        </div>
    </div>
@endsection

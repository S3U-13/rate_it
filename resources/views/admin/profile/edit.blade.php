@extends('layouts.admin')

@section('title')
    edit profile
@endsection

@section('content')
    <div class="p-2 sm:ml-64">
        <div class="pt-2 rounded-lg mt-14 pb-4">
            <div
                class="p-2 rounded-lg shadow-xl mx-auto border border-[#006622] w-[320px] h-[440px] overflow-hidden sm:mt-20 sm:w-[360px]
    sm:h-[560px] md:w-[500px] md:h-[720px] mt-10">
                <form action="{{ route('admin.profile.update', $profile->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <h1 class="text-center mt-4 sm:text-xl sm:mt-4 md:text-3xl  md:mt-10">อัพเดทรูปโปรไฟล์</h1>
                    {{-- รูปปัจจุบัน --}}
                    <div
                        class="border border-[#006622] w-[220px] h-[220px] mt-6 overflow-hidden mx-auto sm:mt-6 sm:w-[320px] sm:h-[320px] md:w-[400px] md:h-[400px] md:mt-10">
                        <img class="w-full" id="preview-image" src="{{ asset('storage/profile/' . $profile->user_pic) }}">
                    </div>

                    {{-- เลือกรูปใหม่ --}}
                    <input
                        class="w-[220px] ml-[40px] mt-[10px] sm:w-[320px] sm:mt-[10px] sm:ml-[10px] md:mt-[10px] md:ml-[40px] md:w-[400px]"
                        type="file" name="user_pic" id="user_pic" required accept="image/*"> <br>

                    <div
                        class="mx-auto mt-[20px]  h-[40px] w-[80px]  bg-[#006622] text-white flex justify-center items-center rounded-lg hover:bg-[#014719] sm:mt-[30px] sm:h-[50px] sm:w-[100px] md:mt-[40px]  md:h-[60px] md:w-[140px] ">
                        <button class="h-[40px] w-[80px] sm:h-[50px] sm:w-[100px] md:h-[60px] md:w-[140px]" type="submit">อัพโหลด</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- JavaScript แสดง preview ทับรูปเก่า --}}
    <script>
        document.getElementById('user_pic').addEventListener('change', function(event) {
            const file = event.target.files[0];
            const preview = document.getElementById('preview-image');

            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result; // เปลี่ยน src เป็นภาพใหม่
                }
                reader.readAsDataURL(file);
            }
        });
    </script>
@endsection

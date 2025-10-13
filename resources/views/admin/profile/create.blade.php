@extends('layouts.admin')

@section('title')
    add profile
@endsection

@section('content')
    <div class="p-2 sm:ml-64">
        <div class="pt-2 rounded-lg mt-14 pb-4">
            <div
                class="p-2 rounded-lg shadow-xl mx-auto border border-[#006622] w-[320px] h-[440px] overflow-hidden sm:mt-20 sm:w-[360px] sm:h-[560px] md:w-[500px] md:h-[720px] md:mt-10">
                <form action="{{ route('admin.profile.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <h1 class="text-center mt-4 sm:text-xl sm:mt-4 md:text-3xl  md:mt-10">เพิ่มรูปโปรไฟล์</h1>
                    <div
                        class="border border-[#006622] w-[220px] h-[220px] mt-6 overflow-hidden mx-auto sm:mt-6 sm:w-[320px] sm:h-[320px] md:w-[400px] md:h-[400px] md:mt-10">
                        <img class="w-full" id="preview"
                            src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_960_720.png"
                            alt="Preview" style="display: none;">
                    </div>
                    <input
                        class="w-[220px] ml-[40px] mt-[10px] sm:w-[320px] sm:mt-[10px] sm:ml-[10px] md:mt-[10px] md:ml-[40px] md:w-[400px]"
                        type="file" name="user_pic" id="user_pic" onchange="previewImage(event)">
                    <div
                        class="mx-auto mt-[20px]  h-[40px] w-[80px]  bg-[#006622] text-white flex justify-center items-center rounded-lg hover:bg-[#014719] sm:mt-[30px] sm:h-[50px] sm:w-[100px] md:mt-[40px]  md:h-[60px] md:w-[140px] ">
                        <button class="h-[40px] w-[80px] sm:h-[50px] sm:w-[100px] md:h-[60px] md:w-[140px]" type="submit">อัพโหลด</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
    <script>
        function previewImage(event) {
            const input = event.target;
            const preview = document.getElementById('preview');

            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection

@extends('layouts.admin')

@section('title')
    เพิ่มผู้ใช้งาน
@endsection

@section('content')
    <div class="p-2 sm:ml-64">
        <div class="flex items-center justify-center min-h-screen bg-gray-100 mt-15">
            <div class="w-full max-w-lg p-6 bg-white rounded-lg shadow-md">
                <h2 class="text-2xl font-semibold text-center text-gray-800 mb-4">หน้าเพิ่มผู้ใช้งาน</h2>

                <form action="{{ route('admin.personal.store') }}" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700">ชื่อ</label>
                        <input type="text" id="name" name="name"
                            class="w-full mt-1 p-2 border rounded-lg focus:ring focus:ring-gray-300 text-gray-700" required>
                    </div>
                    <div>
                        <label for="user_name" class="block text-sm font-medium text-gray-700">ชื่อผู้ใช้</label>
                        <input type="text" id="user_name" name="user_name"
                            class="w-full mt-1 p-2 border rounded-lg focus:ring focus:ring-gray-300 text-gray-700" required>
                    </div>
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700">รหัสผ่าน</label>
                        <input type="password" id="password" name="password"
                            class="w-full mt-1 p-2 border rounded-lg focus:ring focus:ring-gray-300 text-gray-700" required>
                        <small id="password_warning" class="block text-sm text-red-500 pt-2"></small>
                    </div>
                    <div>
                        <label for="password_confirmation"
                            class="block text-sm font-medium text-gray-700">ยืนยันรหัสผ่าน</label>
                        <input type="password" id="password_confirmation" name="password_confirmation"
                            class="w-full mt-1 p-2 border rounded-lg focus:ring focus:ring-gray-300 text-gray-700" required>
                        <small id="confirm_password_warning" class="block text-sm text-red-500 pt-2"></small>
                    </div>
                    <div>
                        <label for="group_num" class="block text-sm font-medium text-gray-700">กลุ่มงาน</label>
                        <select name="group_num" id="group_num"
                            class="w-full mt-1 p-2 border rounded-lg focus:ring focus:ring-gray-300 text-gray-700" required>
                            @foreach ($group as $item)
                                <option value="{{ $item->id }}">{{ $item->group_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="work_affiliation_num" class="block text-sm font-medium text-gray-700">สังกัดงาน</label>
                        <select name="work_affiliation_num" id="work_affiliation_num"
                            class="w-full mt-1 p-2 border rounded-lg focus:ring focus:ring-gray-300 text-gray-700" required>
                            @foreach ($work_affiliation as $item)
                                <option value="{{ $item->id }}" data-group="{{ $item->group_num }}">
                                    {{ $item->work_affiliation_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="job_position_num" class="block text-sm font-medium text-gray-700">ตำแหน่งงาน</label>
                        <select name="job_position_num" id="job_position_num"
                            class="w-full mt-1 p-2 border rounded-lg focus:ring focus:ring-gray-300 text-gray-700" required>
                            @foreach ($job_position as $item)
                                <option value="{{ $item->id }}">{{ $item->job_position_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="job_type_num" class="block text-sm font-medium text-gray-700">ประเภทงาน</label>
                        <select name="job_type_num" id="job_type_num"
                            class="w-full mt-1 p-2 border rounded-lg focus:ring focus:ring-gray-300 text-gray-700" required>
                            @foreach ($job_type as $item)
                                <option value="{{ $item->id }}">{{ $item->job_type_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="tier_num" class="block text-sm font-medium text-gray-700">ระดับงาน</label>
                        <select name="tier_num" id="tier_num"
                            class="w-full mt-1 p-2 border rounded-lg focus:ring focus:ring-gray-300 text-gray-700" required>
                            @foreach ($tier as $item)
                                <option value="{{ $item->id }}">{{ $item->tier_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="contract_start_date"
                            class="block text-sm font-medium text-gray-700">วันที่เริ่มต้นสัญญา</label>
                        <input name="contract_start_date" id="contract_start_date" type="date"
                            class="w-full mt-1 p-2 border rounded-lg focus:ring focus:ring-gray-300 text-gray-700">
                        </input>
                    </div>
                    <div>
                        <label for="end_date_of_employment_contract"
                            class="block text-sm font-medium text-gray-700">วันที่สิ้นสุดสัญญา</label>
                        <input name="end_date_of_employment_contract" id="end_date_of_employment_contract" type="date"
                            class="w-full mt-1 p-2 border rounded-lg focus:ring focus:ring-gray-300 text-gray-700">
                        </input>
                    </div>
                    <div>
                        <label id="wagesLabel" for="wages"
                            class="block text-sm font-medium text-gray-700">ค่าจ้าง</label>
                        <input name="wages" id="wages" type="number"
                            class="w-full mt-1 p-2 border rounded-lg focus:ring focus:ring-gray-300 text-gray-700">
                        </input>
                    </div>
                    <div>
                        <label for="role" class="block text-sm font-medium text-gray-700">role</label>
                        <select name="role" id="role"
                            class="w-full mt-1 p-2 border rounded-lg focus:ring focus:ring-gray-300 text-gray-700" required>
                            <option value="user">user</option>
                            <option value="admin">admin</option>
                        </select>
                    </div>


                    <button type="submit"
                        class="w-full p-2 text-white bg-[#138f3c] rounded-lg hover:bg-green-700">ลงทะเบียน</button>
                </form>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
            $(document).ready(function() {
                $("#password").on("input", function() {
                    let password = $(this).val();
                    if (password.length < 8) {
                        $("#password_warning").text("⚠️ รหัสผ่านต้องมีอย่างน้อย 8 ตัวอักษร").css("color",
                            "red");
                    } else {
                        $("#password_warning").text("");
                    }
                });

                $("#password_confirmation").on("input", function() {
                    if ($(this).val() !== $("#password").val()) {
                        $("#confirm_password_warning").text("⚠️ รหัสผ่านไม่ตรงกัน").css("color", "red");
                    } else {
                        $("#confirm_password_warning").text("");
                    }
                });
            });
            document.addEventListener("DOMContentLoaded", function() {
                let groupSelect = document.getElementById("group_num");
                let workSelect = document.getElementById("work_affiliation_num");
                let allOptions = Array.from(workSelect.options); // เก็บ option ทั้งหมด

                groupSelect.addEventListener("change", function() {
                    let selectedGroup = this.value;

                    workSelect.innerHTML = ""; // เคลียร์ option เดิม

                    allOptions.forEach(option => {
                        if (selectedGroup == "1" || option.dataset.group == selectedGroup) {
                            workSelect.appendChild(option);
                        }
                    });
                });
            });
            const jobTypeSelect = document.getElementById('job_type_num');
            const wagesLabel = document.getElementById('wagesLabel');

            jobTypeSelect.addEventListener('change', function() {
                const selectedValue = parseInt(this.value);
                if ([2, 5].includes(selectedValue)) {
                    wagesLabel.textContent = 'ค่าจ้าง รายวัน';
                } else if ([1, 3, 4].includes(selectedValue)) {
                    wagesLabel.textContent = 'ค่าจ้าง รายเดือน';
                } else {
                    wagesLabel.textContent = 'ค่าจ้าง'; // fallback default
                }
            });

            // ทำงานตอนโหลดหน้า กรณีค่า default ถูกเลือก
            window.addEventListener('DOMContentLoaded', () => {
                jobTypeSelect.dispatchEvent(new Event('change'));
            });
        </script>
    </div>
@endsection

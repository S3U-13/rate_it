<nav class="w-full border-b border-[#006622] bg-white">
    <div class="flex justify-between items-center px-6 lg:px-48 py-4">
        <!-- Logo -->
        <div class="flex items-center gap-6">
            <img class="h-14" src="https://ppk2024.semanticplus.co.th/assets/logo/logolong84.png" alt="logo">
        </div>

        <!-- Hamburger (mobile only) -->
        <div class="lg:hidden">
            <button onclick="toggleDropdown('mobile-menu')">
                <svg class="w-6 h-6 text-[#006622]" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16">
                    </path>
                </svg>
            </button>
        </div>

        <!-- Menu (Desktop) -->
        <div class="hidden lg:flex gap-24 items-center">
            <ul class="flex gap-12 text-[#006622] text-sm">
                <li><a href="{{ url('page/rate_it/index') }}">ประเมินบุคลากร</a></li>

                <!-- ประเมินสมรรถนะ -->
                <li><a href="{{ url('/page/capacity_rate_it/self_rate_it/index') }}">ประเมินตนเอง</a></li>

                <!-- สรุปผล -->
                <li class="relative">
                    <button onclick="toggleDropdown('dropdown-summary')" class="flex items-center gap-2">
                        สรุปผล
                        <svg class="w-3 h-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 4 4 4-4" />
                        </svg>
                    </button>
                    <div id="dropdown-summary" class="absolute hidden mt-2 bg-white border rounded shadow w-44 z-50">
                        <ul class="text-sm text-gray-700">
                            <li><a href="{{ url('/page/result/index') }}"
                                    class="block px-4 py-2 hover:bg-gray-100">แบบสรุปผลตามชื่อบุคลากร</a></li>
                            <li><a href="{{ url('/page/witness/index') }}"
                                    class="block px-4 py-2 hover:bg-gray-100">ลงชื่อพยาน</a></li>
                        </ul>
                    </div>
                </li>

                <!-- หัวหน้าประเมิน -->
                @if (in_array(Auth::user()->tier_num, [4, 11, 12]))
                    <li class="relative">
                        <button onclick="toggleDropdown('dropdown-head')" class="flex items-center gap-2">
                            หัวหน้าประเมิน
                            <svg class="w-3 h-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 1 4 4 4-4" />
                            </svg>
                        </button>
                        <div id="dropdown-head" class="absolute hidden mt-2 bg-white border rounded shadow w-44 z-50">
                            <ul class="text-sm text-gray-700">
                                @if (Auth::user()->tier_num === 4)
                                    <li><a href="{{ url('/page/capacity_rate_it/assessment_01/index') }}"
                                            class="block px-4 py-2 hover:bg-gray-100">หัวหน้าประเมินส่วนที่ 1</a></li>
                                    <li><a href="{{ url('/page/capacity_rate_it/assessment_02/index') }}"
                                            class="block px-4 py-2 hover:bg-gray-100">หัวหน้าประเมินส่วนที่ 2</a></li>
                                    <li><a href="{{ url('/page/capacity_rate_it/summarize/index') }}"
                                            class="block px-4 py-2 hover:bg-gray-100">ส่งผลประเมิน</a></li>
                                @elseif(Auth::user()->tier_num === 11)
                                    <li><a href="{{ url('/page/capacity_rate_it/above/index') }}"
                                            class="block px-4 py-2 hover:bg-gray-100">ความคิดเห็นรองผอ.</a></li>
                                @elseif(Auth::user()->tier_num === 12)
                                    <li><a href="{{ url('/page/capacity_rate_it/further/index') }}"
                                            class="block px-4 py-2 hover:bg-gray-100">ความคิดเห็นผอ.</a></li>
                                @endif
                            </ul>
                        </div>
                    </li>
                @endif
            </ul>
        </div>

        <!-- User Profile -->
        <div class="hidden lg:flex items-center gap-4">
            <div class="text-sm text-[#006622]">
                <div>ชื่อผู้ใช้ : {{ Auth::user()->name }}</div>
                <div>กลุ่มงาน : {{ Auth::user()->Group->group_name }}</div>
            </div>
            <div class="relative">
                <img onclick="toggleDropdown('dropdown-profile')"
                    class="w-12 h-12 rounded-full border border-[#006622] cursor-pointer"
                    src="{{ optional(Auth::user()->Profile)->user_pic
                        ? asset('storage/profile/' . optional(Auth::user()->Profile)->user_pic)
                        : 'https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_960_720.png' }}"
                    alt="">
                <div id="dropdown-profile"
                    class="absolute right-0 hidden mt-2 bg-white border rounded shadow w-44 z-50">
                    <ul class="text-sm text-gray-700">
                        <li><a href="{{ url('page/profile/index') }}"
                                class="block px-4 py-2 hover:bg-gray-100">ดูโปรไฟล์</a></li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">@csrf
                                <button type="submit"
                                    class="block w-full text-left px-4 py-2 hover:bg-gray-100">ออกจากระบบ</button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Mobile menu (ซ่อนโดย default) -->
    <div id="mobile-menu" class="lg:hidden hidden px-6 pb-4">
        <ul class="text-[#006622] space-y-2 text-sm">
            <div class="text-sm text-[#006622] border-b border-gray-300 pb-2">
                <div>ชื่อผู้ใช้ : {{ Auth::user()->name }}</div>
                <div>กลุ่มงาน : {{ Auth::user()->Group->group_name }}</div>
            </div>
            <li><a class="block hover:bg-gray-100" href="">หน้าหลัก</a></li>
            <li><a class="block hover:bg-gray-100"
                    href="{{ url('/page/capacity_rate_it/self_rate_it/index') }}">ประเมินตนเอง</a></li>
            <li><a class="block hover:bg-gray-100" href="{{ url('page/rate_it/index') }}">ประเมินบุคลากร</a></li>
            <li><a class="block hover:bg-gray-100" href="{{ url('/page/result/index') }}">สรุปผล</a></li>
            <li><a class="block hover:bg-gray-100 border-b border-gray-300 pb-2"
                    href="{{ url('/page/witness/index') }}">ลงชื่อพยาน</a>
            </li>
            @if (Auth::user()->tier_num === 4)
                <li><a class="block hover:bg-gray-100"
                        href="{{ url('/page/capacity_rate_it/assessment_01/index') }}">หัวหน้าประเมิน 1</a></li>
                <li><a class="block hover:bg-gray-100"
                        href="{{ url('/page/capacity_rate_it/assessment_02/index') }}">หัวหน้าประเมิน 2</a></li>
                <li><a class="block hover:bg-gray-100 border-b border-gray-300 pb-2"
                        href="{{ url('/page/capacity_rate_it/summarize/index') }}">ส่งผลประเมิน</a></li>
            @elseif(Auth::user()->tier_num === 11)
                <li><a class="block hover:bg-gray-100 border-b border-gray-300 pb-2"
                        href="{{ url('/page/capacity_rate_it/above/index') }}">ความคิดเห็นรองผอ.</a></li>
            @elseif(Auth::user()->tier_num === 12)
                <li><a class="block hover:bg-gray-100 border-b border-gray-300 pb-2"
                        href="{{ url('/page/capacity_rate_it/further/index') }}">ความคิดเห็นผอ.</a></li>
            @endif
            <li><a href="{{ url('page/profile/index') }}" class="block hover:bg-gray-100">ดูโปรไฟล์</a>
            </li>
            <li>
                <form method="POST" action="{{ route('logout') }}">@csrf
                    <button type="submit" class="block w-full text-left hover:bg-gray-100">ออกจากระบบ</button>
                </form>
            </li>
        </ul>
    </div>
</nav>

<script>
    function toggleDropdown(id) {
        const el = document.getElementById(id);
        if (!el) return;

        // ซ่อน dropdown อื่น
        document.querySelectorAll('.absolute').forEach(d => {
            if (d.id !== id) d.classList.add('hidden');
        });

        // toggle dropdown ที่เลือก
        el.classList.toggle('hidden');
    }

    // คลิกนอก dropdown เพื่อปิด
    document.addEventListener('click', function(e) {
        document.querySelectorAll('.absolute').forEach(dropdown => {
            if (!dropdown.contains(e.target) && !dropdown.previousElementSibling?.contains(e.target)) {
                dropdown.classList.add('hidden');
            }
        });
    });
</script>

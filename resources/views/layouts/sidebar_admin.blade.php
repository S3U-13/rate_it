<nav class="fixed top-0 z-50 w-full bg-white border-b border-[#138f3c] ">
    <div class="px-3 py-3 lg:px-5 lg:pl-3">
        <div class="flex items-center justify-between">
            <div class="flex items-center justify-start rtl:justify-end">
                <button data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar" aria-controls="logo-sidebar"
                    type="button"
                    class="inline-flex items-center p-2 text-sm text-[#006622] rounded-lg sm:hidden hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-[#006622]">
                    <span class="sr-only">Open sidebar</span>
                    <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path clip-rule="evenodd" fill-rule="evenodd"
                            d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z">
                        </path>
                    </svg>
                </button>
                <a href="https://ppk.moph.go.th/" class="flex ms-2 md:me-24">
                    <img src="https://ppk2024.semanticplus.co.th/assets/logo/logolong84.png" class="h-12 me-3 bg-white"
                        alt="FlowBite Logo" />
                </a>
            </div>
            <div class="flex items-center">
                <div class="flex items-center ms-3">
                    <div>
                        <button type="button"
                            class="flex text-sm bg-[#138f3c] rounded-full focus:ring-4 focus:ring-[#006622]"
                            aria-expanded="false" data-dropdown-toggle="dropdown-user">
                            <span class="sr-only">Open user menu</span>
                            <img class="w-10 h-10 rounded-full"
                                src="{{ optional(Auth::user()->Profile)->user_pic
                                    ? asset('storage/profile/' . optional(Auth::user()->Profile)->user_pic)
                                    : 'https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_960_720.png' }}"
                                alt="user photo">
                        </button>
                    </div>
                    <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded-sm shadow-sm border border-gray-200 shadow-lg"
                        id="dropdown-user">
                        <div class="px-4 py-3" role="none">
                            <p class="text-sm text-gray-700" role="none">
                                {{ Auth::user()->name }}
                            </p>
                            <p class="text-sm font-medium text-gray-700 truncate " role="none">
                                สถานะ {{ Auth::user()->role }}
                            </p>
                        </div>
                        <ul class="py-1" role="none">
                            <li class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 " role="menuitem">
                                <a href="{{ url('admin/profile/index') }}">ดูโปร์ไฟล์</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>

<aside id="logo-sidebar"
    class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full bg-white border-r border-[#138f3c] sm:translate-x-0 "
    aria-label="Sidebar">
    <div class="h-full px-3 pb-4 overflow-y-auto bg-white ">
        <ul class="space-y-2 font-medium">
            <li>
                <a href="{{ url('/admin/index') }}"
                    class="flex items-center p-2 text-[#006622] rounded-lg bg-gray-100 hover:bg-gray-200 group">
                    <span class="ms-3">Dashboard</span>
                </a>
            </li>
            <li>
                <a href="{{ url('/admin/personal/index') }}"
                    class="flex items-center p-2 text-[#006622] rounded-lg bg-gray-100 hover:bg-gray-200 group">
                    <span class="flex-1 ms-3 whitespace-nowrap">ผุู้ใช้งานเเละการล้างรอบประเมิน</span>
                </a>
            </li>
            <li>
                <a href="{{ url('/admin/evaluation_components/index') }}"
                    class="flex items-center p-2 text-[#006622] rounded-lg bg-gray-100 hover:bg-gray-200 group">
                    <span class="flex-1 ms-3 whitespace-nowrap">หมวดองค์ประกอบการประเมิน
                    </span>
                </a>
            </li>
            <li>
                <a href="{{ url('/admin/set_main_question/index') }}"
                    class="flex items-center p-2 text-[#006622] rounded-lg bg-gray-100 hover:bg-gray-200 group">
                    <span class="flex-1 ms-3 whitespace-nowrap">ตั้งค่าคำถามสมรรถนะหลัก</span>
                </a>
            </li>
            <li>
                <a href="{{ url('/admin/set_other_question/index') }}"
                    class="flex items-center p-2 text-[#006622] rounded-lg bg-gray-100 hover:bg-gray-200 group">
                    <span class="flex-1 ms-3 whitespace-nowrap">ตั้งค่าคำถามสมรรถนะอื่นๆ</span>
                </a>
            </li>
            <li>
                <a href="{{ url('/admin/set_indicator/index') }}"
                    class="flex items-center p-2 text-[#006622] rounded-lg bg-gray-100 hover:bg-gray-200 group">
                    <span class="flex-1 ms-3 whitespace-nowrap">ตั้งค่าตัวชี้วัด</span>
                </a>
            </li>
            <li>
                <a href="#" class="flex items-center p-2 text-white rounded-lg bg-red-500 hover:bg-red-600 group "
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <span class="flex-1 ms-3 whitespace-nowrap">ออกจากระบบ</span>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </a>
            </li>
        </ul>
    </div>
</aside>

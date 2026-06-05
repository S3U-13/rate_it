<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    @endif
</head>

<body class="font-sans antialiased ">
    <div class="bg-white">
        <img id="background" class="absolute-left-20 top-0 max-w-[877px]" src="" alt="" />
        <div class="relative min-h-screen flex flex-col items-center justify-center selection:bg-[#FF2D20] ">
            <div class="relative w-full max-w-2xl px-6 lg:max-w-7xl">
                <header class="grid grid-cols-2 items-center gap-2 py-10 lg:grid-cols-3">
                    <div class="flex lg:justify-center lg:col-start-2">
                        <img class="h-12 w-auto lg:h-16 lg:text-[#FF2D20]"
                            src="https://ppk2024.semanticplus.co.th/assets/logo/logolong84.png" alt="">
                    </div>
                    @if (Route::has('login'))
                        <nav class="-mx-3 flex flex-1 justify-end">
                            @auth
                                <a href="{{ url('/dashboard') }}"
                                    class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] ">
                                    Dashboard
                                </a>
                            @else
                                <a href="{{ route('login') }}"
                                    class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] ">
                                    Log in
                                </a>

                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}"
                                        class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] ">
                                        Register
                                    </a>
                                @endif
                            @endauth
                        </nav>
                    @endif
                </header>

                <main class="mt-6">
                    <div class="grid gap-6 lg:grid-cols-2 lg:gap-8">
                        <a href="https://ppk.moph.go.th/" id="docs-card"
                            class="flex flex-col items-start gap-6 overflow-hidden rounded-lg bg-white p-6 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)] ring-1 ring-white/[0.05] transition duration-300 hover:text-black/70 hover:ring-black/20 focus:outline-none focus-visible:ring-[#FF2D20] md:row-span-3 lg:p-10 lg:pb-10 ">
                            <div id="screenshot-container" class="relative flex w-full flex-1 items-stretch">
                                <img src=""
                                    alt="Laravel documentation screenshot"
                                    class="hidden aspect-video h-full w-full flex-1 rounded-[10px] object-top object-cover drop-shadow-[0px_4px_34px_rgba(0,0,0,0.25)] dark:block" />
                                <div
                                    class="absolute -bottom-16 -left-16 h-40 w-[calc(100%_+_8rem)] bg-gradient-to-b from-transparent via-white to-white ">
                                </div>
                            </div>

                            <div class="relative flex items-center gap-6 lg:items-end">
                                <div id="docs-card-content" class="flex items-start gap-6 lg:flex-col">
                                    <div class="pt-3 sm:pt-5 lg:pt-0">
                                        <h2 class="text-xl font-semibold text-black">30 บาทรักษาทุกที่
                                        </h2>

                                        <p class="mt-4 text-sm/relaxed">
                                            ขอเชิญชวนชาวจันทบุรีทุกท่าน ลงทะเบียนยืนยันตัวตน Health ID 30 บาทรักษาทุกที่
                                            ด้วยบัตรประชาชนใบเดียว
                                        </p>
                                    </div>
                                </div>

                                <svg class="size-6 shrink-0 stroke-[#006622] " xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 24 24" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M4.5 12h15m0 0l-6.75-6.75M19.5 12l-6.75 6.75" />
                                </svg>
                            </div>
                        </a>

                        <a href="https://ppk.moph.go.th/"
                            class="flex items-start gap-4 rounded-lg bg-white p-6 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)] ring-1 ring-white/[0.05] transition duration-300 hover:text-black/70 hover:ring-black/20 focus:outline-none focus-visible:ring-[#FF2D20] lg:pb-10 ">

                            <div class="pt-3 sm:pt-5">
                                <h2 class="text-xl font-semibold text-black">เจาะเลือดล่วงหน้า เปลี่ยนจาก วันเสาร์ เป็น
                                    วันอาทิตย์ </h2>

                                <p class="mt-4 text-sm/relaxed">
                                    ประชาสัมพันธ์การเปลี่ยนแปลงการให้บริการเจาะเลือดล่วงหน้า
                                    จากเดิมเปิดให้บริการวันเสาร์ เปลี่ยนมาเปิดให้บริการวันอาทิตย์ เริ่ม 4 พฤษภาคม 2568
                                    เป็นต้นไป
                                </p>
                            </div>

                            <svg class="size-6 shrink-0 self-center stroke-[#006622]" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 24 24" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M4.5 12h15m0 0l-6.75-6.75M19.5 12l-6.75 6.75" />
                            </svg>
                        </a>

                        <a href="https://ppk.moph.go.th/"
                            class="flex items-start gap-4 rounded-lg bg-white p-6 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)] ring-1 ring-white/[0.05] transition duration-300 hover:text-black/70 hover:ring-black/20 focus:outline-none focus-visible:ring-[#FF2D20] lg:pb-10 ">

                            <div class="pt-3 sm:pt-5">
                                <h2 class="text-xl font-semibold text-black">
                                    คัดกรองมะเร็งหลอดอาหารเเละกระเพาะอาหารในพระภิกษุสงฆ์</h2>

                                <p class="mt-4 text-sm/relaxed">
                                    โครงการส่องกล้องทางเดินอาหารส่วนต้นเพื่อคัดกรองมะเร็งหลอดอาหารเเละกระเพาะอาหารในพระภิกษุสงฆ์
                                    เนื่องในโอกาสครบรอบ 84 ปี โรงพยาบาลพระปกเกล้า
                                </p>
                            </div>

                            <svg class="size-6 shrink-0 self-center stroke-[#006622]" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 24 24" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M4.5 12h15m0 0l-6.75-6.75M19.5 12l-6.75 6.75" />
                            </svg>
                        </a>

                        <div
                            class="flex items-start gap-4 rounded-lg bg-white p-6 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)] ring-1 ring-white/[0.05] transition duration-300 hover:text-black/70 hover:ring-black/20 focus:outline-none focus-visible:ring-[#FF2D20] lg:pb-10 ">

                            <div class="pt-3 sm:pt-5">
                                <h2 class="text-xl font-semibold text-black">เปิดให้บริการอาคารจอดรถฟรี</h2>

                                <p class="mt-4 text-sm/relaxed">
                                    อาคารจอดรถ 10 ชั้น โรงพยาบาลพระปกเกล้า พร้อมเปิดให้บริการ วันที่ 24 มิถุนายน 2567
                                </p>
                            </div>
                            <svg class="size-6 shrink-0 self-center stroke-[#006622]" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 24 24" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M4.5 12h15m0 0l-6.75-6.75M19.5 12l-6.75 6.75" />
                            </svg>
                        </div>
                    </div>
                    <div class="mb-[8rem]"></div>
                </main>
            </div>
        </div>
    </div>
</body>

</html>

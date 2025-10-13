<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/js/all.min.js" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@200;400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: "Kanit", sans-serif;
            font-weight: 600;
        }
    </style>
</head>

<body>
    <div class="flex items-center justify-center min-h-screen bg-gray-100">
        <div class="w-full max-w-md p-6 bg-white rounded-lg shadow-md">
            <h2 class="text-2xl font-semibold text-center text-gray-900 mb-8 pt-8">เข้าสู่ระบบ</h2>

            <!-- Success Message -->
            @if (session('success'))
                <div class="mb-4 p-3 text-green-700 bg-green-100 border border-green-400 rounded text-center">
                    <i class="fas fa-check-circle mr-2"></i> {{ session('success') }}
                </div>
            @endif
            @error(session('login_fail'))
                <div class="mb-4 p-3 text-white bg-red-500 border border-red-700 rounded text-center">
                    <i class="fas fa-times-circle mr-2"></i> {{ $message }}
                </div>
            @enderror
            <form action="/login" method="POST" class="space-y-4 w-[20rem] mx-auto">
                @csrf
                <div>
                    <label for="user_name" class="block text-lg font-medium text-gray-900 font-bold">ชื่อผู้ใช้</label>
                    <input type="text" id="user_name" name="user_name"
                        class="w-full mt-1 p-2 border rounded-lg focus:ring focus:ring-gray-300 text-gray-700" required
                        placeholder="กรอกชื่อผู้ใช้">
                </div>
                <div>
                    <label for="password" class="block text-lg font-medium text-gray-900 font-bold">รหัสผ่าน</label>
                    <div class="relative">
                        <input type="password" id="password" name="password"
                            class="w-full mt-1 p-2 border rounded-lg pr-10 focus:ring focus:ring-gray-300 text-gray-700"
                            placeholder="กรอกรหัสผ่าน">
                        <button type="button" class="absolute inset-y-0 right-2 flex items-center pt-1 pr-2"
                            id="togglePassword">
                            <i class="fas fa-eye text-gray-500 text-xl"></i>
                        </button>
                    </div>

                </div>

                <div class="flex justify-between items-center text-sm">
                    <div>
                        <input type="checkbox" id="remember" name="remember" class="mr-2">
                        <label for="remember" class="text-gray-600">Remember Me</label>
                    </div>
                    <a href="#" class="text-gray-600 hover:underline">ลืมรหัสผ่าน?</a>
                </div>
                <button type="submit"
                    class="w-full p-2 text-white bg-[#138f3c] rounded-lg hover:bg-green-700">เข้าสู่ระบบ</button>
            </form>
        </div>
    </div>
    <script>
        document.getElementById('togglePassword').addEventListener('click', function() {
            const password = document.getElementById('password');
            const icon = this.querySelector('i');
            if (password.type === 'password') {
                password.type = 'text';
                icon.classList.replace('fa-eye', 'fa-eye-slash');
            } else {
                password.type = 'password';
                icon.classList.replace('fa-eye-slash', 'fa-eye');
            }
        });
    </script>
</body>

</html>

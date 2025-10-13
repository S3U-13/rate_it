<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    //
    public function index()
    {
        $user = Auth::user();
        $profiles = User::where('id', $user->id)->get();
        return view('page.profile.index', compact('profiles'));
    }

    public function create()
    {
        // ถ้าผู้ใช้มี profile แล้ว ไม่ให้เข้าหน้า create
        // if (Auth::user()->profile_num) {
        //     return redirect()->route('page.profile.index')->with('info', 'คุณมีโปรไฟล์อยู่แล้ว');
        // }

        return view('page.profile.create'); // หน้าฟอร์มสร้างโปรไฟล์
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_pic' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        try {
            if ($request->hasFile('user_pic')) {
                $file = $request->file('user_pic');
                $filename = time() . '_' . $file->getClientOriginalName();
                $directory = 'profile'; // อย่าใส่ public/ ซ้ำ

                // สร้างโฟลเดอร์ถ้ายังไม่มี (บน disk 'public')
                if (!Storage::disk('public')->exists($directory)) {
                    Storage::disk('public')->makeDirectory($directory);
                }

                // บันทึกไฟล์ลง disk 'public' ที่ path profile/
                Storage::disk('public')->putFileAs($directory, $file, $filename);

                // สร้าง profile
                $profile = Profile::create([
                    'user_pic' => $filename,
                    // เพิ่มฟิลด์อื่น ๆ หากมี
                ]);

                // อัปเดต user ให้ชี้ profile_num
                Auth::user()->update([
                    'profile_num' => $profile->id,
                ]);

                return redirect()->route('page.profile.index')->with('success', 'เพิ่มโปรไฟล์สำเร็จ!');
            } else {
                return redirect()->back()->with('error', 'ไม่พบไฟล์ที่อัปโหลด');
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'เกิดข้อผิดพลาด: ' . $th->getMessage());
        }
    }
    public function edit()
    {
        $profile = Auth::user()->profile; // ดึงโปรไฟล์ของผู้ใช้ที่ล็อกอิน

        if (!$profile) {
            return redirect()->route('page.profile.index')->with('error', 'ยังไม่มีข้อมูลโปรไฟล์');
        }

        return view('page.profile.edit', compact('profile'));
    }


    public function update(Request $request)
    {
        $request->validate([
            'user_pic' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $profile = Auth::user()->profile;

        if (!$profile) {
            return redirect()->route('page.profile.index')->with('error', 'ไม่พบโปรไฟล์');
        }

        try {
            if ($request->hasFile('user_pic')) {
                $file = $request->file('user_pic');
                $filename = time() . '_' . $file->getClientOriginalName();
                $directory = 'profile'; // ตรงนี้ไม่ต้องใส่ public

                // ลบไฟล์เก่า (จาก disk 'public')
                if ($profile->user_pic && Storage::disk('public')->exists($directory . '/' . $profile->user_pic)) {
                    Storage::disk('public')->delete($directory . '/' . $profile->user_pic);
                }

                // เก็บไฟล์ใหม่ลง disk 'public'
                Storage::disk('public')->putFileAs($directory, $file, $filename);

                // อัปเดตชื่อไฟล์ใน profile
                $profile->user_pic = $filename;
            }

            $profile->save();

            return redirect()->route('page.profile.index')->with('success', 'อัปเดตโปรไฟล์สำเร็จ!');
        } catch (\Throwable $th) {
            return redirect()->route('page.profile.index')->with('error', 'อัปเดตโปรไฟล์ไม่สำเร็จ: ' . $th->getMessage());
        }
    }
    public function index_admin()
    {
        $user = Auth::user();
        $profiles = User::where('id', $user->id)->get();
        return view('admin.profile.index', compact('profiles'));
    }

    public function create_admin()
    {
        // ถ้าผู้ใช้มี profile แล้ว ไม่ให้เข้าหน้า create
        // if (Auth::user()->profile_num) {
        //     return redirect()->route('page.profile.index')->with('info', 'คุณมีโปรไฟล์อยู่แล้ว');
        // }

        return view('admin.profile.create'); // หน้าฟอร์มสร้างโปรไฟล์
    }

    public function store_admin(Request $request)
    {
        $request->validate([
            'user_pic' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        try {
            if ($request->hasFile('user_pic')) {
                $file = $request->file('user_pic');
                $filename = time() . '_' . $file->getClientOriginalName();
                $directory = 'profile'; // อย่าใส่ public/ ซ้ำ

                // สร้างโฟลเดอร์ถ้ายังไม่มี (บน disk 'public')
                if (!Storage::disk('public')->exists($directory)) {
                    Storage::disk('public')->makeDirectory($directory);
                }

                // บันทึกไฟล์ลง disk 'public' ที่ path profile/
                Storage::disk('public')->putFileAs($directory, $file, $filename);

                // สร้าง profile
                $profile = Profile::create([
                    'user_pic' => $filename,
                    // เพิ่มฟิลด์อื่น ๆ หากมี
                ]);

                // อัปเดต user ให้ชี้ profile_num
                Auth::user()->update([
                    'profile_num' => $profile->id,
                ]);

                return redirect()->route('admin.profile.index')->with('success', 'เพิ่มโปรไฟล์สำเร็จ!');
            } else {
                return redirect()->back()->with('error', 'ไม่พบไฟล์ที่อัปโหลด');
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'เกิดข้อผิดพลาด: ' . $th->getMessage());
        }
    }
    public function edit_admin()
    {
        $profile = Auth::user()->profile; // ดึงโปรไฟล์ของผู้ใช้ที่ล็อกอิน

        if (!$profile) {
            return redirect()->route('admin.profile.index')->with('error', 'ยังไม่มีข้อมูลโปรไฟล์');
        }

        return view('admin.profile.edit', compact('profile'));
    }


    public function update_admin(Request $request)
    {
        $request->validate([
            'user_pic' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $profile = Auth::user()->profile;

        if (!$profile) {
            return redirect()->route('admin.profile.index')->with('error', 'ไม่พบโปรไฟล์');
        }

        try {
        if ($request->hasFile('user_pic')) {
            $file = $request->file('user_pic');
            $filename = time() . '_' . $file->getClientOriginalName();
            $directory = 'profile'; // ตรงนี้ไม่ต้องใส่ public

            // ลบไฟล์เก่า (จาก disk 'public')
            if ($profile->user_pic && Storage::disk('public')->exists($directory . '/' . $profile->user_pic)) {
                Storage::disk('public')->delete($directory . '/' . $profile->user_pic);
            }

            // เก็บไฟล์ใหม่ลง disk 'public'
            Storage::disk('public')->putFileAs($directory, $file, $filename);

            // อัปเดตชื่อไฟล์ใน profile
            $profile->user_pic = $filename;
        }

        $profile->save();

        return redirect()->route('admin.profile.index')->with('success', 'อัปเดตโปรไฟล์สำเร็จ!');
    } catch (\Throwable $th) {
        return redirect()->route('admin.profile.index')->with('error', 'อัปเดตโปรไฟล์ไม่สำเร็จ: ' . $th->getMessage());
    }
    }
}

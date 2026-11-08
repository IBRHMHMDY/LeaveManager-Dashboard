<?php
// database/seeders/AdminSeeder.php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        // إنشاء أو تحديث حساب المدير الوحيد
        User::updateOrCreate(
            ['email' => 'ibrhmhmdy@gmail.com'],
            [
                'name' => 'System Admin',
                'password' => Hash::make('Admin@20.30'),
                'email_verified_at' => now(),
            ]
        );

        // حذف أي مستخدمين آخرين لضمان وجود مالك واحد فقط للوحة الإدارة
        User::where('email', '!=', 'ibrhmhmdy@gmail.com')->delete();
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable; // استيراد Authenticatable

class Admin extends Authenticatable
{
    use HasFactory;

    // إضافة الخصائص التي يمكن ملؤها (fillable)
    protected $fillable = ['name', 'email', 'password'];

    // خصائص أخرى يمكن إضافتها حسب الحاجة مثل:
    protected $hidden = ['password', 'remember_token']; // إخفاء كلمة المرور و remember_token عند استرجاع البيانات

    // تعيين السمة للتواريخ مثل created_at و updated_at
    protected $dates = ['created_at', 'updated_at'];
}

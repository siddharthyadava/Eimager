<?php 
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
// use Illuminate\Database\Eloquent\Model;

class CustomPasswordReset extends Model
{
    protected $table = 'custom_password_resets';

    protected $fillable = [
        'email',
        'otp',
        'token',
        'created_at',
        'updated_at'
    ];

    public $timestamps = true;
}

<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegisterData extends Model
{
    use HasFactory;

    protected $table = 'register_data';

    protected $fillable = [
        'first_name',
        'email',
        'phone_number',
        'password',
        'aadhar_number',
        'pan_number',
        'dob',
        'unique_id',
        'profile_image',
    ];
}

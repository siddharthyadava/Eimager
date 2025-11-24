<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfileUpdateRequest extends Model
{
    use HasFactory;

    protected $table = 'user_profile_update_request';

    protected $fillable = [
        'eimager_id',
        'existing_name',
        'new_name',
        'existing_aadhar',
        'new_aadhar',
        'existing_pan',
        'new_pan',
        'image',
    ];
}

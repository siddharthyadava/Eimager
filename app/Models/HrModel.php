<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HrModel extends Model
{
    use HasFactory;
    protected $table = 'hr_data';
    protected $fillable = [
        'hr_name',
        'hr_email',
        'hr_phone',
        'hr_password',
        'hr_aadhar',
        'hr_pan',
        'hr_dob',
        'hr_unique_id',
        'company_name',
        'username',
        'reporting_manager_mail',
        'employee_profile_otp',
        'register_otp',
        'is_register_verified',
        'reporting_manager_name',
        'reporting_manager_contact',
        'company_website',
        'employee_approval_rejection_otp',
        'employee_lwd_update_otp',
        'is_hr_admin',
        'is_profile_deactivated',
        'profile_deactivated_by',
    ];
}
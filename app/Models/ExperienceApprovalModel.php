<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExperienceApprovalModel extends Model
{
    use HasFactory;

    protected $table = 'user_experience_approval';

    protected $fillable = [
        'experience_id',
        'approver_email',
        'approval_status',
        'status_note',
    ];
}

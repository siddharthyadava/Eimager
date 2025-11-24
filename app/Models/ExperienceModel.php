<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExperienceModel extends Model
{
    use HasFactory;

    protected $table = 'user_experience';

    protected $fillable = [
        'eimager_id',
        'company_name',
        'designation',
        'projects',
        'start_date',
        'end_date',
        'is_still_working',
        'ctc',
        'in_hand',
        'roles_responsibility',
    ];
}

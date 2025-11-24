<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QualificationModel extends Model
{
    use HasFactory;

    protected $table = 'user_qualification';

    protected $fillable = [
        'eimager_id',
        'school',
        'degree',
        'study',
        'start_date',
        'end_date',
        'grade',
        'description',
    ];
}

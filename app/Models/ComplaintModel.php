<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComplaintModel extends Model
{
    use HasFactory;

    protected $table = 'user_complaint';

    protected $fillable = [
        'employee_eimager_id',
        'name',
        'description',
        'raised_by_employee_id',
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Career extends Model
{
    use HasFactory;

    protected $table = 'careers'; // Define table name

    protected $fillable = [
        'career_name',
        'career_email',
        'career_contact_number',
        'career_current_designation',
        'career_applied_post',
        'career_total_experience',
        'career_current_ctc',
        'career_expected_ctc',
        'career_notice_period',
    ];
}

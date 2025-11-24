<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AdminActivity extends Model
{
    use HasFactory;

    protected $table = 'admin_activities';

    protected $fillable = [
        'admin_id','action','subject_type','subject_id',
        'message','changes','ip_address','user_agent',
    ];

    protected $casts = [
        'changes' => 'array',
    ];

    public function admin()
    {
        // relate to the custom Admin model (table: admin)
        return $this->belongsTo(Admin::class, 'admin_id');
    }

    public function subject()
    {
        return $this->morphTo(null, 'subject_type', 'subject_id');
    }
}

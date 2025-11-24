<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Contact extends Model
{
    use HasFactory;

    protected $table = 'ca_contact'; // Table name
    protected $primaryKey = 'ca_id';

    protected $fillable = [
        'ca_name',
        'ca_email',
        'ca_number',
        'ca_address',
        'ca_type',
        'ca_message'
    ];
}

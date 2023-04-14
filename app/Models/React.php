<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class React extends Model
{
    use HasFactory;

    // Define the table name
    protected $table = 'reacts';

    // Define the fillable columns
    protected $fillable = [
        'user_id',
        'status_id',
        'reaction',
    ];

    // Define the user relationship
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Define the status relationship
    public function status()
    {
        return $this->belongsTo(Status::class);
    }
}

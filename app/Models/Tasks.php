<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Tasks extends Model
{
    use HasFactory;
    protected $table = "tasks";

    protected $fillable = [
        'title',
        'description',
        'deadline',
        'user_id',
        'workspace_id',
        'status',
    ];

    protected $casts = [
        'deadline' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function workspace()
    {
        return $this->belongsTo(WorkSpace::class);
    }
}

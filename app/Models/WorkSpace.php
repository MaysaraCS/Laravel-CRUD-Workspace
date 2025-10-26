<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class WorkSpace extends Model
{
    use HasFactory;

    protected $table = 'work_spaces';

    protected $fillable = [
        'name',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tasks()
    {
        return $this->hasMany(Tasks::class, 'workspace_id');
    }
}

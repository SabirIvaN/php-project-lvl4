<?php

namespace App;

use App\User;
use App\Label;
use App\Status;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'name', 'description', 'status_id', 'created_by_id', 'assigned_to_id',
    ];

    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class);
    }

    public function assignedTo()
    {
        return $this->belongsTo(User::class);
    }

    public function labels()
    {
        return $this->belongsToMany(Label::class);
    }
}

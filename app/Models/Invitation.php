<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invitation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'invited_by',
        'invitable_id',
        'invitable_type',
        'role',
        'status',
        'token',
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function invitedBy()
    {
        return $this->belongsTo(User::class, 'invited_by');
    }

    public function invitable()
    {
        return $this->morphTo();
    }

    public function accept()
    {
        $this->status = 'accepted';
        $this->save();
    }

    public function decline()
    {
        $this->status = 'declined';
        $this->save();
    }

    public function isPending()
    {
        return $this->status === 'pending';
    }

}

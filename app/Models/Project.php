<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'workspace_id',
        'status',
    ];

    public function workspace()
    {
        return $this->belongsTo(Workspace::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class)->using(ProjectTag::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class)->using(ProjectUser::class);
    }
}

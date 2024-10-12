<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'workspace_id',
    ];

    public function workspace()
    {
        return $this->belongsTo(Workspace::class);
    }

    public function projects()
    {
        return $this->belongsToMany(Project::class)->using(ProjectTag::class);
    }
}

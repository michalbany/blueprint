<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Workspace extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function projects()
    {
        return $this->hasMany(Project::class);
    }

    public function members()
    {
        return $this->belongsToMany(User::class, 'workspace_users')
            ->using(WorkspaceUser::class)
            ->withPivot('role');
    }

    public function owner()
    {
        return $this->members()->wherePivot('role', 'owner');
    }

    public function tags()
    {
        return $this->hasMany(Tag::class);
    }

    public static function current()
    {
        $workspaceId = session('current_workspace_id');
        if ($workspaceId) {
            return static::where('id', $workspaceId)->first();
        } else {
            return static::default();
        }
    }

    public static function switch($workspaceId)
    {
        session(['current_workspace_id' => $workspaceId]);
    }

    public static function clear()
    {
        session()->forget('current_workspace_id');
    }

    /**
     * Default workspace for the user is the
     * first workspace where the user is the owner.
     */
    public static function default()
    {
        if (Auth::check()) {
            $defaultWorkspace = Auth::user()->workspaces()->wherePivot('role', 'owner')
                ->orderBy('id')
                ->first();

            if ($defaultWorkspace) {
                session(['current_workspace_id' => $defaultWorkspace->id]);
                return $defaultWorkspace;
            }

            return null;
        }
    }

}
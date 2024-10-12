<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Component extends Model
{
    use HasFactory;

    protected $fillable = [
        'page_id',
        'type',
        'data',
        'order',
    ];

    public function page()
    {
        return $this->belongsTo(Page::class);
    }

    public function moveBefore(Component $component)
    {
        $this->order = $component->order - 1;
        $this->save();
    }

    public function moveAfter(Component $component)
    {
        $this->order = $component->order + 1;
        $this->save();
    }

    public function moveToPosition(int $position)
    {
        $this->order = $position;
        $this->save();
    }

    public function moveUp()
    {
        $this->order--;
        $this->save();
    }

    public function moveDown()
    {
        $this->order++;
        $this->save();
    }

    public function duplicate()
    {
        $this->page->components()->create([
            'type' => $this->type,
            'data' => $this->data,
            'order' => $this->order + 1,
        ]);
    }
}

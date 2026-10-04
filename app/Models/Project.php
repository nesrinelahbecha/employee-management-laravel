<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'description', 'start_date', 'end_date', 'status', 'budget',
    ];

    public function employees(): BelongsToMany
{
    return $this->belongsToMany(Employee::class, 'project_employee')->withPivot('role')->withTimestamps();
}
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Employee extends Model
{
    use HasFactory;

   protected $fillable = [
    'first_name', 'last_name', 'email', 'phone', 'address', 'linkedin',
    'position', 'photo', 'cv_path', 'hire_date', 'department_id',
];

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }

    public function projects(): BelongsToMany
{
    return $this->belongsToMany(Project::class, 'project_employee')->withPivot('role')->withTimestamps();
}
}
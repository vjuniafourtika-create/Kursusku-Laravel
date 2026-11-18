<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    public function enrollments(): HasMany
{
    return $this->hasMany(Enrollment::class);
}

public function participants(): BelongsToMany
{
    return $this->belongsToMany(
        Participant::class,
        'enrollments'
    )
    ->withPivot('status')
    ->withTimestamps();
}
    protected $fillable = [
        'code',
        'name',
        'description',
        'fee',
        'quota',
        'start_date',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'start_date' => 'date',
        ];
    }
}
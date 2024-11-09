<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class CourseStudent extends Model
{
    use CrudTrait;
    use HasFactory;

    protected $table='course_student';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'course_id',
        'student_id',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'course_id' => 'integer',
        'student_id' => 'integer',
    ];

    public function students(): BelongsToMany
    {
        return $this->BelongsToMany(Student::class);
    }

    public function courses(): BelongsToMany
    {
        return $this->BelongsToMany(Course::class);
    }

    public function student(): BelongsTo
    {
        return $this->BelongsTo(Student::class);
    }

    public function course(): BelongsTo
    {
        return $this->BelongsTo(Course::class);
    }
}

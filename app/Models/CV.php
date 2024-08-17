<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use mysql_xdevapi\Table;

class CV extends Model
{
    use HasFactory, softDeletes;
    protected $fillable =
        [
            'user_id',
            'first_name',
            'last_name',
            'email',
            'phone',
            'birth_date',
            'country',
            'city',
            'picture'
        ];
    protected $with = [
        'experiences',
        'educations',
        'licenses',
        'languages',
        'skills'
    ];
    protected $table = 'cv';
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function skills(): HasMany
    {
        return $this->hasMany(Skill::class, 'cv_id', 'id');
    }
    public function experiences(): HasMany
    {
        return $this->hasMany(Experience::class, 'cv_id', 'id');
    }
    public function educations(): HasMany
    {
        return $this->hasMany(Education::class, 'cv_id', 'id');
    }
    public function licenses(): HasMany
    {
        return $this->hasMany(License::class, 'cv_id', 'id');
    }
    public function languages(): HasMany
    {
        return $this->hasMany(Language::class, 'cv_id', 'id');
    }
}

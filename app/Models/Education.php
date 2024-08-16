<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Education extends Model
{
    use HasFactory, softDeletes;

    protected $fillable =
        [
            'level',
            'institution',
            'start_date',
            'end_date'
        ];
    public function cv(): BelongsTo
    {
        return $this->belongsTo(Cv::class, 'id', 'cv_id');
    }
}

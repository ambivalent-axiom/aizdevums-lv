<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Experience extends Model
{
    use HasFactory, softDeletes;
    protected $fillable =
        [
            'company',
            'position',
            'business_type',
            'start_date',
            'end_date'
        ];
    public function cv(): BelongsTo
    {
        return $this->belongsTo(Cv::class, 'id', 'cv_id');
    }
}

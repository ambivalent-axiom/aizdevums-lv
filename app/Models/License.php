<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class License extends Model
{
    use HasFactory, softDeletes;
    protected $fillable =
        [
            'cv_id',
            'license_name',
            'license_institution',
            'license_id',
            'license_issue_date',
        ];
    public function cv(): BelongsTo
    {
        return $this->belongsTo(Cv::class, 'id', 'cv_id');
    }

}

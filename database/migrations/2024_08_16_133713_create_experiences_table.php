<?php

use App\Models\CV;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('experiences', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(CV::class, 'cv_id')->constrained('cv')->cascadeOnDelete();
            $table->string('experience_company');
            $table->string('experience_position');
            $table->string('experience_business_type');
            $table->date('experience_start_date');
            $table->date('experience_end_date')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->unique(['cv_id', 'id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('experiences');
    }
};

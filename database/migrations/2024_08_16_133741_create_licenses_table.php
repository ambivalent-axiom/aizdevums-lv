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
        Schema::create('licenses', function (Blueprint $table) {
           $table->id();
           $table->foreignIdFor(CV::class, 'cv_id')->constrained('cv')->cascadeOnDelete();
           $table->string('license_name');
           $table->string('license_institution')->nullable();
           $table->string('license_id')->nullable();
           $table->date('license_issue_date')->nullable();
           $table->timestamps();
           $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('licenses');
    }
};

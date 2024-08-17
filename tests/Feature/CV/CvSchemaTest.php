<?php

use App\Models\CV;
use App\Models\Education;
use App\Models\Experience;
use App\Models\Language;
use App\Models\License;
use App\Models\Skill;

it('should be able to create CV', function () {
    CV::factory()->create();
    $this->assertDatabaseCount('cv', 1);
});
it('should be able to update CV', function () {
    $cv = CV::factory()->create();
    $cv->first_name = 'John';
    $cv->save();
    $this->assertDatabaseHas('cv', [
        'id' => $cv->id,
        'first_name' => 'John',
    ]);
});
it('should be able to softDelete CV', function () {
    $cv = CV::factory()->create();
    $cv->delete();
    $this->assertDatabaseHas('cv', [
        'id' => $cv->id,
        'deleted_at' => now(),
    ]);
});
it('should be able to create Education', function () {
    Education::factory()->create();
    $this->assertDatabaseCount('educations', 1);
});
it('should be able to create Experience', function () {
    Experience::factory()->create();
    $this->assertDatabaseCount('experiences', 1);
});
it('should be able to create Language', function () {
    Language::factory()->create();
    $this->assertDatabaseCount('languages', 1);
});
it('should be able to create License', function () {
    License::factory()->create();
    $this->assertDatabaseCount('licenses', 1);
});
it('should be able to create Skill', function () {
    Skill::factory()->create();
    $this->assertDatabaseCount('skills', 1);
});


<?php

use App\Models\CV;
use App\Models\Education;
use App\Models\Experience;
use App\Models\Language;
use App\Models\License;
use App\Models\Skill;
use App\Models\User;

it('should return 200', function () {
    $user = User::factory()->create();
    $response = $this->actingAs($user)
        ->get('/cv');
    $response->assertStatus(200);
});
it('should render index view', function () {
    $user = User::factory()->create();
    $response = $this->actingAs($user)
        ->get('/cv');
    $response->assertViewIs('cv.index');
});
it('should return 302 if user is not authorized', function () {
    $response = $this->get('/cv');
    $response->assertStatus(302);
});
it('should be able to load full cv data', function () {
    $user = User::factory()->create();

    $cv = Cv::factory()->create(['user_id' => $user->id]);
    $education = Education::factory()->create(['cv_id' => $cv->id]);
    $experience = Experience::factory()->create(['cv_id' => $cv->id]);
    $language = Language::factory()->create(['cv_id' => $cv->id]);
    $license = License::factory()->create(['cv_id' => $cv->id]);
    $skill = Skill::factory()->create(['cv_id' => $cv->id]);

    $response = $this->actingAs($user)
        ->get('/cv');
    $response->assertViewHas('cvs');
    $cvs = $response->viewData('cvs');

    expect($cvs->count())->toBe(1);
    $responseCv = $cvs->first();
    expect($responseCv->id)->toBe($cv->id);
    expect($responseCv->educations->first()->id)->toBe($education->id);
    expect($responseCv->experiences->first()->id)->toBe($experience->id);
    expect($responseCv->languages->first()->id)->toBe($language->id);
    expect($responseCv->licenses->first()->id)->toBe($license->id);
    expect($responseCv->skills->first()->id)->toBe($skill->id);
});


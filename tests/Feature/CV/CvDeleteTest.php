<?php

use App\Models\CV;
use App\Models\Education;
use App\Models\Experience;
use App\Models\Language;
use App\Models\License;
use App\Models\Skill;
use App\Models\User;

it('can softDelete CV with foreign constraints', function () {
    $user = User::factory()->create();
    $cv = Cv::factory()->create(['user_id' => $user->id]);
    $education = Education::factory()->create(['cv_id' => $cv->id]);
    $experience = Experience::factory()->create(['cv_id' => $cv->id]);
    $language = Language::factory()->create(['cv_id' => $cv->id]);
    $license = License::factory()->create(['cv_id' => $cv->id]);
    $skill = Skill::factory()->create(['cv_id' => $cv->id]);
    $response = $this->actingAs($user)
        ->delete('/cv/destroy', [
            'id' => $cv->id,
        ]);
    $response->assertRedirect('/cv');
    $response->assertStatus(302);
    $response->assertSessionHas('success', 'CV has been deleted.');
    $response->assertSessionHasNoErrors();
    $this->assertDatabaseHas('cv', [
        'id' => $cv->id,
        'deleted_at' => now(),
    ]);
    $this->assertDatabaseHas('educations', [
        'id' => $education->id,
        'deleted_at' => now(),
    ]);
    $this->assertDatabaseHas('experiences', [
        'id' => $experience->id,
        'deleted_at' => now(),
    ]);
    $this->assertDatabaseHas('languages', [
        'id' => $language->id,
        'deleted_at' => now(),
    ]);
    $this->assertDatabaseHas('skills', [
        'id' => $skill->id,
        'deleted_at' => now(),
    ]);
    $this->assertDatabaseHas('licenses', [
        'id' => $license->id,
        'deleted_at' => now(),
    ]);
});

it('cannot softDelete CV that belongs to other user', function () {
    $user1 = User::factory()->create();
    $cv1 = Cv::factory()->create(['user_id' => $user1->id]);
    $user2 = User::factory()->create();
    $cv2 = Cv::factory()->create(['user_id' => $user2->id]);
    $response = $this->actingAs($user1)
        ->delete('/cv/destroy', [
            'id' => $cv2->id,
        ]);
    $response->assertStatus(302);
    $response->assertSessionHas('error', 'Unable to locate CV.');
});

<?php

use App\Models\CV;
use App\Models\User;

it('should return 200', function () {
    $user = User::factory()->create();
    $cv = Cv::factory()->create(['user_id' => $user->id]);
    $response = $this->actingAs($user)
        ->get('/cv/show/' . $cv->id);
    $response->assertStatus(200);
});
it('should return 302', function () {
    $cv = Cv::factory()->create();
    $response = $this->get('/cv/show/' . $cv->id);
    $response->assertStatus(302);
});
it('has cv data', function () {
    $user = User::factory()->create();
    $cv = Cv::factory()->create(['user_id' => $user->id]);
    $response = $this->actingAs($user)
        ->get('/cv/show/' . $cv->id);
    $response->assertViewHas('cv');
    $cvData = $response->viewData('cv');
    expect($cvData->id)->toBe($cv->id);
});
it('cannot get other user CV data', function () {
    $user1 = User::factory()->create();
    $cv1 = Cv::factory()->create(['user_id' => $user1->id]);
    $user2 = User::factory()->create();
    $cv2 = Cv::factory()->create(['user_id' => $user2->id]);
    $response = $this->actingAs($user1)
        ->get('/cv/show/' . $cv2->id);
    $response->assertStatus(302);
    $response->assertSessionHas('error', 'Unable to locate CV.');
});
it('should return 404 with error if CV does not exist', function () {
    $user1 = User::factory()->create();
    $cv1 = Cv::factory()->create(['user_id' => $user1->id]);
    $response = $this->actingAs($user1)
        ->get('/cv/show/' . 2);
    $response->assertStatus(404);
});

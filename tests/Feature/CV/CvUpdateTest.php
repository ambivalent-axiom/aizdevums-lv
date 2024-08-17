<?php

use App\Models\CV;
use App\Models\Education;
use App\Models\Experience;
use App\Models\Language;
use App\Models\License;
use App\Models\Skill;
use App\Models\User;


it('should be able to load the update view', function () {
    $user = User::factory()->create();
    $cv = Cv::factory()->create(['user_id' => $user->id,]);
    $response = $this->actingAs($user)
        ->get('cv/update/' . $cv->id);
    $response->assertStatus(200);
});

it('should be able to update the CV record', function () {
    $user = User::factory()->create();
    $cv = Cv::factory()->create(['user_id' => $user->id,]);
    $education = Education::factory()->create(['cv_id' => $cv->id]);
    $experience = Experience::factory()->create(['cv_id' => $cv->id]);
    $language = Language::factory()->create(['cv_id' => $cv->id]);
    $license = License::factory()->create(['cv_id' => $cv->id]);
    $skill = Skill::factory()->create(['cv_id' => $cv->id]);

    $response = $this->actingAs($user)
        ->patch('/cv/update', [
            'id' => $cv->id,
            'phone' => $cv->phone,
            'birth_date' => $cv->birth_date,
            'country' => 'Latvia',
            'city' => $cv->city,
            'picture' => $cv->picture,
            'educations' => [
                [
                    'education_level' => $education->education_level,
                    'education_institution' => $education->education_institution,
                    'education_start_date' => $education->education_start_date,
                    'education_end_date' => $education->education_end_date,
                ]
            ],
            'experiences' => [
                [
                    'experience_company' => 'Aizdevums.lv',
                    'experience_position' => 'Full stack developer',
                    'experience_business_type' => $experience->experience_business_type,
                    'experience_start_date' => $experience->experience_start_date,
                    'experience_end_date' => $experience->experience_end_date,
                ]
            ],
            'languages' => [
                [
                    'language_name' => $language->language_name,
                    'language_level' => $language->language_level,
                ]
            ],
            'licenses' => [
                [
                    'license_name' => $license->license_name,
                    'license_institution' => $license->license_institution,
                    'license_id' => $license->license_id,
                    'license_issue_date' => $license->license_issue_date,
                ]
            ],
            'skills' => [
                [
                    'skill_name' => $skill->skill_name,
                    'skill_level' => $skill->skill_level,
                ]
            ]
        ]);
    $response->assertStatus(302);
    $response->assertSessionHas('success', 'CV record updated!');
    $response->assertRedirect('/cv');
    $this->assertDatabaseHas('cv', [
        'user_id' => $user->id,
        'country' => 'Latvia',
    ]);
    $this->assertDatabaseHas('experiences', [
        'cv_id' => $cv->id,
        'experience_company' => 'Aizdevums.lv',
        'experience_position' => 'Full stack developer',
    ]);
});

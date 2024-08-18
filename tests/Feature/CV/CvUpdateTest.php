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
        ->patch('/cv/update/' . $cv->id, [
            'id' => $cv->id,
            'phone' => $cv->phone,
            'birth_date' => $cv->birth_date,
            'country' => 'Latvia',
            'city' => $cv->city,
            'picture' => $cv->picture,
            'educations' => [
                [
                    'educations_id' => $education->id,
                    'education_level' => $education->education_level,
                    'education_institution' => $education->education_institution,
                    'education_start_date' => $education->education_start_date,
                    'education_end_date' => $education->education_end_date,
                ]
            ],
            'experiences' => [
                [
                    'experiences_id' => $experience->id,
                    'experience_company' => 'Aizdevums.lv',
                    'experience_position' => 'Full stack developer',
                    'experience_business_type' => $experience->experience_business_type,
                    'experience_start_date' => $experience->experience_start_date,
                    'experience_end_date' => $experience->experience_end_date,
                ]
            ],
            'languages' => [
                [
                    'languages_id' => $language->id,
                    'language_name' => $language->language_name,
                    'language_level' => $language->language_level,
                ]
            ],
            'licenses' => [
                [
                    'licenses_id' => $license->id,
                    'license_name' => $license->license_name,
                    'license_institution' => $license->license_institution,
                    'license_id' => $license->license_id,
                    'license_issue_date' => $license->license_issue_date,
                ]
            ],
            'skills' => [
                [
                    'skills_id' => $skill->id,
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
    $this->assertDatabaseCount('educations', 1);
    $this->assertDatabaseCount('experiences', 1);
    $this->assertDatabaseCount('languages', 1);
    $this->assertDatabaseCount('licenses', 1);
    $this->assertDatabaseCount('skills', 1);
});
it('should be able to update incomplete the CV record', function () {
    $user = User::factory()->create();
    $cv = Cv::factory()->create(['user_id' => $user->id,]);
    $language = Language::factory()->create(['cv_id' => $cv->id]);

    $response = $this->actingAs($user)
        ->patch('/cv/update/' . $cv->id, [
            'id' => $cv->id,
            'phone' => $cv->phone,
            'birth_date' => $cv->birth_date,
            'country' => 'Latvia',
            'city' => $cv->city,
            'picture' => $cv->picture,
            'languages' => [
                [
                    'language_id' => $language->id,
                    'cv_id' => $language->cv_id,
                    'language_name' => $language->language_name,
                    'language_level' => 1,
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
    $this->assertDatabaseHas('languages', [
        'cv_id' => $cv->id,
        'language_name' => $language->language_name,
        'language_level' => 1,
    ]);
});
it('should be able to add components to the CV record', function () {
    $user = User::factory()->create();
    $cv = Cv::factory()->create(['user_id' => $user->id,]);
    $language = Language::factory()->create(['cv_id' => $cv->id]);


    $response = $this->actingAs($user)
        ->patch('/cv/update/' . $cv->id, [
            'id' => $cv->id,
            'phone' => $cv->phone,
            'birth_date' => $cv->birth_date,
            'country' => 'Latvia',
            'city' => $cv->city,
            'picture' => $cv->picture,
            'languages' => [
                [
                    'id' => $language->id,
                    'cv_id' => $language->cv_id,
                    'language_name' => $language->language_name,
                    'language_level' => $language->language_level,
                ]
            ],
            'licenses' => [
                [
                    'cv_id' => $cv->id,
                    'license_name' => 'A',
                    'license_institution' => "CSDD",
                    'license_id' => "ASBC",
                    'license_issue_date' => '1988-12-12',
                ]
            ],
        ]);
    $response->assertStatus(302);
    $response->assertSessionHas('success', 'CV record updated!');
    $response->assertRedirect('/cv');
    $this->assertDatabaseHas('licenses', [
        'license_name' => 'A',
        'license_institution' => "CSDD",
        'license_id' => "ASBC",
        'license_issue_date' => '1988-12-12',
    ]);
});
it('should be able to remove components from the CV record', function () {
    $user = User::factory()->create();
    $cv = Cv::factory()->create(['user_id' => $user->id,]);
    $language1 = Language::factory()->create(['cv_id' => $cv->id]);
    $language2 = Language::factory()->create(['cv_id' => $cv->id]);

    $response = $this->actingAs($user)
        ->patch('/cv/update/' . $cv->id, [
            'id' => $cv->id,
            'phone' => $cv->phone,
            'birth_date' => $cv->birth_date,
            'country' => 'Latvia',
            'city' => $cv->city,
            'picture' => $cv->picture,
            'languages' => [
                [
                    'languages_id' => $language1->id,
                    'cv_id' => $cv->id,
                    'language_name' => $language1->language_name,
                    'language_level' => $language1->language_level,
                ]
            ],
        ]);
    $response->assertStatus(302);
    $response->assertSessionHas('success', 'CV record updated!');
    $response->assertRedirect('/cv');
    $this->assertDatabaseCount('languages', 2);
    $this->assertDatabaseHas('languages',
        [
            'language_name' => $language2->language_name,
            'deleted_at' => now()
        ]
    );
});
it('should be able to remove and add components from the CV record', function () {
    $user = User::factory()->create();
    $cv = Cv::factory()->create(['user_id' => $user->id,]);
    $language1 = Language::factory()->create(['cv_id' => $cv->id]);
    $language2 = Language::factory()->create(['cv_id' => $cv->id]);

    $response = $this->actingAs($user)
        ->patch('/cv/update/' . $cv->id, [
            'id' => $cv->id,
            'phone' => $cv->phone,
            'birth_date' => $cv->birth_date,
            'country' => 'Latvia',
            'city' => $cv->city,
            'picture' => $cv->picture,
            'languages' => [
                [
                    'languages_id' => $language1->id,
                    'language_name' => $language1->language_name,
                    'language_level' => $language1->language_level,
                ]
            ],
        ]);
    $response->assertStatus(302);
    $response->assertSessionHas('success', 'CV record updated!');
    $response->assertRedirect('/cv');
    $this->assertDatabaseCount('languages', 2);
    $this->assertDatabaseHas('languages',
        [
            'language_name' => $language2->language_name,
            'deleted_at' => now()
        ]
    );
    $response = $this->actingAs($user)
        ->patch('/cv/update/' . $cv->id, [
            'id' => $cv->id,
            'phone' => $cv->phone,
            'birth_date' => $cv->birth_date,
            'country' => 'Latvia',
            'city' => $cv->city,
            'picture' => $cv->picture,
            'languages' => [
                [
                    'languages_id' => $language1->id,
                    'language_name' => $language1->language_name,
                    'language_level' => $language1->language_level,
                ],
                [
                    'cv_id' => $cv->id,
                    'language_name' => 'Russian',
                    'language_level' => 10,
                ]
            ],
        ]);
    $response->assertStatus(302);
    $response->assertSessionHas('success', 'CV record updated!');
    $response->assertRedirect('/cv');
    $this->assertDatabaseCount('languages', 3);
    $this->assertDatabaseHas('languages',
        [
            'language_name' => 'Russian',
            'language_level' => 10,
        ]
    );
});

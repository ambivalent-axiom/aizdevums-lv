<?php

use App\Models\User;
use Illuminate\Http\UploadedFile;

it('should return 200 for create view', function () {
    $user = User::factory()->create();
    $response = $this->actingAs($user)
        ->get('/cv/create');
    $response->assertViewIs('cv.add');
    $response->assertStatus(200);
});
it('should return 302 for unauthorized access of create view', function () {
    $response = $this->get('/cv/create');
    $response->assertStatus(302);
});
it('should be able to create a CV record', function () {
    $user = User::factory()->create();
    $response = $this->actingAs($user)
        ->post('/cv/create', [
            'phone' => 20178002,
            'birth_date' => '1985-04-12',
            'country' => 'Latvia',
            'city' => 'Riga',
            'picture' => UploadedFile::fake()
                ->image('avatar.jpg')
                ->size(2000),
            'educations' => [
                [
                    'education_level' => 'Bachelor',
                    'education_institution' => 'University of Latvia',
                    'education_start_date' => '2017-01-01',
                    'education_end_date' => '2017-12-31',
                ]
            ],
            'experiences' => [
                [
                    'experience_company' => 'Aizdevums.lv',
                    'experience_position' => 'Web Developer',
                    'experience_business_type' => 'IT',
                    'experience_start_date' => '2017-01-01',
                    'experience_end_date' => '2017-12-31',
                ]
            ],
            'languages' => [
                [
                    'language_name' => 'Latvian',
                    'language_level' => 10,
                ],
                [
                    'language_name' => 'English',
                    'language_level' => 10,
                ],
                [
                    'language_name' => 'Danish',
                    'language_level' => 8,
                ]
            ],
            'licenses' => [
                [
                    'license_name' => 'PHP Full Stack Developer',
                    'license_institution' => 'Codelex',
                    'license_id' => '2024-08-01PHPMASTER100',
                    'license_issue_date' => '2024-08-01',
                ]
            ],
            'skills' => [
                [
                    'skill_name' => 'PHP',
                    'skill_level' => 10,
                ],
                [
                    'skill_name' => 'Python',
                    'skill_level' => 10,
                ]
            ]
        ]);
    $response->assertStatus(302);
    $response->assertSessionHas('success', 'CV record created!');
    $response->assertRedirect('/cv');
    $this->assertDatabaseHas('cv', [
        'user_id' => $user->id,
    ]);
    $this->assertDatabaseCount('educations', 1);
    $this->assertDatabaseCount('experiences', 1);
    $this->assertDatabaseCount('languages', 3);
    $this->assertDatabaseCount('licenses', 1);
    $this->assertDatabaseCount('skills', 2);
});

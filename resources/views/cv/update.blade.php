<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between ">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Edit CV:') }}{{ $cv->id }}
            </h2>
            @include('includes.flashmsgs')
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <!-- Personal Information -->
                        <div class="mb-4">
                            <h3 class="text-lg font-semibold">Personal Information</h3>
                            <div class="border rounded-lg p-6 items-middle mt-4 grid grid-cols-2 gap-4 bg-gray-50">
                                <x-text-input
                                    name="id"
                                    label="id"
                                    type="number"
                                    value="{{ $cv->id }}"
                                    required
                                    hidden/>
                                <div>
                                    <x-input-label>First Name</x-input-label>
                                    <x-text-input
                                        name="first_name"
                                        label="First Name"
                                        type="text"
                                        value="{{ $cv->first_name }}"
                                        required />
                                    <x-input-error :messages="$errors->get('first_name')" class="mt-2" />
                                </div>
                                <div>
                                    <x-input-label>Last Name</x-input-label>
                                    <x-text-input
                                        name="last_name"
                                        label="Last Name"
                                        type="text"
                                        value="{{ $cv->last_name }}"
                                        required />
                                    <x-input-error :messages="$errors->get('last_name')" class="mt-2" />
                                </div>
                                <div>
                                    <x-input-label>Email</x-input-label>
                                    <x-text-input
                                        name="email"
                                        label="Email"
                                        value="{{ $cv->email }}"
                                        type="email"
                                        required />
                                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                </div>
                                <div>
                                    <x-input-label>Phone</x-input-label>
                                    <x-text-input
                                        name="phone"
                                        label="Phone"
                                        value="{{ $cv->phone }}"
                                        type="text"
                                        required />
                                    <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                                </div>
                                <div>
                                    <x-input-label>Country</x-input-label>
                                    <x-text-input
                                        name="country"
                                        label="Country"
                                        value="{{ $cv->country }}"
                                        required />
                                    <x-input-error :messages="$errors->get('country')" class="mt-2" />
                                </div>
                                <div>
                                    <x-input-label>City</x-input-label>
                                    <x-text-input
                                        name="city"
                                        label="City"
                                        value="{{ $cv->city }}"
                                        required />
                                    <x-input-error :messages="$errors->get('city')" class="mt-2" />
                                </div>
                                <div>
                                    <x-input-label>Birth Date</x-input-label>
                                    <x-text-input
                                        name="birth_date"
                                        label="Birth Date"
                                        value="{{ $cv->birth_date }}"
                                        type="date" required />
                                    <x-input-error :messages="$errors->get('birth_date')" class="mt-2" />
                                </div>
                                <div>
                                    <!-- File Input for Profile Picture -->
                                    <x-input-label>Profile Picture</x-input-label>
                                    @if($cv->picture)
                                        <div class="">
                                            <img src="{{ Storage::url($cv->picture) }}" alt="Profile Picture" class="w-32 h-32 object-cover rounded-full">
                                        </div>
                                    @endif
                                    <input
                                        type="file"
                                        name="picture"
                                        class="mt-1 block w-full text-sm text-gray-500 border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                    >
                                    <x-input-error :messages="$errors->get('picture')" class="mt-2" />
                                </div>
                            </div>
                        </div>

                        <!-- Experience Section -->
                        <div id='experiences-section' class="m-4">
                            <h3 class='text-lg font-semibold mb-4'>Experience</h3>
                            @if(isset($cv->experiences))
                                @foreach($cv->experiences as $index => $experience)
                                    <div class="experiences-group mb-4">
                                        <x-text-input
                                            name="experiences_id"
                                            label="id"
                                            type="number"
                                            value="{{ $experience->id }}"
                                            required
                                            hidden/>
                                        <div class="p-6 border border-gray-200 rounded-lg bg-gray-50">
                                            <div class="mb-4">
                                                <label
                                                    for="experience_company_{{ $index }}"
                                                    class="block text-sm font-medium text-gray-700">Company</label>
                                                <input
                                                    type="text"
                                                    name="experiences[{{ $index }}][experience_company]"
                                                    value="{{ $experience->experience_company }}"
                                                    id="experience_company_{{ $index }}"
                                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                                    required
                                                >
                                            </div>
                                            <div class="mb-4">
                                                <label for="experience_position_${experienceCount}"
                                                       class="block text-sm font-medium text-gray-700">Position</label>
                                                <input
                                                    type="text"
                                                    name="experiences[{{ $index }}][experience_position]"
                                                    id="experience_position_{{ $index }}"
                                                    value="{{ $experience->experience_position }}"
                                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                                    required>
                                            </div>
                                            <div class="mb-4">
                                                <label for="experience_business_type_{{ $index }}"
                                                       class="block text-sm font-medium text-gray-700">Business Type</label>
                                                <input
                                                    type="text"
                                                    name="experiences[{{ $index }}][experience_business_type]"
                                                    id="experience_business_type_{{ $index }}"
                                                    value="{{ $experience->experience_business_type }}"
                                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                            </div>
                                            <div class="mb-4">
                                                <label for="experience_start_date_{{ $index }}"
                                                       class="block text-sm font-medium text-gray-700">Start Date</label>
                                                <input
                                                    type="date"
                                                    name="experiences[{{ $index }}][experience_start_date]"
                                                    id="experience_start_date_{{ $index }}"
                                                    value="{{ $experience->experience_start_date }}"
                                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                                    required>
                                            </div>
                                            <div class="mb-4">
                                                <label for="experience_end_date_{{ $index }}"
                                                       class="block text-sm font-medium text-gray-700">End Date</label>
                                                <input
                                                    type="date"
                                                    name="experiences[{{ $index }}][experience_end_date]"
                                                    id="experience_end_date_{{ $index }}"
                                                    value="{{ $experience->experience_end_date }}"
                                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                            </div>
                                            <button
                                                type="button"
                                                class="remove-experience bg-red-600 text-white px-3 py-2 border border-red-500 rounded-lg hover:bg-red-500"
                                            >Remove Experience
                                            </button>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                        <x-secondary-button id='add-experience'>Add Experience</x-secondary-button>

                        <!-- Educations Section -->
                        <div id='educations-section' class="m-4">
                            <h3 class='text-lg font-semibold mb-4'>Education</h3>
                            @if(isset($cv->educations))
                                @foreach($cv->educations as $index => $education)
                                    <div class="education-group mb-4">
                                        <x-text-input
                                            name="educations_id"
                                            label="id"
                                            type="number"
                                            value="{{ $education->id }}"
                                            required
                                            hidden/>
                                        <div class="p-6 border border-gray-200 rounded-lg bg-gray-50">
                                            <div class="mb-4">
                                                <label for="education_level_{{ $index }}"
                                                       class="block text-sm font-medium text-gray-700">Education Level</label>
                                                <input
                                                    type="text"
                                                    name="educations[{{ $index }}][education_level]"
                                                    id="education_level_{{ $index }}"
                                                    value="{{ $education->education_level }}"
                                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                                    required>
                                            </div>
                                            <div class="mb-4">
                                                <label for="education_institution_{{ $index }}"
                                                       class="block text-sm font-medium text-gray-700">Educational Institurion</label>
                                                <input
                                                    type="text"
                                                    name="educations[{{ $index }}][education_institution]"
                                                    id="education_institution_{{ $index }}"
                                                    value="{{ $education->education_institution }}"
                                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                                    required>
                                            </div>
                                            <div class="mb-4">
                                                <label for="education_start_date_{{ $index }}"
                                                       class="block text-sm font-medium text-gray-700">Start Date</label>
                                                <input
                                                    type="date"
                                                    name="educations[{{ $index }}][education_start_date]"
                                                    id="education_start_date_{{ $index }}"
                                                    value="{{ $education->education_start_date }}"
                                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                                    required>
                                            </div>
                                            <div class="mb-4">
                                                <label for="education_end_date_{{ $index }}"
                                                       class="block text-sm font-medium text-gray-700">End Date</label>
                                                <input
                                                    type="date"
                                                    name="educations[{{ $index }}][education_end_date]"
                                                    id="education_end_date_{{ $index }}"
                                                    value="{{ $education->education_end_date }}"
                                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                            </div>
                                            <button
                                                type="button"
                                                class="remove-education bg-red-600 text-white px-3 py-2 border border-red-500 rounded-lg hover:bg-red-500"
                                            >Remove Education
                                            </button>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                        <x-secondary-button id='add-education'>Add Education</x-secondary-button>

                        <!-- Languages Section -->
                        <div id='languages-section' class="m-4">
                            <h3 class='text-lg font-semibold mb-4'>Languages</h3>
                            @if(isset($cv->languages))
                                @foreach($cv->languages as $index => $language)
                                    <div class="language-group mb-4">
                                        <x-text-input
                                            name="languages_id"
                                            label="id"
                                            type="number"
                                            value="{{ $language->id }}"
                                            required
                                            hidden/>
                                        <div class="p-6 border border-gray-200 rounded-lg bg-gray-50">
                                            <div class="mb-4">
                                                <label for="language_name_{{ $index }}"
                                                       class="block text-sm font-medium text-gray-700">Language</label>
                                                <input
                                                    type="text"
                                                    name="languages[{{ $index }}][language_name]"
                                                    id="language_name_{{ $index }}"
                                                    value="{{ $language->language_name }}"
                                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                                    required>
                                            </div>
                                            <div class="mb-4">
                                                <label for="language_level_{{ $index }}"
                                                       class="block text-sm font-medium text-gray-700">Langauge Level</label>
                                                <input
                                                    type="text"
                                                    name="languages[{{ $index }}][language_level]"
                                                    id="language_level_{{ $index }}"
                                                    value="{{ $language->language_level }}"
                                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                                    required>
                                            </div>
                                            <button
                                                type="button"
                                                class="remove-language bg-red-600 text-white px-3 py-2 border border-red-500 rounded-lg hover:bg-red-500"
                                            >Remove Language
                                            </button>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                        <x-secondary-button id='add-language'>Add Language</x-secondary-button>

                        <!-- Licenses Section -->
                        <div id='licenses-section' class="m-4">
                            <h3 class='text-lg font-semibold mb-4'>Licenses</h3>
                            @if(isset($cv->licenses))
                                @foreach($cv->licenses as $index => $license)
                                    <div class="license-group mb-4">
                                        <x-text-input
                                            name="licenses_id"
                                            label="id"
                                            type="number"
                                            value="{{ $license->id }}"
                                            required
                                            hidden/>
                                        <div class="p-6 border border-gray-200 rounded-lg bg-gray-50">
                                            <div class="mb-4">
                                                <label for="license_name_{{ $index }}"
                                                       class="block text-sm font-medium text-gray-700">License Name</label>
                                                <input
                                                    type="text"
                                                    name="licenses[{{ $index }}][license_name]"
                                                    id="license_name_{{ $index }}"
                                                    value="{{ $license->license_name }}"
                                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                                    required>
                                            </div>
                                            <div class="mb-4">
                                                <label for="license_institution_{{ $index }}"
                                                       class="block text-sm font-medium text-gray-700">Issuer</label>
                                                <input
                                                    type="text"
                                                    name="licenses[{{ $index }}][license_institution]"
                                                    id="license_institution_{{ $index }}"
                                                    value="{{ $license->license_institution }}"
                                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                                    required>
                                            </div>
                                            <div class="mb-4">
                                                <label for="license_id_{{ $index }}"
                                                       class="block text-sm font-medium text-gray-700">License ID</label>
                                                <input
                                                    type="text"
                                                    name="licenses[{{ $index }}][license_id]"
                                                    id="license_id_{{ $index }}"
                                                    value="{{ $license->license_id }}"
                                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                                    required>
                                            </div>
                                            <div class="mb-4">
                                                <label for="license_issue_date_{{ $index }}"
                                                       class="block text-sm font-medium text-gray-700">Issue Date</label>
                                                <input
                                                    type="date"
                                                    name="licenses[{{ $index }}][license_issue_date]"
                                                    id="license_issue_date_{{ $index }}"
                                                    value="{{ $license->license_issue_date }}"
                                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                                    required>
                                            </div>
                                            <button
                                                type="button"
                                                class="remove-license bg-red-600 text-white px-3 py-2 border border-red-500 rounded-lg hover:bg-red-500"
                                            >Remove License
                                            </button>
                                        </div>
                                    </div>

                                @endforeach
                            @endif
                        </div>
                        <x-secondary-button id='add-licenses'>Add License</x-secondary-button>

                        <!-- Skills Section -->
                        <div id='skills-section' class="m-4">
                            <h3 class='text-lg font-semibold mb-4'>Skills</h3>
                            @if(isset($cv->skills))
                                @foreach($cv->skills as $index => $skill)
                                    <div class="skill-group mb-4">
                                        <x-text-input
                                            name="skills_id"
                                            label="id"
                                            type="number"
                                            value="{{ $skill->id }}"
                                            required
                                            hidden/>
                                        <div class="p-6 border border-gray-200 rounded-lg bg-gray-50">
                                            <div class="mb-4">
                                                <label for="skill_name_{{ $index }}"
                                                       class="block text-sm font-medium text-gray-700">Skill</label>
                                                <input
                                                    type="text"
                                                    name="skills[{{ $index }}][skill_name]"
                                                    id="skill_name_{{ $index }}"
                                                    value="{{ $skill->skill_name }}"
                                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                                    required>
                                            </div>
                                            <div class="mb-4">
                                                <label for="skill_level_{{ $index }}"
                                                       class="block text-sm font-medium text-gray-700">Skill Level</label>
                                                <input
                                                    type="text"
                                                    name="skills[{{ $index }}][skill_level]"
                                                    id="skill_level_{{ $index }}"
                                                    value="{{ $skill->skill_level }}"
                                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                                    required>
                                            </div>
                                            <button
                                                type="button"
                                                class="remove-skill bg-red-600 text-white px-3 py-2 border border-red-500 rounded-lg hover:bg-red-500"
                                            >Remove Skill
                                            </button>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                        <x-secondary-button id='add-skill'>Add Skill</x-secondary-button>

                        <div class="mt-8 ml-8 mb-2">
                            <x-primary-button type="submit">Save CV</x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>


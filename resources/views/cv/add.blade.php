<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between ">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Add CV') }}
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
                        <!-- Personal Information -->
                        <div class="mb-4">
                            <h3 class="text-lg font-semibold">Personal Information</h3>
                            <div class="border rounded-lg p-6 items-middle mt-4 grid grid-cols-2 gap-4 bg-gray-50">
                                <div>
                                    <x-input-label>First Name</x-input-label>
                                    <x-text-input
                                        name="first_name"
                                        label="First Name"
                                        type="text"
                                        value="{{ old('first_name', Auth::user()->first_name) }}"
                                        required />
                                    <x-input-error :messages="$errors->get('first_name')" class="mt-2" />
                                </div>
                                <div>
                                    <x-input-label>Last Name</x-input-label>
                                    <x-text-input
                                        name="last_name"
                                        label="Last Name"
                                        type="text"
                                        value="{{ old('last_name', Auth::user()->last_name) }}"
                                        required />
                                    <x-input-error :messages="$errors->get('last_name')" class="mt-2" />
                                </div>
                                <div>
                                    <x-input-label>Email</x-input-label>
                                    <x-text-input
                                        name="email"
                                        label="Email"
                                        value="{{ old('email', Auth::user()->email) }}"
                                        type="email"
                                        required />
                                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                </div>
                                <div>
                                    <x-input-label>Phone</x-input-label>
                                    <x-text-input
                                        name="phone"
                                        label="Phone"
                                        type="text"
                                        value="{{ old('phone') }}"
                                        required />
                                    <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                                </div>
                                <div>
                                    <x-input-label>Country</x-input-label>
                                    <x-text-input
                                        name="country"
                                        label="Country"
                                        value="{{ old('country') }}"
                                        required />
                                    <x-input-error :messages="$errors->get('country')" class="mt-2" />
                                </div>
                                <div>
                                    <x-input-label>City</x-input-label>
                                    <x-text-input
                                        name="city"
                                        label="City"
                                        value="{{ old('city') }}"
                                        required />
                                    <x-input-error :messages="$errors->get('city')" class="mt-2" />
                                </div>
                                <div>
                                    <x-input-label>Birth Date</x-input-label>
                                    <x-text-input
                                        name="birth_date"
                                        label="Birth Date"
                                        value="{{ old('birth_date') }}"
                                        type="date"
                                        required />
                                    <x-input-error :messages="$errors->get('birth_date')" class="mt-2" />
                                </div>
                                <div>
                                    <!-- File Input for Profile Picture -->
                                    <x-input-label>Profile Picture</x-input-label>
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
                        </div>
                        <x-secondary-button id='add-experience'>Add Experience</x-secondary-button>

                        <!-- Educations Section -->
                        <div id='educations-section' class="m-4">
                            <h3 class='text-lg font-semibold mb-4'>Education</h3>
                        </div>
                        <x-secondary-button id='add-education'>Add Education</x-secondary-button>

                        <!-- Languages Section -->
                        <div id='languages-section' class="m-4">
                            <h3 class='text-lg font-semibold mb-4'>Languages</h3>
                        </div>
                        <x-secondary-button id='add-language'>Add Language</x-secondary-button>

                        <!-- Licenses Section -->
                        <div id='licenses-section' class="m-4">
                            <h3 class='text-lg font-semibold mb-4'>Licenses</h3>
                        </div>
                        <x-secondary-button id='add-licenses'>Add License</x-secondary-button>

                        <!-- Skills Section -->
                        <div id='skills-section' class="m-4">
                            <h3 class='text-lg font-semibold mb-4'>Skills</h3>
                        </div>
                        <x-secondary-button id='add-skill'>Add Skill</x-secondary-button>

                        <div class="mt-8 ml-8 mb-2">
                            <x-primary-button type="submit">Create CV</x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

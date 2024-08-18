<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between ">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('CV Index') }}
            </h2>
            @include('includes.flashmsgs')
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="flex justify-between">
                    <div class="p-6 text-gray-900">
                        {{ __("List of Your CV's") }}
                    </div>
                    <div class="p-6">
                        <x-secondary-button>Add CV</x-secondary-button>
                    </div>
                </div>
                <div class="p-4 block w-full overflow-x-auto">
                    <div class="m-5 mb-6">
                        {{ $cvs->links() }}
                    </div>
                    @foreach($cvs as $cv)
                        <div class="p-6 mb-6 border rounded-lg bg-gray-50">
                            <!-- Upper Part: Picture and Main Description -->
                            <div class="flex justify-between items-center mb-6">
                                <!-- Picture -->
                                <div class="w-1/4">
                                    @if($cv->picture)
                                        <img src="{{ asset('storage/' . $cv->picture) }}" alt="Profile Picture" class="w-full h-auto rounded-lg shadow-md">
                                    @else
                                        <img src="{{ asset('images/default-avatar.png') }}" alt="Default Avatar" class="w-full h-auto rounded-lg shadow-md">
                                    @endif
                                </div>
                                <!-- Main Description -->
                                <div class="ml-6">
                                    <h3 class="text-2xl font-bold">{{ $cv->first_name }} {{ $cv->last_name }}</h3>
                                    <p class="text-gray-600">Email: {{ $cv->email }}</p>
                                    <p class="text-gray-600">Phone: {{ $cv->phone }}</p>
                                    <p class="text-gray-600">Address: {{ $cv->city }}, {{ $cv->country }}</p>
                                </div>
                                <div class="flex">
                                    <div class="px-2">
                                        <x-primary-button>Edit</x-primary-button>
                                    </div>
                                    <div>
                                        <form action="cv/destroy" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <x-text-input
                                                name="id"
                                                id="id"
                                                value="{{ $cv->id }}"
                                                required
                                                hidden
                                            ></x-text-input>
                                            <x-danger-button type="submit" class="button">Delete</x-danger-button>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <!-- Lower Part: Grid Layout -->
                            <div class="grid grid-cols-2 gap-4">
                                <!-- Education -->
                                @if($cv->educations->isNotEmpty())
                                    <div class="border rounded-lg bg-white p-4">
                                        <h4 class="font-semibold text-xl mb-2">Education</h4>
                                        @foreach($cv->educations as $education)
                                            <div class="mb-4">
                                                <hr class="mt-4 mb-4">
                                                <h3 class="font-semibold mb-2">Level</h3>
                                                <p class="font-bold">{{ $education->education_level }}</p>
                                                <h3 class="font-semibold mb-2">Institution</h3>
                                                <p>{{ $education->education_institution }}</p>
                                                <p class="text-sm text-gray-600">{{ $education->education_start_date }} - {{ $education->education_end_date }}</p>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif

                                <!-- Experience -->
                                @if($cv->experiences->isNotEmpty())
                                    <div class="border rounded-lg bg-white p-4">
                                        <h4 class="font-semibold text-xl mb-2">Experience</h4>
                                        @foreach($cv->experiences as $experience)
                                            <div class="mb-4">
                                                <hr class="mt-4 mb-4">
                                                <h3 class="font-semibold mb-2">Position</h3>
                                                <p class="font-bold">{{ $experience->experience_position }}</p>
                                                <h3 class="font-semibold mb-2">Company</h3>
                                                <p>{{ $experience->experience_company }}</p>
                                                <h3 class="font-semibold mb-2">Business Type</h3>
                                                <p>{{ $experience->experience_business_type }}</p>
                                                <p class="text-sm text-gray-600">{{ $experience->experience_start_date }} - {{ $experience->experience_end_date }}</p>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif

                                <!-- Languages -->
                                @if($cv->languages->isNotEmpty())
                                    <div class="border rounded-lg bg-white p-4">
                                        <h4 class="font-semibold text-xl mb-2">Languages</h4>
                                        @foreach($cv->languages as $language)
                                            <hr class="mt-4 mb-4">
                                            <div class="mb-4">
                                                <p class="font-bold">{{ $language->language_name }}</p>
                                                <p class="text-sm text-gray-600">Level: {{ $language->language_level }}</p>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif

                                <!-- Skills -->
                                @if($cv->skills->isNotEmpty())
                                    <div class="border rounded-lg bg-white p-4">
                                        <h4 class="font-semibold text-xl mb-2">Skills</h4>
                                        @foreach($cv->skills as $skill)
                                            <hr class="mt-4 mb-4">
                                            <div class="mb-4">
                                                <p class="font-bold">{{ $skill->skill_name }}</p>
                                                <p class="text-sm text-gray-600">Level: {{ $skill->skill_level }}</p>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif

                                <!-- Licenses -->
                                @if($cv->licenses->isNotEmpty())
                                    <div class="border rounded-lg bg-white p-4">
                                        <h4 class="font-semibold text-xl mb-2">Licenses</h4>
                                        @foreach($cv->licenses as $license)
                                            <hr class="mt-4 mb-4">
                                            <div class="mb-4">
                                                <h3 class="font-semibold mb-2">License Name</h3>
                                                <p class="font-bold">{{ $license->license_name }}</p>
                                                <h3 class="font-semibold mb-2">Issuer</h3>
                                                <p>{{ $license->license_institution }}</p>
                                                <h3 class="font-semibold mb-2">ID</h3>
                                                <p>{{ $license->license_id }}</p>
                                                <p class="text-sm text-gray-600">Issued: {{ $license->license_issue_date }}</p>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                    <div class="m-5 mb-6">
                        {{ $cvs->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

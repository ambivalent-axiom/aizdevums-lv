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
                        <a href="/cv/create">
                            <x-primary-button>Add CV</x-primary-button>
                        </a>
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
                                        <img src="{{ Storage::url($cv->picture) }}" alt="Profile Picture" class="w-1/2 h-auto rounded-lg shadow-md">
                                    @else
                                        <img src="{{ Storage::url('pictures/default-avatar.png') }}" alt="Default Avatar" class="w-1/2 h-auto rounded-lg shadow-md">
                                    @endif
                                </div>
                                <!-- Main Description -->
                                <div class="">
                                    <h3 class="text-2xl font-bold">{{ $cv->first_name }} {{ $cv->last_name }}</h3>
                                    <p class="text-gray-600">Email: {{ $cv->email }}</p>
                                    <p class="text-gray-600">Phone: {{ $cv->phone }}</p>
                                    <p class="text-gray-600">Address: {{ $cv->city }}, {{ $cv->country }}</p>
                                </div>
                                <div>
                                    <div class="ml-6">
                                        @if($cv->educations->isNotEmpty())
                                            <p>Educations: {{ count($cv->educations) }}</p>
                                        @endif
                                        @if($cv->experiences->isNotEmpty())
                                            <p>Job Experiences: {{ count($cv->experiences) }}</p>
                                        @endif
                                        @if($cv->languages->isNotEmpty())
                                            <p>Languages: {{ count($cv->languages) }}</p>
                                        @endif
                                        @if($cv->skills->isNotEmpty())
                                            <p>Skills: {{ count($cv->skills) }}</p>
                                        @endif
                                        @if($cv->licenses->isNotEmpty())
                                            <p>Licenses: {{ count($cv->licenses) }}</p>
                                        @endif
                                    </div>
                                </div>
                                <div class="flex">
                                    <div class="">
                                        <a href="cv/show/{{ $cv->id }}">
                                            <x-secondary-button>Open</x-secondary-button>
                                        </a>
                                    </div>
                                    <div class="px-2">
                                        <a href="cv/update/{{ $cv->id }}">
                                            <x-secondary-button>Edit</x-secondary-button>
                                        </a>
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

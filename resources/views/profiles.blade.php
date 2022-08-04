<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            All User Profiles
        </h2>
    </x-slot>

    @foreach($users as $user)
        <div class="py-6">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <a href={{route('dashboard', ['id' => $user->id])}}>
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 bg-white border-b border-gray-200">
                            <p>Name: <b> {{$user->name}} </b></p>
                            <p>Email: <b> {{$user->email}} </b></p>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    @endforeach

</x-app-layout>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    User Profile <br><br>

                    Name: {{ $user->name }} <br>
                    Email: {{$user->email}}
                </div>
            </div>
        </div>
    </div>

    @auth
        <form method="POST" action="{{ route('upload') }}">
            @csrf
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 p-6 bg-white border-b border-gray-200 m-10">
                <x-label for="title" value="Title"/>

                <x-input id="title" class="block mt-1 mb-10 w-full" type="text" name="title" required
                         autofocus/>

                <x-label for="msg" value="Message"/>

                <textarea id="msg" rows="5" name="message" class="block mt-1 mb-10 w-full" required></textarea>

                <x-button>
                    Send
                </x-button>
            </div>
        </form>
    @endauth
</x-app-layout>

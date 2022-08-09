<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Books by {{$user->name}}
        </h2>
    </x-slot>

    @foreach($books as $book)
       {{$book->text}} <br>
    @endforeach
</x-app-layout>

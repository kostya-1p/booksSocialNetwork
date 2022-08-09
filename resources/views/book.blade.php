<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{$book->title}}
        </h2>
    </x-slot>

    <div class="book_button">
        {{$book->text}}
    </div>
</x-app-layout>

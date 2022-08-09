<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Books by {{$user->name}}
        </h2>
    </x-slot>

    @foreach($books as $book)
        <div class="book_button">
            <a href={{route('book', ['user_id'=>$user->id, 'book_id'=>$book->id])}}>
                {{$book->title}}
            </a>
        </div>
    @endforeach

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 p-6 border-b border-gray-200 ml-20">
        <x-button class="">
            <a href={{route('createBookPage', ['user_id'=>$user->id])}}>
                Create Book
            </a>
        </x-button>
    </div>
</x-app-layout>

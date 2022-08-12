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

        @if(Auth::id() == $user->id)
            <form method="post" action="{{ route('deleteBook') }}">
                @csrf
                <input type="hidden" name="id" value={{$book->id}}>
                <button class="ml-28"> Delete Book</button>
            </form>

            <button class="ml-28">
                <a href={{route('editBookPage', ['user_id'=>$user->id, 'book_id'=>$book->id])}}>Edit Book </a>
            </button>

            <form method="post" action="{{ route('toggleBookLinkSharing') }}">
                @csrf
                <input type="hidden" name="id" value={{$book->id}}>
                <button class="ml-28">{{ ($book->isAvailable) ? "Stop sharing book" : "Share book by link" }} </button>
            </form>
        @endif
    @endforeach

    @if(Auth::id() == $user->id)
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 p-6 border-b border-gray-200 ml-20">
            <x-button class="">
                <a href={{route('createBookPage', ['user_id'=>$user->id])}}>
                    Create Book
                </a>
            </x-button>
        </div>
    @endif
</x-app-layout>

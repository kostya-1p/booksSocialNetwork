<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @if(isset($book))
                Edit Book
            @else
                Create Book
            @endif
        </h2>
    </x-slot>

    <form method="POST" action={{(isset($book)) ? route('editBook') : route('createBook')}}>
        @csrf
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 p-6 bg-white border-b border-gray-200 m-10">
            <input type="hidden" name="authorId" value={{ $id }}>

            @if(isset($book))
                <input type="hidden" name="bookId" value={{ $book->id }}>
            @endif

            <x-label for="book-title" value="Title"/>

            <x-input id="book-title" class="block mt-1 mb-10 w-full" type="text" name="title" required
                     value="{{(isset($book)) ? $book->title : ''}}"/>

            <x-label for="text" value="Text"/>

            <textarea id="text" rows="25" name="text" class="block mt-1 mb-10 w-full"
                      required>{{(isset($book) ? $book->text : "")}}</textarea>

            <x-button>
                @if(isset($book))
                    Edit
                @else
                    Create
                @endif
            </x-button>
        </div>
    </form>

</x-app-layout>

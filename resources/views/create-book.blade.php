<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Create Book
        </h2>
    </x-slot>

    <form method="POST" action={{route('createBook')}}>
        @csrf
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 p-6 bg-white border-b border-gray-200 m-10">
            <input type="hidden" name="authorId" value={{ $id }}>

            <x-label for="book-title" value="Title"/>

            <x-input id="book-title" class="block mt-1 mb-10 w-full" type="text" name="title" required/>

            <x-label for="text" value="Text"/>

            <textarea id="text" rows="25" name="text" class="block mt-1 mb-10 w-full" required></textarea>

            <x-button>
                Create
            </x-button>
        </div>
    </form>

</x-app-layout>

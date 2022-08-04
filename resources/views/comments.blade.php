<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Comments of {{$user->name}}
        </h2>
    </x-slot>

    @foreach($comments as $comment)
        <div class="py-6">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        @auth
                            @if(Auth::id() == $comment->profileId || Auth::id() == $comment->authorId)
                                <form method="post" action="{{ route('delete') }}">
                                    @csrf
                                    <input type="hidden" name="id" value={{$comment->id}}>
                                    <input type="hidden" name="author_id" value={{$comment->authorId}}>
                                    <button class="close">X</button>
                                </form>
                            @endif
                        @endauth

                        <h1><b> {{$user->name}} </b></h1>

                        <p>
                            {{$comment->title}}
                        </p>

                        <p>
                            {{$comment->message}}
                        </p>

                        <p class="comment_date">
                            {{$comment->created_at->format('d.m.Y')}}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</x-app-layout>

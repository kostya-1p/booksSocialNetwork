<x-app-layout>
    <script>
        const authUserId = "{{{ (Auth::user()) ? Auth::id() : null }}}";
    </script>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ 'User Profile' }}
        </h2>

        <p> Name: {{ $user->name }} </p>
        <p> Email: {{$user->email}} </p>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    Comments:
                </div>
            </div>
        </div>
    </div>

    @foreach($comments as $index => $comment)
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

                        <h2 hidden> {{$comment->id}} </h2>

                        <h1><b> {{$authorNames[$index]}} </b></h1>


                        @if($comment->answeredCommentId != null)
                            @if(($answeredComment = $comments->keyBy('id')->get($comment->answeredCommentId)) != null)
                                <div class="reply_message">
                                    <p>{{$answeredComment->message}}</p>
                                </div>
                            @endif
                        @elseif($comment->isReply)
                            <div class="reply_message">
                                <p>Message Deleted</p>
                            </div>
                        @endif

                        <p>
                            {{$comment->title}}
                        </p>

                        <p>
                            {{$comment->message}}
                        </p>

                        <p class="comment_date">
                            {{$comment->created_at->format('d.m.Y')}}
                        </p>

                        @auth
                            <button class="reply">Reply</button>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    @endforeach


    <div id="load_more_container" class="max-w-7xl mx-auto sm:px-6 lg:px-8 p-6 border-b border-gray-200 m-10">
        <x-button id="load_more_comments">
            Load More
        </x-button>
    </div>


    @auth
        <form method="POST" action="{{ route('upload') }}">
            @csrf
            <div id="comment_form_container"
                 class="max-w-7xl mx-auto sm:px-6 lg:px-8 p-6 bg-white border-b border-gray-200 m-10">
                <input type="hidden" name="profile_id" value={{ $user->id }}>

                <x-label for="title" value="Title"/>

                <x-input id="title" class="block mt-1 mb-10 w-full" type="text" name="title" required/>

                <x-label for="msg" value="Message"/>

                <textarea id="msg" rows="5" name="message" class="block mt-1 mb-10 w-full" required></textarea>

                <x-button>
                    Send
                </x-button>
            </div>
        </form>
    @endauth
</x-app-layout>

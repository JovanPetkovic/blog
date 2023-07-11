{{--@props(['comment'])--}}
<x-panel class="bg-gray-50" x-data="{open: true}" x-show="open">
    <article class="relative flex space-x-4" id="comment_{{$comment->id}}">
        <div class="flex-shrink-0">
            <img src="https://i.pravatar.cc/60?u={{$comment->user_id}}" alt="" width="60" height="60" class="rounded-xl "/>
        </div>

        <div>
            <header class="mb-4">
                <h3 class="font-bold">
                    @if ($comment->author)
                        {{$comment->author->username}}
                    @else
                        No Author Available
                    @endif
                </h3>
                <p class="text-xs">
                    Posted
                    <time>{{$comment->created_at->format('F j, Y, g:i a')}}</time>
                </p>
            </header>

            <p>
                {{$comment->body}}
            </p>
        </div>
        @if(auth()->check())
            @if(auth()->user()->role==1)
            <div class="flex absolute top-0 right-0">
                <a href="/comment/{{$comment->id}}/edit" x-target="comment_{{$comment->id}}" class="bg-blue-500 text-white text-xs uppercase font-semibold
                                py-2 px-10 rounded-2xl hover:bg-blue-600">Edit</a>
                <form method="post" x-target="comment_{{$comment->id}}" action="/comment/{{$comment->id}}/delete" class="ml-2">
                    @method('DELETE')
                    @csrf
                    <button class="bg-red-500 text-white text-xs uppercase font-semibold
                                py-2 px-10 rounded-2xl hover:bg-blue-600" x-on:click="open = !open">Delete</button>
                </form>
            </div>
            @endif
        @endif
    </article>

</x-panel>

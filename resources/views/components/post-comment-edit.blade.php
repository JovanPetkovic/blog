
<x-panel class="bg-gray-50" >
    <form class="flex space-x-4 relative" id="comment_{{$comment->id}}" x-target="" method="post" action="/comment/{{$comment->id}}">
        @csrf
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

            <textarea rows="4" cols="50" class="outline outline-2 outline-blue-500" name="body">{{$comment->body}}</textarea>
        </div>
        <button class="absolute top-0 right-0 bg-blue-500 text-white text-xs uppercase font-semibold
                        py-2 px-8 rounded-2xl hover:bg-blue-600">Update</button>
    </form>
</x-panel>

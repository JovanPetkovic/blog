<article x-data="{open: true}" x-show="open" id="post_{{$post->id}}"
    class="lg:col-span-3 transition-colors duration-300 hover:bg-gray-100 border border-black border-opacity-0 hover:border-opacity-5 rounded-xl">
    <div class="py-6 px-5">
        <div>
            <img src="{{$post->img_url}}" alt="Blog Post illustration" class="rounded-xl">
        </div>

        <div class="relative mt-8 flex flex-col justify-between">
            @if(auth()->check())
                @if(auth()->user()->role==1)
                    <div class="flex absolute top-0 right-0">
                        <form method="post" x-target="post_{{$post->id}}" action="/admin/posts/{{$post->slug}}/delete" class="ml-2">
                            @method('DELETE')
                            @csrf
                            <button class="bg-red-500 text-white text-xs uppercase font-semibold
                                py-2 px-10 rounded-2xl hover:bg-blue-600" x-on:click="open = !open">Delete</button>
                        </form>
                    </div>
                @endif
            @endif
            <header>
               <x-category-button :category="$post->category" />

                <div class="mt-4">
                    <h1 class="text-3xl">
                        {{ $post->title }}
                    </h1>

                    <span class="mt-2 block text-gray-400 text-xs">
                                        Published <time>{{$post->created_at->diffForHumans()}}</time>
                                    </span>
                </div>
            </header>

            <div class="text-sm mt-4">
                <p>
                    {{$post->excerpt}}
                </p>

            </div>

            <footer class="flex justify-between items-center mt-8">
                <div class="flex items-center text-sm">
                    <img src="https://i.pravatar.cc/60?u={{$post->author_id}}" alt="Lary avatar">
                    <div class="ml-3">
                        <h5 class="font-bold"><a href="/?author={{$post->author->username}}">
                                {{$post->author->name}}</a></h5>
                    </div>
                </div>

                <div>
                    <a href="/posts/{{$post->slug}}"
                       class="transition-colors duration-300 text-xs font-semibold bg-gray-200 hover:bg-gray-300 rounded-full py-2 px-8"
                    >
                        Read More
                    </a>
                </div>
            </footer>
        </div>
    </div>
</article>

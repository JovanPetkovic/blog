<header class="max-w-xl mx-auto mt-20 text-center">
    <h1 class="text-4xl">
        Latest <span class="text-blue-500">TechnLand</span> News
    </h1>

    <h2 class="inline-flex mt-2">By TechLand Team</h2>

    <p class="text-sm mt-14">
        Another year. Another update. We're refreshing the popular Laravel series with new content.
        I'm going to keep you guys up to speed with what's going on!
    </p>

    <div class="space-y-2 lg:space-y-0 lg:space-x-4 lg:flex justify-around align-center lmt-8 mt-12">
        <!--  Category -->
        <div class="h-auto absolute relative flex lg:inline-flex items-center bg-gray-100 rounded-xl">

            <x-category-dropdown/>

        </div>

        <!-- Search -->
        <div class="relative flex lg:inline-flex items-center bg-gray-100 rounded-xl px-3 py-2">
            <form method="GET" action="#">

                @if(request('category') ?? false)
                    <input type="hidden" name="category" value="{{ request('category') }}">
                @endif

                <input type="text" name="search" placeholder="Find something"
                       class="bg-transparent placeholder-black font-semibold text-sm">
            </form>
        </div>
    </div>
</header>

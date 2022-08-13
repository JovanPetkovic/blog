<div x-data="{ show : false}" class="lg:flex lg:flex-col lg:w-32 py-2">

    <div @click="show = !show">
        {{$trigger}}
    </div>

    <div x-show="show" class=" rounded-xl absolute mt-10 bg-gray-100 w-full text-left flex-col flex" style="display: none" >
        {{$slot}}


    </div>

</div>

<div class="h-40 rounded shadow bg-gradient-to-r from-orange-50/55 to-orange-100/10">
    {{-- If you look to others for fulfillment, you will never truly be fulfilled. --}}
    <div class="flex flex-row flex-wrap w-full h-full ">
        <div class="flex flex-row w-full">
            <div class="w-24 h-24 ">
                <img src="{{asset('storage/' . $story->illustration)}}" alt="" class="object-cover size-full">
            </div>
            <div class="flex flex-col flex-grow h-24 ">
                <div class="font-medium break-words ps-1">
                    <a href="{{route('story.show', ['id' => $story->id])}}">
                    {{ \Illuminate\Support\Str::limit($story->title, 45) }}
                    </a>
                </div>
                <div class="text-sm font-medium text-gray-700 ps-1">
                    by <span> <a href="{{ $story->user ? route("profil.show", $story->user->name) : '#'}}">
                        {{ $story->user ? $story->user->name : 'Anonyme'}} </a>  </span>
                </div>
                <div class="w-full ps-1 pe-1">
                    {{$story->accroche}}
                </div>
            </div>
        </div>


        <div class="w-full h-14 ">
           Tags : {{implode(", ", $story->tags->pluck('name')->toArray())}}
        </div>

    </div>


</div>

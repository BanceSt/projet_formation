<div class="h-40 p-1 bg-slate-600">
    {{-- If you look to others for fulfillment, you will never truly be fulfilled. --}}
    <div class="flex flex-row flex-wrap w-full h-full bg-slate-900">
        <div class="flex flex-row w-full">
            <div class="w-24 h-24 bg-red-200">
                <img src="{{asset('storage/' . $story->illustration)}}" alt="" class="object-cover size-full">
            </div>
            <div class="flex flex-col flex-grow h-24 bg-red-400">
                <div class="font-medium break-words ps-1">
                    <a href="{{route('story.show', ['id' => $story->id])}}">
                    {{ \Illuminate\Support\Str::limit($story->title, 50) }}
                    </a>
                </div>
                <div class="text-sm font-medium text-gray-700 ps-1">
                    by <span> {{$story->user->name}} </span>
                </div>
                <div class="w-full ps-1 pe-1">
                    {{$story->accroche}}
                </div>
            </div>
        </div>


        <div class="w-full h-14 bg-slate-700">
           Tags : {{implode(", ", $story->tags->pluck('name')->toArray())}}
        </div>

    </div>


</div>

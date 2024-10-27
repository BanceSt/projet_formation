@props(["tags", "delete_opt" => true])

<div class="flex flex-row flex-wrap mb-2 cursor-pointer">
    @foreach ($tags as $tag)
    <span id="badge-dismiss-default" class="inline-flex items-center px-2 py-1 text-sm font-medium text-blue-800 bg-blue-100 rounded me-2 dark:bg-blue-900 dark:text-blue-300 ">
        {{$tag}}
        @if ($delete_opt)
        <button type="button" class="inline-flex items-center p-1 text-sm text-blue-400 duration-500 bg-transparent rounded-sm ms-2 hover:bg-blue-200 hover:text-blue-900 dark:hover:bg-blue-800 dark:hover:text-blue-300"
        data-dismiss-target="#badge-dismiss-default" aria-label="Remove" wire:click="deleteTag('{{$tag}}')">
        <svg class="w-2 h-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
        </svg>
        <span class="sr-only">Remove badge</span>
        </button>
        @endif
    </span>
    @endforeach
</div>

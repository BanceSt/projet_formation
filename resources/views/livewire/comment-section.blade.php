<div class="">
    <div class="text-2xl font-semibold">
        Commentaires :
    </div>

    {{-- Zone pour qu l'utilisateur comment  --}}
    <div class="my-5">
        <x-input-label for="comment" :value="__('Votre commentaire :')" class="text-xl"/>
        <div class="flex flex-row mt-1">
            <div class="mr-2 rounded size-10 bg-slate-700"></div>
            <x-text-area wire:model='comment_text' id="note" class="block w-full " type="text" name="comment" :value="old('comment')"
                placeholder="Commentez ici..."/>
        </div>

        <div class="flex justify-end mt-1 ">
            <button class="text-sm font-medium text-white bg-green-700 rounded hover:bg-green-800 focus:outline-none focus:ring-4
                        focus:ring-green-300 px-5 py-2.5 text-center mb-2" wire:click='create_comment()'>
                Commenter
            </button>
        </div>
    </div>

    {{-- lister les commentaire --}}
    <div class="mt-2">
        @forelse ($comments as $comment)
            <div class="w-full mb-4 {{ 'pl-' . (4 * $comment["depth"]) }}">
                {{-- commentaire --}}
                <div class="flex flex-row">
                    <div class="mr-2 rounded size-10 bg-slate-700"></div>
                    <div class="flex flex-col w-full pl-1 overflow-auto border-gray-300 border-solid rounded-md shadow-sm min-h-20 max-h-24 bg-slate-100" style='border-width : 1px;'>
                        <span class="inline-block text-base font-bold"> {{($comment['comment']->user ? $comment["comment"]->user->name : "Anonyme") . " :"}} </span>
                        {{$comment["comment"]->content}}
                    </div>
                </div>

                {{-- option de répondre --}}
                <div class="flex flex-row justify-between">
                    <button class="inline-block pl-12" wire:click='display_reply({{$comment["comment"]->id}})'> Répondre </button>
                    @isset($comment["autre"])
                    <button class="inline-block pl-12" wire:click='voir_plus({{$comment["comment"]->id}})'> Voir plus... </button>
                    @endisset
                </div>

                {{-- entrée de réponse --}}
                @if (in_array($comment["comment"]->id, $replying_to) )
                    <div class="pl-4">
                        <x-input-label for="comment" :value="__('Votre commentaire :')" class="text-xl"/>
                        <div class="flex flex-row mt-1">
                            <div class="mr-2 rounded size-10 bg-slate-700"></div>
                            <x-text-area wire:model="comment_reply.{{$comment['comment']->id}}" id="note" class="block w-full " type="text" name="comment" :value="old('comment')"
                                placeholder="Commentez ici..."/>
                        </div>

                        <div class="flex justify-end mt-1 ">
                            <button class="text-sm font-medium text-white bg-green-700 rounded hover:bg-green-800 focus:outline-none focus:ring-4
                                        focus:ring-green-300 px-5 py-2.5 text-center mb-2" wire:click='create_comment({{$comment["comment"]->id}})'>
                                Commenter
                            </button>
                        </div>
                    </div>
                @endif
            </div>
        @empty
        @endforelse
    </div>

</div>

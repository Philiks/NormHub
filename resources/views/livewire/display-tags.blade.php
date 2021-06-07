<div class="flex w-full">
    @foreach ($tags as $tag)
        <div class="text-xs text-orange font-bold mt-2 mr-2 p-2 bg-white rounded-full">
            {{  __($tag->title)  }}
        </div>
    @endforeach                
</div>

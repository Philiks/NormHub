<x-app-layout>
    <x-wide-card>
        <div class="flex flex-col items-center">
            <div class="flex justify-center items-center">
                <!-- Title -->
                <div class="p-3 font-bold text-orange text-center text-xl lg:text-3xl text-white">
                    {{ __($blog->title) }}
                </div>

                @author($blog->id)
                    <x-icon-anchor modelName="blog" action="edit" paramId="{{ $blog->id }}" isInverted=true />
                    <x-icon-anchor modelName="blog" action="destroy" paramId="{{ $blog->id }}" isInverted=true />
                @endauthor
            </div>
            
            <!-- Photo -->
            <img class="mt-4 self-center rounded-2xl bg-cover" 
                        src="{{ $blog->main_photo != null ?
                            asset('images/' . $blog->main_photo) :
                            asset('storage/defaults/blog.png') }}" 
                        width="420" height="350" />
    
            <div class="mt-4 w-1/2 bg-gradient-to-l from-orange rounded-lg p-3 text-sm text-white lg:text-base">
                <div class="flex items-center">
                    <!-- Author Profile Photo -->
                    @livewire('display-profile', ['user' => $blog->author])

                    <div>
                        <div class="text-base lg:text-lg">
                            <!-- Author -->
                            {{ $blog->author->username }}
                        </div>

                        <div class="text-sm lg:text-base">
                            <!-- Date Created and Read Time -->
                            {!! $blog->created_at->format('M j') . ' &bull; ' . $blog->read_time . ' min read'!!}
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Content -->
            <div class="w-full mt-4 bg-orange-dark rounded-lg p-3 text-sm text-white lg:text-base">
                {!! $blog->format_content() !!}
            </div>
    
            <!-- Tags -->
            @livewire('display-tags', ['tags' => $blog->tags])
        </div>
    </x-wide-card>
</x-app-layout>
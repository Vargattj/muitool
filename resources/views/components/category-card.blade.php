<div class="bg-white rounded-lg border border-gray-200 p-6 hover:shadow-lg transition-all duration-300 group">
    <div class="flex items-start space-x-4">
        @if($category->icon)
        <div class="flex-shrink-0">
            <div class="w-12 h-12 bg-gray-100 rounded-lg flex items-center justify-center group-hover:bg-gray-200 transition-colors">
                <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
            </div>
        </div>
        @endif

        <div class="flex-1 min-w-0">
            <h3 class="text-xl font-semibold text-gray-900 mb-2 group-hover:text-gray-700 transition-colors">
                {{ $translation->name }}
            </h3>
            <p class="text-gray-600 text-sm mb-4">
                {{ $translation->description }}
            </p>

            <!-- Tools in this category -->
            @if($category->tools->count() > 0)
            <div class="space-y-2">
                @foreach($category->tools as $tool)
                    @php
                        $toolTranslation = $tool->translation();
                    @endphp
                    
                    @if($toolTranslation)
                    <a href="{{ route('tools.show', ['slug' => $tool->slug]) }}" 
                       class="block text-sm text-gray-700 hover:text-gray-900 hover:bg-gray-50 px-3 py-2 rounded-md transition-colors">
                        <span class="font-medium">{{ $toolTranslation->name }}</span>
                        @if($toolTranslation->short_description)
                        <span class="text-gray-500 ml-2">- {{ Str::limit($toolTranslation->short_description, 50) }}</span>
                        @endif
                    </a>
                    @endif
                @endforeach
            </div>
            @endif
        </div>
    </div>
</div>

@php
    // Mapeamento de slugs para ícones do RemixIcon
    $iconMap = [
        'text-tools' => 'ri-text',
        'code-tools' => 'ri-code-s-slash-line',
        'converters' => 'ri-arrow-left-right-line',
        'generators' => 'ri-magic-line',
        'image-tools' => 'ri-image-line',
        'data-tools' => 'ri-database-2-line',
        'security' => 'ri-shield-line',
        'utilities' => 'ri-tools-line',
    ];
    
    $iconClass = $iconMap[$category->slug] ?? 'ri-tools-line';
    $toolCount = $category->tools->count();
    $firstTool = $category->tools->first();
    $categoryUrl = $firstTool ? localized_route('tools.show', ['slug' => $firstTool->slug]) : localized_route('home') . '#categories';
@endphp

<a href="{{ $categoryUrl }}" class="aspect-square bg-white border border-gray-200 rounded-lg p-12 flex flex-col items-center justify-center text-center transition-all duration-200 hover:border-gray-600 hover:-translate-y-1 cursor-pointer group">
    <div class="w-8 h-8 flex items-center justify-center mb-6">
        <i class="{{ $iconClass }} text-[32px] text-gray-600 group-hover:text-gray-900 transition-colors"></i>
    </div>
    <h3 class="text-xl font-bold text-gray-900 tracking-tight mb-2">
        {{ $translation->name }}
    </h3>
    <p class="text-sm text-gray-500">
        {{ $toolCount }} {{ $toolCount === 1 ? __('common.tool') : __('common.tools') }}
    </p>
</a>

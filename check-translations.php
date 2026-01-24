#!/usr/bin/env php
<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\Tool;

$tools = Tool::with('translations')->get();

echo "\n=== FERRAMENTAS E SUAS TRADUÇÕES ===\n\n";

foreach ($tools as $tool) {
    echo "Tool: {$tool->slug}\n";
    echo "  Traduções disponíveis: ";
    $locales = $tool->translations->pluck('locale')->toArray();
    echo !empty($locales) ? implode(', ', $locales) : 'Nenhuma';
    echo "\n";
    
    $missing = array_diff(['en', 'pt_BR', 'es'], $locales);
    if (!empty($missing)) {
        echo "  ⚠️  Faltam: " . implode(', ', $missing) . "\n";
    }
    echo "\n";
}

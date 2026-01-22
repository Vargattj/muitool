<div class="flex gap-8 max-lg:flex-col">
    <div class="flex-1">
        <label class="block text-xs uppercase tracking-wider text-[#666666] mb-4">INPUT</label>
        <textarea 
            id="json-input" 
            placeholder="Paste your JSON here..." 
            class="w-full min-h-[400px] p-4 bg-[#FAFAFA] border border-[#CCCCCC] rounded-lg font-mono text-sm text-[#333333] placeholder:text-[#999999] focus:outline-none focus:border-[#333333] focus:bg-white transition-all resize-none"
        ></textarea>
    </div>
    <div class="w-px bg-[#E5E5E5] max-lg:hidden"></div>
    <div class="flex-1 relative">
        <div class="flex items-center justify-between mb-4">
            <label class="block text-xs uppercase tracking-wider text-[#666666]">OUTPUT</label>
            <button 
                onclick="copyOutput()" 
                class="h-8 px-4 border border-[#333333] rounded-md text-sm text-[#333333] hover:bg-[#333333] hover:text-white transition-all cursor-pointer whitespace-nowrap"
            >
                Copy
            </button>
        </div>
        <textarea 
            id="json-output" 
            readonly 
            placeholder="Formatted output will appear here..." 
            class="w-full min-h-[400px] p-4 bg-[#FAFAFA] border border-[#CCCCCC] rounded-lg font-mono text-sm text-[#333333] placeholder:text-[#999999] focus:outline-none resize-none"
        ></textarea>
    </div>
</div>
<div class="flex items-center gap-3 mt-8 max-md:flex-wrap">
    <button 
        onclick="formatJSON()" 
        class="h-9 px-6 bg-[#333333] text-white text-sm font-medium rounded-md hover:bg-black transition-colors cursor-pointer whitespace-nowrap"
    >
        Format
    </button>
    <button 
        onclick="minifyJSON()" 
        class="h-9 px-6 border border-[#333333] text-[#333333] text-sm font-medium rounded-md hover:bg-[#333333] hover:text-white transition-all cursor-pointer whitespace-nowrap"
    >
        Minify
    </button>
    <button 
        onclick="clearJSON()" 
        class="h-9 px-6 border border-[#333333] text-[#333333] text-sm font-medium rounded-md hover:bg-[#333333] hover:text-white transition-all cursor-pointer whitespace-nowrap"
    >
        Clear
    </button>
</div>

<script>
function formatJSON() {
    const input = document.getElementById('json-input').value;
    const output = document.getElementById('json-output');
    
    if (!input.trim()) {
        return;
    }
    
    try {
        const parsed = JSON.parse(input);
        output.value = JSON.stringify(parsed, null, 2);
    } catch (error) {
        output.value = 'Error: ' + error.message;
    }
}

function minifyJSON() {
    const input = document.getElementById('json-input').value;
    const output = document.getElementById('json-output');
    
    if (!input.trim()) {
        return;
    }
    
    try {
        const parsed = JSON.parse(input);
        output.value = JSON.stringify(parsed);
    } catch (error) {
        output.value = 'Error: ' + error.message;
    }
}

function clearJSON() {
    document.getElementById('json-input').value = '';
    document.getElementById('json-output').value = '';
}

function copyOutput() {
    const output = document.getElementById('json-output');
    if (!output.value.trim()) {
        return;
    }
    
    output.select();
    document.execCommand('copy');
    
    if (navigator.clipboard) {
        navigator.clipboard.writeText(output.value);
    }
}
</script>

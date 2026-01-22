<div class="json-formatter-tool">
    <div class="space-y-4">
        <!-- Input Area -->
        <div>
            <label for="json-input" class="block text-sm font-medium text-gray-700 mb-2">
                Input JSON
            </label>
            <textarea 
                id="json-input" 
                rows="10" 
                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-400 focus:border-transparent font-mono text-sm resize-y"
                placeholder='{"name": "John", "age": 30}'
            ></textarea>
        </div>

        <!-- Action Buttons -->
        <div class="flex flex-wrap gap-3">
            <button 
                onclick="formatJSON()" 
                class="px-6 py-2 bg-gray-900 text-white rounded-lg hover:bg-gray-800 transition-colors font-medium"
            >
                Format JSON
            </button>
            <button 
                onclick="minifyJSON()" 
                class="px-6 py-2 bg-gray-700 text-white rounded-lg hover:bg-gray-600 transition-colors font-medium"
            >
                Minify JSON
            </button>
            <button 
                onclick="validateJSON()" 
                class="px-6 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-400 transition-colors font-medium"
            >
                Validate JSON
            </button>
            <button 
                onclick="clearJSON()" 
                class="px-6 py-2 bg-white text-gray-700 border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors font-medium"
            >
                Clear
            </button>
        </div>

        <!-- Output Area -->
        <div>
            <label for="json-output" class="block text-sm font-medium text-gray-700 mb-2">
                Output
            </label>
            <textarea 
                id="json-output" 
                rows="10" 
                class="w-full px-4 py-3 border border-gray-300 rounded-lg bg-gray-50 font-mono text-sm resize-y"
                readonly
            ></textarea>
        </div>

        <!-- Status Message -->
        <div id="json-status" class="hidden p-4 rounded-lg"></div>
    </div>
</div>

<script>
function formatJSON() {
    const input = document.getElementById('json-input').value;
    const output = document.getElementById('json-output');
    const status = document.getElementById('json-status');
    
    try {
        const parsed = JSON.parse(input);
        output.value = JSON.stringify(parsed, null, 2);
        showStatus('JSON formatted successfully!', 'success');
    } catch (error) {
        showStatus('Invalid JSON: ' + error.message, 'error');
        output.value = '';
    }
}

function minifyJSON() {
    const input = document.getElementById('json-input').value;
    const output = document.getElementById('json-output');
    
    try {
        const parsed = JSON.parse(input);
        output.value = JSON.stringify(parsed);
        showStatus('JSON minified successfully!', 'success');
    } catch (error) {
        showStatus('Invalid JSON: ' + error.message, 'error');
        output.value = '';
    }
}

function validateJSON() {
    const input = document.getElementById('json-input').value;
    
    try {
        JSON.parse(input);
        showStatus('Valid JSON!', 'success');
    } catch (error) {
        showStatus('Invalid JSON: ' + error.message, 'error');
    }
}

function clearJSON() {
    document.getElementById('json-input').value = '';
    document.getElementById('json-output').value = '';
    document.getElementById('json-status').classList.add('hidden');
}

function showStatus(message, type) {
    const status = document.getElementById('json-status');
    status.textContent = message;
    status.classList.remove('hidden', 'bg-green-50', 'bg-red-50', 'text-green-800', 'text-red-800');
    
    if (type === 'success') {
        status.classList.add('bg-green-50', 'text-green-800');
    } else {
        status.classList.add('bg-red-50', 'text-red-800');
    }
}
</script>

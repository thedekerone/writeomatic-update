<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AI Blog Post Creator</title>
    <style>
        /* Your Styles */
        body {
            font-family: Arial, sans-serif;
            background-color: #f1f1f1;
        }
        /* ... (rest of your styles) ... */
    </style>
</head>
<body>

<div class="card">
    <h1 class="text-2xl mb-4">Write quality blog posts with AI</h1>
    <p class="mb-6">Go from a blog idea to an engaging blog post in minutes by following the steps below.</p>
    
    <!-- Step navigation buttons -->
    <!-- ... (your step navigation buttons code) ... -->

    <!-- Fields for each step -->
    <!-- Step 1: Details -->
    <div class="step-content" data-step="1">
        <h1 class="mb-4 text-xl font-bold">What do you want to write about?</h1>
        <label class="block mb-4">
            <span class="text-gray-700">Blog Description (0/200)</span>
            <textarea class="form-input mt-1 block w-full border p-2" rows="3" name="description" placeholder="Explain what is your blog post about."></textarea>
        </label>
        <span class="text-red-500 mb-4 block">40 more characters needed in your description.</span>
        <label class="block mb-4">
            <span class="text-gray-700">Targeted Keyword (optional)</span>
            <input class="form-input mt-1 block w-full border p-2" type="text" name="keyword">
        </label>
        <button class="next-step btn bg-blue-500 text-white">Next</button>
    </div>

    <!-- Step 2: Title -->
    <div class="step-content hidden" data-step="2">
        <h1 class="mb-4 text-xl font-bold">Generate a post title or write your own</h1>
        <button class="write-own btn bg-blue-500 text-white">Write Own</button>
        <button class="ai-generate btn bg-green-500 text-white">AI Generate</button>
        <p id="titleOutput"></p>
    </div>

    <!-- ... (rest of your steps) ... -->

</div>

<script>
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    document.addEventListener('DOMContentLoaded', function() {
        const stepButtons = document.querySelectorAll('.step-button');
        const stepContents = document.querySelectorAll('.step-content');
        const nextStepButtons = document.querySelectorAll('.next-step');

        stepButtons.forEach((button, index) => {
            button.addEventListener('click', function() {
                stepContents.forEach(content => content.classList.add('hidden'));
                stepContents[index].classList.remove('hidden');

                stepButtons.forEach(btn => {
                    btn.classList.remove('bg-blue-500', 'text-white');
                    btn.classList.add('bg-gray-200', 'text-gray-400');
                });
                button.classList.add('bg-blue-500', 'text-white');
            });
        });

        nextStepButtons.forEach((button, index) => {
            button.addEventListener('click', function() {
                if (index + 1 < stepButtons.length) {
                    stepButtons[index + 1].click();
                }
            });
        });

        // Elements for Step 1
        const descriptionInput = document.querySelector('textarea[name="description"]');
        const keywordsInput = document.querySelector('input[name="keyword"]');
        
        // Elements for Step 2
        const generateTitleButton = document.querySelector('.ai-generate');
        const titleOutput = document.getElementById('titleOutput');
        
        // Attach event listener to "Generate Title" button
        generateTitleButton.addEventListener('click', function() {
            const endpoint = "/dashboard/user/openai/generate";

            fetch(endpoint, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    description: descriptionInput.value,
                    post_type: 'openai_slug',
                    openai_id: 1,
                    custom_template: 'custom_template_value',
                    maximum_length: '100',
                    number_of_results: '5',
                    creativity: 'high',
                    tone_of_voice: 'neutral',
                    language: 'en'
                })
            })
            .then(response => response.json())
            .then(data => {
                titleOutput.textContent = data.generatedTitle;
            })
            .catch(error => {
                console.error('Error generating title:', error);
            });
        });
    });
</script>

</body>
</html>

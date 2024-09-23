{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Post</title>
    <!-- Include Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Include AlpineJS for handling modal -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <!-- Include Select2 JS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
</head>
<body class="bg-gray-100">
    <div class="max-w-4xl mx-auto mt-10" x-data="{ open: false }">
        <div class="bg-white shadow-md rounded-lg p-8">

            <div class="flex flex-row justify-between items-center mb-4">
                <h2 class="text-2xl font-bold">Create Post</h2>

                <!-- Button to Open Modal -->
                <button type="button" @click="open = true" class="w-50 bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded-lg text-sm">
                    Add Category
                </button>
            </div>

            <!-- Modal (hidden by default) -->
            <div x-show="open" x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100"
                x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 scale-100"
                x-transition:leave-end="opacity-0 scale-90"
                class="fixed inset-0 z-50 flex items-center justify-center bg-gray-500 bg-opacity-50">

                <div @click.away="open = false" class="bg-white w-full max-w-md p-5 rounded-lg shadow-lg">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-semibold">Add New Category</h3>
                        <button @click="open = false" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>

                    <!-- Modal Body -->
                    <form action="{{ route('categories.store') }}" method="POST" class="space-y-4">
                        @csrf
                        <div class="col-span-2">
                            <label for="category_name" class="block mb-2 text-sm font-medium text-gray-900">Name</label>
                            <input type="text" name="category_name" id="category_name" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" placeholder="Type category name" required>
                        </div>
                        <div class="col-span-2">
                            <label for="category_description" class="block mb-2 text-sm font-medium text-gray-900">Category Description</label>
                            <textarea id="category_description" name="category_description" rows="4" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" placeholder="Write category description here"></textarea>
                        </div>

                        <button type="submit" @click="open = false" class="w-full bg-blue-600 text-white py-2 rounded-lg">Add Category</button>
                    </form>
                </div>
            </div>

            @if (session('success'))
                <div class="alert alert-success mb-6">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Form Start -->
            <form action="{{ route('posts.store') }}" method="POST" class="space-y-4">
                @csrf
                <!-- Title Input -->
                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700">Post Title</label>
                    <input type="text" id="title" name="title" required
                        class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                        placeholder="Enter the post title">
                </div>

                <!-- Content Textarea -->
                <div>
                    <label for="content" class="block text-sm font-medium text-gray-700">Content</label>
                    <textarea id="content" name="content" required rows="5"
                        class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                        placeholder="Write your content here"></textarea>
                </div>

                <!-- Category Select -->
                <div>
                    <label for="category_id" class="block text-sm font-medium text-gray-700">Category</label>
                    <select id="category_id" name="category_id" required
                        class="mt-1 block w-full pl-3 pr-10 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <option value="">Select a category</option>
                        <!-- Dynamic categories here -->
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="tags">Tags:</label>
                    <select class="form-control" id="tags" name="tags[]" multiple="multiple">
                        @foreach($allTags as $tag)
                            <option value="{{ $tag->name }}">{{ $tag->name }}</option>
                        @endforeach
                    </select>
                    <small class="form-text text-muted">Pilih atau ketik tag baru.</small>
                </div>

                <!-- Action Buttons -->
                <div class="mt-20">
                    <!-- Submit Button -->
                    <button type="submit"
                        class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Submit
                    </button>
                </div>

            </form>
            <!-- Form End -->

        </div>
    </div>
</body>
</html>

@section('scripts')
<script>
    $(document).ready(function() {
        $('#tags').select2({
            tags: true,
            tokenSeparators: [',', ' ']
        });
    });
</script>
@endsection --}}

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Post</title>
    <!-- Include Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Include AlpineJS for handling modal -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <!-- Include Select2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <!-- Optional: Include Select2 Tailwind Theme (Jika Ada) -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2-tailwind.min.css" rel="stylesheet" />
</head>
<body class="bg-gray-100">
    <div class="max-w-4xl mx-auto mt-10" x-data="{ open: false }">
        <div class="bg-white shadow-md rounded-lg p-8">

            <div class="flex flex-row justify-between items-center mb-4">
                <h2 class="text-2xl font-bold">Create Post</h2>

                <!-- Button to Open Modal -->
                <button type="button" @click="open = true" class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded-lg text-sm">
                    Add Category
                </button>
            </div>

            <!-- Modal (hidden by default) -->
            <div x-show="open" x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100"
                x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 scale-100"
                x-transition:leave-end="opacity-0 scale-90"
                class="fixed inset-0 z-50 flex items-center justify-center bg-gray-500 bg-opacity-50">

                <div @click.away="open = false" class="bg-white w-full max-w-md p-5 rounded-lg shadow-lg">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-semibold">Add New Category</h3>
                        <button @click="open = false" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>

                    <!-- Modal Body -->
                    <form action="{{ route('categories.store') }}" method="POST" class="space-y-4">
                        @csrf
                        <div class="col-span-2">
                            <label for="category_name" class="block mb-2 text-sm font-medium text-gray-900">Name</label>
                            <input type="text" name="category_name" id="category_name" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" placeholder="Type category name" required>
                        </div>
                        <div class="col-span-2">
                            <label for="category_description" class="block mb-2 text-sm font-medium text-gray-900">Category Description</label>
                            <textarea id="category_description" name="category_description" rows="4" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" placeholder="Write category description here"></textarea>
                        </div>

                        <button type="submit" @click="open = false" class="w-full bg-blue-600 text-white py-2 rounded-lg">Add Category</button>
                    </form>
                </div>
            </div>

            @if (session('success'))
                <div class="alert alert-success mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <!-- Form Start -->
            <form action="{{ route('posts.store') }}" method="POST" class="space-y-4">
                @csrf
                <!-- Title Input -->
                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700">Post Title</label>
                    <input type="text" id="title" name="title" required
                        class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                        placeholder="Enter the post title" value="{{ old('title') }}">
                    @error('title')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Content Textarea -->
                <div>
                    <label for="content" class="block text-sm font-medium text-gray-700">Content</label>
                    <textarea id="content" name="content" required rows="5"
                        class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                        placeholder="Write your content here">{{ old('content') }}</textarea>
                    @error('content')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Category Select -->
                <div>
                    <label for="category_id" class="block text-sm font-medium text-gray-700">Category</label>
                    <select id="category_id" name="category_id" required
                        class="mt-1 block w-full pl-3 pr-10 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <option value="">Select a category</option>
                        <!-- Dynamic categories here -->
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->category_name }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Tags Select -->
                <div>
                    <label for="tags" class="block text-sm font-medium text-gray-700">Tags</label>
                    <select id="tags" name="tags[]" multiple="multiple"
                        class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        @foreach($allTags as $tag)
                            <option value="{{ $tag->name }}" {{ (collect(old('tags'))->contains($tag->name)) ? 'selected' : '' }}>
                                {{ $tag->name }}
                            </option>
                        @endforeach
                    </select>
                    <small class="text-gray-500 text-sm">Select or type new tags.</small>
                    @error('tags')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Action Buttons -->
                <div class="mt-6">
                    <!-- Submit Button -->
                    <button type="submit"
                        class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Submit
                    </button>
                </div>

            </form>
            <!-- Form End -->

        </div>
    </div>

    <!-- Include jQuery (Select2 dependency) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Include Select2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <!-- Select2 Initialization Script -->
    <script>
        $(document).ready(function() {
            $('#tags').select2({
                tags: true,
                tokenSeparators: [',', ' '],
                placeholder: "Select or type tags",
                allowClear: true,
                width: '100%',
                dropdownParent: $('body'), // Prevent Select2 from being hidden behind modal
                templateResult: formatTag,
                templateSelection: formatTagSelection
            });

            // Optional: Customize tag appearance
            function formatTag(tag) {
                return $('<span>' + tag.text + '</span>');
            }

            function formatTagSelection(tag) {
                return $('<span>' + tag.text + '</span>');
            }
        });
    </script>
</body>
</html>

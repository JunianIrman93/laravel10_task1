{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Post</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Alpine.js for Modal Handling -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <!-- Include Select2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <!-- Optional: Include Select2 Tailwind Theme (Jika Ada) -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2-tailwind.min.css" rel="stylesheet" />
</head>
<body class="bg-gray-100" >
    <div class="max-w-4xl mx-auto mt-10">
        <div class="bg-white shadow-md rounded-lg p-6">
            <h2 class="text-2xl font-bold mb-6">Edit Post</h2>

            <!-- Form Start -->
            <form action="{{ route('posts.update', $post->id) }}" method="POST" class="space-y-4">
                @csrf
                <!-- Title Input -->
                @method('PUT')
                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700">Post Title</label>
                    <input type="text" id="title" name="title" value="{{ old('title', $post->title) }}" required
                        class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                        placeholder="Enter the post title">
                </div>

                <!-- Content Textarea -->
                <div>
                    <label for="content" class="block text-sm font-medium text-gray-700">Content</label>
                    <textarea id="content" name="content" required rows="5"
                        class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                        placeholder="Write your content here">{{ old('content', $post->content) }}</textarea>
                </div>

                <!-- Category Select -->
                <div>
                    <label for="category_id" class="block text-sm font-medium text-gray-700">Category</label>
                    <select id="category_id" name="category_id" required
                        class="mt-1 block w-full pl-3 pr-10 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <!-- Dynamic categories here -->
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ $category->id == $post->category->id ? 'selected' : '' }}>{{ $category->id == $post->category->id ? $post->category->category_name : $category->category_name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Tags Select -->
                <div>
                    <label for="tags" class="block text-sm font-medium text-gray-700">Tags</label>
                    <select id="tags" name="tags[]" multiple="multiple"
                        class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        @foreach($post->tags as $tag)
                            <option value="{{ $tag->id }}" {{ $post->tags->contains($tag->id) ? 'selected' : '' }}>
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
                <div class="flex flex-row justify-between items-center mt-6" x-data="{ openModal: false }">
                    <!-- Submit Button -->
                    <div class="flex flex-col">
                        <button type="submit"
                            class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Submit
                        </button>
                    </div>

                    <!-- Delete Button -->
                    <div class="flex flex-col">
                        <!-- Button to open the modal -->
                        <button @click="openModal = true" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                            Delete
                        </button>

                        <!-- Modal -->
                        <div>
                            <!-- Modal Background -->
                            <div x-show="openModal" x-transition:enter="transition ease-out duration-300" x-transition:leave="transition ease-in duration-200"
                                class="fixed inset-0 bg-gray-800 bg-opacity-50 flex justify-center items-center z-50">

                                <!-- Modal Content -->
                                <div @click.away="openModal = false" class="bg-white rounded-lg shadow-lg max-w-md w-full p-6">
                                    <!-- Close Button -->
                                    <button @click="openModal = false" class="absolute top-3 right-3 text-gray-400 hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8">
                                        <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1l6 6m0 0l6 6M7 7l6-6M7 7l-6 6"/>
                                        </svg>
                                        <span class="sr-only">Close</span>
                                    </button>

                                    <!-- Modal Body -->
                                    <div class="text-center">
                                        <svg class="mx-auto mb-4 text-gray-400 w-12 h-12" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                                        </svg>
                                        <h3 class="mb-5 text-lg font-normal text-gray-500">Apakah anda yakin ingin menghapus data ini?</h3>

                                        <!-- Action Buttons -->
                                        <form action="{{ route('posts.destroy', $post->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                            <button @click="openModal = false" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                                                Ya, saya yakin
                                            </button>
                                        </form>

                                        <button @click="openModal = false" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100">
                                            Batalkan
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
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

</body> --}}

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Post</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Alpine.js for Modal Handling -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <!-- Include Select2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <!-- Optional: Include Select2 Tailwind Theme (Jika Ada) -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2-tailwind.min.css" rel="stylesheet" />

</head>
<body class="bg-gray-100">
    <div class="max-w-4xl mx-auto mt-10">
        <div class="bg-white shadow-md rounded-lg p-6">
            <h2 class="text-2xl font-bold mb-6">Edit Post</h2>

            <!-- Form Start -->
            <form action="{{ route('posts.update', $post->id) }}" method="POST" class="space-y-4">
                @csrf
                @method('POST')
                <!-- Title Input -->
                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700">Post Title</label>
                    <input type="text" id="title" name="title" value="{{ old('title', $post->title) }}" required
                        class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                        placeholder="Enter the post title">
                </div>

                <!-- Content Textarea -->
                <div>
                    <label for="content" class="block text-sm font-medium text-gray-700">Content</label>
                    <textarea id="content" name="content" required rows="5"
                        class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                        placeholder="Write your content here">{{ old('content', $post->content) }}</textarea>
                </div>

                <!-- Category Select -->
                <div>
                    <label for="category_id" class="block text-sm font-medium text-gray-700">Category</label>
                    <select id="category_id" name="category_id" required
                        class="mt-1 block w-full pl-3 pr-10 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <!-- Dynamic categories here -->
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ $category->id == $post->category->id ? 'selected' : '' }}>
                                {{ $category->category_name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Tags Select -->
                <div>
                    <label for="tags" class="block text-sm font-medium text-gray-700">Tags</label>
                    <select id="tags" name="tags[]" multiple="multiple"
                        class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        @foreach($post->tags as $tag)
                            <option value="{{ $tag->id }}" {{ $post->tags->contains($tag->id) ? 'selected' : '' }}>
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
                <div class="flex flex-row justify-between items-center mt-6" x-data="{ openModal: false }">
                    <!-- Submit Button -->
                    <button type="submit"
                    class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Submit
                </button>
            </form>

                    <!-- Delete Button -->
                    <button @click="openModal = true" type="button"
                        class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                        Delete
                    </button>

                    <!-- Modal -->
                    <div x-show="openModal" x-transition:enter="transition ease-out duration-300" x-transition:leave="transition ease-in duration-200"
                        class="fixed inset-0 bg-gray-800 bg-opacity-50 flex justify-center items-center z-50">
                        <div @click.away="openModal = false" class="bg-white rounded-lg shadow-lg max-w-md w-full p-6">
                            <!-- Close Button -->
                            <button @click="openModal = false" class="absolute top-3 right-3 text-gray-400 hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8">
                                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1l6 6m0 0l6 6M7 7l6-6M7 7l-6 6"/>
                                </svg>
                                <span class="sr-only">Close</span>
                            </button>

                            <!-- Modal Body -->
                            <div class="text-center">
                                <svg class="mx-auto mb-4 text-gray-400 w-12 h-12" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                                </svg>
                                <h3 class="mb-5 text-lg font-normal text-gray-500">Apakah anda yakin ingin menghapus data ini?</h3>

                                <!-- Action Buttons -->
                                <form action="{{ route('posts.destroy', $post->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                                        Ya, saya yakin
                                    </button>
                                </form>

                                <button @click="openModal = false" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100">
                                    Batalkan
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
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

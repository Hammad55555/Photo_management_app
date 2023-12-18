<!-- photos/show.blade.php -->

<x-app-layout>
    <x-slot name="header">
        <!-- Header content goes here -->
    </x-slot>

    <div class="container mx-auto mt-8">
        <div class="py-12">
            <div class="max-w-7xl mx-5 sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-500 dark:text-gray-100">

                        <!-- Display Photo Details -->
                        <h2 class="text-2xl font-bold mb-4">{{ $photo->title }}</h2>
                        <img src="{{ asset('path/to/your/photos/' . $photo->image) }}" alt="{{ $photo->title }}" class="mb-4">
                        
                        <!-- Add more details about the photo -->

                        <!-- Options for the Photo -->
                        <div class="mb-4">
                            <a href="{{ route('photos.edit', ['photo' => $photo->id]) }}" class="btn fs-6 text-xl mr-2">Edit</a>
                            <form action="{{ route('photos.destroy', ['photo' => $photo->id]) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn fs-6 text-xl" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

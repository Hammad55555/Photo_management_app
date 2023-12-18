<x-app-layout>
    <x-slot name="header">
      
    <div class="container mx-auto mt-8">
    <form action="{{ route('photos.index') }}" method="POST" enctype="multipart/form-data"
          class="max-w-md mx-auto bg-white p-6 rounded-md shadow-md">
        @csrf

        <!-- Add a hidden input field to include the user ID -->
        <input type="hidden" name="user_id" value="{{ Auth::id() }}">

        <div class="mb-4">
            <label for="title" class="block text-sm font-medium text-gray-600">Title:</label>
            <input type="text" name="title" id="title" required
                   class="block text-sm font-medium text-gray-600">
        </div>

        <div class="mb-4">
            <label for="image" class="block text-sm font-medium text-gray-600">Image:</label>
            <input type="file" name="image" id="image" required accept="image/*"
                   class="block text-sm font-medium text-gray-600">
        </div>

        <div class="mb-4">
            <label for="folderName" class="block text-sm font-medium text-gray-600">Folder Name:</label>
            <input type="text" name="folderName" id="folderName" 
                   class="block text-sm font-medium text-gray-600">
        </div>

        <div class="flex justify-center">
            <button type="submit" class="btn fs-6 text-xl">Upload</button>
        </div>
    </form>
</div>

    
    <!-- Your existing form for uploading photos -->

    <form action="{{ route('photos.searchAndDeleteDuplicates') }}" method="POST" class="max-w-md mt-2 mx-auto bg-white p-6 rounded-md shadow-md">
    @csrf
    <div class="flex justify-center">
    <button type="submit" class="btn fs-6 text-xl">Delete Duplicates</button>
</div>
</form>
  
<div class="py-12">
    <div class="max-w-7xl mx-5 sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-500 dark:text-gray-100">

                <!-- Display List of Photos -->
                <h1 class="text-3xl font-bold mb-4">List of Photos</h1>
                <div class="py-12">
    <div class="max-w-7xl mx-5 sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-500 dark:text-gray-100">
                <!-- Display List of Photos -->
                

                @php
                    $groupedPhotos = $photos->groupBy('folderName');
                @endphp

                @foreach($groupedPhotos as $folderName => $folderPhotos)
                    @if($folderPhotos->first()->user_id == Auth::id())
                        <div class="mb-3">
                            <h5 class="text-xl font-semibold mb-2">{{ $folderName }}</h5> <br>
                            <div class="grid grid-cols-3 gap-4">
                                @foreach($folderPhotos as $photo)
                                    @if($photo->user_id == Auth::id())
                                        <div class="bg-white p-4 rounded-md shadow-md flex justify-between items-center">
                                            <img
                                                src="{{ asset('storage/photos/' . $photo->image) }}"
                                                alt="{{ $photo->title }}"
                                                class="mb-2"
                                                style="width: 100px; height: 100px; object-fit: cover;"
                                            />

                                            <div class="ml-4">
                                                <p class="text-gray-600">Title: {{ $photo->title }}</p>
                                                <p class="text-gray-600">Folder: {{ $photo->folderName }}</p>
                                                <!-- Add other details as needed -->
                                                <p class="text-gray-600">Date: {{ $photo->created_at->format('Y-m-d') }}</p>
                                                <p class="text-gray-600">Size: {{ $photo->size }} KB</p>
                                            </div>

                                            <form action="{{ route('photos.destroy', ['photo' => $photo->id]) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-white bg-red-500 hover:bg-red-700 focus:outline-none py-1 px-3 rounded-md">Delete</button>
                                            </form>
                                        </div>
                                    @endif
                                @endforeach
                                <div class='underline'>--------------------------------------------------------------------------------------------------------------------------------------------------------------</div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</x-app-layout>



                          
          
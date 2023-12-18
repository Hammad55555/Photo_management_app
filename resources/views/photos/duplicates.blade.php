<!-- duplicates.blade.php -->

<x-app-layout>
    <x-slot name="header">
        <!-- Add header content if needed -->
    </x-slot>

    <div class="container mx-auto mt-8 bg-white">
        <h2 class="text-2xl font-bold mb-4">List of Duplicate Photos</h2>

        <div class="grid grid-cols-3 gap-4">
            @foreach($duplicateRecords as $duplicate)
                <!-- Your duplicate record display logic goes here -->
            @endforeach
        </div>
    </div>
</x-app-layout>

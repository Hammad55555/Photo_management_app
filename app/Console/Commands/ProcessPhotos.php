<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ProcessPhotos extends Command
{
    protected $signature = 'photos:process';
    protected $description = 'Recursively search folder, extract photo info, and store in MariaDB';

    public function handle()
    {
        $folderPath = public_path('photos'); // Adjust the folder path as needed

        // Call the Python script
        $output = [];
        $returnVar = 0;
        $pythonScriptPath = 'C:\Users\MUHAMMAD HAMMAD\AppData\Local\Programs\Python\Python312\python.exe';

        $escapedScriptPath = escapeshellarg(base_path('scripts/process_photos.py'));
        $escapedFolderPath = escapeshellarg($folderPath);
         
        exec("\"$pythonScriptPath\" $escapedScriptPath $escapedFolderPath", $output, $returnVar);

        if ($returnVar === 0) {
            $this->info('Photos processed successfully.');
        } else {
            $this->error('Failed to process photos.');
        }
    }
}

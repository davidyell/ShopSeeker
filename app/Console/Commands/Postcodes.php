<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Models\Postcode;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use League\Csv\Reader;
use ZipArchive;

class Postcodes extends Command
{
    /**
     * We could take this as input from a user on the CLI, but that opens us up to user input error
     */
    private const DATA_URL = 'https://parlvid.mysociety.org/os/ONSPD/2022-11.zip';

    private const FILE_URL = storage_path('app/postcodes.zip');

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:postcodes';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Download and import postcode data';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Starting postcode data import...');

        // Ensure we don't download a file we already downloaded
        if (Storage::assertExists(self::FILE_URL) === false) {
            // Check the download url exists and is reachable
            $response = Http::head(self::DATA_URL);
            if ($response->failed()) {
                $this->error('The download URL is not reachable.');

                return self::FAILURE;
            }
            $this->info('Download url is valid and accessible.');

            // Try downloading the zip file to the local filesystem
            $zipFilePath = storage_path('app/postcodes.zip');
            $response = Http::get(self::DATA_URL);
            if ($response->failed()) {
                $this->error('Failed to download the zip file.');

                return self::FAILURE;
            }
            $this->info('Saving the zip file...');
            Storage::put('postcodes.zip', $response->body());
        }

        // Unzip the file
        $zip = new ZipArchive;
        if ($zip->open($zipFilePath) === true) {
            $zip->extractTo(storage_path('app/postcodes'));
            $zip->close();
        } else {
            $this->error('Failed to unzip the file.');

            return self::FAILURE;
        }

        // Go into the Data/multi_csv folder
        $csvFolderPath = storage_path('app/postcodes/Data/multi_csv');
        if (! is_dir($csvFolderPath)) {
            $this->error('The expected CSV folder does not exist.');

            return self::FAILURE;
        }

        // Check files exist in the folder
        $csvFiles = glob($csvFolderPath.'/*.csv');
        if (empty($csvFiles)) {
            $this->error('No CSV files found in the folder.');

            return self::FAILURE;
        }

        // Loop through the files and process the csv data, importing it into the database with an upsert
        foreach ($csvFiles as $csvFile) {
            $this->info("Processing file: $csvFile");

            $csv = Reader::createFromPath($csvFile, 'r');
            $csv->setHeaderOffset(0);

            foreach ($csv as $record) {
                Postcode::updateOrCreate(
                    ['postcode' => $record['postcode']],
                    $record
                );
            }
        }

        $this->info('Postcode data import completed successfully.');
        // TODO: Could handle cleanup here by deleting the files, but we don't want to keep downloading it again and again

        return self::SUCCESS;
    }
}

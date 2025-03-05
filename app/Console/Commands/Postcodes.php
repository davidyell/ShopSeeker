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

    private string $folder;

    private string $filename;

    private string $path;

    public function __construct()
    {
        $this->folder = storage_path('app/postcodes');
        $this->filename = 'postcodes.zip';
        $this->path = $this->folder.'/'.$this->filename;

        parent::__construct();
    }

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
        if (Storage::fileMissing($this->path)) {
            // Check the download url exists and is reachable
            $response = Http::head(self::DATA_URL);
            if ($response->failed()) {
                $this->error('The download URL is not reachable.');

                return self::FAILURE;
            }
            $this->info('Download url is valid and accessible.');

            // Try downloading the zip file to the local filesystem
            $response = Http::get(self::DATA_URL);
            if ($response->failed()) {
                $this->error('Failed to download the zip file.');

                return self::FAILURE;
            }
            $this->info('Saving the zip file...');
            Storage::put($this->path, $response->body());
        } else {
            $this->info('File already exists');
        }

        // Unzip the file
        $zip = new ZipArchive;
        $result = $zip->open($this->path, ZipArchive::CHECKCONS);
        if ($result === true) {
            $zip->extractTo($this->folder);
            $zip->close();
        } else {
            $this->error(sprintf('Failed to unzip the file, %s', $result));

            return self::FAILURE;
        }
        $this->info('Unzipping archive...');

        // Go into the Data/multi_csv folder
        $csvFolderPath = storage_path($this->folder.'/Data/multi_csv');
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

        $this->info('✨ Postcode data import completed successfully.');

        return self::SUCCESS;
    }
}

# Shop Seeker

An example application in Larvel to find shops near to a UK postal code.

-   Created using Laravel Breeze as a base.
-   Created in collaboration with Github Copilot.

## Requirements

-   Docker
-   PHP
-   Composer

## Install

-   Clone the repo
-   `composer install`
-   `./vendor/bin/sail up -d`
-   `./vendor/bin/sail npm ci`
-   `./vendor/bin/sail npm run dev`

Visit http://localhost

## Things to do and improvements

-   Wrap all the setup commands into a neat bash script.
-   Break up the Postcodes artisan command into smaller methods so it's easier to test.
-   Improve the download file cleanup in the Postcode artisan command by checking if the filename in the remote has changed before deleting the downloads, so we don't re-download over and over.
-   Add capabilities to the web guard so only some users can create new shops.
-   Refactor the Postcode command out of the app so it can run as a scheduled AWS Lambda for instance to allow it to clean up afterwards, run on a schedule, leverage faster downloads on AWS and remove the need for the Zip PHP extension in the Docker container.

## Timesheet

-   Session 1: 09:30 -> 11:30
-   Session 2: 11:45 ->

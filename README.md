# Shop Seeker

An example application in Larvel to find shops near to a UK postal code.

-   Created using Laravel Breeze as a base.
-   Uses Laravel Sail for Docker.
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

## Things to do

-   [TODO] Complete the Postcode artisan command

## Improvements

-   [DEVOPS] Wrap all the setup commands into a neat bash script.
-   [DEVOPS] Organise the generated Github Workflows
-   [DEVOPS] Could add a workflow to validate the OpenAPI schema.
-   [DEVOPS] Ensure the php-zip extension is installed into the container from Pecl.
-   [REFACTOR] Break up the Postcodes artisan command into smaller methods so it's easier to test.
-   [REFACTOR] Improve the download file cleanup in the Postcode artisan command by checking if the filename in the remote has changed before deleting the downloads, so we don't re-download over and over.
-   [AUTH] Add capabilities to the web guard so only some users can create new shops.
-   [REFACTOR] Move postcode command out of the app so it can run as a scheduled AWS Lambda for instance to allow it to clean up afterwards, run on a schedule, leverage faster downloads on AWS and remove the need for the Zip PHP extension in the Docker container.
-   [AUTH] Implement Laravel Sanctum to add JSON web token API authentication and authorisation.
-   [API] Add the Spatie Query Builder package for sorting and filtering in admin and api.
-   [API] Add the PHPLeague Fractal package if complex JSON API output is needed.
-   [API] Add api rate limiting middleware.
-   [API] Could add an OpenAPI schema and writes tests against it.

## Timesheet

-   Session 1: 09:30 -> 11:30
-   Session 2: 11:45 ->

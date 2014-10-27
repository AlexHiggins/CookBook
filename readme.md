## Installation

1. npm install
2. composer install
3. php artisan migrate; php artisan db:seed

## Configuration

You'll need to create a .env. file containing these variables

'DISQUS_SHORTNAME', 'DB_HOST', 'DB_NAME', 'DB_USERNAME', 'DB_PASSWORD'

If you are sending emails you'll need to be aware of the mail configuration

## Tests

Create a testing database and a .env.testing file to point to this.

Run vendor/bin/codecept run; vendor/bin/phpspec run

## Contributing

Feel free to contribute features / bug fixes. 

## Development Schedule

1. Adding a rating system
2. Sort ordering on recipes (most popular, highest rated...)
3. Github Authentication
4. Notifications when a recipe is posted (twitter, email)
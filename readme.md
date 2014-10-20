## Installation

1. npm install
2. composer install
3. php artisan migrate; php artisan db:seed

## Configuration

You'll need to create a .env. file containing these variables

'DISQUS_SHORTNAME', 'DB_HOST', 'DB_NAME', 'DB_USERNAME', 'DB_PASSWORD'

## Tests

Create a testing database and a .env.testing file to point to this.

Run vendor/bin/codecept run; vendor/bin/phpspec run

## Contributing

Feel free to contribute features / bug fixes. 

## Development Schedule

1. Adding a rating system
2. Notifications when logging in / out etc.
3. Implimenting password reminders
4. Tweaking the UI to be more consistant - e.g. href's colour scheme
5. Search
6. Sort ordering on recipies (most popular, highest rated...)
7. Github Authentication
8. Notifications when a recipie is posted (twitter, email)
9. Improve tests

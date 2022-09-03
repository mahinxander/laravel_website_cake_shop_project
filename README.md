## Laravel Cake Shop Website Project - The Sweet Piece

The Sweet Piece - A Laravel Cake Shop Website Project is an open source ecommerce/online shop platform management system using Laravel.

## Packages Used
 **Laravel Debugbar came in handy. Set APP_DEBUG=true if usage is helpful, otherwise set false.**
## Installation Instructions

- Clone the repo.
- Run `composer install`
- Run `php -r "file_exists('.env') || copy('.env.example', '.env');"`
- Run `php artisan key:generate --ansi`
- Run `mysql -uroot`
- Create a database named `cakeshop` (or you can change the name in .env) in your localhost
- Edit `.env` file
- Run `php artisan migrate --seed`

## Contributing

Thank you for considering contributing to the Laravel- Cake Shop Project!

## Contribution Guideline

- Fork the repo.
- Clone the repo.
- Run `git checkout dev`
- Create a new local branch
- Work on your local branch
- Push to remote
- When work is tested, done or ready, push to remote
- Merge to dev

## License

The Sweet Piece- A Laravel Cake Shop Website Project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

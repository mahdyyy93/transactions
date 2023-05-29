## About

- This project is to show some practices of common software development patterns.
- Use case is money lending. 
- Build on PHP Laravel 10.
- Uses Laravel Sail for a simple and convenient local development environment.

## Requirements

- Docker
- Composer

## Installation Steps

1. Clone the repository:

```bash
git clone https://github.com/mahdyyy93/transactions/.git
cd transactions
```

2. Install dependencies using Composer:

```bash
composer install
```

3. Copy the `.env.example` file to create a new `.env` file:

```bash
cp .env.example .env
```

4. Generate an application key:

```bash
php artisan key:generate
```

5. Start the Laravel Sail environment:

```bash
./vendor/bin/sail up
```

If you're using Windows, you may need to use the `sail` command from the `vendor\bin` directory:

```powershell
vendor\bin\sail up
```

6. Run the database migrations and seeders:

```bash
./vendor/bin/sail artisan migrate --seed
```

For Windows:

```powershell
vendor\bin\sail artisan migrate --seed
```

7. Access the application in your browser:

Open your browser and navigate to `http://localhost` (or the custom domain you've set up in your `.env` file).

## Additional Commands

- To stop the Sail environment, run:

```bash
./vendor/bin/sail down
```

For Windows:

```powershell
vendor\bin\sail down
```

- To run tests, use:

```bash
./vendor/bin/sail test
```

For Windows:

```powershell
vendor\bin\sail test
```

- To access the application container's shell, run:

```bash
./vendor/bin/sail shell
```

For Windows:

```powershell
vendor\bin\sail shell
```

## Customizing Sail

You can customize the Sail environment by editing the `docker-compose.yml` file in the root of your project. For more information on customizing Sail, refer to the [official Laravel Sail documentation](https://laravel.com/docs/sail).

## Contributing

Please read the [CONTRIBUTING.md](CONTRIBUTING.md) file for details on how to contribute to this project.

## License

This project is licensed under the [MIT License](LICENSE.md).
```
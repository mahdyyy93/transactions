## About

- This project is to show some practices of common software development patterns.
- Still in beta phase.
- Use case is money lending. 
- Built on PHP 8.2 Laravel 10.
- Uses Laravel Sail for a simple and convenient local development environment.


## About PHP and Laravel
PHP, as a scripting language, has always been easy to use and focused on server side development, it has always been popular and have great packages and great community with different backgrounds and experience levels. and it a good choice for building services that helps businesses. 

Lately, not only PHP but also other languages, are taking the side of restrict types to make use of it's advantages.

Laravel with it's ecosystem is one of the best in the market, it's easy to use and maintain and improves code reuseablity. It helps to shift focus to business logic.

## App features

- User registers and recieved a welcome email.
- User initiates a transaction and recieves a notification (email).
- Admin commits transactions.
- User recieved a notification when ever loan status is changed.
- User has a wallet having his overall balance, credit and debit are calculated for better accuracy.
- Credit and debit is checked against saving a transaction in TransactionObserver.

## To do

- Implement Settlements
- Apply currencies to transactions table
- Fix test workflow 

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


## Note 
If you are using Fedora Linux you might need to temporarily disable SELinux by running the following command before you can do "sail up":
```
sudo setenforce 0
```
This command sets SELinux to permissive mode, allowing you to execute the script without being blocked by SELinux policies. Keep in mind that this reduces the security of your system, so it's not recommended for production environments.

If the command works without any issues, you can re-enable SELinux by running:
```
sudo setenforce 1
```

## Customizing Sail

You can customize the Sail environment by editing the `docker-compose.yml` file in the root of your project. For more information on customizing Sail, refer to the [official Laravel Sail documentation](https://laravel.com/docs/sail).

## Contributing

Please read the [CONTRIBUTING.md](CONTRIBUTING.md) file for details on how to contribute to this project.

## License

This project is licensed under the [MIT License](LICENSE.md).
```

# COVID RCP backend app

[Symfony](https://symfony.com/) based backend application for the [COVID RCP](https://github.com/tozanni/covid_rcp_webapp) web app.

## Requirements

  * PHP 7.2.9 or higher;
  * Appropriate PDO PHP extension enabled for your database;
  * and the [usual Symfony application requirements](https://symfony.com/doc/current/reference/requirements.html).

## Installation

1. Use the package manager [composer](https://getcomposer.org/) to install dependencies.

```bash
composer install
```
2. Create a .env.local file to setup your environment.
3. Run migrations
```bash
bin/console doctrine:schema:create
```
4. (OPTIONAL) Get the [Symfony CLI](https://symfony.com/download) tool to run a local web server
```bash
symfony serve
```

##Jason Web Token (JWT) Configuration 

1. Generate Certificates
```bash
openssl genrsa -out config/jwt/private.pem -aes256 4096
openssl rsa -pubout -in config/jwt/private.pem -out config/jwt/public.pem
```

2. Update .env file
```
JWT_SECRET_KEY=%kernel.project_dir%/config/jwt/private.pem
JWT_PUBLIC_KEY=%kernel.project_dir%/config/jwt/public.pem
JWT_PASSPHRASE=covid19prevRCP (used in previous step)
```

## Contributing
Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.

Please make sure to update tests as appropriate.

## License
[MIT](https://choosealicense.com/licenses/mit/)
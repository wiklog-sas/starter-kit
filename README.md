# Package de développment de Wiklog pour Laravel

Starter kit pour le développement de solutions sur le framework Laravel. 

## Installation

You can install the package via composer:

```bash
composer require wiklog/starter-kit
```

You can publish and run the migrations with:

```bash
php artisan vendor:publish --tag="starter-kit-migrations"
php artisan migrate
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="starter-kit-config"
```

This is the contents of the published config file:

```php
return [
];
```

Optionally, you can publish the views using

```bash
php artisan vendor:publish --tag="starter-kit-views"
```

## Usage

```php
$starterKit = new Wiklog\StarterKit();
echo $starterKit->echoPhrase('Hello, Wiklog!');
```

You can publish inputs components:
```bash
php artisan wiklog-inputs-components:publish
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.


## Credits

- [Wiklog](https://github.com/wiklog-sas)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

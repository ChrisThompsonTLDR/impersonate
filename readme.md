## Impersonate

Allow a user to impersonate another user.

It is currently under heavy development and not recommended for production environments.

## Installation

### Composer

Require this package with composer:

```
composer require christhompsontldr/impersonate
```

### Service Provider

After updating composer, add the ServiceProvider to the providers array in config/app.php

#### Laravel 5.x:

```
Christhompsontldr\Impersonate\ImpersonateServiceProvider::class,
```

### Setup

The next command will create migrations, create the `Role` and `Permission` models and add traits to your application's User model.

```
php artisan impersonate:setup
```

This will run two commands (which can be run independently
```
php artisan impersonate:add-trait
php artisan impersonate:publish
```

## Source

This package is based off an example located [here](http://blog.mauriziobonani.com/easily-impersonate-any-user-in-a-laravel-application/).
## Impersonate

Allow a user to impersonate another user.

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

This will apply a trait to the user model configured in `config/auth.php`.  `setup` runs both the `add-trait` and `publish` commands.

```
php artisan impersonate:setup
```

This will run two commands (which can be run independently:
```
php artisan impersonate:add-trait
php artisan impersonate:publish
```

`publish` publishes the config and `add-trait` applies a trait to the user model.

## Source

This package is based off an example located [here](http://blog.mauriziobonani.com/easily-impersonate-any-user-in-a-laravel-application/).
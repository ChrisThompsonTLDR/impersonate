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

## Access Control

You must complete this step, or none of your users will have permission to impersonate.

The authorized users that can impersonate and which users they can impersonate is controlled via the trait.  This can be overloaded on your user model

```
public function canImpersonate($id)
{
    return $this->is_admin ?: false;
}
```

In this example, the user model has an `is_admin` attribute that is being checked.

## Issues

Log out will be performed on both the main user and the impersonated user.

## Source

This package is based off an example located [here](http://blog.mauriziobonani.com/easily-impersonate-any-user-in-a-laravel-application/).
This Laravel package allows a user to impersonate another user.

## Installation

### Composer

Require this package with composer:

```
composer require christhompsontldr/impersonate
```

### Model

Update your user model to be impersonatable.

```
namespace App\Models;

use Christhompsontldr\Impersonate\Models\Traits\Impersonatable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Impersonatable;
```

## Access Control

You must complete this step, or none of your users will have permission to impersonate.

The authorized users that can impersonate and which users they can impersonate is controlled via the trait.  This can be overloaded on your user model

In this example, the user model has an `is_admin` attribute that is being checked.

```
public function canImpersonate(User $user)
{
    return $this->is_admin ?: false;
}
```

Or if you are using [Laratrust](https://github.com/santigarcor/laratrust)

```
public function canImpersonate(User $user)
{
    // can't impersonate other admins
    if ($user->hasRole('admin')) {
        return false;
    }

    // current user is admin
    return $this->hasRole('admin');
}
```

## Issues

Logout will be performed on both the main user and the impersonated user.

## Source

This package is based on [this example](http://blog.mauriziobonani.com/easily-impersonate-any-user-in-a-laravel-application/).

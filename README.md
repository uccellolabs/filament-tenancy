[![Latest Version on Packagist](https://img.shields.io/packagist/v/uccellolabs/filament-tenancy.svg?style=flat-square)](https://packagist.org/packages/uccellolabs/filament-tenancy)
[![Total Downloads](https://img.shields.io/packagist/dt/uccellolabs/filament-tenancy.svg?style=flat-square)](https://packagist.org/packages/uccellolabs/filament-tenancy)

# Filament Tenancy

Easy way to manage tenancy with filament.

## Installation

You can install the package via composer:

```bash
composer require uccellolabs/filament-tenancy
```

## Configuration

Edit `app/Models/User.php` and add the following code:

```php
use Uccellolabs\FilamentTenancy\Support\Traits\UserBelongsToTenant;

class User extends Authenticatable
{
    use UserBelongsToTenant;
}
```

Edit `app/Filament/Resources/UserResource/Pages/ListUsers.php` and add the following code:

```php
use Uccellolabs\FilamentTenancy\Support\Traits\CurrentTenant;

class ListUsers extends ListRecords
{
    use CurrentTenant;

    protected function getTableQuery(): Builder
    {
        $userIds = $this->getCurrentTenant()?->users()->pluck('users.id') ?? [];

        return User::whereIn('id', $userIds);
    }
}
```

## Credits

-   [Uccellolabs](https://github.com/uccellolabs)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

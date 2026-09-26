<?php

namespace App\Models;

use Filament\Panel;
use JeffersonGoncalves\Filament\User\Models\User as BaseUser;
use JeffersonGoncalves\HelpDesk\Concerns\HasTickets;

/**
 * Columns, casts, factory, observer and avatar come from
 * jeffersongoncalves/laravel-user + jeffersongoncalves/filament-user.
 */
class User extends BaseUser
{
    use HasTickets;

    public function canAccessPanel(Panel $panel): bool
    {
        return ! in_array($panel->getId(), ['admin', 'operator']);
    }
}

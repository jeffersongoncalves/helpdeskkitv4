<?php

use JeffersonGoncalves\FilamentHelpDesk\Admin\Resources\CannedResponseResource;
use JeffersonGoncalves\FilamentHelpDesk\Admin\Resources\CategoryResource;
use JeffersonGoncalves\FilamentHelpDesk\Admin\Resources\DepartmentResource;
use JeffersonGoncalves\FilamentHelpDesk\Admin\Resources\EmailChannelResource;
use JeffersonGoncalves\FilamentHelpDesk\User\Resources\TicketResource;

return [

    /*
    |--------------------------------------------------------------------------
    | User Panel Configuration
    |--------------------------------------------------------------------------
    */
    'user' => [
        'resource' => TicketResource::class,
        'navigation_group' => 'Support',
        'navigation_icon' => 'heroicon-o-ticket',
        'navigation_sort' => null,
        'navigation_label' => null,
        'slug' => 'tickets',
    ],

    /*
    |--------------------------------------------------------------------------
    | Operator Panel Configuration
    |--------------------------------------------------------------------------
    */
    'operator' => [
        'resource' => JeffersonGoncalves\FilamentHelpDesk\Operator\Resources\TicketResource::class,
        'navigation_group' => 'Help Desk',
        'navigation_icon' => 'heroicon-o-inbox-stack',
        'navigation_sort' => null,
        'navigation_label' => null,
        'slug' => 'tickets',
    ],

    /*
    |--------------------------------------------------------------------------
    | Admin Panel Configuration
    |--------------------------------------------------------------------------
    */
    'admin' => [
        'navigation_group' => 'Help Desk',
        'navigation_icon' => 'heroicon-o-cog-6-tooth',
        'navigation_sort' => null,
        'resources' => [
            'ticket' => JeffersonGoncalves\FilamentHelpDesk\Admin\Resources\TicketResource::class,
            'department' => DepartmentResource::class,
            'category' => CategoryResource::class,
            'canned_response' => CannedResponseResource::class,
            'email_channel' => EmailChannelResource::class,
        ],
    ],

];

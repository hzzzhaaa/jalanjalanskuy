<?php

/*
 * This file is part of Laravel Hashids.
 *
 * (c) Vincent Klaiber <hello@doubledip.se>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

return [

    /*
    |--------------------------------------------------------------------------
    | Default Connection Name
    |--------------------------------------------------------------------------
    |
    | Here you may specify which of the connections below you wish to use as
    | your default connection for all work. Of course, you may use many
    | connections at once using the manager class.
    |
    */

    'default' => 'main',

    /*
    |--------------------------------------------------------------------------
    | Hashids Connections
    |--------------------------------------------------------------------------
    |
    | Here are each of the connections setup for your application. Example
    | configuration has been included, but you may add as many connections as
    | you would like.
    |
    */

    'connections' => [

        \App\User::class => [
            'salt' => \App\User::class.'your-salt-string',
            'length' => 8,
        ],

        \App\Event::class => [
            'salt' => \App\Event::class.'your-salt-string',
            'length' => 6,
        ],

        \App\Organizer::class => [
            'salt' => \App\Organizer::class.'your-salt-string',
            'length' => 4,
        ],

        \App\Ticket::class => [
            'salt' => \App\Ticket::class.'your-salt-string',
            'length' => 4,
        ],

        \App\Division::class => [
            'salt' => \App\Division::class.'your-DiV1SION-string',
            'length' => 4,
        ],

        'ticketuser'::class => [
            'salt' => 'In1UNtuKTicketU$3R',
            'length' => 8,
        ],


    ],

];

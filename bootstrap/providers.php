<?php

use App\Providers\AppServiceProvider;
use Illuminate\View\ViewServiceProvider;
use Illuminate\Database\DatabaseServiceProvider;
use Illuminate\Session\SessionServiceProvider;
use Illuminate\Filesystem\FilesystemServiceProvider;
use Illuminate\Cookie\CookieServiceProvider;
use Illuminate\Encryption\EncryptionServiceProvider;
use Illuminate\Bus\BusServiceProvider;
use Illuminate\Cache\CacheServiceProvider;
use Illuminate\Validation\ValidationServiceProvider;
use Illuminate\Translation\TranslationServiceProvider;
use Illuminate\Auth\AuthServiceProvider;

return [
    AppServiceProvider::class,
    ViewServiceProvider::class,
    DatabaseServiceProvider::class,
    SessionServiceProvider::class,
    FilesystemServiceProvider::class,
    CookieServiceProvider::class,
    EncryptionServiceProvider::class,
    BusServiceProvider::class,
    CacheServiceProvider::class,
    ValidationServiceProvider::class,
    TranslationServiceProvider::class,
    AuthServiceProvider::class,
];

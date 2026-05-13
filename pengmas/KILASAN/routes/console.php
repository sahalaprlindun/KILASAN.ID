<?php

use Illuminate\Support\Facades\Artisan;

Artisan::command('kilasan:about', function () {
    $this->info('KILASAN backend siap digunakan.');
});

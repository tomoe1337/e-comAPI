<?php

use App\Console\Commands\CancelUnpaidOrders;
use Illuminate\Support\Facades\Schedule;

Schedule::command(CancelUnpaidOrders::class)->everyMinute();

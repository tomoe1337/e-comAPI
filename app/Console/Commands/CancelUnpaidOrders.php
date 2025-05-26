<?php

namespace App\Console\Commands;

use App\Models\Order;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;

class CancelUnpaidOrders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'orders:cancel-unpaid';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Закрыть все неоплаченные за 2 минуты заказы';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $threshold = Carbon::now()->subMinutes(2);

        $ordersToCancel = Order::where('status', Order::STATUS_PENDING)
            ->where('created_at', '<', $threshold)
            ->get();

        $count = $ordersToCancel->count();

        if ($count > 0) {
            foreach ($ordersToCancel as $order) {
                $order->status = Order::STATUS_CANCELLED;
                $order->save();
            }
            $this->info("Успешно отменено {$count} неоплаченных заказов.");
        } else {
            $this->info("Нет неоплаченных заказов");
        }
    }

}

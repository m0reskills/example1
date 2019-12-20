<?php

namespace App\Console\Commands;

use App\Entity\Currency\Rate;
use Illuminate\Console\Command;

class GetRate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'getRate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Получаем котировку';

    /**
     * Create a new command instance.
     *
     * @param Rate $rate
     */
    public function __construct(Rate $rate)
    {
        parent::__construct();
        $actualRate = $rate->saveCurrency('USD');
        $rate->fill(['rate' => $actualRate])->save();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
    }
}

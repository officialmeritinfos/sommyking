<?php

namespace App\Console\Commands;

use App\Custom\Wallet;
use App\Models\Coin;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class CachCryptoRates extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cache:cryptoRates';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch Cryptocurrency rates and cache them for a faster retrieval of values';
    public $wallet;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->wallet = new Wallet();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $coins = Coin::where('status',1)->get();
        if ($coins->count()>0) {
            foreach ($coins as $coin) {
                //check if it is already cached
                $key = strtoupper($coin->asset);
                $seconds = 60*30;
                if (!Cache::has($key)) {
                    $rate = $this->wallet->getCryptoExchange($key,'USD');
                    Cache::put($key,$rate,$seconds);
                }
            }
        }
    }
}

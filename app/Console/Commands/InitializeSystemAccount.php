<?php

namespace App\Console\Commands;

use App\Custom\GenerateUnique;
use App\Custom\Wallet;
use App\Models\Coin;
use App\Models\SystemAccount;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Log;

class InitializeSystemAccount extends Command
{
    use GenerateUnique;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'initialize:systemAccount';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generates and initializes System Account for Cryptocurrencies accepted';
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
        $coins = Coin::where('status',1)->where('mainNetwork',1)->get();
        if ($coins->count() >0) {
            foreach ($coins as $coin) {
                //check if the coin has been added to the system
                $sysAccount = SystemAccount::where('asset',$coin->asset)->first();
                if(empty($sysAccount)){
                    //let us generate the wallets. We will split them into functions for ease
                    switch ($coin->asset) {
                        case 'BTC':
                            $this->generateBtcWallet($coin);
                            break;
                        case 'ETH':
                                $this->generateEthWallet($coin);
                                break;
                        case 'LTC':
                                $this->generateLtcWallet($coin);
                                break;
                        case 'DOGE':
                            $this->generateDogeWallet($coin);
                            break;
                    }
                }
            }
        }
    }
    public function generateBtcWallet($coin)
    {
        $generate = $this->wallet->generateWallet($coin->urlCode);
        if ($generate->ok()) {
            $walletResult = $generate->json();
            //xpub and mnemonic
            $xpub = $walletResult['xpub'];
            $mnemonic = $walletResult['mnemonic'];
            $new_mnemonic = Crypt::encryptString($mnemonic);
            $accountKey = $xpub;
            //generate private key
            $dataPrivateKey = [
                'index' => 1,
                'mnemonic' => $mnemonic
            ];
            $generatePrivateKey = $this->wallet->generatePriv($coin->urlCode, $dataPrivateKey);
            if ($generatePrivateKey->ok()) {
                $privateKeyResult = $generatePrivateKey->json();
                $priKey = $privateKeyResult['key'];
                $new_prikey = Crypt::encryptString($priKey);
                $hasPriKey = 1;
            }else {
                $hasPriKey = 2;
                $new_prikey='';
                //Log::alert($generate->json());
            }
            //generate an account for it
            $dataAccount = [
                'currency' => $coin->asset,
                'xpub' => $accountKey,
                'accountingCurrency' => 'USD'
            ];
            $account = $this->wallet->createAccount($dataAccount);
            if ($account->ok()) {
                $accountId = $account['id'];
                //create a deposit address
                $generateAddress = $this->wallet->generateAddress($accountId);
                if ($generateAddress->ok()) {
                    $dataAddress = [
                        'asset' => $coin->asset,
                        'accountId' => $accountId,
                        'address' => $generateAddress['address'],
                        'hasMemo' => $coin->hasMemo,
                        'memo'=>'',
                        'availableBalance' => 0,
                        'priKey'=>$new_prikey,
                        'mnemonic'=>$new_mnemonic,
                        'pubKey'=>$xpub,
                        'hasPriKey'=>$hasPriKey,
                        'derivationKey'=>$generateAddress['derivationKey'],
                        'customId'=>$this->createUniqueRef('system_accounts','customId'),
                    ];
                    SystemAccount::create($dataAddress);
                }else{
                    //Log::alert($generateAddress->json());
                }
            }else{
                //Log::alert($account->json());
            }
        }else{
            //Log::alert($generate->json());
        }
    }
    public function generateLtcWallet($coin)
    {
        $generate = $this->wallet->generateWallet($coin->urlCode);
        if ($generate->ok()) {
            $walletResult = $generate->json();
            //xpub and mnemonic
            $xpub = $walletResult['xpub'];
            $mnemonic = $walletResult['mnemonic'];
            $new_mnemonic = Crypt::encryptString($mnemonic);
            $accountKey = $xpub;
            //generate private key
            $dataPrivateKey = [
                'index' => 1,
                'mnemonic' => $mnemonic
            ];
            $generatePrivateKey = $this->wallet->generatePriv($coin->urlCode, $dataPrivateKey);
            if ($generatePrivateKey->ok()) {
                $privateKeyResult = $generatePrivateKey->json();
                $priKey = $privateKeyResult['key'];
                $new_prikey = Crypt::encryptString($priKey);
                $hasPriKey = 1;
            }else {
                $hasPriKey = 2;
                $new_prikey='';
                Log::alert($generate->json());
            }
            //generate an account for it
            $dataAccount = [
                'currency' => $coin->asset,
                'xpub' => $accountKey,
                'accountingCurrency' => 'USD'
            ];
            $account = $this->wallet->createAccount($dataAccount);
            if ($account->ok()) {
                $accountId = $account['id'];
                //create a deposit address
                $generateAddress = $this->wallet->generateAddress($accountId);
                if ($generateAddress->ok()) {
                    $dataAddress = [
                        'asset' => $coin->asset,
                        'accountId' => $accountId,
                        'address' => $generateAddress['address'],
                        'hasMemo' => $coin->hasMemo,
                        'memo'=>'',
                        'availableBalance' => 0,
                        'priKey'=>$new_prikey,
                        'mnemonic'=>$new_mnemonic,
                        'pubKey'=>$xpub,
                        'hasPriKey'=>$hasPriKey,
                        'derivationKey'=>$generateAddress['derivationKey'],
                        'customId'=>$this->createUniqueRef('system_accounts','customId'),
                    ];
                    SystemAccount::create($dataAddress);
                }else{
                    Log::alert($generateAddress->json());
                }
            }else{
                Log::alert($account->json());
            }
        }else{
            Log::alert($generate->json());
        }
    }
    public function generateEthWallet($coin)
    {
        $generate = $this->wallet->generateWallet($coin->urlCode);
        if ($generate->ok()) {
            $walletResult = $generate->json();
            //xpub and mnemonic
            $xpub = $walletResult['xpub'];
            $mnemonic = $walletResult['mnemonic'];
            $new_mnemonic = Crypt::encryptString($mnemonic);
            $accountKey = $xpub;
            //generate private key
            $dataPrivateKey = [
                'index' => 1,
                'mnemonic' => $mnemonic
            ];
            $generatePrivateKey = $this->wallet->generatePriv($coin->urlCode, $dataPrivateKey);
            if ($generatePrivateKey->ok()) {
                $privateKeyResult = $generatePrivateKey->json();
                $priKey = $privateKeyResult['key'];
                $new_prikey = Crypt::encryptString($priKey);
                $hasPriKey = 1;
            }else {
                $hasPriKey = 2;
                $new_prikey='';
                Log::alert($generate->json());
            }
            //generate an account for it
            $dataAccount = [
                'currency' => $coin->asset,
                'xpub' => $accountKey,
                'accountingCurrency' => 'USD'
            ];
            $account = $this->wallet->createAccount($dataAccount);
            if ($account->ok()) {
                $accountId = $account['id'];
                //create a deposit address
                $generateAddress = $this->wallet->generateAddress($accountId);
                if ($generateAddress->ok()) {
                    $dataAddress = [
                        'asset' => $coin->asset,
                        'accountId' => $accountId,
                        'address' => $generateAddress['address'],
                        'hasMemo' => $coin->hasMemo,
                        'memo'=>'',
                        'availableBalance' => 0,
                        'priKey'=>$new_prikey,
                        'mnemonic'=>$new_mnemonic,
                        'pubKey'=>$xpub,
                        'hasPriKey'=>$hasPriKey,
                        'derivationKey'=>$generateAddress['derivationKey'],
                        'customId'=>$this->createUniqueRef('system_accounts','customId'),
                    ];
                    SystemAccount::create($dataAddress);
                }else{
                    Log::alert($generateAddress->json());
                }
            }else{
                Log::alert($account->json());
            }
        }else{
            Log::alert($generate->json());
        }
    }
    public function generateDogeWallet($coin)
    {
        $generate = $this->wallet->generateWallet($coin->urlCode);
        if ($generate->ok()) {
            $walletResult = $generate->json();
            //xpub and mnemonic
            $xpub = $walletResult['xpub'];
            $mnemonic = $walletResult['mnemonic'];
            $new_mnemonic = Crypt::encryptString($mnemonic);
            $accountKey = $xpub;
            //generate private key
            $dataPrivateKey = [
                'index' => 1,
                'mnemonic' => $mnemonic
            ];
            $generatePrivateKey = $this->wallet->generatePriv($coin->urlCode, $dataPrivateKey);
            if ($generatePrivateKey->ok()) {
                $privateKeyResult = $generatePrivateKey->json();
                $priKey = $privateKeyResult['key'];
                $new_prikey = Crypt::encryptString($priKey);
                $hasPriKey = 1;
            }else {
                $hasPriKey = 2;
                $new_prikey='';
                Log::alert($generate->json());
            }
            //generate an account for it
            $dataAccount = [
                'currency' => $coin->asset,
                'xpub' => $accountKey,
                'accountingCurrency' => 'USD'
            ];
            $account = $this->wallet->createAccount($dataAccount);
            if ($account->ok()) {
                $accountId = $account['id'];
                //create a deposit address
                $generateAddress = $this->wallet->generateAddress($accountId);
                if ($generateAddress->ok()) {
                    $dataAddress = [
                        'asset' => $coin->asset,
                        'accountId' => $accountId,
                        'address' => $generateAddress['address'],
                        'hasMemo' => $coin->hasMemo,
                        'memo'=>'',
                        'availableBalance' => 0,
                        'priKey'=>$new_prikey,
                        'mnemonic'=>$new_mnemonic,
                        'pubKey'=>$xpub,
                        'hasPriKey'=>$hasPriKey,
                        'derivationKey'=>$generateAddress['derivationKey'],
                        'customId'=>$this->createUniqueRef('system_accounts','customId'),
                    ];
                    SystemAccount::create($dataAddress);
                }else{
                    Log::alert($generateAddress->json());
                }
            }else{
                Log::alert($account->json());
            }
        }else{
            Log::alert($generate->json());
        }
    }
    // public function generateMaticWallet($coin)
    // {
    //     $generate = $this->wallet->generateWallet($coin->urlCode);
    //     if ($generate->ok()) {
    //         $walletResult = $generate->json();
    //         //xpub and mnemonic
    //         $xpub = $walletResult['xpub'];
    //         $mnemonic = $walletResult['mnemonic'];
    //         $new_mnemonic = Crypt::encryptString($mnemonic);
    //         $accountKey = $xpub;
    //         //generate private key
    //         $dataPrivateKey = [
    //             'index' => 1,
    //             'mnemonic' => $mnemonic
    //         ];
    //         $generatePrivateKey = $this->wallet->generatePriv($coin->urlCode, $dataPrivateKey);
    //         if ($generatePrivateKey->ok()) {
    //             $privateKeyResult = $generatePrivateKey->json();
    //             $priKey = $privateKeyResult['key'];
    //             $new_prikey = Crypt::encryptString($priKey);
    //             $hasPriKey = 1;
    //         }else {
    //             $hasPriKey = 2;
    //             $new_prikey='';
    //             Log::alert($generate->json());
    //         }
    //         //generate an account for it
    //         $dataAccount = [
    //             'currency' => $coin->asset,
    //             'xpub' => $accountKey,
    //             'accountingCurrency' => 'USD'
    //         ];
    //         $account = $this->wallet->createAccount($dataAccount);
    //         if ($account->ok()) {
    //             $accountId = $account['id'];
    //             //create a deposit address
    //             $generateAddress = $this->wallet->generateAddress($accountId);
    //             if ($generateAddress->ok()) {
    //                 $dataAddress = [
    //                     'asset' => $coin->asset,
    //                     'accountId' => $accountId,
    //                     'address' => $generateAddress['address'],
    //                     'hasMemo' => $coin->hasMemo,
    //                     'memo'=>'',
    //                     'availableBalance' => 0,
    //                     'priKey'=>$new_prikey,
    //                     'mnemonic'=>$new_mnemonic,
    //                     'pubKey'=>$xpub,
    //                     'hasPriKey'=>$hasPriKey,
    //                     'derivationKey'=>$generateAddress['derivationKey'],
    //                     'customId'=>$this->createUniqueRef('system_accounts','customId'),
    //                 ];
    //                 SystemAccount::create($dataAddress);
    //             }else{
    //                 Log::alert($generateAddress->json());
    //             }
    //         }else{
    //             Log::alert($account->json());
    //         }
    //     }else{
    //         Log::alert($generate->json());
    //     }
    // }
    // public function generateTronWallet($coin)
    // {
    //     $generate = $this->wallet->generateWallet($coin->urlCode);
    //     if ($generate->ok()) {
    //         $walletResult = $generate->json();
    //         //xpub and mnemonic
    //         $xpub = $walletResult['xpub'];
    //         $mnemonic = $walletResult['mnemonic'];
    //         $new_mnemonic = Crypt::encryptString($mnemonic);
    //         $accountKey = $xpub;
    //         //generate private key
    //         $dataPrivateKey = [
    //             'index' => 1,
    //             'mnemonic' => $mnemonic
    //         ];
    //         $generatePrivateKey = $this->wallet->generatePriv($coin->urlCode, $dataPrivateKey);
    //         if ($generatePrivateKey->ok()) {
    //             $privateKeyResult = $generatePrivateKey->json();
    //             $priKey = $privateKeyResult['key'];
    //             $new_prikey = Crypt::encryptString($priKey);
    //             $hasPriKey = 1;
    //         }else {
    //             $hasPriKey = 2;
    //             $new_prikey='';
    //             Log::alert($generate->json());
    //         }
    //         //generate an account for it
    //         $dataAccount = [
    //             'currency' => $coin->asset,
    //             'xpub' => $accountKey,
    //             'accountingCurrency' => 'USD'
    //         ];
    //         $account = $this->wallet->createAccount($dataAccount);
    //         if ($account->ok()) {
    //             $accountId = $account['id'];
    //             //create a deposit address
    //             $generateAddress = $this->wallet->generateAddress($accountId);
    //             if ($generateAddress->ok()) {
    //                 $dataAddress = [
    //                     'asset' => $coin->asset,
    //                     'accountId' => $accountId,
    //                     'address' => $generateAddress['address'],
    //                     'hasMemo' => $coin->hasMemo,
    //                     'memo'=>'',
    //                     'availableBalance' => 0,
    //                     'priKey'=>$new_prikey,
    //                     'mnemonic'=>$new_mnemonic,
    //                     'pubKey'=>$xpub,
    //                     'hasPriKey'=>$hasPriKey,
    //                     'derivationKey'=>$generateAddress['derivationKey'],
    //                     'customId'=>$this->createUniqueRef('system_accounts','customId'),
    //                 ];
    //                 SystemAccount::create($dataAddress);
    //             }else{
    //                 Log::alert($generateAddress->json());
    //             }
    //         }else{
    //             Log::alert($account->json());
    //         }
    //     }else{
    //         Log::alert($generate->json());
    //     }
    // }
    // public function generateAdaWallet($coin)
    // {
    //     $generate = $this->wallet->generateWallet($coin->urlCode);
    //     if ($generate->ok()) {
    //         $walletResult = $generate->json();
    //         //xpub and mnemonic
    //         $xpub = $walletResult['xpub'];
    //         $mnemonic = $walletResult['mnemonic'];
    //         $new_mnemonic = Crypt::encryptString($mnemonic);
    //         $accountKey = $xpub;
    //         //generate private key
    //         $dataPrivateKey = [
    //             'index' => 1,
    //             'mnemonic' => $mnemonic
    //         ];
    //         $generatePrivateKey = $this->wallet->generatePriv($coin->urlCode, $dataPrivateKey);
    //         if ($generatePrivateKey->ok()) {
    //             $privateKeyResult = $generatePrivateKey->json();
    //             $priKey = $privateKeyResult['key'];
    //             $new_prikey = Crypt::encryptString($priKey);
    //             $hasPriKey = 1;
    //         }else {
    //             $hasPriKey = 2;
    //             $new_prikey='';
    //             Log::alert($generate->json());
    //         }
    //         //generate an account for it
    //         $dataAccount = [
    //             'currency' => $coin->asset,
    //             'xpub' => $accountKey,
    //             'accountingCurrency' => 'USD'
    //         ];
    //         $account = $this->wallet->createAccount($dataAccount);
    //         if ($account->ok()) {
    //             $accountId = $account['id'];
    //             //create a deposit address
    //             $generateAddress = $this->wallet->generateAddress($accountId);
    //             if ($generateAddress->ok()) {
    //                 $dataAddress = [
    //                     'asset' => $coin->asset,
    //                     'accountId' => $accountId,
    //                     'address' => $generateAddress['address'],
    //                     'hasMemo' => $coin->hasMemo,
    //                     'memo'=>'',
    //                     'availableBalance' => 0,
    //                     'priKey'=>$new_prikey,
    //                     'mnemonic'=>$new_mnemonic,
    //                     'pubKey'=>$xpub,
    //                     'hasPriKey'=>$hasPriKey,
    //                     'derivationKey'=>$generateAddress['derivationKey'],
    //                     'customId'=>$this->createUniqueRef('system_accounts','customId'),
    //                 ];
    //                 SystemAccount::create($dataAddress);
    //             }else{
    //                 Log::alert($generateAddress->json());
    //             }
    //         }else{
    //             Log::alert($account->json());
    //         }
    //     }else{
    //         Log::alert($generate->json());
    //     }
    // }
    // public function generateBnbWallet($coin)
    // {
    //     $generate = $this->wallet->generateWallet($coin->urlCode,2);
    //     if ($generate->ok()) {
    //         $walletResult = $generate->json();
    //         //xpub and mnemonic
    //         $xpub = $walletResult['address'];
    //         $mnemonic = $walletResult['privateKey'];
    //         $new_mnemonic = Crypt::encryptString($mnemonic);
    //         $accountKey = $xpub;
    //         //binance node does not support mnemonics
    //         $hasPriKey = 1;
    //         $new_prikey='';
    //         //generate an account for it
    //         $dataAccount = [
    //             'currency' => $coin->asset,
    //             'xpub' => $accountKey,
    //             'accountingCurrency' => 'USD'
    //         ];
    //         $account = $this->wallet->createAccount($dataAccount);
    //         if ($account->ok()) {
    //             $accountId = $account['id'];
    //             //create a deposit address
    //             $generateAddress = $this->wallet->generateAddress($accountId);
    //             if ($generateAddress->ok()) {
    //                 $dataAddress = [
    //                     'asset' => $coin->asset,
    //                     'accountId' => $accountId,
    //                     'address' => $generateAddress['address'],
    //                     'hasMemo' => $coin->hasMemo,
    //                     'memo'=>$generateAddress['memo'],
    //                     'availableBalance' => 0,
    //                     'priKey'=>$new_prikey,
    //                     'mnemonic'=>$new_mnemonic,
    //                     'pubKey'=>$xpub,
    //                     'hasPriKey'=>$hasPriKey,
    //                     'derivationKey'=>$generateAddress['derivationKey'],
    //                     'customId'=>$this->createUniqueRef('system_accounts','customId'),
    //                 ];
    //                 SystemAccount::create($dataAddress);
    //             }else{
    //                 Log::alert($generateAddress->json());
    //             }
    //         }else{
    //             Log::alert($account->json());
    //         }
    //     }else{
    //         Log::alert($generate->json());
    //     }
    // }
    // public function generateBchWallet($coin)
    // {
    //     $generate = $this->wallet->generateWallet($coin->urlCode);
    //     if ($generate->ok()) {
    //         $walletResult = $generate->json();
    //         //xpub and mnemonic
    //         $xpub = $walletResult['xpub'];
    //         $mnemonic = $walletResult['mnemonic'];
    //         $new_mnemonic = Crypt::encryptString($mnemonic);
    //         $accountKey = $xpub;
    //         //generate private key
    //         $dataPrivateKey = [
    //             'index' => 1,
    //             'mnemonic' => $mnemonic
    //         ];
    //         $generatePrivateKey = $this->wallet->generatePriv($coin->urlCode, $dataPrivateKey);
    //         if ($generatePrivateKey->ok()) {
    //             $privateKeyResult = $generatePrivateKey->json();
    //             $priKey = $privateKeyResult['key'];
    //             $new_prikey = Crypt::encryptString($priKey);
    //             $hasPriKey = 1;
    //         }else {
    //             $hasPriKey = 2;
    //             $new_prikey='';
    //             Log::alert($generate->json());
    //         }
    //         //generate an account for it
    //         $dataAccount = [
    //             'currency' => $coin->asset,
    //             'xpub' => $accountKey,
    //             'accountingCurrency' => 'USD'
    //         ];
    //         $account = $this->wallet->createAccount($dataAccount);
    //         if ($account->ok()) {
    //             $accountId = $account['id'];
    //             //create a deposit address
    //             $generateAddress = $this->wallet->generateAddress($accountId);
    //             if ($generateAddress->ok()) {
    //                 $dataAddress = [
    //                     'asset' => $coin->asset,
    //                     'accountId' => $accountId,
    //                     'address' => str_replace('bitcoincash:','',$generateAddress['address']),
    //                     'hasMemo' => $coin->hasMemo,
    //                     'memo'=>'',
    //                     'availableBalance' => 0,
    //                     'priKey'=>$new_prikey,
    //                     'mnemonic'=>$new_mnemonic,
    //                     'pubKey'=>$xpub,
    //                     'hasPriKey'=>$hasPriKey,
    //                     'derivationKey'=>$generateAddress['derivationKey'],
    //                     'customId'=>$this->createUniqueRef('system_accounts','customId'),
    //                 ];
    //                 SystemAccount::create($dataAddress);
    //             }else{
    //                 Log::alert($generateAddress->json());
    //             }
    //         }else{
    //             Log::alert($account->json());
    //         }
    //     }else{
    //         Log::alert($generate->json());
    //     }
    // }
}

<?php
namespace App\Custom;


use App\Models\Coin;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Log;

class GenerateWallet{
    use GenerateUnique;

    public function __construct()
    {
        $this->wallet = new Wallet();
    }

    public function createWallet($asset)
    {
        $coin = Coin::where('status',1)->where('asset',$asset)->first();
        if (empty($coin)){
            return [
                'success'=>false,
                'message'=>'Invalid Asset'
            ];
        }
        if ($coin->mainNetwork ==1) {
            //let us generate the wallets. We will split them into functions for ease
            switch (strtoupper($asset)) {
                case 'BTC':
                    return $this->generateBtcWallet($coin);
                    break;
                case 'BCH':
                    return $this->generateBchWallet($coin);
                    break;
                case 'ETH':
                    return $this->generateEthWallet($coin);
                    break;
                case 'LTC':
                    return $this->generateLtcWallet($coin);
                    break;
                case 'ADA':
                    return $this->generateAdaWallet($coin);
                    break;
                case 'MATIC':
                    return $this->generateMaticWallet($coin);
                    break;
                case 'TRON':
                    return $this->generateTronWallet($coin);
                    break;
                case 'BSC':
                    return $this->generateBscWallet($coin);
                    break;
                case 'DOGE':
                    return $this->generateDogeWallet($coin);
                    break;
                case 'SOL':
                    return $this->generateSolWallet($coin);
                    break;
                case 'CELO':
                    return $this->generateCeloWallet($coin);
                    break;
            }
        }else{
            switch (strtoupper($coin)) {
                case 'USDT_TRON':
                    return $this->generateUsdtWallet($coin);
                    break;
                case 'BUSD_BSC':
                    return $this->generateBusdWallet($coin);
                    break;
            }
        }
    }
    //Generate BTC wallet
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
                    return [
                        'success'=>true,
                        'accountId' => $accountId,
                        'address'=>$generateAddress['address'],
                        'priKey'=>$new_prikey,
                        'mnemonic'=>$new_mnemonic,
                        'pubKey'=>$xpub,
                        'hasPriKey'=>$hasPriKey,
                        'derivationKey'=>$generateAddress['derivationKey'],
                        'customId'=>$this->createUniqueRef('payment_link_payments','customId'),
                    ];
                }else{
                    Log::alert($generateAddress->json());
                    return [
                        'success'=>false,
                        'message'=>'unable to generate address.'
                    ];
                }
            }else{
                Log::alert($account->json());
                return [
                    'success'=>false,
                    'message'=>'unable to generate account.'
                ];
            }
        }else{
            Log::alert($generate->json());
            return [
                'success'=>false,
                'message'=>'unable to generate wallet.'
            ];
        }
    }
    //Generate BCH wallet
    public function generateBchWallet($coin)
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
                    return [
                        'success'=>true,
                        'accountId' => $accountId,
                        'address'=>$generateAddress['address'],
                        'priKey'=>$new_prikey,
                        'mnemonic'=>$new_mnemonic,
                        'pubKey'=>$xpub,
                        'hasPriKey'=>$hasPriKey,
                        'derivationKey'=>$generateAddress['derivationKey'],
                        'customId'=>$this->createUniqueRef('payment_link_payments','customId'),
                    ];
                }else{
                    Log::alert($generateAddress->json());
                    return [
                        'success'=>false,
                        'message'=>'unable to generate address.'
                    ];
                }
            }else{
                Log::alert($account->json());
                return [
                    'success'=>false,
                    'message'=>'unable to generate account.'
                ];
            }
        }else{
            Log::alert($generate->json());
            return [
                'success'=>false,
                'message'=>'unable to generate wallet.'
            ];
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
                    return [
                        'success'=>true,
                        'accountId' => $accountId,
                        'address'=>$generateAddress['address'],
                        'priKey'=>$new_prikey,
                        'mnemonic'=>$new_mnemonic,
                        'pubKey'=>$xpub,
                        'hasPriKey'=>$hasPriKey,
                        'derivationKey'=>$generateAddress['derivationKey'],
                        'customId'=>$this->createUniqueRef('payment_link_payments','customId'),
                    ];
                }else{
                    Log::alert($generateAddress->json());
                    return [
                        'success'=>false,
                        'message'=>'unable to generate address.'
                    ];
                }
            }else{
                Log::alert($account->json());
                return [
                    'success'=>false,
                    'message'=>'unable to generate account.'
                ];
            }
        }else{
            Log::alert($generate->json());
            return [
                'success'=>false,
                'message'=>'unable to generate wallet.'
            ];
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
                    return [
                        'success'=>true,
                        'accountId' => $accountId,
                        'address'=>$generateAddress['address'],
                        'priKey'=>$new_prikey,
                        'mnemonic'=>$new_mnemonic,
                        'pubKey'=>$xpub,
                        'hasPriKey'=>$hasPriKey,
                        'derivationKey'=>$generateAddress['derivationKey'],
                        'customId'=>$this->createUniqueRef('payment_link_payments','customId'),
                    ];
                }else{
                    Log::alert($generateAddress->json());
                    return [
                        'success'=>false,
                        'message'=>'unable to generate address.'
                    ];
                }
            }else{
                Log::alert($account->json());
                return [
                    'success'=>false,
                    'message'=>'unable to generate account.'
                ];
            }
        }else{
            Log::alert($generate->json());
            return [
                'success'=>false,
                'message'=>'unable to generate wallet.'
            ];
        }
    }
    public function generateMaticWallet($coin)
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
                    return [
                        'success'=>true,
                        'accountId' => $accountId,
                        'address'=>$generateAddress['address'],
                        'priKey'=>$new_prikey,
                        'mnemonic'=>$new_mnemonic,
                        'pubKey'=>$xpub,
                        'hasPriKey'=>$hasPriKey,
                        'derivationKey'=>$generateAddress['derivationKey'],
                        'customId'=>$this->createUniqueRef('payment_link_payments','customId'),
                    ];
                }else{
                    Log::alert($generateAddress->json());
                    return [
                        'success'=>false,
                        'message'=>'unable to generate address.'
                    ];
                }
            }else{
                Log::alert($account->json());
                return [
                    'success'=>false,
                    'message'=>'unable to generate account.'
                ];
            }
        }else{
            Log::alert($generate->json());
            return [
                'success'=>false,
                'message'=>'unable to generate wallet.'
            ];
        }
    }
    public function generateTronWallet($coin)
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
                    return [
                        'success'=>true,
                        'accountId' => $accountId,
                        'address'=>$generateAddress['address'],
                        'priKey'=>$new_prikey,
                        'mnemonic'=>$new_mnemonic,
                        'pubKey'=>$xpub,
                        'hasPriKey'=>$hasPriKey,
                        'derivationKey'=>$generateAddress['derivationKey'],
                        'customId'=>$this->createUniqueRef('payment_link_payments','customId'),
                    ];
                }else{
                    Log::alert($generateAddress->json());
                    return [
                        'success'=>false,
                        'message'=>'unable to generate address.'
                    ];
                }
            }else{
                Log::alert($account->json());
                return [
                    'success'=>false,
                    'message'=>'unable to generate account.'
                ];
            }
        }else{
            Log::alert($generate->json());
            return [
                'success'=>false,
                'message'=>'unable to generate wallet.'
            ];
        }
    }
    public function generateAdaWallet($coin)
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
                Log::alert($generatePrivateKey->json());
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
                    return [
                        'success'=>true,
                        'accountId' => $accountId,
                        'address'=>$generateAddress['address'],
                        'priKey'=>$new_prikey,
                        'mnemonic'=>$new_mnemonic,
                        'pubKey'=>$xpub,
                        'hasPriKey'=>$hasPriKey,
                        'derivationKey'=>$generateAddress['derivationKey'],
                        'customId'=>$this->createUniqueRef('payment_link_payments','customId'),
                    ];
                }else{
                    Log::alert($generateAddress->json());
                    return [
                        'success'=>false,
                        'message'=>'unable to generate address.'
                    ];
                }
            }else{
                Log::alert($account->json());
                return [
                    'success'=>false,
                    'message'=>'unable to generate account.'
                ];
            }
        }else{
            Log::alert($generate->json());
            return [
                'success'=>false,
                'message'=>'unable to generate wallet.'
            ];
        }
    }
    public function generateBscWallet($coin)
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
                Log::alert($generatePrivateKey->json());
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
                    return [
                        'success'=>true,
                        'accountId' => $accountId,
                        'address'=>$generateAddress['address'],
                        'priKey'=>$new_prikey,
                        'mnemonic'=>$new_mnemonic,
                        'pubKey'=>$xpub,
                        'hasPriKey'=>$hasPriKey,
                        'derivationKey'=>$generateAddress['derivationKey'],
                        'customId'=>$this->createUniqueRef('payment_link_payments','customId'),
                    ];
                }else{
                    Log::alert($generateAddress->json());
                    return [
                        'success'=>false,
                        'message'=>'unable to generate address.'
                    ];
                }
            }else{
                Log::alert($account->json());
                return [
                    'success'=>false,
                    'message'=>'unable to generate account.'
                ];
            }
        }else{
            Log::alert($generate->json());
            return [
                'success'=>false,
                'message'=>'unable to generate wallet.'
            ];
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
                Log::alert($generatePrivateKey->json());
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
                    return [
                        'success'=>true,
                        'accountId' => $accountId,
                        'address'=>$generateAddress['address'],
                        'priKey'=>$new_prikey,
                        'mnemonic'=>$new_mnemonic,
                        'pubKey'=>$xpub,
                        'hasPriKey'=>$hasPriKey,
                        'derivationKey'=>$generateAddress['derivationKey'],
                        'customId'=>$this->createUniqueRef('payment_link_payments','customId'),
                    ];
                }else{
                    Log::alert($generateAddress->json());
                    return [
                        'success'=>false,
                        'message'=>'unable to generate address.'
                    ];
                }
            }else{
                Log::alert($account->json());
                return [
                    'success'=>false,
                    'message'=>'unable to generate account.'
                ];
            }
        }else{
            Log::alert($generate->json());
            return [
                'success'=>false,
                'message'=>'unable to generate wallet.'
            ];
        }
    }
    public function generateSolWallet($coin)
    {
        $generate = $this->wallet->generateWallet($coin->urlCode);
        if ($generate->ok()) {
            $walletResult = $generate->json();
            //address and privatekey
            $address = $walletResult['address'];
            $privKey = $walletResult['privateKey'];
            $new_priKey = Crypt::encryptString($privKey);
            $accountKey = $address;

            $hasPriKey = 1;
            //generate an account for it
            $dataAccount = [
                'currency' => $coin->asset,
                'accountingCurrency' => 'USD'
            ];
            $account = $this->wallet->createAccount($dataAccount);
            if ($account->ok()) {
                $accountId = $account['id'];
                //assign address to the account ID
                $assignAddress = $this->wallet->assignAddressToAccount($accountId,$accountKey);
                if ($assignAddress->ok()) {
                    return [
                        'success'=>true,
                        'accountId' => $accountId,
                        'address'=>$assignAddress['address'],
                        'priKey'=>$new_priKey,
                        'mnemonic'=>$new_priKey,
                        'pubKey'=>'',
                        'hasPriKey'=>$hasPriKey,
                        'derivationKey'=>0,
                        'customId'=>$this->createUniqueRef('payment_link_payments','customId'),
                    ];
                }else{
                    Log::alert($assignAddress->json());
                    return [
                        'success'=>false,
                        'message'=>'unable to assign address.'
                    ];
                }
            }else{
                Log::alert($account->json());
                return [
                    'success'=>false,
                    'message'=>'unable to generate account.'
                ];
            }
        }else{
            Log::alert($generate->json());
            return [
                'success'=>false,
                'message'=>'unable to generate wallet.'
            ];
        }
    }
    public function generateUsdtWallet($coin)
    {
        $coins = Coin::where('asset','TRON')->first();
        $generate = $this->wallet->generateWallet($coins->urlCode);
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
                    return [
                        'success'=>true,
                        'accountId' => $accountId,
                        'address'=>$generateAddress['address'],
                        'priKey'=>'',
                        'mnemonic'=>$new_mnemonic,
                        'pubKey'=>$xpub,
                        'hasPriKey'=>2,
                        'derivationKey'=>$generateAddress['derivationKey'],
                        'customId'=>$this->createUniqueRef('payment_link_payments','customId'),
                    ];
                }else{
                    Log::alert($generateAddress->json());
                    return [
                        'success'=>false,
                        'message'=>'unable to generate address.'
                    ];
                }
            }else{
                Log::alert($account->json());
                return [
                    'success'=>false,
                    'message'=>'unable to generate account.'
                ];
            }
        }else{
            Log::alert($generate->json());
            return [
                'success'=>false,
                'message'=>'unable to generate wallet.'
            ];
        }
    }
    public function generateBusdWallet($coin)
    {
        $coins = Coin::where('asset','BSC')->first();
        $generate = $this->wallet->generateWallet($coins->urlCode);
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
                Log::alert($generatePrivateKey->json());
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
                    return [
                        'success'=>true,
                        'accountId' => $accountId,
                        'address'=>$generateAddress['address'],
                        'priKey'=>'',
                        'mnemonic'=>$new_mnemonic,
                        'pubKey'=>$xpub,
                        'hasPriKey'=>2,
                        'derivationKey'=>$generateAddress['derivationKey'],
                        'customId'=>$this->createUniqueRef('payment_link_payments','customId'),
                    ];
                }else{
                    Log::alert($generateAddress->json());
                    return [
                        'success'=>false,
                        'message'=>'unable to generate address.'
                    ];
                }
            }else{
                Log::alert($account->json());
                return [
                    'success'=>false,
                    'message'=>'unable to generate account.'
                ];
            }
        }else{
            Log::alert($generate->json());
            return [
                'success'=>false,
                'message'=>'unable to generate wallet.'
            ];
        }
    }
    //Generate BTC wallet
    public function generateCeloWallet($coin)
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
                'index' => 0,
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
                    return [
                        'success'=>true,
                        'accountId' => $accountId,
                        'address'=>$generateAddress['address'],
                        'priKey'=>$new_prikey,
                        'mnemonic'=>$new_mnemonic,
                        'pubKey'=>$xpub,
                        'hasPriKey'=>$hasPriKey,
                        'derivationKey'=>$generateAddress['derivationKey'],
                        'customId'=>$this->createUniqueRef('payment_link_payments','customId'),
                    ];
                }else{
                    Log::alert($generateAddress->json());
                    return [
                        'success'=>false,
                        'message'=>'unable to generate address.'
                    ];
                }
            }else{
                Log::alert($account->json());
                return [
                    'success'=>false,
                    'message'=>'unable to generate account.'
                ];
            }
        }else{
            Log::alert($generate->json());
            return [
                'success'=>false,
                'message'=>'unable to generate wallet.'
            ];
        }
    }
}

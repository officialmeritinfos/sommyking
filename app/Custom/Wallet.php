<?php
namespace App\Custom;


use Illuminate\Support\Facades\Http;

class Wallet{
    public $tetum;
    public $url;
    /**
     * @param mixed $tetum
     */
    public function __construct()
    {
        $tatumPack = config('constant.tatum.is_live');
        switch ($tatumPack){
            case 1:
                $tetum = config('constant.tatum.livenet_api');
                break;
            default:
                $tetum = config('constant.tatum.testnet_api');
                break;
        }
        $this->tetum = $tetum;
        $this->url= config('constant.tatum.live_url');
    }
    public function generateWallet($url,$type=1)
    {
        $accountType= ($type==1)? 'wallet':'account';
        $response = Http::withHeaders([
            "x-api-key" =>$this->tetum
        ])->get($this->url.'v3/'.strtolower($url).'/'.$accountType);
        return $response;
    }
    public function generatePriv($url,$data)
    {
        $response = Http::withHeaders([
            "x-api-key" =>$this->tetum
        ])->post($this->url.'v3/'.strtolower($url).'/wallet/priv',$data);
        return $response;
    }
    public function createAccount($data){
        $response = Http::withHeaders([
            "x-api-key" =>$this->tetum
        ])->post ($this->url.'v3/ledger/account',$data);
        return $response;
    }
    public function assignAddressToAccount($account,$address)
    {
        $response = Http::withHeaders([
            "x-api-key" =>$this->tetum
        ])->post ($this->url.'v3/offchain/account/'.$account.'/address/'.$address);
        return $response;
    }
    public function generateAddress($account){
        $response = Http::withHeaders([
            "x-api-key" =>$this->tetum
        ])->post ($this->url.'v3/offchain/account/'.$account.'/address');
        return $response;
    }
    public function getCryptoExchange($crypto,$fiat){
        $response = Http::withHeaders([
            "x-api-key" =>$this->tetum
        ])->get($this->url.'v3/tatum/rate/'.$crypto.'?basePair='.strtoupper($fiat));
        $response= $response['value'];
        return $response;
    }
    public function getAccount($account){
        $response = Http::withHeaders([
            "x-api-key" =>$this->tetum
        ])->get($this->url.'v3/ledger/account/'.$account);
        return $response;
    }
    public function getAccountAddresses($account){
        $response = Http::withHeaders([
            "x-api-key" =>$this->tetum
        ])->get($this->url.'v3/offchain/account/'.$account.'/address');
        return $response;
    }
    public function getBalance($account){
        $response = Http::withHeaders([
            "x-api-key" =>$this->tetum
        ])->get($this->url.'v3/ledger/account/'.$account.'/balance');
        return $response;
    }
    public function createSubscription($data){
        $response = Http::withHeaders([
            "x-api-key" =>$this->tetum
        ])->post ($this->url.'v3/subscription',$data);
        return $response;
    }
    public function createTransfer($url,$data){
        $response = Http::withHeaders([
            "x-api-key" =>$this->tetum
        ])->post($this->url.'v3/offchain/'.strtolower($url).'/transfer',$data);
        return $response;
    }
    public function createWithdrawal($data){
        $response = Http::withHeaders([
            "x-api-key" =>$this->tetum
        ])->post($this->url.'v3/offchain/withdrawal',$data);
        return $response;
    }
    public function estimateFee($data){
        $response = Http::withHeaders([
            "x-api-key" =>$this->tetum
        ])->post($this->url.'v3/offchain/blockchain/estimate',$data);
        return $response;
    }
    public function sendNetworkTransaction($url,$network,$data){
        $response = Http::withHeaders([
            "x-api-key" =>$this->tetum
        ])->post($this->url.'v3/'.strtolower($url).'/'.strtolower($network).'/transaction',$data);
        /*$response = Http::withHeaders([
            "x-api-key" =>$this->tetum
        ])->post($this->url.'v3/tron/transaction',$data);*/
        return $response;
    }
    public function testEndpoint($data){
        $response = Http::withHeaders([
            "x-api-key" =>$this->tetum
        ])->post(url('transactions/incoming/xkc3j01630966553/user/1'),$data);
        return $response;
    }
    public function getCryptoExchangeCrypto($coin,$crypto){
        $response = Http::withHeaders([
            "x-api-key" =>$this->tetum
        ])->get($this->url.'v3/tatum/rate/'.$coin.'?basePair='.strtoupper($crypto));
        return $response;
    }
    public function completeWithdrawal($withdrawalId, $txId){
        $response = Http::withHeaders([
            "x-api-key" =>$this->tetum
        ])->put($this->url.'v3/offchain/withdrawal/'.$withdrawalId.'/'.$txId);
        return $response;
    }
    public function cancelWithdrawal($withdrawalId){
        $response = Http::withHeaders([
            "x-api-key" =>$this->tetum
        ])->delete($this->url.'v3/offchain/withdrawal/'.$withdrawalId);
        return $response;
    }
    public function getTransactionReference($ref){
        $response = Http::withHeaders([
            "x-api-key" =>$this->tetum
        ])->get($this->url.'v3/ledger/transaction/reference/'.$ref);
        return $response;
    }
    public function getAccountTransactions($data){
        $response = Http::withHeaders([
            "x-api-key" =>$this->tetum
        ])->post($this->url.'v3/ledger/transaction/account?pageSize=10&offset=0&count=false',$data);
        return $response;
    }
    public function getEthGas($data){
        $response = Http::withHeaders([
            "x-api-key" =>$this->tetum,
        ])->post($this->url.'v3/ethereum/gas',$data);
        return $response;
    }
    public function getBscGas($data){
        $response = Http::withHeaders([
            "x-api-key" =>$this->tetum,
        ])->post($this->url.'v3/bsc/gas',$data);
        return $response;
    }
    public function getEthBalance($address){
        $response = Http::withHeaders([
            "x-api-key" =>$this->tetum
        ])->get($this->url.'v3/ethereum/account/balance/'.$address);
        return $response;
    }
    public function getBscBalance($address){
        $response = Http::withHeaders([
            "x-api-key" =>$this->tetum
        ])->get($this->url.'v3/bsc/account/balance/'.$address);
        return $response;
    }
    public function getBtcBalance($address){
        $response = Http::withHeaders([
            "x-api-key" =>$this->tetum
        ])->get($this->url.'v3/bitcoin/address/balance/'.$address);
        return $response;
    }
    public function getLtcBalance($address){
        $response = Http::withHeaders([
            "x-api-key" =>$this->tetum
        ])->get($this->url.'v3/litecoin/address/balance/'.$address);
        return $response;
    }
}

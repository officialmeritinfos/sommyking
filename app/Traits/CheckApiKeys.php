<?php
namespace App\Traits;

use App\Models\BusinessApiKey;
use Illuminate\Support\Facades\Crypt;

trait CheckApiKeys{
    public function encryptKeys($key): string
    {
        $key = Crypt::encryptString($key);
        return $key;
    }
    public function decryptKeys($key): string
    {
        $key = Crypt::decryptString($key);
        return $key;
    }

    public function getKeyDetails($key): array
    {
        $keyExists = BusinessApiKey::where('publicKey',$key)->first();
        if (empty($keyExists)){
            return [
                'success' =>false,
                'message'=> 'Invalid Api key sent'
            ];
        }
        return [
            'success'=>true,
            'data'=>[
                'user'=>$keyExists->user,
                'business'=>$keyExists->business,
                'allowWithdrawal'=>$keyExists->allowWithdrawal,
                'ipn_url'=>$keyExists->ipn_url
            ]
        ];
    }
    public function getPayoutKey($key,$pubkey): array
    {
        $keyExists = BusinessApiKey::where('publicKey',$pubkey)->first();
        if (empty($keyExists)){
            return [
                'success' =>false,
                'message'=> 'Invalid Api key sent'
            ];
        }
        //check if the secret key matches
        $secKey = $this->decryptKeys($keyExists->secretKey);
        if ($secKey !=$key){
            return [
                'success' =>false,
                'message'=> 'Invalid Secret key sent'
            ];
        }
        return [
            'success'=>true,
            'data'=>[
                'user'=>$keyExists->user,
                'business'=>$keyExists->business,
                'allowWithdrawal'=>$keyExists->allowWithdrawal,
                'ipn_url'=>$keyExists->ipn_url
            ]
        ];
    }
}

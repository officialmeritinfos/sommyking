<?php
namespace App\Custom;

use App\Models\BusinessApiKey;
use App\Models\Business;
use App\Models\PaymentLinkPayment;
use App\Models\User;
use Illuminate\Support\Facades\Crypt;

/**
 *  custom checks for data in the database which will
 *  be globally used instead of using yhem in the controller
 */
class CustomChecks{
    public function userId($id): string
    {
        $user = User::where('id',$id)->first();
        $name = $user->name;
        return $name.' ('.$user->email.')';
    }
    public function businessId($id)
    {
        $business = Business::where('id',$id)->first();
        $name = $business->name;
        return $name;
    }
    public function numberOfPaymentLinkTransactions($reference)
    {
        $transactions = PaymentLinkPayment::where('reference',$reference)->get();
        $counts = $transactions->count();
        return $counts;
    }
    public function getSecretKey($id): string
    {
        $keys = BusinessApiKey::where('id',$id)->first();
        $key = Crypt::decryptString($keys->secretKey);
        return $key;
    }
    public function decryptKey($keys): string
    {
        $key = Crypt::decryptString($keys);
        return $key;
    }
}

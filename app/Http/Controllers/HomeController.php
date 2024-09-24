<?php

namespace App\Http\Controllers;

use App\Models\Deposit;
use App\Models\GeneralSetting;
use App\Models\Service;
use App\Models\Staking;
use App\Models\StakingPackage;
use App\Models\Withdrawal;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $web = GeneralSetting::where('id',1)->first();

        $dataView = [
            'siteName'  => $web->name,
            'web'       => $web,
            'pageName'  => 'Home Page',
            'packages'  => StakingPackage::where('status',1)->where('isBonus','!=',1)->get(),
            'deposits'  => Staking::where('status',1)->orWhere('status',4)->limit(10)->get(),
            'withdrawals'=>Withdrawal::where('status',1)->limit(10)->get(),
            'services' =>Service::where('status',1)->get()
        ];

        return view('home.home',$dataView);
    }

    public function about()
    {
        $web = GeneralSetting::where('id',1)->first();

        $dataView = [
            'siteName'  => $web->name,
            'web'       => $web,
            'pageName'  => 'About Us',
            'packages'  => StakingPackage::where('status',1)->where('isBonus','!=',1)->get(),
        ];

        return view('home.about',$dataView);
    }
    public function plans()
    {
        $web = GeneralSetting::where('id',1)->first();

        $dataView = [
            'siteName'  => $web->name,
            'web'       => $web,
            'pageName'  => 'Packages',
            'packages'  => StakingPackage::where('status',1)->where('isBonus','!=',1)->get(),
        ];

        return view('home.plans',$dataView);
    }
    public function terms()
    {
        $web = GeneralSetting::where('id',1)->first();

        $dataView = [
            'siteName'  => $web->name,
            'web'       => $web,
            'pageName'  => 'Terms and Conditions',
            'packages'  => StakingPackage::where('status',1)->where('isBonus','!=',1)->get(),
        ];

        return view('home.terms',$dataView);
    }
    public function privacy()
    {
        $web = GeneralSetting::where('id',1)->first();

        $dataView = [
            'siteName'  => $web->name,
            'web'       => $web,
            'pageName'  => 'Privacy Policy',
            'packages'  => StakingPackage::where('status',1)->where('isBonus','!=',1)->get(),
        ];

        return view('home.privacy',$dataView);
    }
    public function faqs()
    {
        $web = GeneralSetting::where('id',1)->first();

        $dataView = [
            'siteName'  => $web->name,
            'web'       => $web,
            'pageName'  => 'Frequently Asked Questions',
            'packages'  => StakingPackage::where('status',1)->where('isBonus','!=',1)->get(),
        ];

        return view('home.faq',$dataView);
    }
    public function contact()
    {
        $web = GeneralSetting::where('id',1)->first();

        $dataView = [
            'siteName'  => $web->name,
            'web'       => $web,
            'pageName'  => 'Contact us',
            'packages'  => StakingPackage::where('status',1)->where('isBonus','!=',1)->get(),
        ];

        return view('home.contact',$dataView);
    }
    public function service()
    {
        $web = GeneralSetting::where('id',1)->first();

        $dataView = [
            'siteName'  => $web->name,
            'web'       => $web,
            'pageName'  => 'Services',
            'packages'  => StakingPackage::where('status',1)->where('isBonus','!=',1)->get(),
            'services' =>Service::where('status',1)->get()
        ];

        return view('home.service',$dataView);
    }
    public function serviceDetail($id)
    {
        $web = GeneralSetting::where('id',1)->first();

        $dataView = [
            'siteName'  => $web->name,
            'web'       => $web,
            'pageName'  => 'Service Detail',
            'packages'  => StakingPackage::where('status',1)->where('isBonus','!=',1)->get(),
            'service' =>Service::where('id',$id)->first()
        ];

        return view('home.service_detail',$dataView);
    }
    public function legal()
    {
        $web = GeneralSetting::where('id',1)->first();

        $dataView = [
            'siteName'  => $web->name,
            'web'       => $web,
            'pageName'  => 'Legal Information',
            'packages'  => StakingPackage::where('status',1)->where('isBonus','!=',1)->get(),
        ];

        return view('home.legal',$dataView);
    }

    public function markets()
    {
        $web = GeneralSetting::where('id',1)->first();

        $dataView = [
            'siteName'  => $web->name,
            'web'       => $web,
            'pageName'  => 'Market Information',
            'packages'  => StakingPackage::where('status',1)->where('isBonus','!=',1)->get(),
        ];

        return view('home.markets',$dataView);
    }
}

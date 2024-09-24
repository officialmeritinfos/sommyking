<?php

use App\Http\Controllers\Auth\Login;
use App\Http\Controllers\User\Dashboard;
use App\Http\Controllers\User\Deposits;
use App\Http\Controllers\User\Investments;
use App\Http\Controllers\User\Referrals;
use App\Http\Controllers\User\Settings;
use App\Http\Controllers\User\Tickets;
use App\Http\Controllers\User\Withdrawals;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| User Routes
|--------------------------------------------------------------------------
|
| Here is where you can register user routes for your web.
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group.
| To access this endpoint, the prefix 'account' has to be added.
| You can change this in the RouteServiceProvider file
|
*/


Route::get('dashboard',[Dashboard::class,'landingPage'])->name('user.dashboard');
Route::get('accounts',[Dashboard::class,'accounts'])->name('user.account');
Route::post('do-swap',[Dashboard::class,'doSwap'])->name('swap');



/*================ DEPOSIT ROUTE ====================*/
Route::get('deposits',[Deposits::class,'landingPage'])->name('deposit.index');
Route::get('new_deposit',[Deposits::class,'newDeposit'])->name('new_deposit');
Route::post('process_deposit',[Deposits::class,'processDeposit'])->name('deposit.new');
Route::get('deposits/{id}/details',[Deposits::class,'depositDetails'])->name('deposit_detail');
Route::get('deposits/{id}/cancel',[Deposits::class,'cancel'])->name('deposit.cancel');
/*================ INVESTMENT ROUTE ====================*/
Route::get('investments',[Investments::class,'landingPage'])->name('investment.index');
Route::get('new_investment',[Investments::class,'newInvestment'])->name('new_investment');
Route::get('preview_investment/{id}',[Investments::class,'newInvestmentId'])->name('new_investment_preview');
Route::post('process_investment',[Investments::class,'processInvestment'])->name('investment.new');
Route::get('investments/{id}/details',[Investments::class,'investmentDetails'])->name('invest_detail');
Route::get('investments/{id}/cancel',[Investments::class,'cancel'])->name('invest.cancel');
/*================ WITHDRAWAL ROUTE ====================*/
Route::get('withdrawals',[Withdrawals::class,'landingPage'])->name('withdrawal.index');
Route::get('new_withdrawals',[Withdrawals::class,'newWithdrawal'])->name('new_withdrawal');
Route::post('process_withdrawal',[Withdrawals::class,'processWithdrawal'])->name('withdraw.new');
Route::get('withdrawals/{id}/cancel',[Withdrawals::class,'cancel'])->name('withdraw.cancel');
/*================ SETTINGS ROUTE ====================*/
Route::get('settings',[Settings::class,'landingPage'])->name('setting.index');
Route::post('update-settings',[Settings::class,'processSetting'])->name('settings.update');
Route::post('update-password',[Settings::class,'processPassword'])->name('password.update');
Route::get('kyc',[Settings::class,'kyc'])->name('setting.kyc');
/*================ REFERRAL ROUTE ====================*/
Route::get('referral',[Referrals::class,'landingPage'])->name('referral.index');
/*================ SUPPORT ===========================*/
Route::get('tickets',[Tickets::class,'landingPage'])->name('support.index');
Route::post('tickets/add',[Tickets::class,'addTicket'])->name('support.new');
Route::get('ticket/{id}/details',[Tickets::class,'ticketDetail'])->name('ticket_detail');
Route::post('ticket/reply',[Tickets::class,'addReply'])->name('support.reply');

Route::get('logout',[Login::class,'logout'])->name('logout');

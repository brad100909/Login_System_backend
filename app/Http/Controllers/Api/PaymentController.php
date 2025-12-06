<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use ECPay_AllInOne;
use ECPay_PaymentMethod;

class PaymentController extends Controller
{
    public function checkout(Request $request)
{
    $orderId = 'TEST' . time();

    $tradeData = [
        'MerchantID' => '2000132',
        'MerchantTradeNo' => $orderId,
        'MerchantTradeDate' => date('Y/m/d H:i:s'),
        'PaymentType' => 'aio',
        'TotalAmount' => 100,
        'TradeDesc' => 'Test Payment',
        'ItemName' => 'Demo Product',
        'ReturnURL' => route('payment.callback'), // Laravel route
        'ChoosePayment' => 'ALL',
        'ClientBackURL' => 'http://localhost:5173/return'
    ];

    $form = "<form id='ecpay-form' method='post' action='https://payment-stage.ecpay.com.tw/Cashier/AioCheckOut/V5'>";
    foreach ($tradeData as $k => $v) {
        $form .= "<input type='hidden' name='{$k}' value='{$v}'>";
    }
    $form .= "</form><script>document.getElementById('ecpay-form').submit();</script>";

    return response($form, 200)->header('Content-Type', 'text/html');
}

    public function callback(Request $request)
    {
        \Log::info('綠界回傳: ', $request->all());
        return '1|OK';
    }
}

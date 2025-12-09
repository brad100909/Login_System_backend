<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\ECPayHelper;

class PaymentController extends Controller
{
    public function checkout(Request $request)
    {
        $MerchantID = '2000132';
        $HashKey = '5294y06JbISpM5x9';
        $HashIV = 'v77hoKGq4kWxNNIS';

        $orderId = 'TEST' . time();

        $params = [
            'MerchantID' => $MerchantID,
            'MerchantTradeNo' => $orderId,
            'MerchantTradeDate' => date('Y/m/d H:i:s'),
            'PaymentType' => 'aio',
            'TotalAmount' => 100,
            'TradeDesc' => 'Demo Payment',
            'ItemName' => 'Demo Product',
            'ReturnURL' => route('payment.callback'),
            'ChoosePayment' => 'ALL',
            'ClientBackURL' => 'http://localhost:5173',
        ];

        // ⭐ 自己產生 CheckMacValue（V5 正確做法）
        $params['CheckMacValue'] = ECPayHelper::generateCheckMacValue($params, $HashKey, $HashIV);

        // 自動提交 form
        $form = "<form id='ecpay-form' method='post' action='https://payment-stage.ecpay.com.tw/Cashier/AioCheckOut/V5'>";
        foreach ($params as $k => $v) {
            $form .= "<input type='hidden' name='{$k}' value='{$v}'>";
        }
        $form .= "</form><script>document.getElementById('ecpay-form').submit();</script>";

        return response($form)->header('Content-Type', 'text/html');
    }

    public function callback(Request $request)
    {
        \Log::info('ECPay 回傳: ', $request->all());
        return '1|OK';
    }
}

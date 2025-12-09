<?php

namespace App\Helpers;

class ECPayHelper
{
    public static function generateCheckMacValue($params, $hashKey, $hashIV)
    {
        // 1. 參數依照鍵名排序
        ksort($params);

        // 2. URL encode
        $encodeStr = 'HashKey=' . $hashKey;
        foreach ($params as $key => $value) {
            $encodeStr .= '&' . $key . '=' . $value;
        }
        $encodeStr .= '&HashIV=' . $hashIV;

        // 3. URL encode
        $encodeStr = urlencode($encodeStr);

        // 4. 特殊字串處理
        $encodeStr = str_replace('%2D', '-', $encodeStr);
        $encodeStr = str_replace('%5F', '_', $encodeStr);
        $encodeStr = str_replace('%2E', '.', $encodeStr);
        $encodeStr = str_replace('%21', '!', $encodeStr);
        $encodeStr = str_replace('%2A', '*', $encodeStr);
        $encodeStr = str_replace('%28', '(', $encodeStr);
        $encodeStr = str_replace('%29', ')', $encodeStr);

        // 5. 轉成小寫 → SHA256
        $encodeStr = strtolower($encodeStr);

        return strtoupper(hash('sha256', $encodeStr));
    }
}

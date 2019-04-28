<?php
return [
    //应用ID,您的APPID。
    'app_id' => "2016092500595501",

    //商户私钥
    'merchant_private_key' => "MIIEpgIBAAKCAQEA9CQGuG+nCRiK1YzUzHyBDec+as0gFOQPrC/NmOvugjOyuyixera8slVnJpElyWxMXpdHdXUuYB2RBXiTsdVexOBxCqEeG+dCqgwb+13t9NlCspeVCXqOvU9a2Pd6E0mPmxUzqVuqNj6iA12jjU7JSBdhMvsNB1F48nNnij4ifdY6Gl4lLiRf1esDXHCxN6IDhiHoFJ7IYD0FEs0Svtf5nQBAmRGMG8iCyCUP5VNnYRcUu1JXvERfwJyd0+m4HjiHq+uAUXF/uldEQFbFtRYujUe1fKldA1LoCGp+M9XGeer9m6xpGXLQwqAQgeEcDsns0vm68tiR+A2vYYlCH05itwIDAQABAoIBAQCLDUXioH1Duf3BObAuM6+RiqbLT7+5BlhC2ws/0QkMkYN4A+pqGVCKRgg1ODCMc6lfqswhgzeBuPVTZ2S/weZzPd5EjpXGkMYwcisx1ULl1SSe8aUKPAq2mk8FCpc2CwzG6KF/EV11/eBrCFdR8ZDFBcPvtHusMmQvuzk6zL76af/vf86I2+7cX4NzLvhfd+IGgW0RwZWjSgKzUdkQV4PP6YGZfk5rMu+/j4bqNCx1yUH8Usfyf29JVVaBQDA4AzTc9akWqG8ThxMPcH8OM+6IYKQejY1XiGAvB+sWiTJDcZardFahusX1/ql6af0RV9csNaZMbQoBv1QHtORL65SBAoGBAPps73eIZLTq7tF5LMhkYfEsTcqbtlK9w1nOM+B9nTLECFGz20GhxGfvXIgSKCtbpcyES9q6MnT7LuaofHFd9+pF/b5JfAr1mqPqc1bYJeGEQPVnzUAKoeI3Fbc78PYiMAqnSfmBOjZ5xCj8jR+48+4eLBBWPBiJzcRpwW4D/PlBAoGBAPmTRspIfjwGG2+IRDGWvNkrp8WxC7AcBUUY9k1Sv6RD2J1ZoCgGHXXcJ91Xy1EFjB0EcKjvAhUtfgMPQwvrR0uxqxTGPSscTXoAOzBE86uPqRxGv9gNP244CltfQp+FWIuXwZSix7XQwIeWF+rWZT9p/oPCSdet0ShgfmWJ06X3AoGBAIsctLIcLIVr9Jqcy8nOKbJFwDkK4u93xus+ZwcQAKFQ0KZCWUxORsLN7wMPwwzC7ol7/H9W6+ycFGPBuM9pOe0EUH7CZ4vW/76K4OOfUvvB8ivhK92limQV4ZRWUfcI6tMgNzHJHcNhRRzXnrW+kpL2Y9f3b47aDlpLvU4WHROBAoGBANpi8EfjhWp6oZlH8Pw/fcK++5D2qlaRPl9HR4dDyGQx5iNSIN3E9BSE7/E0eLnOE9v0XazFb9oeM6zztuSAHaPztNN54F6P5o/CEgjb3SkbjYwrsIWamg2VRiLMSZ0S7vc/dOneQskrAL3kLcuVjYUe99JNuZXcCDC/tvqczzHjAoGBAN8RbCi0H8ZWJGcd/HCj3Pjx7bmVIcDsWNSFOvqlnvlPQN8T8XVsTKzz0hHZ8PYzisQxnxrMOPkpvyHKIi7+dDZf+zsn9j7Tk4I05XwOXIVBgB9ajMdHIiQrA/728SkjdGzzAw5o0+rrjGp4bWjldeVgpLK3cu9SDJ8U3dJ9s3o5",

    //异步通知地址
//    'notify_url' => "http://localhost/alipay/notify_url.php",
    'notify_url' => "http://www.laravelshop.com/zhubao/notify",

    //同步跳转
//    'return_url' => "http://localhost/alipay/return_url.php",
    'return_url' => "http://www.laravelshop.com/zhubao/return",

    //编码格式
    'charset' => "UTF-8",

    //签名方式
    'sign_type'=>"RSA2",

    //支付宝网关
    'gatewayUrl' => "https://openapi.alipaydev.com/gateway.do",

    //支付宝公钥,查看地址：https://openhome.alipay.com/platform/keyManage.htm 对应APPID下的支付宝公钥。
    'alipay_public_key' => "MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAseJwOfWDgk+2OmsRSZ19siG+VDA/KVr/anVL5MEv9CEHdGENuPEPVd36uN26wNbuOn+v/6+R6QM3SCuicHt3MLun7MYO4+myvQiK08v6pY/Twf5ktwQfxfHP9K4qS9Z1Sqq4y8pN3vU2H+B9Hb6SybRs9u/tTamFKVSNAyUojm8f6kZPxrSGg2hl7Hlv64a27MHCuo4AFu3Fejz3lWVWySNUkvLkNJDYZu9nL3/WCCZfF95FH4/6jBT/SSZd5/LOQW7/fTjtIZN2GflG9Pt0Al8AUvpHU2HjJnmWYAgibwY988d7tU3Qf26HeKOtNpSv/0NIMkVZCJg9bI9Ftrsa6QIDAQAB",
    'seller_id'=>'2088102177251776',
];
<?php
return [
    //应用ID,您的APPID。
    'app_id' => "2016092500595798",

    //商户私钥
    'merchant_private_key' => "MIIEpAIBAAKCAQEAquDeIW7onplyfyMxwF/n3ieQprvYZlZU49sWJgJfSSOgkKiZ7XVH1JMVOECMiHlb2WlYB4fWzPhOrkIcz2HsT+Ubl6ZiurscH1FfzCfZq/UPVvq9z8jN2PBPk6wF+sIczDaDxT0Rk8FT+R9JuRX9OUJSYzkRYYGY6tvwK0anr8nT8q49eSGocqEOv3MQLIbobvq4JnU6XmlJ1vHh7/QjzBtDGNvfIi6s0qlG945lAFsT7y8NUaMQ29XXi70TyeZsiDKVH1k9Ywo9LNZ7gsQkTYBM5qPvcibwRKIB/kBy1EnYW0OZ6a8HZ7sVqe//OaIw89r2NdMlpr/9orTQKq1eWQIDAQABAoIBAGXb6U2QqUVxPtkeh5efE75PY2CgdNx79dplTIyXuWkFvb69YhQ0Zv8GNg30HFF11hSBQSIsDRTdpzkk27ubKZxue8YoPo4E3zyj6zDtSEnCqMQ2b1Me5eW9ShJC5sWVVEk+7clzH7kt8vp7dhzISMwLBsVyzTOMZzUIqd+CHI8iDEq4VNLX3cHNa/FS+6NRlhHJ5BDiP/BGDpe9QvPVY7rJq/XNeZC5Dd1e6eZ7TE6BZy8+Ttl0UpL/msxMP6osgojSKoXaPmvSvxR8T0UUUKsrkQQT+Mt2t9PaCNqiH2Vc+A/qhNfA/1emrjpd49LWXvngkIML3EvbUdr+TLDKmyECgYEA3og3eS8mXsfD6aya62bRS3mzzsezx/n+EL5aTDyJlN4BnNg9ZRNQ31TcrNl1D949bUhsIJIdNx52MtQOkPzPc4bNeDGq3CXc/2BSvgA8L722XTr6ni8dxiKPb7yJMa3TT9xmp9QeEsSDYqjCEut9LVPx5Dw4O9UYLbo1CKywwp0CgYEAxJPqCYiVpYedMGfKoAGb6ozFEjdvfU5f4XG9glKtrVkWrrxHMd5ozSXaShv3ygBAcxMw3uIuPJBJpyExAgS/+GF4fO4Rv3iKFB0YLkPZAS+nkiyrrxQX3G/U3Q+/0AJhNqSDS6LMPXaoLQqCljT+K0uCuQOM13+j+VWUXvOKD+0CgYEAik5nC+5+DpJh9S3N61iv5BTz6CS+XB/IBGgKfy9w4xFIN08+eT+UF/oKXXOaCg66Zt2INoYZmlRYaibaFsrJtKentHhKFSGDRUV8p5JF1fY3DaLGeOIXwzlfpLatHi9HEm+Nbemr90Yj0oHIfTHXTwDJamzzFlzO9jyxEX8jLRECgYEAm2OFBAY4rMF3itTwweyjsBOYkF7LvZSfjBkZwZPTgAzFNljUOmJiG5BJbn2PMNlkGNLZtcW64Nr5rag6EitpCFEcKj0SQHVrSJz7CU9OkXZ3EsBG8j2C4xhvflM9v5Kx/7ypoLdOlWNfa0M8mLnJFLY63j8lLQ/TsXtprmj7AL0CgYAYmK/UXBkNNnUR9EGvTh+82j8Vi1Dy/9WVh7PCeDSPkCiN5YoMBc2p7W1+nnpTt77xk7GQZ5zJWI3uwQUw1WpcPgybR4i9n4rYELUc91i77y74sLuc4KvGOWDkOZ8py+h33zeIGut5gMgBfa3LhVhiTIJb+8hCGQ9PLFv0Bywxeg==",

    //异步通知地址
    'notify_url' => "http://www.laravel.com/index/notify",

    //同步跳转
    'return_url' => "http://www.laravel.com/index/returnpay",

    //编码格式
    'charset' => "UTF-8",

    //签名方式
    'sign_type'=>"RSA2",

    //支付宝网关
    'gatewayUrl' => "https://openapi.alipaydev.com/gateway.do",

    //支付宝公钥,查看地址：https://openhome.alipay.com/platform/keyManage.htm 对应APPID下的支付宝公钥。
    'alipay_public_key' => "MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEA97ie0KruNCZ+zmwcjn+moex1Nwt9DW6eOq/VSYTsS1GdIhqh3KQP40MsE5/hhW+B0a3yaGbEEydLrEThIortOaMm4i1O3jVzL0hqRAJ1cP6y/70dqOXFHSuKvWQzcjt1cN9WX8olGUzxmPEFqUTwI08kGdbU4A7hDhqAiCMOOMmhn84O+vN4WZ8l94Q2uimKMwmQ/3UsXkiyECMbjjZXh36d96NBH9zXN0JyEDj0IHYkfgpfkpVaeEsOn0NGvpVdlpEO5Ay/Izhg6Ch9VZ9YPnCfpVtYLrUr9L8iKECTQ0hpvuIOalPJltb7PF5DlS3EdNg+IIWi4cNk4SDhS6YmgQIDAQAB",
    'seller_id'=>'2088102177251776',
    ];
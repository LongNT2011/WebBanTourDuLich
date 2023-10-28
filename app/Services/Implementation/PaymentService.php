<?php
require __DIR__ . '/vendor/autoload.php';
class PaymentService implements IPaymentService
{
    private string $SecretKey = "sk_test_51MzQLDHpQ4WsUFgqryhEwh0SyVCD0donY4Zc1eM1ndFRpvmIQEP0wbx2UtwTC6rTls8u7fcImW9MplmoCCT9pUAT00tHCdUZho";
    private string $publicKey = "pk_test_51MzQLDHpQ4WsUFgq2NhyVIJOHg3hMNfAEUApRfXNxbvPKkrQo9Vw4bE4jyFqcp0JdLv3wG9YjfiVknhqxZdWAKqF00IpKHWrmo";    
    public function __construct() {
        \Stripe\Stripe::setApiKey($this->SecretKey);
    }
    public function CheckOut(PaymentRequest $request)
    {
        $Checkout_Session = \Stripe\CheckOut\Session::Create([
            'success_url' => $request->getApproveUrl(),
            'cancel_url' => $request->getCancelUrl(),
            'mode' => 'payment',
            'line_items' => [
                [
                    'quantity' => 1,
                    'price_data' => [
                        'currency' => 'usd',
                        'unit_amount' =>  $request->getPrice() * 100,
                        'product_data' => [
                            'name' => $request->getName()
                        ]
                    ]

                ]
            ]
        ]);
    }
}
?>
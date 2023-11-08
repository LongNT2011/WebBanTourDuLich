<?php
namespace App\Services\Implementation;
use App\Models\Dtos\PaymentRequest;
use App\Models\Dtos\PaymentResponse;

trait PaymentService 
{
    private string $SecretKey = "sk_test_51MzQLDHpQ4WsUFgqryhEwh0SyVCD0donY4Zc1eM1ndFRpvmIQEP0wbx2UtwTC6rTls8u7fcImW9MplmoCCT9pUAT00tHCdUZho";
    private string $publicKey = "pk_test_51MzQLDHpQ4WsUFgq2NhyVIJOHg3hMNfAEUApRfXNxbvPKkrQo9Vw4bE4jyFqcp0JdLv3wG9YjfiVknhqxZdWAKqF00IpKHWrmo";    
    public function __construct() {
        \Stripe\Stripe::setApiKey($this->SecretKey);
    }
    public function CheckOut(PaymentRequest $request) : PaymentResponse
    {
        $Checkout_Session = \Stripe\CheckOut\Session::Create([
            'success_url' => $request->getApproveUrl(),
            'cancel_url' => $request->getCancelUrl(),
            'mode' => 'payment',
            'line_items' => [
                [
                    'quantity' => 1,
                    'price_data' => [
                        'currency' => 'VND',
                        'unit_amount' =>  intval($request->getPrice()),
                        'product_data' => [
                            'name' => $request->getName()
                        ]
                    ]

                ]
            ]
        ]);
        $response = new PaymentResponse();
        $response->setUrl($Checkout_Session->url);
        $response->setStripeSessionId($Checkout_Session->id);
        return $response;
    }
    // http_response_code(303);
    //header("Location: " . $checkout_session->url);
    public function ValidatePayment(string $sessionId) : PaymentResponse{
        $stripe = new \Stripe\StripeClient('sk_test_51MzQLDHpQ4WsUFgqryhEwh0SyVCD0donY4Zc1eM1ndFRpvmIQEP0wbx2UtwTC6rTls8u7fcImW9MplmoCCT9pUAT00tHCdUZho');
        $session = $stripe->checkout->sessions->retrieve(
            $sessionId,
            []
          );
          $paymentResponse = new PaymentResponse();
        if ($session->PaymentStatus == "paid") {
          
            $paymentResponse->StripeSessionId = $session->Id;
            $paymentResponse->PaymentIntentId = $session->PaymentIntentId;           
        }
        return $paymentResponse;
    }
}
?>
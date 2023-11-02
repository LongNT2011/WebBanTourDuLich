<?php
interface IPaymentService
{
    public function CheckOut(PaymentRequest $request);
    public function ValidatePayment(string $sessionId) : PaymentResponse;
}
?>
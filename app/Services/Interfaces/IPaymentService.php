<?php
interface IPaymentService
{
    public function CheckOut(PaymentRequest $request);
}
?>
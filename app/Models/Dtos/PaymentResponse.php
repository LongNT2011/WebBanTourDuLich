<?php
class PaymentResponse {
    public $StripeSessionId;
    public $PaymentIntentId;

    /**
     * Get the value of StripeSessionId
     */ 
    public function getStripeSessionId()
    {
        return $this->StripeSessionId;
    }

    /**
     * Set the value of StripeSessionId
     *
     * @return  self
     */ 
    public function setStripeSessionId($StripeSessionId)
    {
        $this->StripeSessionId = $StripeSessionId;

        return $this;
    }

    /**
     * Get the value of PaymentIntentId
     */ 
    public function getPaymentIntentId()
    {
        return $this->PaymentIntentId;
    }

    /**
     * Set the value of PaymentIntentId
     *
     * @return  self
     */ 
    public function setPaymentIntentId($PaymentIntentId)
    {
        $this->PaymentIntentId = $PaymentIntentId;

        return $this;
    }
}

?>
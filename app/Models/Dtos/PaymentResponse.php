<?php
namespace App\Models\Dtos;
class PaymentResponse {
    public $StripeSessionId;
    public $PaymentIntentId;
    public $Url;

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

    

    /**
     * Get the value of Url
     */ 
    public function getUrl()
    {
        return $this->Url;
    }

    /**
     * Set the value of Url
     *
     * @return  self
     */ 
    public function setUrl($Url)
    {
        $this->Url = $Url;

        return $this;
    }
}

?>
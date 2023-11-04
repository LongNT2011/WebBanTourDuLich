<?php
namespace App\Models\Dtos;
class PaymentRequest {
    // @var string
    public string $ApproveUrl;
    public string $CancelUrl;
    public string $Name;
    public float $Price;

    /**
     * Get the value of ApproveUrl
     */ 
    public function getApproveUrl()
    {
        return $this->ApproveUrl;
    }

    /**
     * Set the value of ApproveUrl
     *
     * @return  self
     */ 
    public function setApproveUrl($ApproveUrl)
    {
        $this->ApproveUrl = $ApproveUrl;

        return $this;
    }

    /**
     * Get the value of CancelUrl
     */ 
    public function getCancelUrl()
    {
        return $this->CancelUrl;
    }

    /**
     * Set the value of CancelUrl
     *
     * @return  self
     */ 
    public function setCancelUrl($CancelUrl)
    {
        $this->CancelUrl = $CancelUrl;

        return $this;
    }

    /**
     * Get the value of Name
     */ 
    public function getName()
    {
        return $this->Name;
    }

    /**
     * Set the value of Name
     *
     * @return  self
     */ 
    public function setName($Name)
    {
        $this->Name = $Name;

        return $this;
    }

    /**
     * Get the value of Price
     */ 
    public function getPrice()
    {
        return $this->Price;
    }

    /**
     * Set the value of Price
     *
     * @return  self
     */ 
    public function setPrice($Price)
    {
        $this->Price = $Price;

        return $this;
    }
}
?>
<?php
namespace App\Models\Dtos;

use App\Models\TourDetail;

class OrderPreview{
    private $name;
    private $address;
    private $email;
    private $paticipantNumber;
    private $paticipantChildrenNumber;
    private $hotel;
    private $tourdetail;
    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }
}
?>
<?php
namespace App\Models\Dtos;
class ChartData{
    public $name;
    // int[]
    public $data;

    /**
     * Get the value of Name
     */ 
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of Name
     *
     * @return  self
     */ 
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of Data
     */ 
    public function getData()
    {
        return $this->data;
    }

    /**
     * Set the value of Data
     *
     * @return  self
     */ 
    public function setData($data)
    {
        $this->data = $data;

        return $this;
    }
}
?>
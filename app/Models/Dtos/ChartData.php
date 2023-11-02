<?php
class ChartData{
    public string $Name;
    // int[]
    public $Data;

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
     * Get the value of Data
     */ 
    public function getData()
    {
        return $this->Data;
    }

    /**
     * Set the value of Data
     *
     * @return  self
     */ 
    public function setData($Data)
    {
        $this->Data = $Data;

        return $this;
    }
}
?>
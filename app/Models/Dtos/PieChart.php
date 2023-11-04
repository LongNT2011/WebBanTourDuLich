<?php
namespace App\Models\Dtos;
class PieChart{

    // decimal[]
    public $Series;
    // string[]
    public $Labels;

    /**
     * Get the value of Series
     */ 
    public function getSeries()
    {
        return $this->Series;
    }

    /**
     * Set the value of Series
     *
     * @return  self
     */ 
    public function setSeries($Series)
    {
        $this->Series = $Series;

        return $this;
    }

    /**
     * Get the value of Labels
     */ 
    public function getLabels()
    {
        return $this->Labels;
    }

    /**
     * Set the value of Labels
     *
     * @return  self
     */ 
    public function setLabels($Labels)
    {
        $this->Labels = $Labels;

        return $this;
    }
}

?>
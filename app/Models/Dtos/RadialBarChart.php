<?php
namespace App\Models\Dtos;
class RadialBarChart{
    public $TotalCount;
    public $CountInCurrentMonth;
    //bool
    public $HasRatioIncreased;
    // int[]
    public $Series;

    /**
     * Get the value of TotalCount
     */ 
    public function getTotalCount()
    {
        return $this->TotalCount;
    }

    /**
     * Set the value of TotalCount
     *
     * @return  self
     */ 
    public function setTotalCount($TotalCount)
    {
        $this->TotalCount = $TotalCount;

        return $this;
    }

    /**
     * Get the value of CountInCurrentMonth
     */ 
    public function getCountInCurrentMonth()
    {
        return $this->CountInCurrentMonth;
    }

    /**
     * Set the value of CountInCurrentMonth
     *
     * @return  self
     */ 
    public function setCountInCurrentMonth($CountInCurrentMonth)
    {
        $this->CountInCurrentMonth = $CountInCurrentMonth;

        return $this;
    }

    /**
     * Get the value of HasRatioIncreased
     */ 
    public function getHasRatioIncreased()
    {
        return $this->HasRatioIncreased;
    }

    /**
     * Set the value of HasRatioIncreased
     *
     * @return  self
     */ 
    public function setHasRatioIncreased($HasRatioIncreased)
    {
        $this->HasRatioIncreased = $HasRatioIncreased;

        return $this;
    }

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
}
?>
<?php
namespace App\Models\Dtos;
    class LineChart {
        // array
        public $Series;
        // string[]
        public $Categories;

        /**
         * Get the value of Categories
         */ 
        public function getCategories()
        {
                return $this->Categories;
        }

        /**
         * Set the value of Categories
         *
         * @return  self
         */ 
        public function setCategories($Categories)
        {
                $this->Categories = $Categories;

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
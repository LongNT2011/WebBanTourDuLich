<?php
namespace App\Models\Dtos;
    class LineChart {
        // array
        public $series;
        // string[]
        public $categories;

        /**
         * Get the value of Categories
         */ 
        public function getCategories()
        {
                return $this->categories;
        }

        /**
         * Set the value of Categories
         *
         * @return  self
         */ 
        public function setCategories($categories)
        {
                $this->categories = $categories;

                return $this;
        }

        /**
         * Get the value of Series
         */ 
        public function getSeries()
        {
                return $this->series;
        }

        /**
         * Set the value of Series
         *
         * @return  self
         */ 
        public function setSeries($series)
        {
                $this->series = $series;

                return $this;
        }
    }
?>
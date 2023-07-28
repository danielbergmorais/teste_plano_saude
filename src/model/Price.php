<?php

class Price {
    protected $code;
    protected $min_lifes;
    protected $range_one;
    protected $range_two;
    protected $range_three;

    public function __construct($code, $min_lifes, $range_one, $range_two, $range_three) {
        $this->code = $code;
        $this->min_lifes = $min_lifes;
        $this->range_one = $range_one;
        $this->range_two = $range_two;
        $this->range_three = $range_three;
    }

    public function getCode() {
        return $this->code;
    }
    public function getMinLifes() {
        return $this->min_lifes;
    }
    public function getRangeOne() {
        return $this->range_one;
    }

    public function getRangeTwo() {
        return $this->range_two;
    }

    public function getRangeThree() {
        return $this->range_three;
    }


}

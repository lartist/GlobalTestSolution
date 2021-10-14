<?php declare(strict_types=1);

namespace Salim\GlobTest;

class Segment
{
    private $min;
    private $max;


    public function __construct($min, $max)
    {
        $this->min = $min;
        $this->max = $max;
    }

    public static function fromArray(array $segment)
    {
        return new self(min($segment), max($segment));
    }

    public function getMin()
    {
        return $this->min;
    }

    public function getMax()
    {
        return $this->max;
    }

    public function toArray()
    {
        return [$this->min, $this->max];
    }

    public function getRange()
    {
        return range($this->min, $this->max);
    }

}
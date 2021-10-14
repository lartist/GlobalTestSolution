<?php declare(strict_types=1);

namespace Salim\GlobTest;

class Intersection
{
    private $segment1;
    private $segment2;

    public function __construct(Segment $segment1, Segment $segment2)
    {
        $this->segment1 = $segment1;
        $this->segment2 = $segment2;
    }

    public function getSegment1(): Segment
    {
        return $this->segment1;
    }

    public function getSegment2(): Segment
    {
        return $this->segment2;
    }

    public function computeNewSegment(): Segment
    {
        $points = [
            $this->segment1->getMin(),
            $this->segment1->getMax(),
            $this->segment2->getMin(),
            $this->segment2->getMax()
        ];

        return new Segment(min($points), max($points));
    }

}
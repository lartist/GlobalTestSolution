<?php

namespace Salim\GlobTest;

class SegmentCollection
{
    /** @var Segment[]  */
    private $segments;

    /**
     * @param array $segments
     */
    public function __construct(array $segments)
    {
        $this->setSegmentsFromArray($segments);
    }

    public function removeSegment(Segment $segment)
    {
        $key = array_search($segment, $this->segments);
        unset($this->segments[$key]);
    }

    public function addSegment(Segment $segment)
    {
        array_unshift($this->segments, $segment);
    }

    public function orderAsc()
    {
        $segmentsAsArray = $this->getSegmentsAsArray();
        usort($segmentsAsArray, function (array $a, array $b) {
            $a = Segment::fromArray($a);
            $b = Segment::fromArray($b);
            return ($a->getMin() <=> $b->getMin());
        });

        $this->setSegmentsFromArray($segmentsAsArray);
    }

    public function getOneIntersectionOrNull(): ?Intersection
    {
        $segments = $this->getCloneOfSegments();
       while (!empty($segments)) {
            $firstSegment = array_shift($segments);
            foreach ($segments as $segmentLoop) {
                if (!empty(array_intersect($firstSegment->getRange(), $segmentLoop->getRange())))
                    return new Intersection($firstSegment, $segmentLoop);
            }
        }

        return null;
    }

    private function getCloneOfSegments(): array
    {
        return array_merge($this->segments, []);
    }

    public function getSegmentsAsArray()
    {
        return array_map(function (Segment $segment) {
            return $segment->toArray();
        }, $this->segments);
    }

    private function setSegmentsFromArray(array $segments): void
    {
        $this->segments = array_map(function ($segment) {
            return Segment::fromArray($segment);
        }, $segments);
    }

}
<?php declare(strict_types=1);

namespace Salim\GlobTest;

class Bar
{
    public function foo(array $inputs): array
    {
        $segments = new SegmentCollection($inputs);
        while($intersection = $segments->getOneIntersectionOrNull()) {
            $sumOfSegments =  $intersection->computeNewSegment();
            $segments->removeSegment($intersection->getSegment1());
            $segments->removeSegment($intersection->getSegment2());
            $segments->addSegment($sumOfSegments);
        }
        $segments->orderAsc();
        return $segments->getSegmentsAsArray();
    }

}
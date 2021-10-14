<?php declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Salim\GlobTest\Bar;

class BarTest extends TestCase
{

    private function assertOutputInput(array $output, array $input): void
    {
        $bar = new Bar();
        $this->assertEquals($output, $bar->foo($input));
    }


    public function testReturnSameOutputAsInputIfThereIsNoIntersection()
    {
        $input = [[0, 3], [6, 10]];
        $output = [[0, 3], [6, 10]];
        $this->assertOutputInput($output, $input);
    }


    public function testLinkTwoSegmentsIfThereIsAnIntersection()
    {
        $input = [[0, 5], [3, 10]];
        $output = [[0, 10]];
        $this->assertOutputInput($output, $input);
    }

    public function testLinkSeveralSegmentsIfThereIsIntersections()
    {
        $input = [[7, 8], [3, 6], [2, 4]];
        $output = [[2, 6], [7, 8]];
        $this->assertOutputInput($output, $input);
    }

    public function testLinkSeveralSegmentsIfThereIsAnIntersectionAndSortSegmentAsc()
    {
        $input = [[2, 6], [7, 8], [3, 6], [3, 4], [15, 20], [16, 17], [1, 4], [6, 10], [3, 6]];
        $output = [[1, 10], [15, 20]];
        $this->assertOutputInput($output, $input);
    }

    /**
     * @dataProvider getData
     */
    public function testFoo($input, $output)
    {
        $bar = new Bar();
        $this->assertEquals($output, $bar->foo($input));
    }

    public function getData()
    {
        return [
            [[[0, 3], [6, 10]], [[0, 3], [6, 10]]],
            [[[0, 5], [3, 10]], [[0, 10]]],
            [[[0, 5], [2, 4]], [[0, 5]]],
            [[[7, 8], [3, 6], [2, 4]], [[2, 6], [7, 8]]],
            [[[2, 6], [7, 8], [3, 6], [3, 4], [15, 20], [16, 17], [1, 4], [6, 10], [3, 6]], [[1, 10], [15, 20]]]
        ];
    }
}
<?php

use PHPUnit\Framework\TestCase;
use Fullpipe\NormalDistribution\GeneralNormalDistribution;

class GeneralNormalDistributionTest extends TestCase
{
    /**
     * @dataProvider cdfProvider
     */
    public function testInvCdf($expected, $alfa)
    {
        $snd = new GeneralNormalDistribution();

        $this->assertEquals($expected, round($snd->invCdf($alfa), 3));
    }

    /**
     * @dataProvider pdfProvider
     */
    public function testPdf($x, $expected)
    {
        $snd = new GeneralNormalDistribution();

        $this->assertEquals($expected, round($snd->pdf($x), 5));
    }

    /**
     * @dataProvider cdfProvider
     */
    public function testCdf($x, $expected)
    {
        $snd = new GeneralNormalDistribution();

        $this->assertEquals($expected, round($snd->cdf($x), 5));
    }

    public function cdfProvider()
    {
        return [
            [-3, 0.00135],
            [-2, 0.02275],
            [-1, 0.15866],
            [0, 0.5],
            [1, 1 - 0.15866],
            [2, 1 - 0.02275],
            [3, 1 - 0.00135],
        ];
    }

    public function pdfProvider()
    {
        return [
            [0, 0.39894],
            [1, 0.24197],
            [-1, 0.24197],
            [3, 0.00443],
            [5, 0],
        ];
    }
}

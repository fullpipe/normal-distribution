<?php

use PHPUnit\Framework\TestCase;
use Fullpipe\NormalDistribution\StandardNormalDistribution;

class StandardNormalDistributionTest extends TestCase
{
    /**
     * @dataProvider cdfProvider
     */
    public function testCdfFromErf($x, $expected)
    {
        $snd = new StandardNormalDistribution();

        $this->assertEquals($expected, round($snd->cdfFromErf($x), 5));
    }

    /**
     * @dataProvider cdfProvider
     */
    public function testInvCdf($expected, $alfa)
    {
        $snd = new StandardNormalDistribution();

        $this->assertEquals($expected, round($snd->invCdf($alfa), 3));
    }

    /**
     * @dataProvider pdfProvider
     */
    public function testPdf($x, $expected)
    {
        $snd = new StandardNormalDistribution();

        $this->assertEquals($expected, round($snd->pdf($x), 5));
    }

    /**
     * @dataProvider cdfProvider
     */
    public function testCdf($x, $expected)
    {
        $snd = new StandardNormalDistribution();

        $this->assertEquals($expected, round($snd->cdf($x), 5));
    }

    /**
     * @dataProvider erfProvider
     */
    public function testErf($x, $expected)
    {
        $snd = new StandardNormalDistribution();

        $this->assertEquals($expected, round($snd->erf($x), 5));
    }

    public function testInvCdfException()
    {
        $this->expectException(\Exception::class);
        $snd = new StandardNormalDistribution();

        $snd->invCdf(2);
    }

    public function erfProvider()
    {
        return [
            [-3, -0.99998],
            [-2, -0.99532],
            [-1, -0.8427],
            [-0.5, -0.5205],
            [0, 0],
            [0.5, 0.5205],
            [1, 0.8427],
            [2, 0.99532],
            [3, 0.99998],
        ];
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

<?php

namespace Fullpipe\NormalDistribution;

/**
 * @see https://en.wikipedia.org/wiki/Normal_distribution#General_normal_distribution
 */
class GeneralNormalDistribution implements NormalDistributionInterface
{
    /**
     * @var float
     */
    private $meanValue;

    /**
     * @var float
     */
    private $standardDeviation;

    /**
     * Constructor.
     *
     * @param int $meanValue
     * @param int $standardDeviation
     */
    public function __construct($meanValue = 0, $standardDeviation = 1)
    {
        $this->meanValue = $meanValue;
        $this->standardDeviation = $standardDeviation;

        $this->snd = new StandardNormalDistribution();
    }

    /**
     * {@inheritdoc}
     */
    public function pdf($x)
    {
        return $this->snd->pdf($this->transX($x)) / $this->standardDeviation;
    }

    /**
     * {@inheritdoc}
     */
    public function cdf($x)
    {
        return $this->snd->cdf($this->transX($x));
    }

    /**
     * {@inheritdoc}
     */
    public function invCdf($alfa)
    {
        return $this->meanValue + $this->standardDeviation * $this->snd->invCdf($alfa);
    }

    /**
     * Transform value to standart calculations.
     *
     * @param float $x
     *
     * @return float
     */
    private function transX($x)
    {
        return ($x - $this->meanValue) / $this->standardDeviation;
    }
}

<?php

namespace Fullpipe\NormalDistribution;

interface NormalDistributionInterface
{
    /**
     * Probability density function.
     *
     * @see https://en.wikipedia.org/wiki/Normal_distribution#Standard_normal_distribution
     *
     * @param number $x
     *
     * @return float (0, 1)
     */
    public function pdf($x);

    /**
     * Cumulative distribution function.
     *
     * @see https://en.wikipedia.org/wiki/Normal_distribution#Cumulative_distribution_function
     *
     * @param number $x
     *
     * @return float
     */
    public function cdf($x);

    /**
     * Inverse cumulative distribution function.
     *
     * @param float $alfa (0, 1)
     *
     * @return number
     */
    public function invCdf($alfa);
}

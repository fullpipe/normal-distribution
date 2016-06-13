<?php

namespace Fullpipe\NormalDistribution;

/**
 * @see https://en.wikipedia.org/wiki/Normal_distribution#Standard_normal_distribution
 */
class StandardNormalDistribution implements NormalDistributionInterface
{
    /**
     * sqrt(2 * M_PI).
     */
    const SQRT_2_PI = 2.506628274631;

    /**
     * {@inheritdoc}
     */
    public function pdf($x)
    {
        return exp(-0.5 * pow($x, 2))/self::SQRT_2_PI;
    }

    /**
     * {@inheritdoc}
     */
    public function cdf($x)
    {
        $sign = $this->sgn($x);
        $x = abs($x);

        $p = 0.2316419;

        $b1 = 0.319381530;
        $b2 = -0.356563782;
        $b3 = 1.781477937;
        $b4 = -1.821255978;
        $b5 = 1.330274429;

        $t = 1/(1 + $p * $x);

        $cd = 1 - $this->pdf($x) * ($b1 * $t + $b2 * pow($t, 2) + $b3 * pow($t, 3) + $b4 * pow($t, 4) + $b5 * pow($t, 5));


        if ($sign < 0) {
            return 1 - $cd;
        }

        return $cd;
    }

    /**
     * Cumulative distribution function throw erf.
     *
     * @param number $x
     *
     * @return float
     */
    public function cdfFromErf($x)
    {
        return 0.5 * (1 + $this->erf($x/M_SQRT2));
    }

    /**
     * Error function.
     *
     * @see  https://en.wikipedia.org/wiki/Error_function
     *
     * @param number $x
     *
     * @return float
     */
    public function erf($x)
    {
        $sign = $this->sgn($x);
        $x = abs($x);

        $p = 0.3275911;

        $a1 = 0.254829592;
        $a2 = -0.284496736;
        $a3 = 1.421413741;
        $a4 = -1.453152027;
        $a5 = 1.061405429;

        $t = 1/(1 + $p * $x);

        $er =  1 - ($a1 * $t + $a2 * pow($t, 2) + $a3 * pow($t, 3) + $a4 * pow($t, 4) + $a5 * pow($t, 5)) * exp(-pow($x, 2));

        return $sign * $er;
    }

    /**
     * {@inheritdoc}
     */
    public function invCdf($alfa)
    {
        if (0 >= $alfa || $alfa >= 1) {
            throw new \Exception("Alfa should be betwen 0 and 1", 1);
        }

        $sign = 1;

        if ($alfa < 0.5) {
            $alfa = 1 - $alfa;
            $sign = -1;
        }

        $c0 = 2.515517;
        $c1 = 0.802853;
        $c2 = 0.010328;

        $d1 = 1.432788;
        $d2 = 0.189269;
        $d3 = 0.001308;

        $t = sqrt(-2 * log(1 - $alfa));

        $invCd = $t - ($c0 + $c1 * $t + $c2 * pow($t, 2)) / (1 + $d1 * $t + $d2 * pow($t, 2) + $d3 * pow($t, 3));

        return $sign * $invCd;
    }

    /**
     * Get var sign.
     *
     * @param number $x
     *
     * @return integer -1|0|1
     */
    private function sgn($x)
    {
        if ($x < 0) {
            return -1;
        } elseif ($x > 0) {
            return 1;
        } else {
            return 0;
        }
    }
}

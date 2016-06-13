# Basic Normal distribution calculations
Simple php lib for basic Normal distribution calculations

```php
$snd = new \Fullpipe\NormalDistribution\StandardNormalDistribution();
echo $snd->pdf(1);
echo $snd->cdf(1);
echo $snd->invCdf(0.5);

$gnd = new \Fullpipe\NormalDistribution\GeneralNormalDistribution(100, 9);
echo $gnd->pdf(50);
echo $gnd->cdf(50);
echo $gnd->invCdf(0.5);
```

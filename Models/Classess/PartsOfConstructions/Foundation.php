<?php
namespace classes;

include_once 'Cement.php';
include_once 'Matel.php';
include_once 'Sand.php';
include_once 'RainforceentBars.php';
include_once 'BindingWires.php';

include_once 'UnitRates.php';

use RowMaterials\UnitRates;

class Foundation
{
    private $length;
    private $width;
    private $height;
    private $no_of_foundation;


    public function __construct($length, $width, $height, $no_of_foundation)
    {
        $this->length = $length;
        $this->width = $width;
        $this->height = $height;
        $this->no_of_foundation = $no_of_foundation;
    }

    public function getVolOfFoundation()
    {
        $vol = ($this->length * $this->width * $this->height)*$this->no_of_foundation;
        return $vol;
    }

    public function getSqOfFoundation()
    {
        $sq = ($this->length * $this->width)*$this->no_of_foundation; 
        return $sq;

    }

    public function getTotalCostForConcrete()
    {
        $unitRatesObj = new UnitRates();
        $totalConCost = $unitRatesObj->getRatesOfConcreteOne()*$this->getVolOfFoundation();
      
        return $totalConCost;
    }
    public function getTotalCostForReinforcement()
    {
        $unitRatesObj = new UnitRates();
        $totalConCost = $unitRatesObj->getRatesOfRainforcement()*$this->getVolOfFoundation();
      
        return $totalConCost;
    }
    public function getTotalCostForFrameWork()
    {
        $unitRatesObj = new UnitRates();
        $totalFrameCost = $unitRatesObj->getRatesOfFormworks()*$this->getSqOfFoundation();
      
        return $totalFrameCost;
    }
}

<?php
namespace classes;

include_once 'Cement.php';
include_once 'Matel.php';
include_once 'Sand.php';
include_once 'RainforceentBars.php';
include_once 'BindingWires.php';

include_once 'UnitRates.php';

use RowMaterials\UnitRates;

class Tiebeams
{
    private $length; // length of the
    private $width; // width of the
    private $thickness; // thickness of the
    private $no_of_tiebeams; // thickness of the


    public function __construct($length, $width, $thickness, $no_of_tiebeams)
    {
        $this->length = $length;
        $this->width = $width;
        $this->thickness = $thickness;
        $this->no_of_tiebeams = $no_of_tiebeams;
    }

    public function getVolOfTiebeams()
    {
        $vol = ($this->length * $this->width * $this->thickness)*$this->no_of_tiebeams; // in cubic meters
        return $vol;
    }

    public function getSqOfTiebeams()
    {
        $sq = ($this->length * $this->width)*$this->no_of_tiebeams; // in square meters
        return $sq;

    }

    public function getTotalCostForConcrete()
    {
        $unitRatesObj = new UnitRates();
        $totalConCost = $unitRatesObj->getRatesOfConcreteOne()*$this->getVolOfTiebeams();
      
        return $totalConCost;
    }
    public function getTotalCostForReinforcement()
    {
        $unitRatesObj = new UnitRates();
        $totalConCost = $unitRatesObj->getRatesOfRainforcement()*$this->getVolOfTiebeams();
      
        return $totalConCost;
    }
    public function getTotalCostForFrameWork()
    {
        $unitRatesObj = new UnitRates();
        $totalFrameCost = $unitRatesObj->getRatesOfFormworks()*$this->getSqOfTiebeams();
      
        return $totalFrameCost;
    }
}

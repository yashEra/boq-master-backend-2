<?php
namespace classes;

include_once 'Cement.php';
include_once 'Matel.php';
include_once 'Sand.php';
include_once 'RainforceentBars.php';
include_once 'BindingWires.php';

use RowMaterials\BindingWires;
use RowMaterials\Cement;
use RowMaterials\Matel;
use RowMaterials\RainforceentBars;
use RowMaterials\Sand;
include_once 'UnitRates.php';

use RowMaterials\UnitRates;

class ColumnFootings
{
    private $length; // length of the Footings
    private $width; // width of the Footings
    private $thickness; // thickness of the Footings
    private $cement = 11; //11 50Kg bags for one cubic meter
    private $sand = 15; //cubic feet for one cubic meter
    private $metal = 30; // cubic feet for one cubic meter
    private $reinforcementBars = 20.202; //Reinforcement bars square meter -1 for Kg
    private $bindingWires = 20.202 * 0.01; //Binding wires square meter -1 for Kg
    private $numberOfFootingss;

    public function __construct($length, $width, $thickness)
    {
        $this->length = $length;
        $this->width = $width;
        $this->thickness = $thickness;
    }

    public function getVolOfFootings()
    {
        $vol = $this->length * $this->width * $this->thickness; // in cubic meters
        return $vol;
    }

    public function getSqOfFootings()
    {
        $sq = $this->length * $this->width; // in square meters
        return $sq;

    }

    public function getTotalCostForConcrete()
    {
        $unitRatesObj = new UnitRates();
        $totalConCost = $unitRatesObj->getRatesOfConcreteOne()*$this->getVolOfFootings();
      
        return $totalConCost;
    }
    public function getTotalCostForReinforcement()
    {
        $unitRatesObj = new UnitRates();
        $totalConCost = $unitRatesObj->getRatesOfRainforcement()*$this->getVolOfFootings();
      
        return $totalConCost;
    }
    public function getTotalCostForFrameWork()
    {
        $unitRatesObj = new UnitRates();
        $totalFrameCost = $unitRatesObj->getRatesOfFormworks()*$this->getSqOfFootings();
      
        return $totalFrameCost;
    }
}

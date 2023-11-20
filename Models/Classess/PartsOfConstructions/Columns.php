<?php
namespace classes;

include_once 'Cement.php';
include_once 'Matel.php';
include_once 'Sand.php';
include_once 'RainforceentBars.php';
include_once 'BindingWires.php';

include_once 'UnitRates.php';

use RowMaterials\UnitRates;

class Columns
{
    private $length; // length of the
    private $width; // width of the
    private $thickness; // thickness of the
    private $no_of_columns; // thickness of the


    public function __construct($length, $width, $thickness, $no_of_columns)
    {
        $this->length = $length;
        $this->width = $width;
        $this->thickness = $thickness;
        $this->no_of_columns = $no_of_columns;
    }

    public function getVolOfColumn()
    {
        $vol = ($this->length * $this->width * $this->thickness)*$this->no_of_columns; // in cubic meters
        return $vol;
    }

    public function getSqOfColumn()
    {
        $sq = ($this->length * $this->width)*$this->no_of_columns; // in square meters
        return $sq;

    }

    public function getTotalCostForConcrete()
    {
        $unitRatesObj = new UnitRates();
        $totalConCost = $unitRatesObj->getRatesOfConcreteOne()*$this->getVolOfColumn();
      
        return $totalConCost;
    }
    public function getTotalCostForReinforcement()
    {
        $unitRatesObj = new UnitRates();
        $totalConCost = $unitRatesObj->getRatesOfRainforcement()*$this->getVolOfColumn();
      
        return $totalConCost;
    }
    public function getTotalCostForFrameWork()
    {
        $unitRatesObj = new UnitRates();
        $totalFrameCost = $unitRatesObj->getRatesOfFormworks()*$this->getSqOfColumn();
      
        return $totalFrameCost;
    }
}

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

class Tiebeam
{
    private $length; // length of the Tiebeam
    private $width; // width of the Tiebeam
    private $height; // thickness of the Tiebeam
    private $cement = 11; //11 50Kg bags for one cubic meter
    private $sand = 15; //cubic feet for one cubic meter
    private $metal = 30; // cubic feet for one cubic meter
    private $reinforcementBars = 20.202; //Reinforcement bars square meter -1 for Kg
    private $bindingWires = 20.202 * 0.01; //Binding wires square meter -1 for Kg
    private $noOfTiebeams;

    public function __construct($length, $width, $height, $noOfTiebeams)
    {
        $this->length = $length;
        $this->width = $width;
        $this->height = $height;
        $this->noOfTiebeams = $noOfTiebeams;
    }

    public function getVolOfTiebeam()
    {
        $vol = $this->length * $this->width * $this->height* $this->noOfTiebeams; // in cubic meters
        return $vol;
    }

    public function getSqOfTiebeam()
    {
        $sq = $this->length * $this->width* $this->noOfTiebeams; // in square meters
        return $sq;
    }

    public function getCementQuantityForTiebeam()
    {
        $cementQuantity = $this->cement * $this->getVolOfTiebeam();
        return $cementQuantity;
    }

    public function getCementPriceForTiebeam()
    {
        $cementObj = new Cement();
        $cementCost = $this->getCementQuantityForTiebeam()*$cementObj->getPriceOfCementBag();

        return $cementCost;

    }

    public function getSandQuantityForTiebeam()
    {
        $sandQuantity = $this->sand * $this->getVolOfTiebeam();
        return $sandQuantity;
    }

    public function getSandPriceForTiebeam()
    {
        $sandObj = new Sand();
        $sandCost = $this->getSandQuantityForTiebeam()*$sandObj->getPriceOfSand();

        return $sandCost;
    }

    public function getMetalQuantityForTiebeam()
    {
        $metalQuantity = $this->metal * $this->getVolOfTiebeam();
        return $metalQuantity;
    }

    public function getMetalPriceForTiebeam()
    {
        $matalObj = new Matel();
        $metalCost = $this->getMetalQuantityForTiebeam()*$matalObj->getPriceOfMetal();//total 50kg cement bags

        return $metalCost;
    }

    public function getReinforcementQuantityForTiebeam()
    {
        $reinforcementQuantity = $this->reinforcementBars * $this->getVolOfTiebeam();
        return $reinforcementQuantity;
    }

    public function getReinforcementPriceForTiebeam()
    {
        $rainforcementbarsObj = new RainforceentBars();
        $rainforcementbars = $this->getReinforcementQuantityForTiebeam()*$rainforcementbarsObj->getPriceOfReinforcementBars();//total 50kg cement bags

        return $rainforcementbars;

    }

    public function getBindingWiresQuantityForTiebeam()
    {
        $bindingWiresQuantity = $this->bindingWires * $this->getVolOfTiebeam();
        return $bindingWiresQuantity;
    }

    public function getBindingWiresPriceForTiebeam()
    {
        $bindingWiresObj = new BindingWires();
        $metalCost = $this->getBindingWiresQuantityForTiebeam()*$bindingWiresObj->getPriceOfBindingWires();//total 50kg cement bags

        return $metalCost;

    }

    public function getTotalCostForTiebeam()
    {
        $totalCost = $this->getCementPriceForTiebeam()+$this->getSandPriceForTiebeam()+$this->getMetalPriceForTiebeam()+$this->getReinforcementPriceForTiebeam()+$this->getBindingWiresPriceForTiebeam();
      
        return $totalCost;
    }
}

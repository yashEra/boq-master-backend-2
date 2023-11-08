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

class Slabs
{
    private $length; // length of the slab
    private $width; // width of the slab
    private $thickness; // thickness of the slab
    private $cement = 11; //11 50Kg bags for one cubic meter
    private $sand = 15; //cubic feet for one cubic meter
    private $metal = 30; // cubic feet for one cubic meter
    private $reinforcementBars = 20.202; //Reinforcement bars square meter -1 for Kg
    private $bindingWires = 20.202 * 0.01; //Binding wires square meter -1 for Kg
    private $numberOfSlabs;

    public function __construct($length, $width, $thickness)
    {
        $this->length = $length;
        $this->width = $width;
        $this->thickness = $thickness;
    }

    public function getVolOfSlab()
    {
        $vol = $this->length * $this->width * $this->thickness; // in cubic meters
        return $vol;
    }

    public function getSqOfSlab()
    {
        $sq = $this->length * $this->width; // in square meters
        return $sq;
    }

    public function getCementQuantityForSlab()
    {
        $cementQuantity = $this->cement * $this->getVolOfSlab();
        return $cementQuantity;
    }

    public function getCementPriceForSlab()
    {
        $cementObj = new Cement();
        $cementCost = $this->getCementQuantityForSlab()*$cementObj->getPriceOfCementBag();

        return $cementCost;

    }

    public function getSandQuantityForSlab()
    {
        $sandQuantity = $this->sand * $this->getVolOfSlab();
        return $sandQuantity;
    }

    public function getSandPriceForSlab()
    {
        $sandObj = new Sand();
        $sandCost = $this->getSandQuantityForSlab()*$sandObj->getPriceOfSand();

        return $sandCost;
    }

    public function getMetalQuantityForSlab()
    {
        $metalQuantity = $this->metal * $this->getVolOfSlab();
        return $metalQuantity;
    }

    public function getMetalPriceForSlab()
    {
        $matalObj = new Matel();
        $metalCost = $this->getMetalQuantityForSlab()*$matalObj->getPriceOfMetal();//total 50kg cement bags

        return $metalCost;
    }

    public function getReinforcementQuantityForSlab()
    {
        $reinforcementQuantity = $this->reinforcementBars * $this->getSqOfSlab();
        return $reinforcementQuantity;
    }

    public function getReinforcementPriceForSlab()
    {
        $rainforcementbarsObj = new RainforceentBars();
        $rainforcementbars = $this->getReinforcementQuantityForSlab()*$rainforcementbarsObj->getPriceOfReinforcementBars();//total 50kg cement bags

        return $rainforcementbars;

    }

    public function getBindingWiresQuantityForSlab()
    {
        $bindingWiresQuantity = $this->bindingWires * $this->getSqOfSlab();
        return $bindingWiresQuantity;
    }

    public function getBindingWiresPriceForSlab()
    {
        $bindingWiresObj = new BindingWires();
        $metalCost = $this->getBindingWiresQuantityForSlab()*$bindingWiresObj->getPriceOfBindingWires();//total 50kg cement bags

        return $metalCost;

    }

    public function getTotalCostForSlab()
    {
        $totalCost = $this->getCementPriceForSlab()+$this->getSandPriceForSlab()+$this->getMetalPriceForSlab()+$this->getReinforcementPriceForSlab()+$this->getBindingWiresPriceForSlab();
      
        return $totalCost;
    }
}

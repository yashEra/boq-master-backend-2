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

class Columns
{
    private $length; // length of the Column
    private $width; // width of the Column
    private $height; // thickness of the Column
    private $cement = 11; //11 50Kg bags for one cubic meter
    private $sand = 15; //cubic feet for one cubic meter
    private $metal = 30; // cubic feet for one cubic meter
    private $reinforcementBars = 20.202; //Reinforcement bars square meter -1 for Kg
    private $bindingWires = 20.202 * 0.01; //Binding wires square meter -1 for Kg
    private $noOfColumns;

    public function __construct($length, $width, $height, $noOfColumns)
    {
        $this->length = $length;
        $this->width = $width;
        $this->height = $height;
        $this->noOfColumns = $noOfColumns;
    }

    public function getVolOfColumn()
    {
        $vol = $this->length * $this->width * $this->height*$this->noOfColumns; // in cubic meters
        return $vol;
    }

    public function getSqOfColumn()
    {
        $sq = $this->length * $this->width*$this->noOfColumns; // in square meters
        return $sq;
    }

    public function getCementQuantityForColumn()
    {
        $cementQuantity = $this->cement * $this->getVolOfColumn();
        return $cementQuantity;
    }

    public function getCementPriceForColumn()
    {
        $cementObj = new Cement();
        $cementCost = $this->getCementQuantityForColumn()*$cementObj->getPriceOfCementBag();

        return $cementCost;

    }

    public function getSandQuantityForColumn()
    {
        $sandQuantity = $this->sand * $this->getVolOfColumn();
        return $sandQuantity;
    }

    public function getSandPriceForColumn()
    {
        $sandObj = new Sand();
        $sandCost = $this->getSandQuantityForColumn()*$sandObj->getPriceOfSand();

        return $sandCost;
    }

    public function getMetalQuantityForColumn()
    {
        $metalQuantity = $this->metal * $this->getVolOfColumn();
        return $metalQuantity;
    }

    public function getMetalPriceForColumn()
    {
        $matalObj = new Matel();
        $metalCost = $this->getMetalQuantityForColumn()*$matalObj->getPriceOfMetal();//total 50kg cement bags

        return $metalCost;
    }

    public function getReinforcementQuantityForColumn()
    {
        $reinforcementQuantity = $this->reinforcementBars * $this->getSqOfColumn();
        return $reinforcementQuantity;
    }

    public function getReinforcementPriceForColumn()
    {
        $rainforcementbarsObj = new RainforceentBars();
        $rainforcementbars = $this->getReinforcementQuantityForColumn()*$rainforcementbarsObj->getPriceOfReinforcementBars();//total 50kg cement bags

        return $rainforcementbars;

    }

    public function getBindingWiresQuantityForColumn()
    {
        $bindingWiresQuantity = $this->bindingWires * $this->getSqOfColumn();
        return $bindingWiresQuantity;
    }

    public function getBindingWiresPriceForColumn()
    {
        $bindingWiresObj = new BindingWires();
        $metalCost = $this->getBindingWiresQuantityForColumn()*$bindingWiresObj->getPriceOfBindingWires();//total 50kg cement bags

        return $metalCost;

    }

    public function getTotalCostForColumn()
    {
        $totalCost = $this->getCementPriceForColumn()+$this->getSandPriceForColumn()+$this->getMetalPriceForColumn()+$this->getReinforcementPriceForColumn()+$this->getBindingWiresPriceForColumn();
      
        return $totalCost;
    }
}

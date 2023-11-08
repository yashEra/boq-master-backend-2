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
use RowMaterials\Sand;
use RowMaterials\RainforceentBars;

class Stairs

{
    private $thickness;
    private $width;
    private $length;
    private $thread;
    private $riser;
    private $noOfSteps;



    public function __construct($thickness, $length, $width, $riser, $thread, $noOfSteps)
    {
        $this->length = $length;
        $this->thickness = $thickness;
        $this->width = $width;
        $this->riser = $riser;
        $this->thread = $thread;
        $this->noOfSteps = $noOfSteps;
    }

    public function getStairsCaseVol()
    {
        $stairsCaseVol = $this->thickness * $this->length*$this->width;

        return $stairsCaseVol;
    }

    public function getStairsCaseArea()
    {
        $stairsCaseArea = $this->length*$this->width;

        return $stairsCaseArea;
    }

    public function getStairsTotVol()
    {
        $stairVol = ($this->thread * $this->width*$this->riser)/2;
        $stairsTotVol = $stairVol*$this->noOfSteps;

        return $stairsTotVol;
    }


    public function getCement()
    {
        $totVol = $this->getStairsCaseVol() + $this->getStairsTotVol();
        $cementQuantity = $totVol * 11;//total 50kg cement bags

        return $cementQuantity;
    }

    public function getSand()
    {
        $totVol = $this->getStairsCaseVol() + $this->getStairsTotVol();
        $sandQuantity = $totVol * 15;//total cube sand
        return $sandQuantity;
    }

    public function getMatel()
    {
        $totVol = $this->getStairsCaseVol() + $this->getStairsTotVol();
        $matelQuantity = $totVol * 30;//total cubic feet Mater
        return $matelQuantity;
    }

    public function getRainforcementBars()
    {
        $totArea = $this->getStairsCaseArea();
        $rainforcementBars = $totArea * 20.202;
        return $rainforcementBars;
    }
    public function getBindingWires()
    {
        $totArea = $this->getStairsCaseArea();
        $bindingWires = $totArea * 11;
        return $bindingWires;
    }
/***************************************** COST CALCULATIONS **************************************** */
    public function getCementCost()
    {
        $cementObj = new Cement();
        $cementCost = $this->getCement()*$cementObj->getPriceOfCementBag();//total 50kg cement bags

        return $cementCost;
    }
    public function getMatelCost()
    {
        $matalObj = new Matel();
        $metalCost = $this->getMatel()*$matalObj->getPriceOfMetal();//total 50kg cement bags

        return $metalCost;
    }

    public function getSandCost()
    {
        $sandObj = new Sand();
        $metalCost = $this->getSand()*$sandObj->getPriceOfSand();//total 50kg cement bags

        return $metalCost;
    }

    public function getRainforcementBarsCost()
    {
        $rainforcementbarsObj = new RainforceentBars();
        $rainforcementbars = $this->getRainforcementBars()*$rainforcementbarsObj->getPriceOfReinforcementBars();//total 50kg cement bags

        return $rainforcementbars;
    }
    public function getBindingWiresCost()
    {
        $bindingWiresObj = new BindingWires();
        $metalCost = $this->getBindingWires()*$bindingWiresObj->getPriceOfBindingWires();//total 50kg cement bags

        return $metalCost;
    }

    public function getStairesTotalCost(){

        $totCost = $this->getCementCost()+$this->getMatelCost()+$this->getSandCost()+$this->getRainforcementBarsCost()+$this->getBindingWiresCost();

        return $totCost;
    }



}


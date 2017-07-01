<?php
namespace KML\Entity\Feature\Container;

use KML\Entity\Feature\Feature;
use KML\Entity\KMLObject;

abstract class Container extends Feature
{
    protected $features = [];
  
    public function jsonSerialize()
    {
        $jsonData = null;
    
        if (count($this->features)) {
            $jsonData = [];
      
            foreach ($this->features as $feature) {
                $jsonData[] = $feature;
            }
        }
    
        return $jsonData;
    }
  
    public function getAllFeatures()
    {
        $allFeature = [];
    
        foreach ($this->features as $feature) {
            $allFeature = array_merge($allFeature, $feature->getAllFeatures());
        }
    
        return $allFeature;
    }
  
    public function addFeature(KMLObject $feature)
    {
        $this->features[] = $feature;
    }
  
    public function clearFeature()
    {
        $this->features = [];
    }
  
    public function toWKT(): string
    {
        $output = [];
    
        foreach ($this->features as $feature) {
            $output[] = $feature->toWKT();
        }
    
        return implode(",", $output);
    }
  
    public function toWKT2d(): string
    {
        $output = [];
    
        foreach ($this->features as $feature) {
            $output[] = $feature->toWKT2d();
        }
    
        return implode(",", $output);
    }
  
    public function __toString(): string
    {
        $parent_string = parent::__toString();
    
        $output = [];
        $output[] = $parent_string;
    
        foreach ($this->features as $feature) {
            $output[] = $feature->__toString();
        }
    
        return implode("\n", $output);
    }
  
    public function setFeature($feature)
    {
        $this->features = $feature;
    }
  
    public function getFeatures()
    {
        return $this->features;
    }
}

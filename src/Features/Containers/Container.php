<?php
namespace KML\Features\Containers;

use KML\Features\Feature;
use KML\KMLObject;

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
        $allFeatures = [];
    
        foreach ($this->features as $feature) {
            $allFeatures = array_merge($allFeatures, $feature->getAllFeatures());
        }
    
        return $allFeatures;
    }
  
    public function addFeature(KMLObject $feature)
    {
        $this->features[] = $feature;
    }
  
    public function clearFeatures()
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
  
    public function setFeatures($features)
    {
        $this->features = $features;
    }
  
    public function getFeatures()
    {
        return $this->features;
    }
}

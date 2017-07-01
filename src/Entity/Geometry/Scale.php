<?php
namespace KML\Entity\Geometry;

use KML\Entity\KMLObject;

class Scale extends KMLObject
{
    private $x;
    private $y;
    private $z;
  
    public function getX()
    {
        return $this->x;
    }
  
    public function setX($x)
    {
        $this->x = $x;
    }
  
    public function getY()
    {
        return $this->y;
    }
  
    public function setY($y)
    {
        $this->y = $y;
    }
  
    public function getZ()
    {
        return $this->z;
    }
  
    public function setZ($z)
    {
        $this->z = $z;
    }

    public function __toString(): string
    {
        return '';
    }
}

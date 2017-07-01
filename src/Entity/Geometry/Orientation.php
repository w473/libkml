<?php
namespace KML\Entity\Geometry;

use KML\Entity\KMLObject;

class Orientation extends KMLObject
{
    private $heading;
    private $tilt;
    private $roll;

    function __construct(string $data)
    {
        throw new \Exception($data);
    }

    public function getHeading()
    {
        return $this->heading;
    }
  
    public function setHeading($heading)
    {
        $this->heading = $heading;
    }
  
    public function getTilt()
    {
        return $this->tilt;
    }
  
    public function setTilt($tilt)
    {
        $this->tilt = $tilt;
    }
  
    public function getRoll()
    {
        return $this->roll;
    }
  
    public function setRoll($roll)
    {
        $this->roll = $roll;
    }

    public function __toString(): string
    {
        return '';
    }
}

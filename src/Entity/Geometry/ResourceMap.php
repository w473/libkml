<?php
namespace KML\Entity\Geometry;

use KML\Entity\KMLObject;

class ResourceMap extends KMLObject
{
    private $aliases;
  
    public function getAliases()
    {
        return $this->aliases;
    }
  
    public function setAliases($aliases)
    {
        $this->aliases = $aliases;
    }

    public function __toString(): string
    {
        return '';
    }
}

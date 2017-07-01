<?php
namespace KML\Entity\Time;

use KML\Entity\KMLObject;

abstract class TimePrimitive extends KMLObject
{
    public function __toString(): string
    {
        return '';
    }
}

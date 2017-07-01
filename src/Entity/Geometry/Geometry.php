<?php
namespace KML\Entity\Geometry;

use KML\Entity\KMLObject;

abstract class Geometry extends KMLObject implements \JsonSerializable
{
    abstract public function toWKT(): string;
}

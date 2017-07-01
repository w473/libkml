<?php

namespace KML\Entity\Geometry;

use KML\Entity\Feature\AltitudeMode;

class Model extends Geometry
{
    private $altitudeMode;
    private $location;
    /** @var  Orientation */
    private $orientation;
    private $scale;
    private $link;
    private $resourceMap;

    public function __toString(): string
    {
        $parent_string = parent::__toString();

        $output = [];
        $output[] = sprintf(
            "<Model%s>",
            isset($this->id) ? sprintf(" id=\"%s\"", $this->id) : ""
        );
        $output[] = $parent_string;

        $output[] = "</Model>";

        return implode("\n", $output);
    }

    public function getAltitudeMode(): AltitudeMode
    {
        return $this->altitudeMode;
    }

    public function setAltitudeMode(AltitudeMode $altitudeMode)
    {
        $this->altitudeMode = $altitudeMode;
    }

    public function getLocation()
    {
        return $this->location;
    }

    public function setLocation($location)
    {
        $this->location = $location;
    }

    public function getOrientation(): Orientation
    {
        return $this->orientation;
    }

    public function setOrientation(Orientation $orientation)
    {
        $this->orientation = $orientation;
    }

    public function getScale()
    {
        return $this->scale;
    }

    public function setScale($scale)
    {
        $this->scale = $scale;
    }

    public function getLink()
    {
        return $this->link;
    }

    public function setLink($link)
    {
        $this->link = $link;
    }

    public function getResourceMap()
    {
        return $this->resourceMap;
    }

    public function setResourceMap($resourceMap)
    {
        $this->resourceMap = $resourceMap;
    }

    public function toWKT(): string
    {
        return '';
    }

    public function jsonSerialize()
    {
    }
}

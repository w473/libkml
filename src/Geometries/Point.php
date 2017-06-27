<?php

namespace KML\Geometries;

use KML\Features\AltitudeMode;
use KML\FieldTypes\Coordinates;

class Point extends Geometry
{

    private $extrude;
    /** @var  AltitudeMode */
    private $altitudeMode;
    /** @var  Coordinates */
    private $coordinates;

    public function clearCoordinates()
    {
        $this->coordinates = null;
    }

    public function getCoordinate(): Coordinates
    {
        return $this->coordinates;
    }

    public function setCoordinate(Coordinates $coordinates)
    {
        $this->coordinates = $coordinates;
    }

    public function toWKT(): string
    {
        $wtk_data = '';

        if (isset($this->coordinate)) {
            $wtk_data = sprintf("POINT (%s)", $this->coordinate->toWKT());
        }

        return $wtk_data;
    }


    public function toWKT2d()
    {
        $wtk_data = '';

        if (isset($this->coordinates)) {
            $wtk_data = sprintf("POINT (%s)", $this->coordinates->toWKT2d());
        }

        return $wtk_data;
    }

    public function jsonSerialize()
    {
        $jsonData = null;

        if (isset($this->coordinates)) {
            $jsonData = [
                'type'        => 'Point',
                'coordinates' => $this->coordinates
            ];
        }

        return $jsonData;
    }

    public function __toString(): string
    {
        $output = [];
        $output[] = sprintf(
            "<Point%s>",
            isset($this->id) ? sprintf(" id=\"%s\"", $this->id) : ""
        );

        if (isset($this->extrude)) {
            $output[] = sprintf("\t<extrude>%d</extrude>", $this->extrude);
        }

        if (isset($this->altitudeMode)) {
            $output[] = sprintf("\t<altitudeMode>%s</altitudeMode>", $this->altitudeMode->__toString());
        }

        if (isset($this->coordinates)) {
            $output[] = sprintf("\t<coordinates>%s</coordinates>", $this->coordinates->__toString());
        }

        $output[] = "</Point>";

        return implode("\n", $output);
    }

    public function getExtrude()
    {
        return $this->extrude;
    }

    public function setExtrude($extrude)
    {
        $this->extrude = $extrude;
    }

    public function getAltitudeMode(): AltitudeMode
    {
        return $this->altitudeMode;
    }

    public function setAltitudeMode(AltitudeMode $altitudeMode)
    {
        $this->altitudeMode = $altitudeMode;
    }
}

<?php

namespace KML\Entity\Geometry;

class MultiGeometry extends Geometry
{
    private $Geometry = [];

    public function addGeometry($geometry)
    {
        $this->Geometry[] = $geometry;
    }

    public function clearGeometry()
    {
        $this->Geometry = [];
    }

    public function jsonSerialize()
    {
        $Geometry = [];

        foreach ($this->Geometry as $geometry) {
            $Geometry = array_merge($Geometry, $geometry);
        }

        return $Geometry;
    }

    public function toWKT(): string
    {
        $Geometry = [];

        foreach ($this->Geometry as $geometry) {
            $Geometry[] = $geometry->toWTK();
        }

        return sprintf("GEOMETRYCOLLECTION(%s)", implode(",", $Geometry));
    }

    public function toWKT2d()
    {
        $Geometry = [];

        foreach ($this->Geometry as $geometry) {
            $Geometry[] = $geometry->toWKT2d();
        }

        return sprintf("GEOMETRYCOLLECTION(%s)", implode(",", $Geometry));
    }

    public function __toString(): string
    {
        $parent_string = parent::__toString();

        $output = [];
        $output[] = sprintf(
            "<MultiGeometry%s>",
            isset($this->id) ? sprintf(" id=\"%s\"", $this->id) : ""
        );
        $output[] = $parent_string;

        if (isset($this->Geometry) && is_array($this->Geometry)) {
            $Geometry_strings = [];
            foreach ($this->Geometry as $geometry) {
                $Geometry_strings[] = $geometry->__toString();
            }

            $output[] = sprintf("\t<coordinates>%s</coordinates>", implode(" ", $Geometry_strings));
        }

        $output[] = "</MultiGeometry>";

        return implode("\n", $output);
    }

    public function getGeometry()
    {
        return $this->Geometry;
    }

    public function setGeometry($Geometry)
    {
        $this->Geometry = $Geometry;
    }
}

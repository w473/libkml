<?php

namespace KML\Entity\Geometry;

class LineString extends Line
{
    public function toWKT(): string
    {
        if (count($this->coordinates)) {
            $coordinates_strings = [];

            foreach ($this->coordinates as $coordinate) {
                $coordinates_strings[] = $coordinate->toWKT();
            }

            return sprintf("LINESTRING (%s)", implode(", ", $coordinates_strings));
        }

        return "";
    }

    public function toWKT2d()
    {
        if (count($this->coordinates)) {
            $coordinates_strings = [];

            foreach ($this->coordinates as $coordinate) {
                $coordinates_strings[] = $coordinate->toWKT2d();
            }

            return sprintf("LINESTRING (%s)", implode(", ", $coordinates_strings));
        }

        return "";
    }

    public function jsonSerialize()
    {
        $jsonData = null;

        if (count($this->coordinates)) {
            $jsonData = [
                'type'        => 'LineString',
                'coordinates' => []
            ];

            foreach ($this->coordinates as $coordinate) {
                $jsonData['coordinates'][] = $coordinate;
            }
        }

        return $jsonData;
    }

    public function __toString(): string
    {
        $output = [];
        $output[] = sprintf(
            "<LineString%s>",
            isset($this->id) ? sprintf(" id=\"%s\"", $this->id) : ""
        );

        if (isset($this->extrude)) {
            $output[] = sprintf("\t<extrude>%d</extrude>", $this->extrude);
        }

        if (isset($this->tessellate)) {
            $output[] = sprintf("\t<tessellate>%d</tessellate>", $this->tessellate);
        }

        if (isset($this->altitudeMode)) {
            $output[] = sprintf("\t<altitudeMode>%s</altitudeMode>", $this->altitudeMode);
        }

        if (count($this->coordinates)) {
            $coordinates_strings = [];
            foreach ($this->coordinates as $coordinate) {
                $coordinates_strings[] = $coordinate->__toString();
            }

            $output[] = sprintf("\t<coordinates>%s</coordinates>", implode(" ", $coordinates_strings));
        }

        $output[] = "</LineString>";

        return implode("\n", $output);
    }
}

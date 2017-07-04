<?php

namespace KML\Entity\Feature\Container;

class Folder extends Container
{
    public function __toString(): string
    {
        $parent_string = parent::__toString();

        $output = [];
        $output[] = sprintf(
            "<Folder%s>",
            isset($this->id) ? sprintf(" id=\"%s\"", $this->id) : ""
        );
        $output[] = $parent_string;
        $output[] = "</Folder>";

        return implode("\n", $output);
    }

    public function jsonSerialize()
    {
        $jsonData = [];

        if (isset($this->id)) {
            $jsonData['id'] = $this->id;
        }

        $jsonData['type'] = 'FeatureCollection';
        $jsonData['properties'] = [
            'name' => $this->getName(),
            'description' => $this->getDescription()
        ];
        $jsonData['features'] = [];

        foreach ($this->getAllFeatures() as $feature) {
            $jsonFeature = $feature->jsonSerialize();
            if ($jsonFeature) {
                $jsonData['features'][] = $jsonFeature;
            }
        }
        return $jsonData;
    }
}

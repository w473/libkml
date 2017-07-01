<?php
namespace KML;

use KML\Entity\Feature\Container\Container;
use KML\Entity\Feature\Feature;
use KML\Hydrator\KMLBuilder;

/**
 * Entity default schema version
 */
define('KML_DEFAULT_SCHEMA_VERSION', '2.2');

/**
 * KML default encoding
 */
define('KML_DEFAULT_ENCODING', 'UTF-8');

class KML implements \JsonSerializable
{
    /** @var Feature */
    private $feature;
    /** @var string  */
    private $version = KML_DEFAULT_SCHEMA_VERSION;
    /** @var string  */
    private $encoding = KML_DEFAULT_ENCODING;

    public function __construct(Feature $feature = null)
    {
        $this->feature = $feature;
    }

    public function __toString(): string
    {
        $output = [];

        $output[] = sprintf("<?xml version=\"1.0\" encoding=\"%s\"?>", $this->encoding);
        $output[] = sprintf("<kml xmlns=\"http://www.opengis.net/kml/%s\">", $this->version);

        if (isset($this->feature)) {
            $output[] = $this->feature->__toString();
        }

        $output[] = '</kml>';

        return implode("\n", $output);
    }

    /**
     *  Generate WKT
     */
    public function toWKT(): string
    {
        if (isset($this->feature)) {
            if ($this->feature instanceof Container) {
                return sprintf("GEOMETRYCOLLECTION(%s)", $this->feature->toWKT());
            } else {
                return $this->feature->toWKT();
            }
        }

        return '';
    }

    /**
     *  Generate WKT without z-coordinates
     */
    public function toWKT2d(): string
    {
        if (isset($this->feature)) {
            if ($this->feature instanceof Container) {
                return sprintf("GEOMETRYCOLLECTION(%s)", $this->feature->toWKT2d());
            } else {
                return $this->feature->toWKT2d();
            }
        }

        return '';
    }

    public function jsonSerialize()
    {
        $jsonData = [];

        if (isset($this->feature)) {
            $all_features = $this->getAllFeatures();

            $jsonData['type'] = 'FeatureCollection';
            $jsonData['features'] = [];

            foreach ($all_features as $feature) {
                $json_feature = $feature->jsonSerialize();
                if ($json_feature) {
                    $jsonData['features'][] = $json_feature;
                }
            }
        }

        return $jsonData;
    }

    public function getAllStyles(): array
    {
        $all_styles = [];

        if (isset($this->feature)) {
            $all_styles = array_merge($all_styles, $this->feature->getAllStyles());
        }

        return $all_styles;
    }

    public function getAllFeatures(): array
    {
        $allFeatures = [];

        if (isset($this->feature)) {
            $allFeatures = array_merge($allFeatures, $this->feature->getAllFeatures());
        }

        return $allFeatures;
    }

    public function setFeature(Feature $feature)
    {
        $this->feature = $feature;
    }

    public function getFeature(): Feature
    {
        return $this->feature;
    }
}

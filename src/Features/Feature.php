<?php

namespace KML\Features;

use KML\FieldTypes\Atom\Author;
use KML\KMLObject;
use KML\Links\Link;
use KML\Region;
use KML\Time\TimePrimitive;
use KML\Views\AbstractView;

abstract class Feature extends KMLObject implements \JsonSerializable
{
    protected $name;
    protected $visibility;
    protected $open;
    /** @var  Author */
    protected $author;
    /** @var  Link */
    protected $link;
    protected $address;
    protected $addressDetails;
    protected $phoneNumber;
    protected $snippet;
    protected $description;
    /** @var  AbstractView */
    protected $abstractView;
    /** @var  TimePrimitive */
    protected $timePrimitive;
    protected $styleUrl;
    protected $styleSelector = [];
    /** @var  Region */
    protected $region;
    protected $extendedData;

    abstract public function toWKT(): string;

    abstract public function toWKT2d(): string;

    abstract public function jsonSerialize();

    abstract public function getAllFeatures();

    public function toExtGeoJSON()
    {
        $json_data = [];

        if (isset($this->id)) {
            $json_data['id'] = $this->id;
        }

        if (isset($this->name)) {
            $json_data['properties']['name'] = $this->name;
        }

        if (isset($this->description)) {
            $json_data['properties']['description'] = $this->description;
        }

        return $json_data;
    }

    public function addStyleSelector($styleSelector)
    {
        $this->styleSelector[] = $styleSelector;
    }

    public function clearStyleSelectors()
    {
        $this->styleSelector = [];
    }

    public function getAllStyles()
    {
        $all_styles = [];

        foreach ($this->styleSelector as $style) {
            $all_styles[] = $style;
        }

        return $all_styles;
    }

    public function __toString(): string
    {
        $output = [];

        if (isset($this->name)) {
            $output[] = sprintf("\t<name>%s</name>", htmlentities($this->name));
        }

        if (isset($this->visibility)) {
            $output[] = sprintf("\t<visibility>%s</visibility>", $this->visibility);
        }

        if (isset($this->open)) {
            $output[] = sprintf("\t<open>%s</open>", $this->open);
        }

        if (isset($this->author)) {
            $output[] = $this->author->__toString();
        }

        if (isset($this->link)) {
            $output[] = $this->link->__toString();
        }

        if (isset($this->address)) {
            $output[] = sprintf("\t<address>%s</address>", $this->address);
        }

        if (isset($this->addressDetails)) {
            $output[] = (string)$this->addressDetails;
        }

        if (isset($this->phoneNumber)) {
            $output[] = sprintf("\t<phoneNumber>%s</phoneNumber>", $this->phoneNumber);
        }

        if (isset($this->snippet)) {
            $output[] = sprintf("\t<Snippet>%s</Snippet>", $this->snippet);
        }

        if (isset($this->description)) {
            $output[] = sprintf("\t<description><![CDATA[\n%s\n]]></description>", $this->description);
        }

        if (isset($this->abstractView)) {
            $output[] = $this->abstractView->__toString();
        }

        if (isset($this->timePrimitive)) {
            $output[] = $this->timePrimitive->__toString();
        }

        if (isset($this->styleUrl)) {
            $output[] = sprintf("\t<styleUrl>%s</styleUrl>", $this->styleUrl);
        }

        if (count($this->styleSelector)) {
            foreach ($this->styleSelector as $style) {
                $output[] = $style->__toString();
            }
        }

        if (isset($this->region)) {
            $output[] = $this->region->__toString();
        }

        if (isset($this->extendedData)) {
            $output[] = (string)$this->extendedData;
        }

        return implode("\n", $output);
    }


    public function setName($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setVisibility($visibility)
    {
        $this->visibility = $visibility;
    }

    public function getVisibility()
    {
        return $this->visibility;
    }

    public function setOpen($open)
    {
        $this->open = $open;
    }

    public function getOpen()
    {
        return $this->open;
    }

    public function setAuthor(Author $author)
    {
        $this->author = $author;
    }

    public function getAuthor(): Author
    {
        return $this->author;
    }

    public function setAddress($address)
    {
        $this->address = $address;
    }

    public function getAddress()
    {
        return $this->address;
    }

    public function setAddressDetails($addressDetails)
    {
        $this->addressDetails = $addressDetails;
    }

    public function getAddressDetails()
    {
        return $this->addressDetails;
    }

    public function setPhoneNumber($phoneNumber)
    {
        $this->phoneNumber = $phoneNumber;
    }

    public function getPhoneNumber()
    {
        return $this->phoneNumber;
    }

    public function setSnippet($snippet)
    {
        $this->snippet = $snippet;
    }

    public function getSnippet()
    {
        return $this->snippet;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setAbstractView(AbstractView $abstractView)
    {
        $this->abstractView = $abstractView;
    }

    public function getAbstractView(): AbstractView
    {
        return $this->abstractView;
    }

    public function setTimePrimitive(TimePrimitive $timePrimitive)
    {
        $this->timePrimitive = $timePrimitive;
    }

    public function getTimePrimitive(): TimePrimitive
    {
        return $this->timePrimitive;
    }

    public function setStyleUrl($styleUrl)
    {
        $this->styleUrl = $styleUrl;
    }

    public function getStyleUrl()
    {
        return $this->styleUrl;
    }

    public function setStyleSelector(array $styleSelector)
    {
        $this->styleSelector = $styleSelector;
    }

    public function getStyleSelector()
    {
        return $this->styleSelector;
    }

    public function setRegion(Region $region)
    {
        $this->region = $region;
    }

    public function getRegion(): ?Region
    {
        return $this->region;
    }

    public function setExtendedData($extendedData)
    {
        $this->extendedData = $extendedData;
    }

    public function getExtendedData()
    {
        return $this->extendedData;
    }

    public function set(string $type, $value)
    {
        switch ($type) {
            case 'Region':
                $this->setRegion($value);
                break;
            case 'name':
                $this->setName($value);
                break;
            case 'visibility':
                $this->setVisibility($value);
                break;
            case 'open':
                $this->setOpen($value);
                break;
            case 'address':
                $this->setAddress($value);
                break;
            case 'phoneNumber':
                $this->setPhoneNumber($value);
                break;
            case 'Snippet':
                $this->setSnippet($value);
                break;
            case 'description':
                $this->setDescription($value);
                break;
            case 'styleUrl':
                $this->setStyleUrl($value);
                break;
        }
    }
}

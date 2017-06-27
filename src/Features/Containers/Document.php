<?php
namespace KML\Features\Containers;

class Document extends Container
{
    private $schemas = [];
  
    public function __toString(): string
    {
        $parent_string = parent::__toString();
    
        $output = [];
        $output[] = sprintf(
            "<Document%s>",
            isset($this->id)?sprintf(" id=\"%s\"", $this->id):""
        );
        $output[] = $parent_string;
    
        foreach ($this->schemas as $schema) {
            $output[] = $schema->__toString();
        }
    
        $output[] = "</Document>";
    
        return implode("\n", $output);
    }
  
    public function addSchema($schema)
    {
        $this->schemas[] = $schema;
    }
  
    public function clearSchemas()
    {
        $this->schemas = [];
    }
  
    public function getSchemas()
    {
        return $this->schemas;
    }
  
    public function setSchemas($schemas)
    {
        $this->schemas = $schemas;
    }
}

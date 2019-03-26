<?php

namespace VMaker;

use VMaker\VTable;
use \Illuminate\Contracts\Pagination\LengthAwarePaginator;

class VDataGrid extends vPrimitiveObject
{
  /**
   * @var \Illuminate\Support\Collection 
   */
  protected $data;
  
  /**
   * @var array 
   */
  protected $fields;
  
  /**
   * @var VTable
   */
  protected $table;
  
  /**
   * @var array
   */
  protected $fieldOptions = [];
  
  /**
   * @var boolean 
   */
  protected $showPagination = true;
  
  /**
   * @var array
   */
  protected $extraFields = [];
  
  /**
   * @var string
   */
  protected $rowClass = "row";
  
  public function __construct()
  {
    $this->class = "table table-hover table-responsive table-sm";
  }
  
  /**
   * Makes data grid
   * @return string
   */
  public function make()
  {
    parent::make(); 
    
    $this->table = new VTable();
    $this->table->setClass($this->class);
    $this->table->setStyle($this->style);
    $this->table->setId($this->id);
    
    if (is_array($this->fields) && sizeof($this->fields))
    {
      $this->table->openTableHead();
      
      //Pagination
      if ($this->data instanceof LengthAwarePaginator && $this->showPagination)
      {
        $colspan = sizeof($this->fields) + sizeof($this->extraFields);
        
        $this->table->openRow(["class" => $this->rowClass]);
        $this->table->openHeader("<br/>" . $this->data->links(), ["class" => "col-12", "colspan" => $colspan]);
      }
      
      //Header
      $this->table->openRow(["class" => $this->rowClass]);
      
      foreach ($this->fields as $nmField => $lbField)
      {
        $options = ["style" => "text-align: center"];
        
        if (isset($this->fieldOptions[$nmField]["class"]))
          $options = array_merge($options, ["class" => $this->fieldOptions[$nmField]["class"]]);
        
        $this->table->openHeader($lbField, $options);
      }
      
      if (sizeof($this->extraFields))
      {
        foreach ($this->extraFields as $arrExtra)
        {
          $options = ["style" => "text-align: center"];
          
          if (isset($arrExtra["colClass"]))
            $options = array_merge($options, ["class" => $arrExtra["colClass"]]);
          
          $this->table->openHeader($arrExtra["label"], $options);
        }
      }
      
      $this->table->closeTableHead();
      
      //Fields
      if (is_object($this->data))
      {
        $this->table->openTableBody();
        
        foreach ($this->data as $obj)
        {
          $this->table->openRow(["class" => $this->rowClass]);
          
          //Regular Fields
          foreach ($this->fields as $nmField => $lbField)
          {
            $options = (isset($this->fieldOptions[$nmField]) ? $this->fieldOptions[$nmField] : []);
            $this->table->openCell($obj->$nmField, $options);
          }
          
          //Extra Fields
          if (sizeof($this->extraFields))
          {
            foreach ($this->extraFields as $arrExtra)
            {
              if ($arrExtra["url"])
              {
                $url = $arrExtra["url"];
                
                if (sizeof($arrExtra["urlData"]))
                {
                  foreach ($arrExtra["urlData"] as $urlField)
                    $url .= "/{$obj->$urlField}";
                }
                
                $arrExtra["content"] = "<a href=\"{$url}\" class=\"{$arrExtra["urlClass"]}\">{$arrExtra["content"]}</a>";
              }
              
              $this->table->openCell($arrExtra["content"], ["style" => "text-align: center", "class" => $arrExtra["colClass"]]);
            }
          } //extra fields
        } //foreach ($this->data as $obj)
        
        $this->table->closeTableBody();
      } //if (is_object($this->data))
    } //if (is_array($this->fields) && sizeof($this->fields))
    
    $this->output = $this->table->make();
    
    return $this->output;
  }
  
  /**
   * @param \Illuminate\Support\Collection $data
   */
  public function setData($data)
  {
    $this->data = $data;
  }
  
  /**
   * @param array $fields
   */
  public function setFields($fields)
  {
    $this->fields = $fields;
  }
  
  /**
   * Set field align
   * @param string $field
   * @param string $align
   */
  public function setFieldAlign($field, $align)
  {
    if (strlen(trim($field)) && strlen(trim($align)))
      $this->fieldOptions[$field]["align"] = $align;
  }
  
  /**
   * Set field class
   * @param string $field
   * @param string $class
   */
  public function setFieldClass($field, $class)
  {
    if (strlen(trim($field)) && strlen(trim($class)))
      $this->fieldOptions[$field]["class"] = $class;
  }
  
  /**
   * Add extra field to grid
   * @param string $label
   * @param string $content
   * @param string $url
   * @param array $urlData
   * @param string $urlClass
   * @param string $colClass
   */
  public function addExtraField($label, $content, $url = "", $urlData = [], $urlClass = "", $colClass = "col-1")
  {
    $this->extraFields[] = [
      "label"    => $label, 
      "content"  => $content, 
      "url"      => $url, 
      "urlData"  => $urlData,
      "urlClass" => $urlClass,
      "colClass" => $colClass];
  }
  
  /**
   * @param boolean $showPagination
   */
  public function setShowPagination($showPagination)
  {
    $this->showPagination = $showPagination;
  }
  
  /**
   * @param string $rowClass
   */
  public function setRowClass($rowClass)
  {
    $this->rowClass = $rowClass;
  }
}
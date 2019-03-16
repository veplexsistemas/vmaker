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
   * Navigation Position (top or bottom)
   * @var string
   */
  protected $navigationPosition = "bottom";
  
  /**
   * @var array
   */
  protected $extraFields = [];
  
  public function __construct()
  {
    $this->class = "table table-hover table-responsive";
  }
  
  /**
   * Makes data grid
   * @return string
   */
  public function make()
  {
    parent::make(); 
    
    $this->table = new VTable();
    $this->table->setStyle("width: 100%");
    $this->table->setClass($this->class);
      
    if (is_array($this->fields) && sizeof($this->fields))
    {
      $this->table->openTableHead();
      
      //Header
      $this->table->openRow();
      
      foreach ($this->fields as $nmField => $lbField)
        $this->table->openHeader($lbField, ["style" => "text-align: center"]);
      
      if (sizeof($this->extraFields))
      {
        foreach ($this->extraFields as $arrExtra)
          $this->table->openHeader($arrExtra["label"], ["style" => "text-align: center"]);
      }
      
      $this->table->closeTableHead();
      
      //Fields
      if (is_object($this->data))
      {
        $this->table->openTableBody();
        
        foreach ($this->data as $obj)
        {
          $this->table->openRow();
          
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
              
              $this->table->openCell($arrExtra["content"]);
            }
          } //extra fields
        } //foreach ($this->data as $obj)
        
        $this->table->closeTableBody();
      } //if (is_object($this->data))
    } //if (is_array($this->fields) && sizeof($this->fields))
    
    $this->output = $this->table->make();
    
    if ($this->data instanceof LengthAwarePaginator && $this->showPagination)
    {
      $dsPagination = $this->data->links();
      
      switch ($this->navigationPosition)
      {
        case "top":    $this->output = $dsPagination . $this->output; break;
        case "bottom": $this->output .= $dsPagination;                break;
      }
    }
    
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
   * Add extra field to grid
   * @param string $label
   * @param string $content
   * @param string $url
   * @param array $urlData
   * @param string $urlClass
   */
  public function addExtraField($label, $content, $url = "", $urlData = [], $urlClass = "")
  {
    $this->extraFields[] = [
      "label"    => $label, 
      "content"  => $content, 
      "url"      => $url, 
      "urlData"  => $urlData,
      "urlClass" => $urlClass];
  }
  
  /**
   * @param boolean $showPagination
   */
  public function setShowPagination($showPagination)
  {
    $this->showPagination = $showPagination;
  }
  
  /**
   * Navigation position ("top" or "bottom")
   * @param string $navigationPosition
   */
  public function setNavigationPosition($navigationPosition)
  {
    $this->navigationPosition = $navigationPosition;
  }
}
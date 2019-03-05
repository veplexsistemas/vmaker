<?php
  namespace VMaker;
  
  use VMaker\vPrimitiveObject;
  
  use Collective\Html\FormFacade as Form;
  
  /**
   * Html Form
   */
  class VTable extends vPrimitiveObject
  {
    /**
     * @var boolean
     */
    protected $idOpenedRow;
    
    /**
     * @var string
     */
    protected $htmlInput = "";
    
    /**
     * Makes the Html Form
     * @return string Html content
     */
    public function make()
    {
      parent::make();
      
      $dsExtra = $this->formatOptions($this->arrExtra);
      
      $this->output = "<table" . (strlen($dsExtra) ? " {$dsExtra}" : "") . ">{$this->output}";
      
      if ($this->idOpenedRow)
        $this->output .= "</tr>";
      
      $this->output .= "</table>";
      
      return $this->output;
    }
    
    public function openRow($arrOptions = [])
    {
      if ($this->idOpenedRow)
        $this->output .= "</tr>";
      
      $dsExtra = $this->formatOptions($arrOptions);
      
      $this->output .= "<tr" . (strlen($dsExtra) ? " {$dsExtra}" : "") . ">";
      
      $this->idOpenedRow = true;
    }
    
    public function openHeader($content = null, $arrOptions = [])
    {
      $dsExtra = $this->formatOptions($arrOptions);
      $this->output .= "<th" . (strlen($dsExtra) ? " {$dsExtra}" : "") . ">{$content}</th>";
    }
    
    public function openCell($content = null, $arrOptions = [])
    {
      $dsExtra = $this->formatOptions($arrOptions);
      $this->output .= "<td" . (strlen($dsExtra) ? " {$dsExtra}" : "") . ">{$content}</td>";
    }
  }
<?php
  namespace VMaker;
  
  use VMaker\vPrimitiveObject;
  
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
      
      $this->closeRow();
      
      $this->output .= "</table>";
      
      return $this->output;
    }
    
    /**
     * @param array $options
     */
    public function openRow($options = [])
    {
      if ($this->idOpenedRow)
        $this->output .= "</tr>";
      
      $dsExtra = $this->formatOptions($options);
      
      $this->output .= "<tr" . (strlen($dsExtra) ? " {$dsExtra}" : "") . ">";
      
      $this->idOpenedRow = true;
    }
    
    protected function closeRow()
    {
      if ($this->idOpenedRow)
      {
        $this->output .= "</tr>";
        $this->idOpenedRow = false;
      }
    }

    /**
     * @param string $content
     * @param array $options
     */
    public function openHeader($content = null, $options = [])
    {
      $dsExtra = $this->formatOptions($options);
      $this->output .= "<th" . (strlen($dsExtra) ? " {$dsExtra}" : "") . ">{$content}</th>";
    }
    
    /**
     * @param string $content
     * @param array $options
     */
    public function openCell($content = null, $options = [])
    {
      $dsExtra = $this->formatOptions($options);
      $this->output .= "<td" . (strlen($dsExtra) ? " {$dsExtra}" : "") . ">{$content}</td>";
    }
    
    /**
     * Table head ("thead" tag)
     * @param array $options
     */
    public function openTableHead($options = [])
    {
      $this->closeRow();
      $dsExtra = $this->formatOptions($options);
      
      $this->output .= "<thead" . (strlen($dsExtra) ? " {$dsExtra}" : "") . ">";
    }
    
    /**
     * Close table head ("thead" tag)
     */
    public function closeTableHead()
    {
      $this->closeRow();
      $this->output .= "</thead>";
    }
    
    /**
     * Table body ("tbody" tag)
     * @param type $options
     */
    public function openTableBody($options = [])
    {
      $this->closeRow();
      $dsExtra = $this->formatOptions($options);
      
      $this->output .= "<tbody" . (strlen($dsExtra) ? " {$dsExtra}" : "") . ">";
    }
    
    /**
     * Close table body ("tbody" tag)
     */
    public function closeTableBody()
    {
      $this->closeRow();
      $this->output .= "</tbody>";
    }
    
    /**
     * Table foot ("tfoot" table)
     * @param array $options
     */
    public function openTableFoot($options)
    {
      $this->closeRow();
      $dsExtra = $this->formatOptions($options);
      
      $this->output .= "<tfoot" . (strlen($dsExtra) ? " {$dsExtra}" : "") . ">";
    }
    
    /**
     * Close table foot
     */
    public function closeTableFoot()
    {
      $this->closeRow();
      $this->output .= "</tfoot>";
    }
  }
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
     * @param array $arrOptions
     * @return string
     */
    protected function formatOptions($arrOptions)
    {
      $dsExtra = "";
      
      if (is_array($arrOptions) && sizeof($arrOptions))
      {  
        foreach ($arrOptions as $key => $dsExtraContent)
        {
          if (!is_numeric($key))
            $dsExtra .= "{$key}=\"{$dsExtraContent}\" ";
          else
            $dsExtra .= "{$dsExtraContent} ";
        }
        
        $dsExtra = trim($dsExtra);
      }
      
      return $dsExtra;
    }
    
    /**
     * Makes the Html Form
     * @return string Html content
     */
    public function make()
    {
      parent::make();
      
      if ($this->idOpenedRow)
        $this->output .= "</tr>";
      
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
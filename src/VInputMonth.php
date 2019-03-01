<?php
  namespace VMaker;
  
  use VMaker\VObject;
  
  use Collective\Html\FormFacade as Form;
  
  /**
   * Input Month Html
   */
  class VInputMonth extends VObject
  {
    /**
     * Constructor
     * @param string $id
     * @param mixed $defaultValue
     */
    public function __construct($id, $defaultValue = null)
    {
      parent::__construct($id, $defaultValue);
    }
    
    /**
     * Make object html
     */
    public function make()
    {
      parent::make();
      
      Form::macro('month', function($name, $default, $arrExtra)
      {
        if (is_array($arrExtra) && sizeof($arrExtra))
        {
          $dsExtra = "";
          
          foreach ($arrExtra as $key => $dsExtraContent)
          {
            if (!is_numeric($key))
              $dsExtra .= "{$key}=\"{$dsExtraContent}\" ";
            else
              $dsExtra .= "{$dsExtraContent} ";
          }
          
          $dsExtra = trim($dsExtra);
        }
        
        $dsComponent = "<input type=\"month\" name=\"$name\"";
        $dsComponent .= ($dsExtra ? " {$dsExtra}" : "");
        $dsComponent .= ($default ? " value=\"{$default}\"" : "");
        
        return $dsComponent;
      });
      
      $this->output .= Form::month($this->name, $this->defaultValue, $this->arrExtra);
      
      if ($this->useDiv)
        $this->output .= "</div>";
      
      echo $this->output;
    }
  }
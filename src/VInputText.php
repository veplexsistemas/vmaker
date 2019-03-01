<?php
  namespace VMaker;
  
  use VMaker\VObject;
  
  use Collective\Html\FormFacade as Form;
  
  /**
   * Input Text Html
   */
  class VInputText extends VObject
  {
    public function __construct($id, $defaultValue = null)
    {
      parent::__construct($id, $defaultValue);
    }
    
    public function make()
    {
      parent::make();
      $this->output .= Form::text($this->name, $this->defaultValue, $this->arrExtra) . "</div>";
      
      echo $this->output;
    }
  }
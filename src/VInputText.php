<?php
  namespace VMaker;
  
  use VMaker\VObject;
  
  use Collective\Html\FormFacade as Form;
  
  class VInputText extends VObject
  {
    protected $placeholder;
    
    public function __construct($id, $defaultValue = null)
    {
      parent::__construct($id, $defaultValue);
    }
    
    public function make()
    {
      parent::make();
      
      $arrExtra = ['id' => $this->id, 'class' => $this->class];
      $this->output .= Form::text($this->name, $this->defaultValue, $arrExtra) . "</div>";
      
      return $this->output;
    }
    
    function setPlaceholder($placeholder)
    {
      $this->placeholder = $placeholder;
    }
    
  }

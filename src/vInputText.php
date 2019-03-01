<?php
  namespace vMaker\html;
  
  use vMaker\html\vObject;
  
  use Collective\Html\FormFacade as Form;
  
  class vInputText extends vObject
  {
    protected $placeholder;
    
    public function __construct($id, $defaultValue)
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

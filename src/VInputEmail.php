<?php
  namespace VMaker;
  
  use VMaker\VObject;
  
  use Collective\Html\FormFacade as Form;
  
  /**
   * Input Email Html
   */
  class VInputEmail extends VObject
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
      $this->output .= Form::text($this->name, $this->defaultValue, $this->arrExtra);
      
      if ($this->useDiv)
        $this->output .= "</div>";
      
      echo $this->output;
    }
  }
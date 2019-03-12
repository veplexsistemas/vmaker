<?php
  namespace VMaker;
  
  use VMaker\VObject;
  
  use Collective\Html\FormFacade as Form;
  
  /**
   * Input Reset Html
   */
  class VInputReset extends VObject
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
     * Makes the Html Object
     * @return string
     */
    public function make()
    {
      parent::make();
      $this->output .= Form::reset($this->defaultValue, $this->arrExtra);
      
      if ($this->useDiv)
        $this->output .= "</div>";
      
      return $this->output;
    }
  }
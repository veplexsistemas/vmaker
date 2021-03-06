<?php
  namespace VMaker;
  
  use VMaker\VObject;
  
  use Collective\Html\FormFacade as Form;
  
  /**
   * Input Password Html
   */
  class VInputPassword extends VObject
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
      $this->output .= Form::password($this->name, $this->arrExtra);
      
      if ($this->useDiv)
        $this->output .= "</div>";
      
      return $this->output;
    }
  }
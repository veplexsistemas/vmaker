<?php
  namespace VMaker;
  
  use VMaker\VObject;
  
  use Collective\Html\FormFacade as Form;
  
  /**
   * Input Number Html
   */
  class VInputNumber extends VObject
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
      $this->output .= Form::number($this->name, $this->defaultValue, $this->arrExtra);
      
      if ($this->useDiv)
        $this->output .= "</div>";
      
      return $this->output;
    }
    
    /**
     * @param int $max
     */
    public function setMax($max)
    {
      $this->arrExtra["max"] = $max;
    }
    
    /**
     * @param int $min
     */
    public function setMin($min)
    {
      $this->arrExtra["min"] = $min;
    }
  }
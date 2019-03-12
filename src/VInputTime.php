<?php
  namespace VMaker;
  
  use VMaker\VObject;
  
  use Collective\Html\FormFacade as Form;
  
  /**
   * Input Time Html
   */
  class VInputTime extends VObject
  {
    /**
     * @var int
     */
    protected $step;
    
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
      
      if ($this->step)
        $this->arrExtra["step"] = $this->step;
      
      $this->output .= Form::time($this->name, $this->defaultValue, $this->arrExtra);
      
      if ($this->useDiv)
        $this->output .= "</div>";
      
      return $this->output;
    }
    
    /**
     * @param int $step
     */
    public function setStep($step)
    {
      $this->step = $step;
    }
  }
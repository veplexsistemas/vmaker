<?php
  namespace VMaker;
  
  use VMaker\VObject;
  
  use Collective\Html\FormFacade as Form;
  
  /**
   * Input File Html
   */
  class VInputFile extends VObject
  {
    /**
     * @var boolean 
     */
    protected $multiple = false;
    
    /**
     * @var string 
     */
    protected $accept;
    
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
      
      if ($this->multiple)
        $this->arrExtra = array_merge(['multiple'], $this->arrExtra);
      
      if ($this->accept)
        $this->arrExtra = array_merge(['accept' => $this->accept], $this->arrExtra);
      
      $this->output .= Form::file($this->name, $this->arrExtra);
      
      if ($this->useDiv)
        $this->output .= "</div>";
      
      return $this->output;
    }
    
    /**
     * @param boolean $multiple
     */
    public function setMultiple($multiple)
    {
      $this->multiple = $multiple;
    }
    
    /**
     * @param string $accept
     */
    public function setAccept($accept)
    {
      $this->accept = $accept;
    }
  }
<?php
  namespace VMaker;
  
  use VMaker\vPrimitiveObject;
  
  use Collective\Html\FormFacade as Form;
  
  /**
   * Html Form
   */
  class vForm extends vPrimitiveObject
  {
    /**
     * @var string
     */
    protected $action;
    
    /**
     * @var string
     */
    protected $method;
    
    /**
     * @var string
     */
    protected $target;
    
    /**
     * @var boolean
     */
    protected $autocomplete;
    
    /**
     * @var string
     */
    protected $htmlInput = "";
    
    /**
     * Makes the Html Form
     * @return string Html content
     */
    public function make()
    {
      parent::make();
      
      if (strlen(trim($this->action)))
        $this->arrExtra["action"] = $this->action;
      
      if (strlen(trim($this->method)))
        $this->arrExtra["method"] = $this->method;
      
      if (strlen(trim($this->target)))
        $this->arrExtra["target"] = $this->target;
      
      if (is_bool($this->autocomplete))
        $this->arrExtra["autocomplete"] = ($this->autocomplete === true ? "on" : "off");
      
      //Output
      $this->output = "";
      $this->output .= Form::open($this->arrExtra);
      $this->output .= $this->htmlInput;
      $this->output .= Form::close();
      
      return $this->output;
    }
    
    public function addInputField(&$object)
    {
      if ($object instanceof VObject)
        $this->htmlInput .= $object->make();
    }
    
    /**
     * @param string $action
     */
    public function setAction($action)
    {
      $this->action = $action;
    }
    
    /**
     * @param string $method
     */
    public function setMethod($method)
    {
      $this->method = $method;
    }
    
    /**
     * @param string $target
     */
    public function setTarget($target)
    {
      $this->target = $target;
    }

    /**
     * @param boolean $autocomplete
     */
    public function setAutocomplete($autocomplete)
    {
      $this->autocomplete = $autocomplete;
    }
  }

<?php
  namespace VMaker;
  
  use VMaker\vPrimitiveObject;
  
  use Collective\Html\FormFacade as Form;
  
  /**
   * Html Form
   */
  class VForm extends vPrimitiveObject
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
    protected $enctype;
    
    /**
     * @var string
     */
    protected $htmlInput = "";
    
    /**
     * @var Illuminate\Database\Eloquent\Model
     */
    protected $modelBinding;
    
    /**
     * @var mixed
     */
    protected $modelBindingId;
    
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
      
      if (strlen(trim($this->enctype)))
        $this->arrExtra["enctype"] = $this->enctype;
      
      //Output
      $this->output = "";
      
      if ($this->model)
      {
        $route = ["route" => [$this->action, $this->modelBindingId]];
        $this->output .= Form::model($this->modelBinding, array_merge($route, $this->arrExtra));
      }
      else
        $this->output .= Form::open($this->arrExtra);
      
      $this->output .= $this->htmlInput;
      $this->output .= Form::close();
      
      return $this->output;
    }
    
    /**
     * @param VObject $object
     */
    public function addInputField(&$object)
    {
      if ($object instanceof VObject)
        $this->htmlInput .= $object->make();
      
      if ($object instanceof VInputFile)
        $this->enctype = "multipart/form-data";
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
    
    /**
     * @param string $enctype
     */
    public function setEnctype($enctype)
    {
      $this->enctype = $enctype;
    }
    
    public function setModelBinding(Illuminate\Database\Eloquent\Model $model, $modelId = null)
    {
      $this->modelBinding   = $model;
      $this->modelBindingId = $modelId;
    }
  }

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
     * @var object
     */
    protected $model;
    
    /**
     * @var boolean
     */
    protected $idModel = false;
    
    /**
     * @var \Illuminate\Support\ViewErrorBag
     */
    protected $errors;
    
    /**
     * @var boolean
     */
    protected $idOpenedRow;
    
    /**
     * @var boolean
     */
    protected $idOpenedCell;
    
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
      
      if (is_object($this->errors))
      {
        if ($this->errors->any())
        {
          $this->output .= "<div class=\"alert alert-danger\"><ul>";
          
          foreach ($this->errors->all() as $teste)
            $this->output .= "<li>{$teste}</li>";
            
          $this->output .= "</ul></div>";
        }
      }
      
      $this->output .= Form::open($this->arrExtra);
      
      $this->output .= $this->htmlInput;
      
      if ($this->idOpenedCell)
        $this->output .= "</div>";
      
      if ($this->idOpenedRow)
        $this->output .= "</div>";
      
      $this->output .= Form::close();
      
      return $this->output;
    }
    
    /**
     * @param VObject $object
     */
    public function addInputField(&$object)
    {
      if ($this->model && !$this->idModel)
      {
        Form::model($this->model);
        $this->idModel = true;
      }
      
      if ($object instanceof VObject)
      {
        if (is_object($this->errors))
          $object->setErrors($this->errors);
        
        $this->htmlInput .= $object->make();
      }
      
      if ($object instanceof VInputFile)
        $this->enctype = "multipart/form-data";
      
      if ($this->idOpenedCell)
      {
        $this->htmlInput .= "</div>";
        $this->idOpenedCell = false;
      }
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
    
    /**
     * @param object $model
     */
    public function setModel($model)
    {
      $this->model = $model;
    }
    
    public function setErrors(\Illuminate\Support\ViewErrorBag $errors)
    {
      $this->errors = $errors;
    }
    
    /**
     * Open row div for input field
     * @param string $class
     * @param array $options
     * @return string Html content
     */
    public function openRow($class = "row", $options = [])
    {
      if (!strlen(trim($class)))
        return;
      
      if ($this->idOpenedRow)
        $this->htmlInput .= "</div>";
      
      $dsExtra = $this->formatOptions($options);
      
      $this->htmlInput .= "<div class=\"{$class}\"" . (strlen($dsExtra) ? " {$dsExtra}" : "") . ">";
      
      $this->idOpenedRow = true;
    }
    
    /**
     * Open col div for input field
     * @param string $class
     * @param array $options
     * @return string Html content
     */
    public function openCell($class = "col", $options = [])
    {
      if (!strlen(trim($class)))
        return;
      
      if ($this->idOpenedCell)
        $this->htmlInput .= "</div>";
      
      $dsExtra = $this->formatOptions($options);
      
      $this->htmlInput .= "<div class=\"{$class}\"" . (strlen($dsExtra) ? " {$dsExtra}" : "") . ">";
      
      $this->idOpenedCell = true;
    }
    
    /**
     * Add Html content on form
     * @param string $content
     */
    public function addContent($content)
    {
      if (!strlen(trim($content)))
        return;
      
      $this->htmlInput .= $content;
    }
  }
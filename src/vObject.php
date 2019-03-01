<?php
  namespace vmaker\html;
  
  /**
   * @author Veplex Sistemas de Informação
   */
  abstract class vObject
  {
    /**
     * Object id
     * @var string
     */
    protected $id;
    
    /**
     * Object name
     * @var string
     */
    protected $name;
    
    /**
     * Object class
     * @var string
     */
    protected $class;
    
    /**
     * Object Label
     * @var string
     */
    protected $label;
    
    /**
     * Object default value
     * @var mixed
     */
    protected $defaultValue;
    
    /**
     * @var string
     */
    protected $output;
    
    /**
     * Constructor
     * @param string $id
     * @param mixed $defaultValue
     */
    public function __construct($id, $defaultValue)
    {
      $this->setId($id);
      $this->setDefaultValue($defaultValue);
      $this->setName("f_{$this->id}");
      
      $this->output = "";
    }
    
    public function make()
    {
      $this->output .= "<div class=\"form-group\">";
      
      if (strlen(trim($this->label)))
        $this->output .= "<label for=\"{$this->id}\">{$this->label}</label>";
    }
    
    /**
     * @param string $id
     */
    public function setId($id)
    {
      $this->id = $id;
    }
    
    /**
     * @param string $class
     */
    public function setClass($class)
    {
      $this->class = $class;
    }
    
    /**
     * @param string $label
     */
    public function setLabel($label)
    {
      $this->label = $label;
    }
    
    /**
     * @param mixed $defaultValue
     */
    public function setDefaultValue($defaultValue)
    {
      $this->defaultValue = $defaultValue;
    }
    
    /**
     * @param string $name
     */
    function setName($name)
    {
      $this->name = $name;
    }
  }

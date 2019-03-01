<?php
  namespace VMaker;
  
  /**
   * Base class for to make html elements
   * @author Veplex Sistemas de Informação
   */
  abstract class VObject
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
    protected $class = "form-control";
    
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
     * @var boolean
     */
    protected $readonly;
    
    /**
     * @var boolean
     */
    protected $disabled;
    
    /**
     * @var int
     */
    protected $size;
    
    /**
     * @var int
     */
    protected $maxlength;
    
    /**
     * @var boolean
     */
    protected $required;
    
    /**
     * @var string
     */
    protected $placeholder;
    
    /**
     * @var boolean
     */
    protected $useDiv = true;

    /**
     * @var string
     */
    protected $divName = "form-group";
    
    /**
     * JS style
     * @var string
     */
    protected $style;
    
    /**
     * @var string
     */
    protected $output;
    
    /**
     * @var array
     */
    protected $arrExtra = array();
    
    /**
     * Constructor
     * @param string $id
     * @param mixed $defaultValue
     */
    public function __construct($id, $defaultValue = null)
    {
      $this->setId($id);
      $this->setDefaultValue($defaultValue);
      $this->setName("f_{$this->id}");
      
      $this->output = "";
    }
    
    /**
     * Make object html
     */
    public function make()
    {
      if ($this->useDiv)
        $this->output .= "<div class=\"{$this->divName}\">";
      
      if (strlen(trim($this->label)))
        $this->output .= "<label for=\"{$this->id}\">{$this->label}</label>";
      
      $this->arrExtra = array_merge(['id' => $this->id, 'class' => $this->class], $this->arrExtra);
      
      if ($this->disabled)
        $this->arrExtra = array_merge(['disabled'], $this->arrExtra);
      
      if ($this->maxlength)
        $this->arrExtra = array_merge(['maxlength' => $this->maxlength], $this->arrExtra);
      
      if ($this->readonly)
        $this->arrExtra = array_merge(['readonly'], $this->arrExtra);
      
      if ($this->required)
        $this->arrExtra = array_merge(['required'], $this->arrExtra);
      
      if (strlen(trim($this->placeholder)))
        $this->arrExtra = array_merge(['placeholder' => $this->placeholder], $this->arrExtra);
      
      if (strlen($this->style))
        $this->arrExtra = array_merge(['style' => $this->style], $this->arrExtra);
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
    public function setName($name)
    {
      $this->name = $name;
    }
    
    /**
     * @param boolean $readonly
     */
    public function setReadonly($readonly)
    {
      $this->readonly = $readonly;
    }
    
    /**
     * @param boolean $disabled
     */
    public function setDisabled($disabled)
    {
      $this->disabled = $disabled;
    }
    
    /**
     * @param int $size
     */
    public function setSize($size)
    {
      $this->size = $size;
    }
    
    /**
     * @param int $maxlength
     */
    public function setMaxlength($maxlength)
    {
      $this->maxlength = $maxlength;
    }
    
    /**
     * @param boolean $required
     */
    public function setRequired($required)
    {
      $this->required = $required;
    }
    
    /**
     * @param string $placeholder
     */
    public function setPlaceholder($placeholder)
    {
      $this->placeholder = $placeholder;
    }
    
    /**
     * @param boolean $useDiv
     */
    function setUseDiv($useDiv)
    {
      $this->useDiv = $useDiv;
    }
    
    /**
     * @param string $divName
     */
    function setDivName($divName)
    {
      $this->divName = $divName;
    }
    
    /**
     * @param string $style
     */
    function setStyle($style)
    {
      $this->style = $style;
    }
  }
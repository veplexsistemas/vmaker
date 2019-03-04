<?php
  namespace VMaker;
  
  use VMaker\VObject;
  
  use Collective\Html\FormFacade as Form;
  
  /**
   * Input Select Html
   */
  class VInputSelect extends VObject
  {
    /**
     * Select Options
     * @var array
     */
    protected $options = array();
    
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
      $this->output .= Form::select($this->name, $this->options, $this->defaultValue, $this->arrExtra);
      
      if ($this->useDiv)
        $this->output .= "</div>";
      
      return $this->output;
    }
    
    /**
     * @param array $options
     */
    public function setOptions($options)
    {
      if (is_array($options) && sizeof($options))
      {
        foreach ($options as $key => $value)
        {
          if (is_array($value))
          {
            if (isset($value["value"]))
              $this->options[$value["value"]] = $value["description"];
            else
              $this->options[$value[0]] = $value[1];
          }
          else
            $this->options[$key] = $value;
        }
      }
    }
    
    /**
     * @param boolean $opcional
     */
    public function setOpcional($opcional = true)
    {
      if ($opcional)
        $this->options = array_merge(["" => ""], $this->options);
    }
    
    /**
     * Add Option to Select field
     * @param mixed $value
     * @param mixed $description
     */
    public function addOption($value, $description)
    {
      $this->options[$value] = $description;
    }
  }
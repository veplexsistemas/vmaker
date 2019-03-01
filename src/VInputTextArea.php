<?php
  namespace VMaker;
  
  use VMaker\VObject;
  
  use Collective\Html\FormFacade as Form;
  
  /**
   * Input TextArea Html
   */
  class VInputTextArea extends VObject
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
     * Make object html
     */
    public function make()
    {
      parent::make();
      $this->output .= Form::textarea($this->name, $this->defaultValue, $this->arrExtra);
      
      if ($this->useDiv)
        $this->output .= "</div>";
      
      echo $this->output;
    }
    
    /**
     * Set TextArea size
     * @param int $cols
     * @param int $rows
     */
    public function setSize($cols, $rows)
    {
      $this->arrExtra["cols"] = $cols;
      $this->arrExtra["rows"] = $rows;
    }
  }
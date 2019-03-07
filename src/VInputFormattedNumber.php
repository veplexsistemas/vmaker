<?php
  namespace VMaker;
  
  use VMaker\VObject;
  
  use Collective\Html\FormFacade as Form;
  
  /**
   * Input Formatted Number Html
   */
  class VInputFormattedNumber extends VObject
  {
    /**
     * @var int
     */
    protected $precision = 2;
    
    /**
     * @var boolean
     */
    protected $allowNegative = false;
    
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
      $this->output .= Form::text($this->name, $this->defaultValue, $this->arrExtra);
      
      if ($this->useDiv)
        $this->output .= "</div>";
      
      $this->output .= "<script>$('#{$this->id}').maskMoney({precision: {$this->precision}, allowNegative: {$this->allowNegative}, thousands: '.', decimal: ','}); </script>";
      
      return $this->output;
    }
    
    /**
     * @param int $precision
     */
    function setPrecision($precision)
    {
      $this->precision = $precision;
    }
    
    /**
     * @param boolean $allowNegative
     */
    function setAllowNegative($allowNegative)
    {
      $this->allowNegative = $allowNegative;
    }
  }
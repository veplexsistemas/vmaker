<?php
  namespace VMaker;
  
  abstract class vPrimitiveObject
  {
    /**
     * @var string
     */
    protected $id;
    
    /**
     * @var string
     */
    protected $class;
    
    /**
     * @var string
     */
    protected $name;
    
    /**
     * @var string
     */
    protected $style;
    
    /**
     * @var string
     */
    protected $output = "";
    
    /**
     * @var array
     */
    protected $arrExtra = array();
    
    /**
     * Makes the Html Object
     */
    public function make()
    {
      if (strlen(trim($this->id)))
        $this->arrExtra["id"] = $this->id;
      
      if (strlen(trim($this->class)))
        $this->arrExtra["class"] = $this->class;
      
      if (strlen(trim($this->name)))
        $this->arrExtra["name"] = $this->name;
      
      if (strlen(trim($this->style)))
        $this->arrExtra["style"] = $this->style;
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
     * @param string $name
     */
    public function setName($name)
    {
      $this->name = $name;
    }
    
    /**
     * @param string $style
     */
    public function setStyle($style)
    {
      $this->style = $style;
    }
    
    /**
     * @param array $arrOptions
     * @return string
     */
    protected function formatOptions($arrOptions)
    {
      $dsExtra = "";
      
      if (is_array($arrOptions) && sizeof($arrOptions))
      {  
        foreach ($arrOptions as $key => $dsExtraContent)
        {
          if (!is_numeric($key))
            $dsExtra .= "{$key}=\"{$dsExtraContent}\" ";
          else
            $dsExtra .= "{$dsExtraContent} ";
        }
        
        $dsExtra = trim($dsExtra);
      }
      
      return $dsExtra;
    }
  }
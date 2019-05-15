<?php
  namespace VMaker;
  
  use VMaker\vPrimitiveObject;
  use VMaker\VPanel;
  
  use Collective\Html\FormFacade as Form;
  
  /**
   * Makes a div with session values from array
   */
  class VSessionFilter extends vPrimitiveObject
  {
    /**
     * @var array
     */
    protected $data;
    
    /**
     * @var string
     */
    protected $panelClass = "panel panel-success";
    
    /**
     * @var string
     */
    protected $panelTitle = "Filtros";
    
    /**
     * @var string
     */
    protected $fieldDivClass = "alert alert-warning alert-dismissible";
    
    
    /**
     * @var array
     */
    protected $fieldOptions = array();
    
    /**
     * Makes the div with filters
     * @return string Html content
     */
    public function make()
    {
      parent::make();
      
      //Output
      $this->output = "";
      
      if (is_array($this->data) && sizeof($this->data))
      {
        $idFilter = false;
        $out = "";
        
        $out .= <<<JS
          <script>
            function tese(field)
            {
              var csrf_token = $('meta[name=\"csrf-token\"]').attr('content');
              data           = {'field': field, '_token': csrf_token};
              
              $.ajax({
                url: '',
                data: data,
                type: 'POST',
                success: function(nomeUf){
                  
                }
              });
            }
          </script>
                
JS;
        
        foreach ($this->data as $var => $label)
        {
          if ($vl = session($var))
          {
            $idFilter = true;
            
            $class = $this->fieldDivClass;
            
            if (isset($this->fieldOptions[$var]["class"]))
              $class .= " {$this->fieldOptions[$var]["class"]}";
            
            $out .= "<div class=\"{$class}\" role=\"alert\">";
            $out .= "<button onClick=\"\" type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button>";
            
            
            $out .= "<p><b>{$label}</b></p>";
            $out .= "<p>{$vl}</p>";
            $out .= "</div>";
          }
        }
        
        $panel = new VPanel();
        $panel->setClass($this->panelClass);
        $panel->addHeading($this->panelTitle);
        $panel->addBody($out);
        
        $this->output = $panel->make();
      }
      
      return $this->output;
    }
    
    /**
     * Array with session vars
     * <br/>Session var => label
     * @param array $data
     */
    public function setData($data)
    {
      $this->data = $data;
    }
    
    /**
     * Set extra class for field
     * @param string $field
     * @param string $class
     */
    public function setFieldExtraClass($field, $class)
    {
      if (strlen(trim($field)) && strlen(trim($class)))
        $this->fieldOptions[$field]["class"] = $class;
    }
    
    /**
     * Filter panel class
     * @param string $panelClass
     */
    public function setPanelClass($panelClass)
    {
      $this->panelClass = $panelClass;
    }

    /**
     * Filter Panel title
     * @param string $panelTitle
     */
    public function setPanelTitle($panelTitle)
    {
      $this->panelTitle = $panelTitle;
    }
  }
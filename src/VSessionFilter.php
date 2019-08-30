<?php
  namespace VMaker;
  
  use VMaker\vPrimitiveObject;
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
     * Route to clean session
     * @var string
     */
    protected $route;
    
    /**
     * @var array
     */
    protected $fieldCallback = array();
    
    /**
     * @var string
     */
    protected $divTextClass = "text";
    
    /**
     * @var string
     */
    protected $divButtonClass = "icon text-white-50";
    
    /**
     * Constructor
     * @param string $route (Route to clean session)
     */
    public function __construct($route)
    {
      $this->route = $route;
      $this->class = "btn btn-info btn-icon-split btn-sm";
    }
    
    /**
     * Makes the div with filters
     * @return string Html content
     */
    public function make()
    {
      if (!strlen(trim($this->route)))
        return;
      
      parent::make();
      
      //Output
      $this->output = "";
      
      if (is_array($this->data) && sizeof($this->data))
      {
        $this->output = "";
        
        $this->output .= <<<JS
          <script>
            function cleanFilter(field)
            {
              var csrf_token = $('meta[name=\"csrf-token\"]').attr('content');
              data           = {'field': field, '_token': csrf_token};
              
              $.ajax({
                headers: {'X-CSRF-Token': csrf_token},
                url: '{$this->route}',
                data: data,
                type: 'POST',
                success: function(result){
                  self.location.reload();
                },
                error: function(response){
                  Swal.fire({
                    type: 'error',
                    title: 'Oops...',
                    text: 'Erro ao excluir filtro',
                  }).then((result) => {
                    location.reload();
                  });
                }
              });
            }
          </script>
JS;
        
        foreach ($this->data as $var => $label)
        {
          if (strlen(trim(session($var))))
          {
            $vl = session($var);
            
            if (isset($this->fieldCallback[$var]))
            {
              $callback   = $this->fieldCallback[$var]["callback"];
              $parameters = array_merge([$vl], $this->fieldCallback[$var]["parameters"]);
              
              $vl = call_user_func_array($callback, $parameters);
            }
            
            $this->output .= <<<HTML
              <a href="#" style="cursor:default" class="{$this->class}">
                <span class="{$this->divTextClass}><b>{$label}</b>: {$vl}</span>
                  <span class="{$this->divButtonClass}">
                    <button type="button" class="close" aria-label="Dismiss" onClick="cleanFilter('{$var}')">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </span>
              </a>
HTML;
          }
        }
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
     * CallBack
     * @param string $field
     * @param string $callback function
     * @param array $parameters function params
     */
    public function setFieldCallback($field, $callback, $parameters = [])
    {
      if (strlen(trim($field)) && strlen(trim($callback)))
      {
        if (function_exists($callback))
        {
          $this->fieldCallback[$field] = [
              "callback" => $callback,
              "parameters" => $parameters
          ];
        }
      }
    }
    
    /**
     * @param string $divTextClass
     */
    public function setDivTextClass($divTextClass)
    {
      $this->divTextClass = $divTextClass;
    }
    
    /**
     * @param string $divButtonClass
     */
    function setDivButtonClass($divButtonClass)
    {
      $this->divButtonClass = $divButtonClass;
    }
  }
<?php
  namespace VMaker;
  
  use VMaker\VObject;
  
  use Collective\Html\FormFacade as Form;
  
  /**
   * Input Duallist Html
   */
  class VInputDualList extends VObject
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
     * Add Option to Select field
     * @param mixed $value
     * @param mixed $description
     */
    public function addOption($value, $description)
    {
      $id = sizeof($this->options);
      
      $this->options[$id]["value"]       = $value;
      $this->options[$id]["description"] = $description;
    }
    
    /**
     * Makes the Html Object
     * @return string
     */
    public function make()
    {
      parent::make();
      
      Form::macro('duallist', function($arrExtra, $arrData)
      {
        $dsComponent = "";
         
        function formatOptions($arrExtra, $arrIgnore = [])
        {
          $dsExtra = "";
          
          if (is_array($arrExtra) && sizeof($arrExtra))
          {
            foreach ($arrExtra as $key => $dsExtraContent)
            {
              if (in_array($key, $arrIgnore))
                continue;
              
              if (!is_numeric($key))
                $dsExtra .= "{$key}=\"{$dsExtraContent}\" ";
              else
                $dsExtra .= "{$dsExtraContent} ";
            }

            $dsExtra = trim($dsExtra);
          }  
          
          return $dsExtra;
        }
        
        $dsExtra            = formatOptions($arrExtra);
        $dsExtraDestination = formatOptions($arrExtra, ["id", "name"]);
        
        $dsComponent .= <<<STR
          <script type="text/javascript">
  
            function selectAll(id)
            {
              $('document').ready(function(){

                var id_campo = '#' + id + '_destination';

                for(i = 0; i < $(id_campo)[0].length; i++)
                  $(id_campo)[0].options[i].selected = true;
              });
            }

            function addOption(id)
            {
                $('#'+id).val().forEach(a => {
                    $('#'+id+'_destination').append($('#'+id).find("[value='"+a+"']"));
                });

                selectAll(id);
            }

            function addAll(id)
            {
                $('#'+id+'_destination').append($('#'+id+' option'));

                selectAll(id);
            }

            function remove(id)
            {
                $('#'+id+'_destination').val().forEach(a => {
                    $('#'+id).append($('#'+id+'_destination').find("[value='"+a+"']"));
                });

                selectAll(id);
            }

            function removeAll(id)
            {
                $('#'+id).append($('#'+id+'_destination option'));
                selectAll(id);
            }
          </script>      
STR;
        
        $id     = $arrExtra["id"]; 
        $dsData = print_r(json_encode($arrData), true);
        
        $dsComponent .= <<< STR
          @php
                \$arrData = json_decode('$dsData');
                \$id = '$id';
          @endphp
                
          <div class="row duallist-veplex">
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">            
              <div class="duallist-select-veplex">
                <select multiple {$dsExtra}>
                  @forelse (\$arrData as \$obj)
                    <option value={{ \$obj->value }}>{{ \$obj->description }}</option>
                  @empty      
                  @endforelse
                </select>
            </div>
                
            <div class="duallist-actions-vmaker">
                <input type="button" class="btn-veplex" id="{{ \$id }}_btn_allleft"  value="<<" onclick="removeAll('{{ \$id }}')"> 
                <input type="button" class="btn-veplex" id="{{ \$id }}_btn_left"     value="<"  onclick="remove('{{ \$id }}')">
                <input type="button" class="btn-veplex" id="{{ \$id }}_btn_right"    value=">"  onclick="addOption('{{ \$id }}')">            
                <input type="button" class="btn-veplex" id="{{ \$id }}_btn_allright" value=">>" onclick="addAll('{{ \$id }}')">    
            </div>
          </div>
          
          <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
            <div class="duallist-select-veplex">
              <select multiple id="{{ \$id }}_destination" name="f_{{ \$id }}_destination[]" {$dsExtraDestination}>
              </select>
            </div>
          </div>
        </div>          
STR;
        
        return $dsComponent;
      });
      
      $this->output .= Form::duallist($this->arrExtra, $this->options);
      
      return $this->output;
    }
  }
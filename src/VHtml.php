<?php
  namespace VMaker;
  
  use Wcadena\StringBladeCompiler\Facades\StringView as StringView;
  
  class VHtml
  {
    /**
     * @var string
     */
    protected $layout;
    
    /**
     * @var boolean
     */
    protected $idOpenedSection = false;
    
    /**
     * @var string
     */
    protected $output;
    
    /**
     * Construct
     * @param string $layout
     */
    public function __construct($layout)
    {
      $this->setLayout($layout);
    }
    
    /**
     * @param string $section
     */
    public function openSection($section)
    {
      if (strlen(trim($section)))
      {
        if ($this->idOpenedSection)
          $this->output .= $this->closeSection();
        
        $this->output .= "@section('$section')";
        
        $this->idOpenedSection = true;
      }
    }
    
    /**
     * Close section
     */
    public function closeSection()
    {
      $this->output .= "@endsection";
    }
    
    /**
     * @param string $layout
     */
    public function setLayout($layout)
    {
      if (strlen(trim($layout)))
      {
        $this->layout = $layout;
        $this->output .= "@extends('{$this->layout}')";
      }
    }
    
    /**
     * @param string $content
     */
    public function addContent($content)
    {
      if (strlen(trim($content)))
        $this->output .= $content;
    }
    
    /**
     * Add object to HTML
     * @param object $object (Instance of VForm, VTable or VObject)
     */
    public function addObject($object)
    {
      if ($object instanceof vPrimitiveObject || $object instanceof VObject)
        $this->output .= $object->make();
    }
    
    /**
     * @param string $view
     */
    public function includeView($view)
    {
      if (strlen(trim($view)))
        $this->output .= "@include('{$view}')";
    }

    /**
     * @param string $script
     * @param string $type
     */
    public function addScript($script, $type = "text/javascript")
    {
      if (strlen(trim($script)))
        $this->output .= "<script type='{$type}'>{$script}</script>";
    }
    
    /**
     * @param string $style
     */
    public function addStyle($style)
    {
      if (strlen(trim($style)))
        $this->output .= "<style>{$style}</style>";
    }
    
    /**
     * Makes Html
     * @return string
     */
    public function make()
    {
      if ($this->idOpenedSection)
        $this->output .= $this->closeSection();
      
      return StringView::make($this->output)->render();
    }
  }
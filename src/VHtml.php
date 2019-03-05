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
     * @var string
     */
    protected $output;
    
    /**
     * Construct
     * @param string $layout
     */
    public function __construct($layout = null)
    {
      $this->setLayout($layout);
    }
    
    /**
     * @param string $section
     */
    public function openSection($section)
    {
      $this->output .= "@section('$section')";
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
      if ($object instanceof VForm || $object instanceof VTable || $object instanceof VObject)
        $this->output .= $object->make();
    }
    
    /**
     * Makes Html
     * @return string
     */
    public function make()
    {
      return StringView::make($this->output)->render();
    }
  }
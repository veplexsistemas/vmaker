<?php
  namespace VMaker;
  
  class VPanel extends vPrimitiveObject
  {
    /**
     * @var string
     */
    protected $headingClass = "panel-heading";
    
    /**
     * @var string
     */
    protected $bodyClass = "panel-body";
    
    /**
     * @var string
     */
    protected $footerClass = "panel-footer";
    
    public function __construct()
    {
      $this->class = "panel panel-default";
    }
    
    /**
     * @param string $content
     */
    public function addHeading($content)
    {
      $this->output .= "<div class=\"{$this->headingClass}\">{$content}</div>";
    }
    
    /**
     * @param string $content
     */
    public function addBody($content)
    {
      $this->output .= "<div class=\"{$this->bodyClass}\">{$content}</div>";
    }
    
    /**
     * @param string $content
     */
    public function addFooter($content)
    {
      $this->output .= "<div class=\"panel-footer\">{$content}</div>";
    }
    
    public function make()
    {
      parent::make();
      
      $this->output = "<div {$this->formatOptions($this->arrExtra)}>" . $this->output . "</div>";
      return $this->output;
    }
  }
<?php
  namespace VMaker;
  
  class VCard extends vPrimitiveObject
  {
    /**
     * @var string
     */
    protected $headerClass = "card-header";
    
    /**
     * @var string
     */
    protected $bodyClass = "card-body";
    
    /**
     * @var string
     */
    protected $footerClass = "card-footer";
    
    
    public function __construct()
    {
      $this->class = "card";
    }
    
    /**
     * @param string $content
     */
    public function addHeader($content)
    {
      $this->output .= "<div class=\"{$this->headerClass}\">{$content}</div>";
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
      $this->output .= "<div class=\"{$this->footerClass}\">{$content}</div>";
    }
    
    public function make()
    {
      parent::make();
      $this->output = "<div {$this->formatOptions($this->arrExtra)}>" . $this->output . "</div>";
      return $this->output;
    }
    
    /**
     * @param string $headerClass
     */
    public function setHeaderClass($headerClass)
    {
      $this->headerClass = $headerClass;
    }
    
    /**
     * @param string $bodyClass
     */
    public function setBodyClass($bodyClass)
    {
      $this->bodyClass = $bodyClass;
    }

    /**
     * @param string $footerClass
     */
    public function setFooterClass($footerClass)
    {
      $this->footerClass = $footerClass;
    }
  }
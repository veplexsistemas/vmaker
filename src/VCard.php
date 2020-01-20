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
    protected $headerId = "";
    
    /**
     * @var string
     */
    protected $bodyClass = "card-body";
    
    /**
     * @var string
     */
    protected $bodyId = "";
    
    /**
     * @var string
     */
    protected $footerClass = "card-footer";
    
    /**
     * @var string
     */
    protected $footerId = "";
    
    public function __construct()
    {
      $this->class = "card";
    }
    
    /**
     * @param string $content
     */
    public function addHeader($content)
    {
      $this->output .= "<div class=\"{$this->headerClass}\" id=\"{$this->headerId}\">{$content}</div>";
    }
    
    /**
     * @param string $content
     */
    public function addBody($content)
    {
      $this->output .= "<div class=\"{$this->bodyClass}\" id=\"{$this->bodyId}\">{$content}</div>";
    }
    
    /**
     * @param string $content
     */
    public function addFooter($content)
    {
      $this->output .= "<div class=\"{$this->footerClass}\" id=\"{$this->footerId}\">{$content}</div>";
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
    
    /**
     * @param string $bodyId
     */
    public function setBodyId(string $bodyId)
    {
        $this->bodyId = $bodyId;
    }
    
    /**
     * @param string $headerId
     */
    public function setHeaderId(string $headerId)
    {
        $this->headerId = $headerId;
    }
    
    /**
     * @param string $footerId
     */
    public function setFooterId(string $footerId)
    {
        $this->footerId = $footerId;
    }
  }
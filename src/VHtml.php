<?php
  namespace VMaker;
  
  use Wcadena\StringBladeCompiler\Facades\StringView as StringView;
  
  class VHtml
  {
    protected $layout;
    
    protected $output = "";
    
    public function __construct($layout)
    {
      $this->setLayout($layout);
    }
    
    public function setLayout($layout)
    {
      $this->layout = $layout;
    }
    
    public function make()
    {
      $this->output .= "";
      return StringView::make("@extends('layouts.app')")->render();
    }
  }

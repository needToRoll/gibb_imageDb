<?php

/**
 * Created by PhpStorm.
 * User: bbuerf
 * Date: 26.05.2016
 * Time: 13:32
 */
class View
{
    private $template;
    private $arguments;

    /**
     * View constructor.
     * @param $template
     * @param $arguments
     */
    public function __construct($template, $arguments = array())
    {
        $this->template = __DIR__."/templates/".$template.".php";
        $this->arguments = $arguments;
    }


    public function fetch(){
        ob_start();
        $this->render();
        return ob_get_clean();
    }

    public function render(){
        // print "rendering starded";
        $parent_view = $this;
        foreach ($this->arguments as $arg){
            ${$arg} = $arg;
        }
        if (file_exists($this->template)) {
            require_once $this->template;
        } else {
            print ("template nicht gefunden");
        }
    }

    public function insideRender($innerTemplate, $args = array()){
        $innerView = new View($innerTemplate,$args);
        $innerView->render();

        
    }

    /**
     * @return mixed
     */
    public function getTemplate()
    {
        return $this->template;
    }

    /**
     * @return mixed
     */
    public function getArguments()
    {
        return $this->arguments;
    }

    public function __get($name){
        if (isset($this->arguments[$name])) {
            return $this->arguments[$name];
        } else{
            return null;
        }
    }

    public function __set($name, $value){
        $this->arguments[$name] = $value;
    }

}
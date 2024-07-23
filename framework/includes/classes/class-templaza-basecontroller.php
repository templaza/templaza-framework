<?php

namespace TemPlazaFramework\Controller;

defined( 'ABSPATH' ) || exit;

use TemPlazaFramework\Admin\Admin_Page_Function;
use TemPlazaFramework\Admin\Admin_Page;
use TemPlazaFramework\Admin\Application;
use TemPlazaFramework\Functions;

if(!class_exists('TemPlazaFramework\Controller\BaseController')){

    class BaseController{

        protected $name;
        protected $theme_name;
        protected $text_domain;
        protected $theme_config_registered;

        protected $cache        = array();
        protected $layout       = 'default';
        protected $methods      = array();
        protected $basePath     = '';
        protected $properties     = array();
        protected $default_view = 'dashboard';

        /**
         * Array of class methods to call for a given task.
         *
         * @var    array
         */
        protected $action_map;

        /**
         * The mapped task that was performed.
         *
         * @var    string
         */
        protected $do_task;

        protected static $instance;
        // phpcs:disable WordPress.Security.NonceVerification.Recommended, WordPress.Security.NonceVerification.Missing

        public function __construct($config = array()){
            $this -> text_domain    = Functions::get_my_text_domain();
            if(isset($config['theme_name'])) {
                $this -> theme_name = $config['theme_name'];
            }
            if(isset($config['theme_config_registered'])) {
                $this -> theme_config_registered = $config['theme_config_registered'];
            }

            if(isset($config['basePath'])){
                $this -> basePath   = $config['basePath'];
            }

            $this -> action_map = array();

            $r = new \ReflectionClass($this);
            $rMethods = $r->getMethods(\ReflectionMethod::IS_PUBLIC);

            // Determine the methods to exclude from the base class.
            $xMethods   = get_class_methods('TemPlazaFramework\Controller\BaseController');
            $xMethods   = $xMethods?$xMethods:array();

            foreach ($rMethods as $rMethod)
            {
                $mName = $rMethod->getName();

                // Add default display method if not explicitly declared.
                if ($mName === 'display' || !in_array($mName, $xMethods))
                {
                    $this->methods[] = strtolower($mName);

                    // Auto register the methods as tasks.
                    $this->action_map[strtolower($mName)] = $mName;
                }
            }
        }

        public static function getInstance($prefix = '', $config = array()){

            $page   = $_REQUEST['page']?$_REQUEST['page']:'';

            $basePath = array_key_exists('basePath', $config) ? $config['basePath'] : TEMPLAZA_FRAMEWORK_CORE_INCLUDES_PATH.'/admin';
            $path       = $basePath.'/controllers';
            $type       = preg_replace('/^'.TEMPLAZA_FRAMEWORK.'[-_]?/i', '', $page);

            if($page && !$type){
                $type   = 'dashboard';
            }

            if(!$type){
                $type   = 'Base';
            }

            $file       = $path . '/' . $type.'controller.php';

            if(!$prefix && is_admin()){
                $prefix = 'TemPlazaFramework\Admin\Controller\\';
            }elseif(!$prefix && !is_admin()){
                $prefix = 'TemPlazaFramework\Controller\\';
            }else{
                $prefix .= '\\';
            }

            if(!file_exists($file)){
                $type       = 'base';
                $prefix     = 'TemPlazaFramework\Controller\\';
                $file       = TEMPLAZA_FRAMEWORK_CORE_INCLUDES_PATH . '/classes/class-templaza-basecontroller.php';
            }

            // Get the controller class name.
            $class = $prefix.ucfirst($type).'Controller';

            if (!class_exists($class) && $type && file_exists($file))
            {
                require_once $file;
            }

            if(!class_exists($class)){
                return false;
            }

            // Instantiate the class, store it to the static container, and return it
            return new $class($config);
        }

        /**
         * Method to get the controller name
         *
         * The dispatcher name is set by default parsed using the classname, or it can be set
         * by passing a $config['name'] in the class constructor
         *
         */
        public function get_name()
        {
            if (empty($this->name))
            {
                $page   = $_GET['page']?$_GET['page']:($_POST['page']?$_POST['page']:'');
                $name   = preg_replace('/^'.TEMPLAZA_FRAMEWORK.'[-_]?/i', '', $page);

                $this -> name   = $name;
                if($page == TEMPLAZA_FRAMEWORK){
                    $this -> name   = 'dashboard';
                }
            }

            return $this->name;
        }

        public function render(){

        }

        public function display($view = ''){
            if(!$view){
                if($name = $this -> get_name()){
                    $view   = $name;
                }elseif($this -> default_view){
                    $view   = $this -> default_view;
                }
            }

            if($file = Admin_Page_Function::get_template_file($this -> get_layout(), $view)){
                $result = require_once $file;
                return $result;
            }

            return false;
        }

        public function get_layout(){
            $layout = (isset($_GET['layout']) && $_GET['layout'])?$_GET['layout']:$this -> layout;
            return $layout;
        }

        public function set_layout($layout){
            $this -> layout = $layout;
        }

        public function load_template($tmpl = null){

            $func   = Admin_Page_Function::get_template_directory();

            $file   = $func.'/'.$this -> get_name().'/'.$this -> get_layout().($tmpl?'_'.$tmpl:'').'.php';

            if(file_exists($file)){
                include $file;
            }
        }


        /**
         * Execute a task by triggering a method in the derived class.
         *
         * @param   string  $action  The task to perform. If no matching task is found, the '__default' task is executed, if defined.
         *
         * @return  mixed   The value returned by the called method.
         *
         * @throws  \Exception
         */
        public function execute($action)
        {
            $this->task = $action;

            $action = strtolower($action);

            if (isset($this->action_map[$action]))
            {
                $doTask = $this->action_map[$action];
            }
            elseif (isset($this->action_map['__default']))
            {
                $doTask = $this->action_map['__default'];
            }
            else
            {
                $app    = Application::get_instance();
                /* translators: %s - Action. */
                $app -> enqueue_message(sprintf(esc_html__('Action %s not found.'), esc_html($action)), 'error');
            }

            // Record the actual task being fired
            $this->do_task = $doTask;

            return $this->$doTask();
        }

        public function set($property, $value = null)
        {
            $previous   = isset($this -> {$property})?$this -> {$property}:null;
            $previous   = !$previous && isset($this->properties[$property]) ? $this->properties[$property] : null;

            if(isset($this->{$property})){
                $this->{$property} = $value;
            }else {
                $this->properties[$property] = $value;
            }

            return $previous;
        }

        public function get($property, $default = null)
        {
            if (isset($this->$property))
            {
                return $this->$property;
            }elseif (isset($this->properties[$property]))
            {
                return $this->properties[$property];
            }

            return $default;
        }
    }
}
<?php

namespace TemPlazaFramework\Admin;

defined('TEMPLAZA_FRAMEWORK') or exit();

if(!class_exists('TemPlazaFramework\Admin\Application')){

    class Application extends Admin_Page_Function {

        protected $_message_queue   = array();
        protected static $instance;

        public function __construct()
        {

        }

        public static function get_instance(){
            if(self::$instance && self::$instance instanceof Application){
                return self::$instance;
            }

            self::$instance = new Application();
            return self::$instance;
        }

//        public function init(){
//
//            if(is_admin()){
//                require_once TEMPLAZA_FRAMEWORK_INSTALLATION_ADMIN_PATH . '/installation_admin.php';
//                $admin = new Installation_Admin();
//                $admin -> init();
////                add_action('init', array($admin, 'init'));
//            }
//        }

        public function enqueue_message($msg, $type = 'message', $options = array()){

            // Don't add empty messages.
            if (trim($msg) === '')
            {
                return;
            }

            // For empty queue, if messages exists in the session, enqueue them first.
            $messages = $this->get_message_queue();

            $message = array('message' => $msg, 'type' => strtolower($type), 'options' => $options);

            if (!in_array($message, $this->_message_queue))
            {
                // Enqueue the message.
                $this->_message_queue[] = $message;
            }
            if( empty(session_id()) && !headers_sent()){
                session_start();
            }
            $_SESSION[TEMPLAZA_FRAMEWORK . '_application.queue']   = $this -> _message_queue;
        }

        public function get_message_queue($clear = false)
        {
            // For empty queue, if messages exists in the session, enqueue them.
            if (!$this->_message_queue)
            {
                if( empty(session_id()) && !headers_sent()){
                    session_start();
                }
                $sessionQueue = (isset($_SESSION[TEMPLAZA_FRAMEWORK . '_application.queue'])
                    && $_SESSION[TEMPLAZA_FRAMEWORK . '_application.queue'])?
                    $_SESSION[TEMPLAZA_FRAMEWORK . '_application.queue']:array();

                if ($sessionQueue)
                {
                    $this->_message_queue = is_array($sessionQueue)?array_unique($sessionQueue):$sessionQueue;
                    $_SESSION[TEMPLAZA_FRAMEWORK . '_application.queue']   = array();
                }
            }

            $messageQueue = $this->_message_queue;

            if ($clear)
            {
                $this->_message_queue = array();
            }

            return $messageQueue;
        }
    }
}
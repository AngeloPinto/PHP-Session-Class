<?php 

/**
 * PHP library for handling sessions.
 *
 * @author    Angelo R. Pinto 
 * @copyright 2019 (c) Angelo - PHP-Session
 * @license   https://opensource.org/licenses/MIT - The MIT License (MIT)
 * @link      https://github.com/angelopinto
 * @version   1.0.0
 */

class Session {

    private $session_name  =  'CENTRAL_ONLINE';  // Name of Session
    private $life_time     =  1;                 // Minutes to expirate
    private $url_timeout   =  'sair.php';
    private $domain        =  'localhost';
    private $show_echo     =  true;

    private $secure        =  true;
    private $httponly      =  true;    

    // ; --------------------------------------------- 
    // ; PUBLIC FUNCTIONS
    // ; --------------------------------------------- 

    public function start(){
        $this->session_create();
    }

    public function validate($redirect = true){
        
        if ($this->session_validate() == false){
            $this->destroy();
            if ($redirect == true) {
                $this->redirect($this->url_timeout);
            }
        }

    }

    public function is_valid(){
        return $this->session_validate();
    }   
    public function destroy(){
        
        session_unset();

        $_SESSION = array();

        $params = session_get_cookie_params();
        setcookie($this->session_name, '', time() - 42000, $params["path"], $params["domain"], $params["secure"], $params["httponly"]);

        @session_destroy();

        if ($this->show_echo) {echo "<br>session destroied";}

    }    

    public function redirect($url = '', $permanent = false) {
        if ($url == '') {
            $url = $this->url_timeout;
        }
        header('Location: ' . $url, true, $permanent ? 301 : 302);
    }    

    public function print_session(){
        echo "<hr>";
        echo 'PRINT $_SESSION';
        if (isset($_SESSION)) {
            echo("<pre>"); 
            print_r($_SESSION);
            echo("</pre>"); 
        } else {
            echo("<pre>"); 
            echo "There's no SESSION created.";
            echo("</pre>"); 
        }
    }

    
    // ; --------------------------------------------- 
    // ; PRIVATE FUNCTIONS 
    // ; --------------------------------------------- 

    private function now(){
        return date('Y-m-d H:i:s');
    }

    private function new_time_out(){
        return date('Y-m-d H:i:s',strtotime('+' . $this->life_time . 'minutes', strtotime(date('Y-m-d H:i:s'))));
    }    

    private function check_session_id(){
        if (isset($_COOKIE[$this->session_name])) {
            return true;
        } else {
            return false;
        }
    }    

    private function session_validate(){

        // Active de Session
        if ($this->session_activate() == false){
            return false;
        }
    
        if (isset($_SESSION['time_out'])) {
            
            $time_out = $_SESSION['time_out'];
            $now      = $this->now();

            if ($now > $time_out) {

                if ($this->show_echo) {echo "<br>session expired";}
                return false;

            } else {
                
                $_SESSION['last_access'] = $this->now();;
                $_SESSION['time_out']    = $this->new_time_out();
                
                if ($this->show_echo) {echo "<br>session ok";}
                return true;

            }

        } else {

            if ($this->show_echo) {echo "<br>session don't created";}
            return false;

        }
    }    

    private function session_activate(){
        $session_id = $this->get_session_id();
        if ($session_id != false) {
            session_id($session_id);
            session_name($this->session_name);
            @session_start();
            return true;
        } else {
            return false;
        }
    }

    private function get_session_id(){
        if (isset($_COOKIE[$this->session_name])) {
            if ($this->show_echo) { echo $_COOKIE[$this->session_name];}
            return $_COOKIE[$this->session_name];
        } else {
            if ($this->show_echo) {echo "don't exist cookie";}
            //$this->destroy();
            return false;
        }
    }     

    private function session_create(){

        // Clear session if exists
        if (session_id() !== '') {
            $this->destroy();
        }

        // Cache defined as PRIVATE
        session_cache_limiter('PRIVATE');

        // Time to expire session cache in minutes
        session_cache_expire($this->life_time);

        // Set Session Name
        session_name($this->session_name);

        // Initialize Session
        session_start();

        // Time Limite
        set_time_limit(0);

        $_SESSION['session_id']   = session_id();
        $_SESSION['time_out']     = $this->new_time_out();
        $_SESSION['session_name'] = $this->session_name;
        $_SESSION['created']      = $this->now();

        if ($this->show_echo) { echo "<br>Session Created"; }

    }


} // [END CLASS]
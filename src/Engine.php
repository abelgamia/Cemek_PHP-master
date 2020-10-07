<?php
namespace src;

class Engine
{
    
    private $ses_name = 'gosc';
    
    private $ses_id;
    
    private $kuki_exp = 30 * 24 * 3600;
    
    public function start()
    {
        $this->sesja();
        $control = new Control();
        // $model = new User();
        View::show('dach');
        $control->uchoGet();
        $control->uchoPost();
        View::show('stopka');
    }
    
    public function sesja()
    {
        if (! empty($_SESSION)) {
            session_destroy();
        }
        if (! isset($_COOKIE[$this->getSes_name()])) {
            session_name($this->getSes_name());
            session_start([
                'cookie_lifetime' => $this->getKuki_exp()
            ]);
            $this->setSes_id(session_id());
        } else {
            session_name($this->getSes_name());
            $this->setSes_id($_COOKIE[$this->getSes_name()]);
            session_id($this->getSes_id());
            session_start([
                'cookie_lifetime' => $this->getKuki_exp()
            ]);
        }
    }
    
    private function getKuki($kuki_name) {
        if (isset($_COOKIE[$kuki_name])) {
            return $_COOKIE[$kuki_name];
        } else {
            return FALSE;
        }
    }
    private function setKuki($kuki_name, $kuki_value) {
        setcookie($kuki_name, $kuki_value, time() + $this->getKuki_exp());
        return TRUE;
    }
    
    private function getSes_name()
    {
        return $this->ses_name;
    }
    
    private function getSes_id()
    {
        return $this->ses_id;
    }
    
    private function setSes_id($ses_id)
    {
        $this->ses_id = $ses_id;
    }
    
    private function getKuki_exp()
    {
        return $this->kuki_exp;
    }
}


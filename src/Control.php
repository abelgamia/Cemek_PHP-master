<?php
namespace src;

class Control
{
    
    public function uchoGet()
    {
        if (! $_GET) {
            return View::show('index');
        }
        if ($_GET) {
            $linki = (int) $_GET['linki'];
            switch ($linki) {
                case 1:
                    return View::show('alfa');
                    break;
                    
                case 2:
                    return View::show('bravo');
                    break;
                    
                case 3:
                    return View::show('certo');
                    break;
                    
                case 4:
                    return View::show('delta');
                    break;
                    
                case 5:
                    return View::show('echo');
                    break;
                    
                case 6:
                    return View::show('register');
                    break;
                    
                case 7:
                    return View::show('admin');
                    break;
                    
                default:
                    return View::show('index');
                    break;
            }
            unset($_GET);
        }
    }
    
    public function uchoPost()
    {
        if ($_POST) {
            $model = new User();
            if (isset($_POST['form_login'])) {
                return $model->login($_POST['form_login']['login'], $_POST['form_login']['pass']);
            }
            if (isset($_POST['form_regist'])) {
                return $model->register($_POST['form_regist']['new_login'], $_POST['form_regist']['new_email'], $_POST['form_regist']['new_pass'], $_POST['form_regist']['new_pass2']);
            }
            if (isset($_POST['form_admin_newemail'])) {
                return $model->newEmail($_POST['form_admin_newemail']['new_email'], $_POST['form_admin_newemail']['pass']);
            }
            if (isset($_POST['form_admin_newpass'])) {
                return $model->newPass($_POST['form_admin_newpass']['pass'], $_POST['form_admin_newpass']['new_pass'], $_POST['form_admin_newpass']['new_pass2']);
            }
            if (isset($_POST['form_admin_del'])) {
                return $model->delUser();
            }
            unset($_POST);
        }
    }
}


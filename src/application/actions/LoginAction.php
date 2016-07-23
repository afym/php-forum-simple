<?php 

class LoginAction extends ActionBase
{
    public function doRequest()
    {
         if ($this->isLogin()) {
            $this->redirect('/welcome');
        }

        $login = $this->data()->login($this->post('name'), $this->post('password'));

        if ($login !== null) {
            $this->setKey('login', true);
            $this->setKey("fullName", "{$login['nombre']} {$login['apellido']}");
            $this->redirect('/welcome');
        }
    }
}
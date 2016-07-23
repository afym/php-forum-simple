<?php 

class HomeAction extends ActionBase
{
    public function doRequest()
    {
        if ($this->isLogin()) {
            $this->redirect('/welcome');
        }

        $this->bootstrap->renderView('/login/form.phtml', array('a' => 'as'));
    }
}
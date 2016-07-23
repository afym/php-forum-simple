<?php 

class WelcomeAction extends ActionBase
{
    public function doRequest()
    {
        if (!$this->isLogin()) {
            $this->redirect('');
        }

        $this->bootstrap->renderView('/welcome/home.phtml', [
            'fullName' => "{$this->getKey('fullName')}",
        ]);
    }
}
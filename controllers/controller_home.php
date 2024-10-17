<?php
class Controller_Home extends Controller
{
    public function action_index()
    {
        $this->view->generate('home_view.php', 'template_view.php');
    }
}
?>

<?php
class Controller_About extends Controller
{
    public function action_index()
    {
        $this->view->generate('about_view.php', 'template_view.php');
    }
}
?>

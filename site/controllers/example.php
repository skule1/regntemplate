<?php
defined('_JEXEC') or die;

use Joomla\CMS\MVC\Controller\BaseController;

class RegnControllerExample extends BaseController
{
    public function getData()
    {
        // Set the view format to JSON
        $this->input->set('view', 'example');
        $this->input->set('format', 'json');

        // Call the parent display method to render the view
        parent::display();
    }
}

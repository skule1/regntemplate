<?php
//echo 'update<br>';
//defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\MVC\Controller\BaseController;
use Joomla\CMS\Response\JsonResponse;

//echo 'controller<br>';












class RegnController extends BaseController
{


    public function display($cachable = false, $urlparams = [])
    {
        $view = $this->input->getCmd('view', 'defaultview'); // Set the default view
        $this->input->set('view', $view);

        return parent::display($cachable, $urlparams);
    }

    // public function execute($task)
    // {
    //     // Execute the task passed in the URL
    //     parent::execute($task);
    // }

    public function execute($task)
    {
        // Check which subcontroller to use based on task
        if (strpos($task, 'products.') === 0) {
            require_once JPATH_COMPONENT . '/controllers/default.php';
            $controller = new RegnControllerProducts();
        } else {
            // Fallback to the main controller or other subcontrollers
            return parent::execute($task);
        }

        // Execute the task in the subcontroller
        $controller->execute(str_replace('default.', '', $task));
        $controller->redirect();
    }





    // public function displayw($cachable = false, $urlvars = array())
    // {
    //     echo 'display controller<br>';
    //     $input = JFactory::getApplication()->input;
    //     $view = $input->get('view', 'yourview');

    //     // Set the view to the JSON view
    //     $this->input->set('format', 'json');
    //     parent::display($cachable, $urlvars);
    // }
    // // public function abc()
    // // {
    // //     // Set view
    // //     JRequest::setVar('view', 'Abc');
    // //     parent::display();
    // // }

    // public function abc()
    // {
    //     echo 'abc controller';
    //     $this->setRedirect(JRoute::_('index.php?option=com_regnt&task=.display'));
    //     $result = "hallooo";
    //     echo json_encode($result);
    //     JFactory::getApplication()->close();
    // }
}

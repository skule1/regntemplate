<?php
namespace Example\Component\Example\Administrator\Controller;

use Joomla\CMS\MVC\Controller\BaseController;
use Joomla\CMS\Factory;
use Joomla\CMS\Response\JsonResponse;

defined('_JEXEC') or die;

class AjaxController extends BaseController
{
    public function execute($task)
    {
        // Make sure we are called through AJAX
        if (!Factory::getApplication()->input->get('tmpl') === 'component') {
            throw new \Exception('Direct access not allowed', 403);
        }

        // Perform different actions based on the task
        switch ($task) {
            case 'getData':
                $this->getData();
                break;

            default:
                throw new \Exception('Invalid task', 400);
        }
    }

    protected function getData()
    {
        // Example data, you can fetch from the database or other sources
        $data = [
            'name' => 'Joomla',
            'version' => '4.x'
        ];

        // Return a JSON response
        echo new JsonResponse($data);
        Factory::getApplication()->close();
    }
}

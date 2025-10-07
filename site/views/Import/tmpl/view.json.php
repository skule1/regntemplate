<?php
defined('_JEXEC') or die;

use Joomla\CMS\MVC\View\JsonView;
echo 'view.abc.tmpl';
class RegnViewAbc extends JsonView
{
    public function display($tpl = null)
    {
        // Get data from the model
        $model = $this->getModel();
        $data = $model->getSomeData();

        // Prepare the response data
        $response = array(
            'status' => 'success',
            'data' => $data
        );

        // Set the response (this will automatically be converted to JSON)
        $this->setData($response);

        // Call the parent display method to return the JSON response
        parent::display($tpl);
    }
}

<?php
defined('_JEXEC') or die;

use Joomla\CMS\MVC\View\JsonView;
echo 'view.abc.tmpl';
class RegnViewJson extends JsonView
{
    public function display($tpl = null)
    {
        echo 'JSON RegnViewJson tmpl<br>';
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

<?php
class Address extends BaseController
{
    public function handleAjaxRequest()
    {
        $model = new AddressModel();
        $data = [];
        $type = isset($_GET['type']) ? $_GET['type'] : '';
        $parentId = isset($_GET['parentId']) ? $_GET['parentId'] : '';

        switch ($type) {
            case 'districts':
                $data = $model->getDistricts($parentId);
                break;
            case 'wards':
                $data = $model->getWards($parentId);
                break;
            default:
                break;
        }

        echo json_encode($data);
    }
}

// Create an instance of the controller and handle the request
$addressController = new Address();
$addressController->handleAjaxRequest();

<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 02.11.15
 * Time: 20:05
 */

namespace Controllers;


use Layer\Manager\DeviceManager;
use Layer\Manager\VendorManager;
use Twig\TwigAccess;

class DeviceController {

    private $model;
    private $vendorModel;

    public function __construct($connectDb)
    {
        $this->model = new DeviceManager($connectDb);
        $this->vendorModel = new VendorManager($connectDb);
    }

    public function indexAction()
    {
        $allDevices = $this->model->getAll();
         return TwigAccess::twigRender('/Device/TableDevices.html.twig',
            ['devices' => $allDevices]);
    }

    public function addDeviceAction()
    {
        if (isset($_GET['deviceModel'])) {
            $this->model->insert([
                'vendor' => $_GET['vendor'],
                'deviceModel' => $_GET['deviceModel'],
                'screenSize' => $_GET['screenSize']
            ]);
            return $this->indexAction();
        }
        $allVendors = $this->vendorModel->getAll();
        return TwigAccess::twigRender('/Device/addForm.html.twig', ['vendors' => $allVendors]);
    }

    public function updateDeviceAction()
    {
        if (isset($_GET['deviceModel'])) {
            $this->model->update($_GET['id'],
                ['id_vendor' => $_GET['vendor'],
                    'deviceModel' => $_GET['deviceModel'],
                    'screenSize' => $_GET['screenSize']
                ]);
            return $this->indexAction();
        }
        $allVendors = $this->vendorModel->getAll();
        $updateDevice = $this->model->find($_GET['id']);
        return TwigAccess::twigRender('/Device/updateForm.html.twig',['vendors' => $allVendors,
            'updateDevice' => $updateDevice]);
    }

    public function deleteDeviceAction()
    {
        if (isset($_GET['id'])) {
            return TwigAccess::twigRender('confirmDelete.html.twig',
                [
                    'id' => $_GET['id'],
                    'action' => 'deleteDevice',
                    'controller' => 'device']);
        }

        $this->model->delete($_GET['confirmedId']);
        return $this->indexAction();


    }

}
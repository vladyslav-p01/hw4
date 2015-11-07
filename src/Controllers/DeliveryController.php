<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 07.11.15
 * Time: 9:41
 */

namespace Controllers;


use Layer\Manager\DeliveryManager;
use Twig\TwigAccess;
use Layer\Manager\VendorManager;
use Layer\Manager\DeviceManager;

class DeliveryController {
    private $model;

    public function __construct($connectDb)
    {
        $this->model = new DeliveryManager($connectDb);
        $this->vendorModel = new VendorManager($connectDb);
        $this->deviceModel = new DeviceManager($connectDb);
    }

    public function indexAction()
    {
        $allDelivery = $this->model->getAll();
        return TwigAccess::twigRender('/Delivery/TableDelivery.html.twig',
            ['allDelivery' => $allDelivery]);
    }

    public function addDeliveryAction()
    {
        if (isset($_GET['deliveryData'])) {
            $this->model->insert($_GET['deliveryData']);
            return $this->indexAction();
        }
        $allVendors = $this->vendorModel->getAll();
        $allDevices = $this->deviceModel->getAll();
        return TwigAccess::twigRender('/Delivery/DeliveryForm.html.twig',
            ['products' => $allDevices, 'vendors' => $allVendors]);
    }

    public function updateDeliveryAction()
    {
        if (isset($_GET['deliveryData'])) {
            $this->model->update($_GET['id'],$_GET['deliveryData']);
            return $this->indexAction();
        }
        $delivery = $this->model->find($_GET['id']);
        $allVendors = $this->vendorModel->getAll();
        $allDevices = $this->deviceModel->getAll();
        return TwigAccess::twigRender('/Delivery/DeliveryForm.html.twig',
            [
                'vendors' => $allVendors,
                'products' => $allDevices,
                'delivery' => $delivery
            ]);
    }

    public function deleteDeliveryAction()
    {
        if (isset($_GET['id'])) {
            return TwigAccess::twigRender('confirmDelete.html.twig',
                [
                    'id' => $_GET['id'],
                    'action' => 'deleteDelivery',
                    'controller' => 'delivery'
                ]);
        }

        $this->model->delete($_GET['confirmedId']);
        return $this->indexAction();


    }
}
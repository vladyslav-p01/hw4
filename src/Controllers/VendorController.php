<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 02.11.15
 * Time: 20:05
 */

namespace Controllers;

use Controllers\DeviceController;
use Layer\Manager\VendorManager;
use Twig\TwigAccess;

class VendorController {

    private $model;
    public function __construct($connectDb)
    {
        $this->model = new VendorManager($connectDb);
    }

    public function indexAction()
    {
        $allVendors = $this->model->getAll();
        return TwigAccess::twigRender('/Vendor/TableVendors.html.twig',
            ['vendors' => $allVendors]);
    }

    public function addVendorAction()
    {
        if (isset($_GET['nameVendor'])) {
            $this->model->insert($_GET['nameVendor']);
            return $this->indexAction();
        }
        return TwigAccess::twigRender('/Vendor/VendorForm.html.twig', ['action' => 'addVendor']);
    }

    public function updateVendorAction()
    {
        if (isset($_GET['idVendorToDb'])) {
            $this->model->update($_GET['idVendorToDb'],$_GET['nameVendor']);
            return $this->indexAction();
        }
        $vendor = $this->model->find($_GET['id']);
        return TwigAccess::twigRender('/Vendor/VendorForm.html.twig',
            ['action' => 'updateVendor', 'vendor' => $vendor]);
    }

    public function deleteVendorAction()
    {
        if (isset($_GET['confirmedId'])) {
            $this->model->delete($_GET['confirmedId']);
            return $this->indexAction();
        }
        return TwigAccess::twigRender('confirmDelete.html.twig',
            ['controller' =>'vendor', 'action' => 'deleteVendor', 'id' => $_GET['id']]);
    }


}
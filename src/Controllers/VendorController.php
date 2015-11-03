<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 02.11.15
 * Time: 20:05
 */

namespace Controllers;


use Layer\Manager\DeviceManager;
use Twig\TwigAccess;

class DeviceController {

    private $model;

    public function __construct($connectDb)
    {
        $this->model = new DeviceManager($connectDb);
    }

    public function indexAction()
    {
        $allDevices=$this->model->getAll();
        return TwigAccess::twigRender('TableDevices.html.twig', [ 'devices' => $allDevices ]);
    }

    public function addDeviceAction()
    {
        if (isset($_GET['deviceModel'])) {
            $this->model->insert([
                'deviceModel' => $_GET['deviceModel'],
                'screenSize' => $_GET['screenSize']
            ]);
            return $this->indexAction();
        }
        return TwigAccess::twigRender('addForm.html.twig');
    }

}
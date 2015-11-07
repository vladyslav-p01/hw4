<?php

namespace Layer\Manager;

/**
 * Class AbstractManager
 * @package Layer\Manager
 */
class DeviceManager implements ManagerInterface
{
    private $connectDb;

    public function __construct($connectDb)
    {
        $this->connectDb = $connectDb;
    }
    /**
     * Insert new entity data to the DB
     * @param mixed $entity
     * @return mixed
     */
    public function insert($deviceData)
    {
        $statement = $this->connectDb->connect()->prepare("INSERT INTO device (id_vendor, model, screenSize)
          VALUES (:vendor, :model, :screenSize )");
        $statement->bindValue(':vendor', $deviceData['vendor']);
        $statement->bindValue(':model', $deviceData['deviceModel']);
        $statement->bindValue(':screenSize', $deviceData['screenSize']);
        return $statement->execute();
    }

    /**
     * Update exist entity data in the DB
     * @param $entity
     * @return mixed
     */
    public function update($id,$deviceData)
    {
        $statement = $this->connectDb->connect()->prepare("UPDATE device SET
            id_vendor = :id_vendor,
             model = :model,
             screenSize = :screenSize
             WHERE id = :id
             ");
        $statement->bindValue(':id_vendor',$deviceData['id_vendor']);
        $statement->bindValue(':model',$deviceData['deviceModel']);
        $statement->bindValue(':screenSize',$deviceData['screenSize']);
        $statement->bindValue(':id',$id);
        return $statement->execute();
    }

    /**
     * Delete entity data from the DB
     * @param $entity
     * @return mixed
     */
    public function delete($id)
    {
        $statement = $this->connectDb->connect()->prepare("DELETE FROM device WHERE id = :id");
        $statement-> bindValue(':id', $id, \PDO::PARAM_INT);
        return $statement->execute();
    }

    /**
     * Search entity data in the DB by Id
     * @param $entityName
     * @param $id
     * @return mixed
     */
    public function find($id)
    {
        $statement = $this->connectDb->connect()->prepare("SELECT * FROM device WHERE id = :id");
        $statement->bindValue(':id', $id, \PDO::PARAM_INT);
        $statement->execute();
        return $statement->fetch();
    }

    public function getAll($limit = 50)
    {
        $statement = $this->connectDb->connect()->prepare("
              SELECT device.id, model, screenSize, name FROM device, vendor
              WHERE device.id_vendor=vendor.id
            ");
        $statement-> bindValue(':limit', $limit, \PDO::PARAM_INT);
        $statement->execute();
        return $this->fetchData($statement);
    }

    private function fetchData($statement)
    {

       return $results = $statement->fetchAll(\PDO::FETCH_ASSOC);
    }
}

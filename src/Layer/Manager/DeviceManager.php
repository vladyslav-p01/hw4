<?php

namespace Layer\Manager;

/**
 * Class AbstractManager
 * @package Layer\Manager
 */
class DeviceManager
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
        $statement = $this->connectDb->connect()->prepare("INSERT INTO device (model, screenSize)
          VALUES (:model, :screenSize )");
        $statement->bindValue(':model', $deviceData['deviceModel']);
        $statement->bindValue(':screenSize', $deviceData['screenSize']);
        return $statement->execute();
    }

    /**
     * Update exist entity data in the DB
     * @param $entity
     * @return mixed
     */
    public function update($id)
    {
        $statement = $this->connectDb->connect()->prepare("UPDATE device SET ");
        $statement->bindValue($deviceData['model']);
        $statement->bindValue($deviceData['screenSize']);
        return $statement->execute();
    }

    /**
     * Delete entity data from the DB
     * @param $entity
     * @return mixed
     */
   // public function remove($entity);

    /**
     * Search entity data in the DB by Id
     * @param $entityName
     * @param $id
     * @return mixed
     */
    //public function find($entityName, $id);

    /**
     * Search all entity data in the DB
     * @param $entityName
     * @return array
     */
   // public function findAll($entityName);

    /**
     * Search all entity data in the DB like $criteria rules
     * @param $entityName
     * @param array $criteria
     * @return mixed
     */
   // public function findBy($entityName, $criteria = []);

    public function getAll($limit = 50)
    {
        $statement = $this->connectDb->connect()->prepare("
              SELECT * FROM device, vendor
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

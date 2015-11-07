<?php

namespace Layer\Manager;

/**
 * Class AbstractManager
 * @package Layer\Manager
 */
class VendorManager implements ManagerInterface
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
    public function insert($name)
    {
        $statement = $this->connectDb->connect()->prepare("INSERT INTO vendor (name)
          VALUES (:name)");
        $statement->bindValue(':name', $name);
        return $statement->execute();
    }

    /**
     * Update exist entity data in the DB
     * @param $entity
     * @return mixed
     */
    public function update($idVendor,$VendorName)
    {
        $statement = $this->connectDb->connect()->prepare("UPDATE vendor SET name = :name WHERE id = :id");
        $statement->bindValue(':id',$idVendor, \PDO::PARAM_INT);
        $statement->bindValue(':name',$VendorName);
        return $statement->execute();
    }

    /**
     * Delete entity data from the DB
     * @param $entity
     * @return mixed
     */
    public function delete($id)
    {
        $statement = $this->connectDb->connect()->prepare("DELETE FROM vendor WHERE id = :id");
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
        $statement = $this->connectDb->connect()->prepare("SELECT * FROM vendor WHERE id = :id");
        $statement->bindValue(':id', $id, \PDO::PARAM_INT);
        $statement->execute();
        return $statement->fetch();
    }
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

        $statement = $this->connectDb->connect()->prepare("SELECT * FROM vendor LIMIT :limit");
        $statement-> bindValue(':limit', $limit, \PDO::PARAM_INT);
        $statement->execute();
        return $this->fetchData($statement);
    }

    private function fetchData($statement)
    {

       return $results = $statement->fetchAll(\PDO::FETCH_ASSOC);
    }
}

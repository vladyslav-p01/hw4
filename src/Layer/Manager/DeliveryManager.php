<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 07.11.15
 * Time: 9:45
 */

namespace Layer\Manager;


class DeliveryManager implements ManagerInterface
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
    public function insert($deliveryData)
    {
        $statement = $this->connectDb->connect()->prepare("INSERT INTO delivery (id_supplier, id_product)
          VALUES (:id_supplier, :id_product)");
        $statement->bindValue(':id_supplier', $deliveryData['suplier']);
        $statement->bindValue(':id_product', $deliveryData['product']);
        return $statement->execute();
    }

    /**
     * Update exist entity data in the DB
     * @param $entity
     * @return mixed
     */
    public function update($id,$deviceData)
    {
        $statement = $this->connectDb->connect()->prepare("UPDATE delivery SET
            id_supplier = :id_supplier,
             ids_products = :id_product,
             WHERE id = :id
             ");
        $statement->bindValue(':id_supplier',$deviceData['id_supplier'], \PDO::PARAM_INT);
        $statement->bindValue(':id_product',
            serialize($deviceData['id_product']));
        $statement->bindValue(':id',$id, \PDO::PARAM_INT);
        return $statement->execute();
    }

    /**
     * Delete entity data from the DB
     * @param $entity
     * @return mixed
     */
    public function delete($id)
    {
        $statement = $this->connectDb->connect()->prepare("DELETE FROM delivery
WHERE id = :id");
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
        $statement = $this->connectDb->connect()->prepare("SELECT * FROM delivery WHERE id = :id");
        $statement->bindValue(':id', $id, \PDO::PARAM_INT);
        $statement->execute();
        $resultArray = $statement->fetch();
        return $resultArray;
    }

    public function getAll($limit = 50)
    {
        $statement = $this->connectDb->connect()->prepare("
              SELECT delivery.id, id_supplier, name, id_vendor, model, screenSize
              FROM delivery
              JOIN vendor ON delivery.id_supplier = vendor.id
              JOIN device ON delivery.id_product = device.id
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
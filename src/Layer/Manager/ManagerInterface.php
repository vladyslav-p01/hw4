<?php

namespace Layer\Manager;

/**
 * Class AbstractManager
 * @package Layer\Manager
 */
interface ManagerInterface
{
    /**
     * Insert new entity data to the DB
     * @param mixed $entity
     * @return mixed
     */
    public function insert($entity);


    /**
     * Update exist entity data in the DB
     * @param $entity
     * @return mixed
     */
    public function update($id, $name);

    /**
     * Delete entity data from the DB
     * @param $entity
     * @return mixed
     */
    public function delete($entity);

    /**
     * Search entity data in the DB by Id
     * @param $entityName
     * @param $id
     * @return mixed
     */
    public function find($id);

    /**
     * Search all entity data in the DB
     * @param $entityName
     * @return array
     */
    public function getAll();
}

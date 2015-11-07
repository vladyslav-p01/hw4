<?php

namespace Controllers;

Class InstallDbController
{

    public function __construct($connectDb)
    {
        $this->db = $connectDb;
    }

    public function indexAction()
    {

        $sql = <<< 'EOD'

        SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
        SET time_zone = "+00:00";


        CREATE DATABASE IF NOT EXISTS `"$config[db]"` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
        USE `hw4`;

        CREATE TABLE IF NOT EXISTS `delivery` (
          `id` int(10) NOT NULL AUTO_INCREMENT,
          `id_supplier` int(10) NOT NULL,
          `id_product` varchar(50) CHARACTER SET utf8 NOT NULL,
          PRIMARY KEY (`id`)
        ) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

        CREATE TABLE IF NOT EXISTS `device` (
          `id` int(10) NOT NULL AUTO_INCREMENT,
          `id_vendor` int(10) NOT NULL,
          `model` varchar(10) NOT NULL,
          `screenSize` varchar(3) NOT NULL,
          PRIMARY KEY (`id`),
          KEY `id_vendor` (`id_vendor`)
        ) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

        CREATE TABLE IF NOT EXISTS `vendor` (
          `id` int(10) NOT NULL AUTO_INCREMENT,
          `name` varchar(15) NOT NULL,
          PRIMARY KEY (`id`),
          UNIQUE KEY `name` (`name`)
        ) ENGINE=InnoDB  DEFAULT CHARSET=utf8;
EOD;

        try
        {
            $statement = $this->db->connect()->prepare($sql);
            $statement->execute();
        }

        catch
        (\PDOException $e) {
            return $e->getMessage();
        }

        return true;
    }


}


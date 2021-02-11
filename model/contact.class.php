<?php
/**
 * @author Taras Shkodenko
 * Created by PhpStorm.
 * Date: 11.02.2021
 * Time: 14:38
 */

class Contact
{
    private $db = null;

    public function __construct()
    {
        require_once 'db.class.php';
        $settings = require dirname( dirname(__FILE__) ) . '/conf/settings.php';
        $this->db = new DB($settings['host'], $settings['user'], $settings['password'], $settings['name']);
        if ($this->checkContactsTable() !== 1) {
            $this->setupContactsTable();
        }
    }

    public function findByPhone($phone)
    {
        $phone = $this->db->escape($phone);
        return $this->db->query("SELECT * FROM `contact` WHERE `phone` = '{$phone}'");
    }

    public function add($data)
    {
        $phone = $this->db->escape($data['phone']);
        $first = $this->db->escape($data['first']);
        $middle = $this->db->escape($data['middle']);
        $last = $this->db->escape($data['last']);

        return $this->db->query("INSERT INTO `contact` SET `phone` = '{$phone}', `first` = '{$first}', `middle` = '{$middle}', `last` = '{$last}', `added_at` = NOW()");
    }

    public function findById($id)
    {
        $id = intval($id);
        return $this->db->query("SELECT * FROM `contact` WHERE `id` = '{$id}'");
    }

    public function edit($data)
    {
        $id = intval($data['id']);
        $phone = $this->db->escape($data['phone']);
        $first = $this->db->escape($data['first']);
        $middle = $this->db->escape($data['middle']);
        $last = $this->db->escape($data['last']);

        return $this->db->query("UPDATE `contact` SET `phone` = '{$phone}', `first` = '{$first}', `middle` = '{$middle}', `last` = '{$last}', `updated_at` = NOW() WHERE `id` = '{$id}'");
    }

    public function findAll()
    {
        return $this->db->query("SELECT * FROM `contact`");
    }

    public function delete($id)
    {
        $id = intval($id);
        return $this->db->query("DELETE FROM `contact` WHERE `id` = '{$id}' LIMIT 1");
    }

    public function findStr($str)
    {
        $str = $this->db->escape($str);
        return $this->db->query("SELECT * FROM `contact` WHERE `phone` LIKE '%{$str}%' OR `first` LIKE '%{$str}%' OR `middle` LIKE '%{$str}%' OR `last` LIKE '%{$str}%'");
    }

    public function checkContactsTable()
    {
        $settings = require dirname( dirname(__FILE__) ) . '/conf/settings.php';
        $sql = "SELECT count(*) AS cnt1 FROM information_schema.tables WHERE table_schema = '{$settings['name']}' AND table_name = '{$settings['table']}'";
        $res = $this->db->query($sql);
        if (isset($res, $res[0])) {
            return $res[0]['cnt1'];
        }
        return 0;
    }

    public function setupContactsTable()
    {
        $settings = require dirname( dirname(__FILE__) ) . '/conf/settings.php';
        $sql = 'SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";';
        $r0 = $this->db->query($sql);
        $sql = "START TRANSACTION;";
        $r1 = $this->db->query($sql);
        $sql = 'SET time_zone = "+00:00";';
        $r2 = $this->db->query($sql);
        $sql = 'CREATE TABLE IF NOT EXISTS `' . $settings['table'] . '` (
  `id` int NOT NULL,
  `phone` varchar(25) NOT NULL,
  `first` varchar(32) NOT NULL,
  `middle` varchar(32) NOT NULL,
  `last` varchar(32) NOT NULL,
  `added_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;';
        $r3 = $this->db->query($sql);
        $sql = 'ALTER TABLE `' . $settings['table'] . '` ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `un_0001_phone` (`phone`);';
        $r4 = $this->db->query($sql);
        $sql = 'ALTER TABLE `' . $settings['table'] . '` ADD FULLTEXT KEY `ft_0002_names_phone` (`first`,`last`,`middle`,`phone`);';
        $r5 = $this->db->query($sql);
        $sql = 'ALTER TABLE `' . $settings['table'] . '` MODIFY `id` int NOT NULL AUTO_INCREMENT;';
        $r6 = $this->db->query($sql);
        $sql = 'COMMIT;';
        $r7 = $this->db->query($sql);
    }
}
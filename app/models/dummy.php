<?php

class Dummies {

    static function save($data) {
        $db = option('db');

        $sql = 'INSERT INTO `dummies` (`foo`, `created_at`) VALUES (:foo, NOW())';

        $stmt = $db->prepare($sql);
        $stmt->bindValue(':foo', $data['foo']);

        return $stmt->execute();
    }

    static function find_all($options = array())
    {
        $db = option('db');

        $options['sql'] = 'SELECT * FROM `dummies`';
        $options['sql_count'] = 'SELECT COUNT(id) FROM `dummies`';

        return Model_Base::find_all($options);
    }
}
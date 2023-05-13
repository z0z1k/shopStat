<?php

    function dbInstance() : PDO
    {
        static $db;

        if ($db === null) {
            $db = new PDO('mysql:host=localhost;dbname=stats;charset=utf8', 'z0z1k', 'EtoPassword123', [
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            ]);
        }
        
        return $db;
    }
   
    function dbQuery(string $sql, array $params = []) : PDOStatement
    {
        $db = dbInstance();
        $query = $db->prepare($sql);
        $query->execute($params);
        return $query;
    }
<?php

define('MYSQL_HOST', 'localhost');
define('MYSQL_NAME', 'choosit');
define('MYSQL_USER', 'root');
define('MYSQL_PASS', '');

 
class SQL {     // Gestion de la base de donnée mysql - design pattern singleton
 
    private static $instance = null;
    private static $pdo = null;
 
   
    public function __construct() {
        if(self::$pdo == null) {
           try{ self::$pdo = new PDO('mysql:host='.MYSQL_HOST.';dbname='.MYSQL_NAME.';charset=utf8', MYSQL_USER, MYSQL_PASS, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));} 
           catch (Exception $e) {die('Erreur : ' . $e->getMessage());}
        }
    }

    public static function getPDO() {
        return self::$pdo;
    }

    public static function getInstance() {
 
        if(is_null(self::$instance)) {
            self::$instance = new SQL();  
        }
        return self::$instance;
    }

    public static function makeStatement($sql, $params=array()) {

        if(count($params) == 0) {
            try {
                $sth = self::getInstance()->getPDO()->query($sql);
                return $sth;
            }
            catch(Exception $e) {
                return false;
            }
        }
        else {
            if(($sth = self::getInstance()->getPDO()->prepare($sql)) !== false) {
                foreach ($params as $key => $value) {
                    $sth->bindValue($key, $value);
                }
                try {
                    $sth->execute();
                    return $sth;
                }
                catch(Exception $e) {
                    return false;
                }       
            }
        }
        return false;
    }

    public static function makeSelect($sql, $params = array(), $fetchStyle = PDO::FETCH_ASSOC, $fetchArg = NULL) {
        $query = SQL::makeStatement($sql, $params);
        if($query === false) return false;
        $data = !is_null($fetchArg) ? $query->fetchAll($fetchStyle, $fetchArg) : $query->fetchAll($fetchStyle);
        $query->closeCursor();
        return count($data) > 0 ? $data : false;
    }

    public static function getLastId() {
        return self::getInstance()->getPDO()->lastInsertId();
    }
}
 
?>
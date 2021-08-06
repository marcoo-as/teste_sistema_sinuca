<?php 
  namespace Classe\Database;

  class Connection {
   
     public static function getConnection($utf=true)  
     {

        $db = new \mysqli('localhost', 'user_sinuca', 'Si87yg12as12', 'sinuca');
        if ($utf) 
        {
            $db -> set_charset("utf8");          
        }
        return $db;
     }

  }
?>
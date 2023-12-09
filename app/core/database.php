<?php

//Database class

class Database{

    private function connect(){
        $str = DBDRIVER.":hostname=".DBHOST.";dbname=".DBNAME;
        return new PDO($str, DBUSER, DBPASS);
    }

    public function query($query, $data = [], $type = 'object'){
        $con = $this->connect();
        //show($con);

        $stm = $con->prepare($query);
        if($stm){
            $check = $stm->execute($data);

            if($check){

                if($type != 'object'){
                    $type = PDO::FETCH_ASSOC;
                }
                else{
                    $type = PDO::FETCH_OBJ;
                }

                $result = $stm->fetchAll($type);

                if(is_array($result) && count($result) > 0){
                    return $result;
                }
            }
        }

        return false;
    }

    public function create_tables(){
        //users table
        $query = "
            CREATE TABLE IF NOT EXISTS `users` (
                `id` int(11) NOT NULL AUTO_INCREMENT,
                `firstname` varchar(30) NOT NULL,
                `lastname` varchar(30) NOT NULL,
                `email` varchar(100) NOT NULL,
                `password` varchar(255) NOT NULL,
                `role` varchar(20) NOT NULL,
                `date` date DEFAULT NULL,
                PRIMARY KEY (`id`),
                KEY `firstname` (`firstname`),
                KEY `lastname` (`lastname`),
                KEY `email` (`email`),
                KEY `date` (`date`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci
        ";

        $this->query($query);
    }
}
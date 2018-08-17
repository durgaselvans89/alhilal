<?php

class dbConnection{
	
	private $conn;
    public function getConnection(){
		try{

			//return $this->conn = new mysqli("localhost","wataniu1_sa","sa","wataniu1_sa");
			return $this->conn = new mysqli("localhost","root","","sa");
			
			if(mysqli_connect_errno()){
				die("Could not connect: ".mysqli_connect_error());
            }
        }
        catch(Exception $exception){
            throw $exception;
       }
       catch(SQLException $sqlException){
           throw $sqlException;
        }
    }
}

?>
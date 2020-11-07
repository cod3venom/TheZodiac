<?php

namespace Kernel\Classes\Data;

use Kernel\Classes\Data\QueryFactory;
use Kernel\Classes\Data\DBUtill;
$count = (int)0;
class MySql extends DBUtill
{
    protected  $Connection;
    protected  $QueryFactory;
    protected  $stmt;

    protected $INSERT_STATUS=0;
    protected $SELECT_STATUS=0;
    protected $UPDATE_STATUS=0;
    protected $COUNT_STATUS=0;

    public function __construct()
    {
        parent::__construct();
        $this->Connection = mysqli_connect($this->HOSTNAME, $this->USERNAME, $this->PASSWORD, $this->DATABASE);
        $this->QueryFactory = new QueryFactory();
    }

    public function CreateStatement($num){
        $query = $this->QueryFactory->QueryFactory($num);
        $this->JSDebug(1,$query);
        if($this->Connection && !empty($query)){
            $this->stmt = mysqli_stmt_init($this->Connection);
            if(!$this->stmt->prepare($query)){
                //@TODO=LOG TO FILE
                echo $query;
                echo mysqli_stmt_error($this->stmt);
            }else{
                $this->stmt->prepare($query);
                return $this->stmt;
            }
        }
    }



    public function Insert(){
        if($this->stmt){
            if($this->stmt->execute()) {
                $this->stmt->store_result();
                $this->INSERT_STATUS = 1;
            }
        }
    }

    public function Select(){
        if($this->stmt){
            if($this->stmt->execute()){
                $Copy =  $this->stmt->get_result();
                $this->SELECT_STATUS = 1;
                return $Copy;
            }
        }
    }

    public function Count(){
        if($this->stmt){
            if($this->stmt->execute()){
                $this->stmt->store_result();
                $Copy = $this->stmt->num_rows();
                $this->COUNT_STATUS = 1;
                return $Copy;
            }
        }
    }

    private function CloseConnection(){
        if($this->Connection){
            $this->stmt->close();
            $this->Connection->close();
        }
    }

    function JSDebug($status,$data)
    {
        global $count;
        $count +=1;
        $code = '<script>console.log("[#]*");</script>';
        $code = str_replace("#",$count, $code);
        $code = str_replace("*",$data,$code);
        #echo $code;
    }

}
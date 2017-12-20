<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DBManager
 *
 * @author sunior
 */
include_once './config/DBSettings.php';
class DBManager {
    
    private $db ;
    public function __construct() {
        $this->db = mysqli_connect($DB_server, $DB_user, $DB_password, $DB_name);
        // Check connection
        if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
        }
    }
    
    function select($tablename,$items,$where)
    {
        $sql = "SELECT $items FROM $tablename WHERE $where";
        $result = mysqli_query($conn, $sql);
    }
    
    
    
    function count($tablename,$items,$where)
    {
        
    }
    
    function insert($tablename,$items,$where)
    {
        
    }
    
    function update($tablename,$items,$where)
    {
        
    }
    
    function delete($tablename,$items,$where)
    {
        
    }
    
    function leftjoin()
    {
        
    }
    
    function rightjoin()
    {
        
    }
}

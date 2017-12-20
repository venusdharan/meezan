<?php

include_once './DBHelper.php';

if(!isset($_POST['id']))
{
   exit(); 
}
$id_get = $_POST['id'] ;
    if($id_get != "")
    {
        
        $id = $id_get;
        $idarr = ["id" => $id];
        $mem_type = $database->select("membership_type","*",$idarr);
        $mem_type = $mem_type[0];
       // print_r($mem_type);
        //$where = [];
        //$selected_memebers = $database->select("home",["uname","housename"],$where);
        
        //$query = set_house_owner($mem_type['mem_house_owner']).set_disables($mem_type['mem_dis']).set_gender($mem_type['mem_dis']);
        // echo '</br>';
     
        
        $sql_where = array();
        $sql_and = array();
        
        $sql_q = "";
        
        $date = $mem_type['mem_date'];
        
        if($mem_type['mem_house_owner'] == '1')
        {
            //$sql_and["housename"] = "Yes";
           $sql_q = $sql_q .  "A.owner = 'Yes' AND ";
        }
        if($mem_type['mem_house_owner'] == '2')
        {
            //$sql_and["housename"] = "No";
            $sql_q = $sql_q .  "A.owner = 'No' AND ";
        }
        
        /*
        
        $lower = date('Y-m-d', strtotime('today -18 years'));
$upper = date('Y-m-d', strtotime('today -51 years'));
$query = "SELECT FirstName FROM users WHERE dob >= '$lower' AND dob < '$upper';";
        
        */
        if($mem_type['mem_age'] != '0')
        {
            $lage =  $mem_type['mem_age'];
            $lower = date('Y-m-d', strtotime("today -$lage years"));
            $sql_q = $sql_q .  "A.bdate <= '$lower' AND ";
            //echo '</br>'. $lower;
        }
        
        if($mem_type['mem_dis'] == '1')
        {
            //$sql_and["dis"] = "Yes";
            $sql_q = $sql_q .  "A.dis = 'Yes' AND ";
        }
        if($mem_type['mem_dis'] == '0')
        {
            //$sql_and["dis"] = "No";
            $sql_q = $sql_q .  "A.dis = 'No' AND ";
        }
        
        if($mem_type['mem_gender'] == '0')
        {
            //$sql_and["gender"] = "Male";
            $sql_q = $sql_q .  "A.gender = 'Male' ";
        }
        if($mem_type['mem_gender'] == '1')
        {
            //$sql_and["gender"] = "Female";
            $sql_q = $sql_q .  "A.gender = 'Female'  ";
        }
        
        $base_mem_type = $mem_type['mem_base'];
        
        //echo $sql_q;
        
        $mem_id = $mem_type['id'];
        //$sql_where["AND"] = $sql_and;
        
        /*
        $result = $database->select("home",['id','uname'],$sql_where);
        
        echo json_encode($result);
        
        foreach($result as $key => $value){
            echo $value. '</br>';
        }
         A.owner = 'Yes' AND A.dis = 'No' AND A.gender = 'Male'
         
*/
        
        $mem_amount = $mem_type['mem_amt'];

        $sql_new = "
           
                    SELECT  uname ,id ,base_mem
                    FROM home A
                    WHERE NOT EXISTS (
                              SELECT *
                              FROM membership B
                              WHERE A.id = B.mem_id AND B.mem_type_id = $mem_id 
                    ) AND $sql_q
                    
                    
                    
                  
        ;";
        
        
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "triophore";
       
$conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
$sql = "SELECT mem_name FROM membership_type";
            $result = $conn->query($sql_new);
           
           if ($result->num_rows > 0) {
               $rres_rows = $result->num_rows;
               
    $database->update("membership_type",["mem_affect" => $rres_rows],["id" => "$id_get"]);
    while($row = $result->fetch_assoc()) {
        //echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
       //echo json_encode($row);
        $memdata = array();
        $memdata['mem_type_id'] = $mem_type['id'];
        $memdata['name'] = $row['uname'];
        $memdata['mem_id'] = $row["id"];
        $memdata['cre_date'] = $mem_type["mem_date"];
        
        if($base_mem_type == '1')
        {
            $memdata['amount'] = intval($mem_amount) + intval($row['base_mem']) ;
        }
        
        if($base_mem_type == '2')
        {
            $id = $row["id"];
            $new_base = intval($mem_amount) + intval($row['base_mem']) ;
            $database->update("home",["base_mem" => "$new_base"],["id" => "$id"] );
            
        }
        
        $database->insert("membership",$memdata);
        
       //echo json_encode($memdata);
    }
    
       echo "Added new $rres_rows members to the selected membership plan";
    }else
    {
        echo "No new members added";
    }
 //echo json_encode($result);
            
       
              // $last_inserted =  mysqli_insert_id($conn); 
              //  echo $last_inserted;
           
             
            $conn->close();





        
        
    }





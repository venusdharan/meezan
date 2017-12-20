<?php
include_once '../../config/db_settings.php';
/*
 * DataTables example server-side processing script.
 *
 * Please note that this script is intentionally extremely simply to show how
 * server-side processing can be implemented, and probably shouldn't be used as
 * the basis for a large complex system. It is suitable for simple use cases as
 * for learning.
 *
 * See http://datatables.net/usage/server-side for full details on the server-
 * side processing requirements of DataTables.
 *
 * @license MIT - http://datatables.net/license_mit
 */

/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * Easy set variables
 */
if(isset($_POST['bg']))
{
// DB table to use
$table = 'membership_type';

// Table's primary key
$primaryKey = 'id';

// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case simple
// indexes
$columns = array(
        array(
        'db' => 'id',
        'dt' => 'DT_RowId',
        'formatter' => function( $d, $row ) {
            // Technically a DOM id cannot start with an integer, so we prefix
            // a string. This can also be useful if you have multiple tables
            // to ensure that the id is unique with a different prefix
            return 'row_'.$d;
        }
        ),
       
	array( 'db' => 'mem_name', 'dt' => 0 ),
	array( 'db' => 'mem_date', 'dt' => 1 ),
        array( 'db' => 'mem_house_owner', 'dt' => 2 ,
        'formatter' => function( $d, $row ) {
            $data = '';
            if($d == 0)
            {
                $data = "Include House-owners along with non House-owners";
            }
            if($d == 1)
            {
                $data = "Include only House-owners and avoid non House-owners";
            }
            if($d == 2)
            {
                $data = "Exclude House-owners and add only non House-owners";
            }
            return $data;
        }),
        array( 'db' => 'mem_dis', 'dt' => 3 ,
        'formatter' => function( $d, $row ) {
            $data = '';
            if($d == 0)
            {
                $data = "No";
            }
            if($d == 1)
            {
                $data = "Yes";
            }
           
            return $data;
        }),
        array( 'db' => 'mem_gender', 'dt' => 4 ,
        'formatter' => function( $d, $row ) {
            $data = '';
            if($d == 0)
            {
                $data = "Male";
            }
            if($d == 1)
            {
                $data = "Female";
            }
            if($d == 2)
            {
                $data = "Both Male and Female";
            }
            return $data;
        }),
        array( 'db' => 'mem_age', 'dt' => 5 ),
        //array( 'db' => 'owner', 'dt' => 6 ),
        array( 'db' => 'mem_nri', 'dt' => 6 ,
        'formatter' => function( $d, $row ) {
            $data = '';
            if($d == 0)
            {
                $data = "No";
            }
            if($d == 1)
            {
                $data = "Yes";
            }
           
            return $data;
        }),
        array( 'db' => 'mem_amt', 'dt' => 7 ),
        array( 'db' => 'mem_base', 'dt' => 8 ,
        'formatter' => function( $d, $row ) {
            $data = '';
            if($d == 0)
            {
                $data = "Not depended on base membership";
            }
            if($d == 1)
            {
                $data = "No leave it as it is, but add with base membership";
            }
            if($d == 2)
            {
                $data = "Yes Update base membership with new amount";
            }
            return $data;
        }),
        array( 'db' => 'mem_affect', 'dt' => 9 )
                /*,
        array( 'db' => 'dis', 'dt' => 9 ),
        array( 'db' => 'nri', 'dt' => 10 ),
        array( 'db' => 'mad', 'dt' => 11 ),
        array( 'db' => 'edu', 'dt' => 12 )*/
);

// SQL server connection information
$sql_details = array(
	'user' => "$db_username",
	'pass' => "$db_password",
	'db'   => "$db_name",
	'host' => "$db_server"
);


/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * If you just want to use the basic configuration for DataTables with PHP
 * server-side, there is no need to edit below this line.
 */

require( './core/ssp.php' );
$bg = $_POST['bg'];
echo json_encode(
	@SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns, null,"mem_name='$bg'")
);

}
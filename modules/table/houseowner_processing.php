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

// DB table to use
//$table = 'home';

$table = <<<EOT
(
   SELECT
     a.id,
     a.housename, 
     a.uname, 
     a.phone, 
     b.id AS house_num
   FROM home a
    JOIN home_num b ON b.ref_id = a.id
) temp
EOT;

// Table's primary key
$primaryKey = 'id';

// Array of database columns which should be read and sent back to DataTables.
// The db parameter represents the column name in the database, while the dt
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
        array( 'db' => 'house_num', 'dt' => 0 ),
	array( 'db' => 'housename', 'dt' => 1 ),
	array( 'db' => 'uname', 'dt' => 2 ),
        array( 'db' => 'phone', 'dt' => 3 )
//                ,
//        array( 'db' => 'bdate', 'dt' => 3 ),
//        array( 'db' => 'bloodgroup', 'dt' => 4 ),
//        array( 'db' => 'gender', 'dt' => 5 ),
//        //array( 'db' => 'owner', 'dt' => 6 ),
//        array( 'db' => 'married', 'dt' => 6 ),
//        array( 'db' => 'email', 'dt' => 7 ),
//        array( 'db' => 'ward', 'dt' => 8 ),
//        array( 'db' => 'dis', 'dt' => 9 ),
//        array( 'db' => 'nri', 'dt' => 10 ),
//        array( 'db' => 'mad', 'dt' => 11 ),
//        array( 'db' => 'edu', 'dt' => 12 )
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

echo json_encode(
	SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns, null,null)
);


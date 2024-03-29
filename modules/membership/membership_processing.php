<?php

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
$table = 'membership';

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
	array( 'db' => 'name', 'dt' => 0 ),
	//array( 'db' => 'last_name',  'dt' => 1 ),
	//array( 'db' => 'position',   'dt' => 2 ),
	
	array(
		'db'        => 'cre_date',
		'dt'        => 1,
		'formatter' => function( $d, $row ) {
			return date( 'd/m/Y', strtotime($d));
		}
	),
                array(
		'db'        => 'paid_date',
		'dt'        => 2,
		'formatter' => function( $d, $row ) {
			return date( 'd/m/Y', strtotime($d));
		}
	),
                array( 'db' => 'amount',     'dt' => 3 ),
                array( 'db' => 'paid', 'dt' => 4 )
                /*,
	array(
		'db'        => 'salary',
		'dt'        => 5,
		'formatter' => function( $d, $row ) {
			return '$'.number_format($d);
		}
	)*/
);

// SQL server connection information
$sql_details = array(
	'user' => 'root',
	'pass' => '',
	'db'   => 'triophore',
	'host' => 'localhost'
);


/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * If you just want to use the basic configuration for DataTables with PHP
 * server-side, there is no need to edit below this line.
 */

/*
require( './core/ssp.class.php' );

echo json_encode(
	SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns )
);
*/


require( './core/ssp.php' );
$bg = $_GET['bg'];
echo json_encode(
	SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns, null,"mem_type_id='$bg'")
);
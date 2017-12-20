document.title = "Disabled persons list";
/*
 {
    "basejs":"modules/table/js/",
    "basecss":"modules/table/css/",
    "basemain":["houseowner.js"],
    "js":["datatables.min.js","bootstrap-datepicker.min.js"],
    "css":["datatables.min.css","table.css","bootstrap-datepicker.css"]
}
*/
var operation = "";
var modal_cols = 3;
$("#table-controls").hide();
$("#add-controls").show();

var cols = [
            { 
                title: "Name",
                type:"text"
            },
            { 
                title: "HouseName",
                type:"text"
            },
            { 
                title: "Phone",
                type:"text"
            },
            { 
                title: "Date of birth",
                type:"date"
            },
            { 
                title: "BloodGroup",
                type:"select",
                options:["A-","A+","B+","B-","O+","O-","AB+","AB-"]
            },
            { 
                title: "Gender",
                type:"select",
                options:["Male","Female"]
            },
            /*
            { 
                title: "Owner",
                type:"select",
                options:["Yes","No"]
            },*/
            { 
                title: "Married",
                type:"select",
                options:["Yes","No"]
            },
            { 
                title: "Email",
                type:"text"
            },
            { 
                title: "Ward",
                type:"text"
            }
        ];

var table = $('#example').DataTable( {
        
        dom: 'lBfrtip',
        bSort: false,
           // aoColumns: [ { sWidth: "10%" }, { sWidth: "10%" }, { sWidth: "10%", bSearchable: false, bSortable: false } ],
       // data: dataSet,
        "processing": true,
	"serverSide": true,
	"ajax": "modules/table/disability_processing.php",
        columns:cols,
        buttons: [
            {
                extend: 'colvis',
                columns: ':not(:first-child)'
            },
             
            {
                extend: 'collection',
                text: 'Export',
                buttons: [
                    'copy',
                    'excel',
                    'csv',
                    'pdf',
                    'print'
                ]
            }
        ],
        "footerCallback": function ( row, data, start, end, display ) {
            var api = this.api(), data;
 
            // Remove the formatting to get integer data for summation
            var intVal = function ( i ) {
                return typeof i === 'string' ?
                    i.replace(/[\$,]/g, '')*1 :
                    typeof i === 'number' ?
                        i : 0;
            };
 
            // Total over all pages
            total = api.data().count();
            /*
                .column( 0 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
            */
            // Total over this page
            /*
            pageTotal = api
                .column( 0, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
            */
            // Update footer
            $( api.column( 0 ).footer() ).html(
                'Total number of members :'+total
            );
        }
        
} );



//# sourceURL=members.js
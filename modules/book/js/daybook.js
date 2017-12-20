document.getElementById("ddate").valueAsDate = new Date();
var ddate = document.getElementById("ddate").value;
var cols1 = [
            { 
                title:"Income Type",
                type:"select",
                cname:'type',
              
                ui:true
            },
            { 
                title:"Date (YMD)",
                type:"date",
                cname:'date',
                ui:true
            },
            { 
                title:"Specificity",
                type:"text",
                cname:'pay_id',
                ui:true
            },
            { 
                title:"Description",
                type:"textarea",
                cname:'des',
                ui:true
            },
            { 
                title:"Amount",
                type:"number",
                cname:"amount",
                ui:true
            }
        ];
        

var cols = [
            { 
                title:"Expense Type",
                type:"select",
                cname:'type',
              
                ui:true
            },
            { 
                title:"Date (YMD)",
                type:"date",
                cname:'date',
                ui:true
            },
            { 
                title:"Specificity",
                type:"text",
                cname:'pay_id',
                ui:true
            },
            { 
                title:"Description",
                type:"textarea",
                cname:'des',
                ui:true
            },
            { 
                title:"Amount",
                type:"number",
                cname:"amount",
                ui:true
            }
        ];
        



var table = $('#example').DataTable( {
        
        dom: 'lBfrtip',
        bSort: false,
           // aoColumns: [ { sWidth: "10%" }, { sWidth: "10%" }, { sWidth: "10%", bSearchable: false, bSortable: false } ],
       // data: dataSet,
        "processing": true,
	"serverSide": true,
	"ajax": "modules/book/income_date_sorted.php?date="+ddate,
        columns:cols1 ,

        buttons: [
            {
                extend: 'colvis',
                columns: ':not(:first-child)'
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

var table1 = $('#example1').DataTable( {
        
        dom: 'lBfrtip',
        bSort: false,
           // aoColumns: [ { sWidth: "10%" }, { sWidth: "10%" }, { sWidth: "10%", bSearchable: false, bSortable: false } ],
       // data: dataSet,
        "processing": true,
	"serverSide": true,
	"ajax": "modules/book/expense_date_sorted.php?date="+ddate,
        columns:cols ,

        buttons: [
            {
                extend: 'colvis',
                columns: ':not(:first-child)'
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


$("#gtdata").on('click',function(){
    ddate = document.getElementById("ddate").value;
  console.log(ddate);
   table.ajax.url( "modules/book/income_date_sorted.php?date="+ddate ).load().draw();
  table1.ajax.url( "modules/book/expense_date_sorted.php?date="+ddate ).load().draw();
    
});


$("#printdata").on('click',function()
{
    window.open("report/daybook.php?date="+ddate,"Day Book Report");
});
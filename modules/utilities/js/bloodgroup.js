document.title = "Blood Group Search";
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
var def_bg = 'A+';
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
            }
        ];

var table = $('#example').DataTable( {
        
        dom: 'lBfrtip',
        bSort: false,
           // aoColumns: [ { sWidth: "10%" }, { sWidth: "10%" }, { sWidth: "10%", bSearchable: false, bSortable: false } ],
       // data: dataSet,
        "processing": true,
	"serverSide": true,
	"ajax": "modules/table/bloodgroup_processing.php?bg="+def_bg,
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
/*
var date =  $('.datepicker').datepicker({
    format: 'dd/mm/yyyy' ,
   // startDate: '-3d',
    todayBtn: "linked",
    defaultDate: new Date()
});
date.datepicker('update', new Date());
*/
control_check();

var table_row="";
 $('#example tbody').on( 'click', 'tr', function () {
        if ( $(this).hasClass('selected') ) {
            $(this).removeClass('selected');
            $("#table-controls").hide();
            $("#add-controls").show();
          
        }
        else {
            table.$('tr.selected').removeClass('selected');
            $(this).addClass('selected');
            $("#table-controls").show();
            $("#add-controls").hide();
        }
} );

$('#sel1').on('change', function (e) {
    var optionSelected = $("option:selected", this);
    def_bg = this.value;
   update_rec();
   

});

function update_rec()
{
 
table.ajax.url( "modules/table/bloodgroup_processing.php?bg="+def_bg ).load();
 
}

$('#toc').on('click', function() {
     alert('works');
});

function control_check()
{   
    if(table.data().count() == 0)
    {
    $("#table-controls").hide();
    $("#add-controls").show();   
    }
    else
    {
     $("#table-controls").show();
     $("#add-controls").hide();   
    } 
}



function puttocoloumn(data,attr)
{
   return "<div class='"+attr+"'>"+data+"</div>" ; 
}

function grouparray(data,size)
{
    var arrays = [];

        while (data.length > 0)
        {
        arrays.push(data.splice(0, size));
        }
       // console.log(arrays);
        return arrays;
}

$.fn.serializeObject = function()
{
    var o = {};
    var a = this.serializeArray();
    $.each(a, function() {
        if (o[this.name] !== undefined) {
            if (!o[this.name].push) {
                o[this.name] = [o[this.name]];
            }
            o[this.name].push(this.value || '');
        } else {
            o[this.name] = this.value || '';
        }
    });
    return o;
};


//# sourceURL=members.js
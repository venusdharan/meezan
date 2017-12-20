document.title = "House owner list";
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
                title: "House Number",
                type:"text"
            },
            { 
                title: "HouseName",
                type:"text"
            },
            { 
                title: "Name",
                type:"text"
            },
            { 
                title: "Phone",
                type:"text"}
//            },
//            { 
//                title: "Date of birth",
//                type:"date"
//            },
//            { 
//                title: "BloodGroup",
//                type:"select",
//                options:["A-","A+","B+","B-","O+","O-","AB+","AB-"]
//            },
//            { 
//                title: "Gender",
//                type:"select",
//                options:["Male","Female"]
//            },
//            /*
//            { 
//                title: "Owner",
//                type:"select",
//                options:["Yes","No"]
//            },*/
//            { 
//                title: "Married",
//                type:"select",
//                options:["Yes","No"]
//            },
//            { 
//                title: "Email",
//                type:"text"
//            },
//            { 
//                title: "Ward",
//                type:"text"
//            }
        ];

var table = $('#example').DataTable( {
        
        dom: 'lBfrtip',
        bSort: false,
           // aoColumns: [ { sWidth: "10%" }, { sWidth: "10%" }, { sWidth: "10%", bSearchable: false, bSortable: false } ],
       // data: dataSet,
        "processing": true,
	"serverSide": true,
	"ajax": "modules/table/houseowner_processing.php",
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
$("#table-add").on( 'click',function(){
    operation = "add";
    $("#modaltitle").text("Add new data");
    var modal_cont = "";
    var md_cols = [];
    $.each(cols,function(value,key){
       
       
            var modal_controls = "";
            
            if(key.type == "date")
            {
              modal_controls += '<div class="form-group"><label for="'+key.title+'">'+key.title+':</label><input data-provide="datepicker" class="form-control datepicker" id="'+key.title+'" placeholder="Enter '+key.title+'"><input type="hidden" id="my_hidden_input"></div>'; 
            }
            if(key.type == "select")
            {
                var selects ="";

              $.each(key.options,function(opt_index,opt_val){
                  if(opt_val != undefined)
                  {

                       selects = selects + "<option>" + opt_val + "</option>"; // 
                  }

              });
              modal_controls += '<div class="form-group"><label for="'+key.title+'">'+key.title+':</label>  <select class="input-large form-control" style="width:100%;" name="'+key.title+'" id="'+key.title+'" data-style="btn-primary" title="'+key.title+'">'+selects+'</select></div>';   
             // console.log( modal_controls);
            }
            if(key.type == "text")
            {
              modal_controls += '<div class="form-group"><label for="'+key.title+'">'+key.title+':</label><input type="text" class="form-control" id="'+key.title+'" placeholder="Enter '+key.title+'"></div>'; 
            }
            
            modal_controls += "";
            //modal_cont += modal_controls;
      
            
        
        //createcontrol();
        //modal_cont += "";
        
        md_cols.push(modal_controls);
    });
    modal_cont += "<div class='row'>";
    var carray = grouparray(md_cols,3);
    $.each(carray,function(val,key){ 
       $.each(key,function(v,k){
           modal_cont += "<div class='col-lg-4'>"+k+"</div>";
       });
    });
    modal_cont += "</div>";
    $("#modal_inputs").html(modal_cont);
    
       $('#myModal').modal({
            backdrop: 'static',
            keyboard: false,
            show:true
        }).on('submit', function(event) {
            event.preventDefault();
           // table.row('.selected').remove().draw();
        }).on('hidden', function () {
            operation = "";
        });
    
});

$("#table-edit").on( 'click',function(){
    operation = "edit";
    var table_selected_row = table.row('.selected').data();
     var modal_controls = "";
      $("#modaltitle").text("Edit data");
    $.each(cols,function(value,key){
       if(key.type == "date")
        {
          modal_controls += '<div class="form-group"><label for="'+key.title+'">'+key.title+':</label><input data-provide="datepicker" class="form-control datepicker" id="'+key.title+'" placeholder="Enter '+key.title+'"><input type="hidden" id="my_hidden_input"></div>'; 
        }
        if(key.type == "select")
        {
            var selects ="";
            
          $.each(key.options,function(opt_index,opt_val){
              if(opt_val != undefined)
              {
                  
                   selects = selects + "<option>" + opt_val + "</option>"; // 
              }
             
          });
          modal_controls += '<div class="form-group"><label for="'+key.title+'">'+key.title+':</label>  <select class="input-large form-control" style="width:100%;" name="'+key.title+'" id="'+key.title+'" data-style="btn-primary" title="'+key.title+'">'+selects+'</select></div>';   
         // console.log( modal_controls);
        }
        if(key.type == "text")
        {
          modal_controls += '<div class="form-group"><label for="'+key.title+'">'+key.title+':</label><input type="text" class="form-control" id="'+key.title+'" placeholder="Enter '+key.title+'"></div>'; 
        }
    });
    $("#modal_inputs").html(modal_controls);
    
       $('#myModal').modal({
            backdrop: 'static',
            keyboard: false,
            show:true
        }).on('submit', function(event) {
            event.preventDefault();
           // table.row('.selected').remove().draw();
        }).on('hidden', function () {
            operation = "";
        });
});

$("#modal_sub").on('click',function(){        
var from_data =  table.row('.selected').id();
if(operation == "del")
{
$.post("modules/table/members_delete.php",{"id":from_data}, function(data, status){
         alert("Data: " + data + "\nStatus: " + status);
         table.row('.selected').remove().draw(false);
         control_check();
});
operation = "";
}
if(operation == "add")
{
var name = $("#Name").val();
var housename = $('#HouseName').val();
var phone = $("#Phone").val();
var age = $("#Age").val();
var bloodgroup = $("#BloodGroup").val();
var gender = $("#Gender").val();
var owner = $("#Owner").val();
var married = $("#Married").val();
var email = $("#Email").val();
var ward = $("#Ward").val();
$.post("modules/table/members_add.php",
{
    "name":name,
    "housename":housename,
    "phone":phone,
    "age":age,
    "bloodgroup":bloodgroup,
    "gender":gender,
    "owner":owner,
    "married":married,
    "email":email,
    "ward":ward
}
,function(data, status){
        alert("Data: " + data + "\nStatus: " + status);
        table.draw();
        //table.row('.selected').remove().draw(false);
});
operation = "";
}
if(operation == "edit")
{
var name = $("#Name").val();
var housename = $('#HouseName').val();
var phone = $("#Phone").val();
var age = $("#Age").val();
var bloodgroup = $("#BloodGroup").val();
var gender = $("#Gender").val();
var owner = $("#Owner").val();
var married = $("#Married").val();
var email = $("#Email").val();
var ward = $("#Ward").val();
$.post("modules/table/members_edit.php",
{
    "id":from_data,
    "name":name,
    "housename":housename,
    "phone":phone,
    "age":age,
    "bloodgroup":bloodgroup,
    "gender":gender,
    "owner":owner,
    "married":married,
    "email":email,
    "ward":ward
}
,function(data, status){
        alert("Data: " + data + "\nStatus: " + status);
        table.draw();
        //table.row('.selected').remove().draw(false);
});
operation = "";
}
});
$("#table-delete").on( 'click',function(){
    
});



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

function createcontrol(title_val,data_val,type_val,class_val,id_val,attr_val)
{
    var control = "";
    switch (type)
    {
       case "button":
       control = '<div class="form-group"><label for="'+title_val+'">'+title_val+':</label><input type="'+type_val+'" name="'+title_val+'" class="form-control '+class_val+'" id="'+id_val+'" value="'+data_val+'" placeholder="Enter '+title_val+'" '+attr_val+'></div>';
       break;
       case "checkbox":
       control = '<div class="form-group"><label for="'+title_val+'">'+title_val+':</label><input type="'+type_val+'" name="'+title_val+'" class="form-control '+class_val+'" id="'+id_val+'" value="'+data_val+'" placeholder="Enter '+title_val+'" '+attr_val+'></div>';
       break;
       case "color":
       control = '';
       break;
       case "date":
       control = '<div class="form-group"><label for="'+title_val+'">'+key.title+':</label><input data-provide="datepicker" class="form-control datepicker" id="'+key.title+'" value="'+table_selected_row[value]+'" placeholder="Enter '+key.title+'"><input type="hidden" id="'+key.title+'_date"></div>';
       break;
       case "datetime-local":
       control = '';
       break;
       case "email":
       control = '<div class="form-group"><label for="'+title_val+'">'+key.title+':</label><input data-provide="datepicker" class="form-control datepicker" id="'+key.title+'" value="'+table_selected_row[value]+'" placeholder="Enter '+key.title+'"><input type="hidden" id="'+key.title+'_date"></div>';
       break;
       case "file":
       control = '';
       break;
       case "hidden":
       control = '';
       break;
       case "image":
       control = '';
       break;
       case "month":
       control = '';
       break;
       case "number":
       control = '';
       break;
       case "password":
       control = '';
       break;
       case "radio":
       control = '';
       break;
       case "range":
       control = '';
       break;
       case "reset":
       control = '';
       break;
       case "search":
       control = '';
       break;
       case "submit":
       control = '';
       break;
       case "tel":
       control = '';
       break;
       case "time":
       control = '';
       break;
       case "url":
       control = '';
       break;
       case "week":
       control = '';
       break;
    }
    return control;
}

function showmodal(modal_type,data)
{
    if(modal_type == "add")
    {
        
    }
    if(modal_type == "edit")
    {
        
    }
    if(modal_type == "add")
    {
        
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
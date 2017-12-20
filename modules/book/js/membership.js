var operation = "";
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




$("#table-controls").hide();
$("#add-controls").show();

var cols = [
     //{ title: "Position" },
            { title: "Name" },
           
           // { title: "Office" },
          //  { title: "Extn" },
            { title: "Date" },
            { title: "Amount" },
            { title: "Paid" }
        ];
var table = $('#example').DataTable( {
        
        dom: 'lBfrtip',
         bSort: false,
           // aoColumns: [ { sWidth: "10%" }, { sWidth: "10%" }, { sWidth: "10%", bSearchable: false, bSortable: false } ],
       // data: dataSet,
        "processing": true,
		"serverSide": true,
		"ajax": "modules/table/membership_processing.php",
        columns:cols,
         'columnDefs': [{
         'targets': 3,
         'searchable':false,
         'orderable':false,
         'className': 'dt-body-center',
         'render': function (data, type, full, meta){
            // alert(type);
             if(data.trim() == '1')
             {
                 return '<input type="checkbox" checked name="id[]" value="' 
                + $('<div/>').text(data).html() + '">';
             }
             else
             {
                 return '<input type="checkbox" name="id[]" value="' 
                + $('<div/>').text(data).html() + '">';
             }
         }
      }],
        
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
        ]
        
} );
var date =  $('.datepicker').datepicker({
    format: 'dd/mm/yyyy' ,
    startDate: '-3d',
    todayBtn: "linked",
    "setDate": new Date()
});

 // Handle click on checkbox to set state of "Select all" control
   $('#example tbody').on('change', 'input[type="checkbox"]', function(){
      // If checkbox is not checked
     // if(!this.checked){
     //    var el = $('#example-select-all').get(0);
        // If "Select all" control is checked and has 'indeterminate' property
       //  if(el && el.checked && ('indeterminate' in el)){
            // Set visual state of "Select all" control 
            // as 'indeterminate'
           // el.indeterminate = true;
        // }
     // }
     // $(this).closest('tr').get(0);
     var rowIndex = $(this).closest('tr').get(0);
     var id = $(rowIndex).attr('id');
    // alert(rowIndex.prototype.toString.call(['id']));
 // var   rowndex = rowIndex.find('tr').attr('id');
  console.log(id);
     
   });


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
    var modal_controls = "";
    $.each(cols,function(value,key){
        if(key.title == "Date")
        {
          modal_controls += '<div class="form-group"><label for="'+key.title+'">'+key.title+':</label><input data-provide="datepicker" class="form-control datepicker" id="'+key.title+'" placeholder="Enter '+key.title+'"><input type="hidden" id="my_hidden_input"></div>'; 
        }else
        {
          modal_controls += '<div class="form-group"><label for="'+key.title+'">'+key.title+':</label><input type="text" class="form-control" id="'+key.title+'" placeholder="Enter '+key.title+'"></div>'; 
        }
    });
    $("#modal_inputs").html(modal_controls);
    
    $('#myModal').removeClass( "modal-info" ).removeClass( "modal-danger" ).addClass("modal-success");
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
       if(key.title == "Date")
        {
          modal_controls += '<div class="form-group"><label for="'+key.title+'">'+key.title+':</label><input data-provide="datepicker" class="form-control datepicker" id="'+key.title+'" value="'+table_selected_row[value]+'" placeholder="Enter '+key.title+'"><input type="hidden" id="my_hidden_input"></div>'; 
        }else
        {
          modal_controls += '<div class="form-group"><label for="'+key.title+'">'+key.title+':</label><input type="text" class="form-control" id="'+key.title+'" value="'+table_selected_row[value]+'" placeholder="Enter '+key.title+'"></div>'; 
        }
    });
    $("#modal_inputs").html(modal_controls);
        $('#myModal').removeClass( "modal-success" ).removeClass( "modal-danger" ).addClass("modal-info");
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
$.post("modules/table/membership_delete.php",{"id":from_data}, function(data, status){
         alert("Data: " + data + "\nStatus: " + status);
         table.row('.selected').remove().draw(false);
         control_check();
});
operation = "";
}
if(operation == "add")
{
var name = $("#Name").val();
var dates = $('.datepicker').val();
var amount = $("#Amount").val();
$.post("modules/table/membership_add.php",
{
    "name":name,
    "date":dates,
    "amount":amount
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
var dates = $('.datepicker').val();
var amount = $("#Amount").val();
$.post("modules/table/membership_edit.php",
{
    "id":from_data,
    "name":name,
    "date":dates,
    "amount":amount
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
    operation = "del";
    var table_selected_row = table.row('.selected').data();
     var modal_controls = "";
      $("#modaltitle").text("Edit data");
    $.each(cols,function(value,key){
       modal_controls += '<div class="form-group"><label for="'+key.title+'">'+key.title+':</label><input type="text" name="'+key.title+'" class="form-control" id="'+key.title+'" value="'+table_selected_row[value]+'" placeholder="Enter '+key.title+'" disabled></div>';
    });
    $("#modal_inputs").html(modal_controls);
    
         $('#myModal').removeClass( "modal-info" ).removeClass( "modal-success" ).addClass("modal-danger");
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

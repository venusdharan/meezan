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

var def_bg ="";
$.post("modules/membership/getplan.php",{op:'all',data:'ward'},function(d,s){
    //var selects = '<label for="sel1">Select Membership Plan:</label> <select class="form-control" id="sel1">';// + "<option>" + "Select Membership Plan" + "</option>"
   // console.log(d);
    if(d.length > 0){
        def_bg = $.parseJSON(d)[0].id;
        console.log(def_bg);
       //console.log($.parseJSON(d)[0].id);
        $.each($.parseJSON(d.trim()), function(idx, opt_val) {
	//$('#ward_table tbody').append('<tr><td>'+obj.name+'</td><td><button type="button" id="'+obj.id+'" class="btn delbtncls btn-danger">Delete</button></td></tr>');
        //wards.push(obj.name);
       // selects = selects + "<option data-tokens="+"'"+opt_val.mem_name+"'"+"value='"+opt_val.id+"'"+">" + opt_val.mem_name + "</option>";
       // console.log(opt_val);
       $('#sel1').append($('<option>', { 
        value: opt_val.id ,
        text :  opt_val.mem_name
        }));
    });
    
    
            
    update_rec();
}
    //selects = selects + "</select>";
    
    //$("#sel1_div").html(selects);
   
 
    
});

$("#table-controls").hide();
$("#add-controls").show();

var cols = [
     //{ title: "Position" },
            { title: "Name" ,
                cname:'uname',
                type:'text'
            },
           
           // { title: "Office" },
          //  { title: "Extn" },
            { title: "Created Date", 
    cname:'date',
    
                type:'date'        
    },
     { title: "Paid Date", 
    cname:'date',
    
                type:'date'        
    },
            { title: "Amount" ,
    cname:'amount',
                type:'number'        
    },
            { title: "Paid" ,
    cname:'paid',
                type:'text'        
    }
        ];
        var def_bg = "0"
var table = $('#example').DataTable( {
        
        dom: 'lBfrtip',
         bSort: false,
           // aoColumns: [ { sWidth: "10%" }, { sWidth: "10%" }, { sWidth: "10%", bSearchable: false, bSortable: false } ],
       // data: dataSet,
       
        "processing": true,
		"serverSide": true,
		//"ajax": "modules/membership/membership_processing.php",
                "ajax": "modules/membership/membership_processing.php?bg="+def_bg,
        columns:cols,
         'columnDefs': [{
         'targets': 4,
         'searchable':false,
         'orderable':false,
         'className': 'dt-body-center',
         "ajax":  {
                "url": "modules/membership/membership_processing.php?bg",
                "type": "GET",
                "data": function(d) {
                    d.bg = def_bg;
                    //d.Bar = "foo";
                    //d.FooBar = "foobarz";
                }
            },
         'render': function (data, type, full, meta){
            // alert(type);
             if(data.trim() == '1')
             {
                 return '<input type="checkbox" class="paid_chk" checked name="id[]" value="' 
                + $('<div/>').text(data).html() + '">';
             }
             else
             {
                 return '<input type="checkbox" class="paid_chk" name="id[]" value="' 
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
var date ;
$('body').on('focus',".form_datetime", function(){
    
     $('.form_datetime').datetimepicker({
     format: "mm/yyyy",
    startView: "year", 
    minView: "year"
      /*,
      startDate: "01-01-2015",
      endDate: "01-01-2020",
      todayBtn: "linked",
      autoclose: true,
      todayHighlight: true*/
    });
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
     var ch = 0;
     if($(this).is(":checked")) {
        //Do stuff
        console.log('checked');
        ch = 1;
      }
     var rowIndex = $(this).closest('tr').get(0);
     var id = $(rowIndex).attr('id');
    // alert(rowIndex.prototype.toString.call(['id']));
 // var   rowndex = rowIndex.find('tr').attr('id');
 
 $.get("modules/membership/membership_update.php",{id:id,paid:ch},function(d,s){
     alert(d);
     table.draw();
 });
      
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
          modal_controls += '<div class="form-group"><label for="'+key.title+'">'+key.title+':</label><div class="input-append date form_datetime"><input size="16" type="text" value="" class="form-control" readonly><span class="add-on"><i class="icon-th"></i></span></div>'   ;       //'<div class="form-group"><label for="'+key.title+'">'+key.title+':</label><input  class="form-control datepicker" id="'+key.title+'" placeholder="Enter '+key.title+'"  >'; 
          
        }else
        {
        
        modal_controls += '<div class="form-group"><label for="'+key.cname+'">'+key.title+':</label><input name="'+key.cname+'" type="'+key.type+'" class="form-control" id="'+key.title+'" placeholder="Enter '+key.title+'"></div>'; 
    }
    });
    $("#modal_inputs").html(modal_controls);
    
    //$('#myModal').removeClass( "modal-info" ).removeClass( "modal-danger" ).addClass("modal-success");
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
  $('#myModal').on('shown.bs.modal', function(e) {
     /*
    $('.form_datetime').datetimepicker({
      format: "dd/mm/yyyy",
      startDate: "01-01-2015",
      endDate: "01-01-2020",
      todayBtn: "linked",
      autoclose: true,
      todayHighlight: true
    });
    */
  });


$("#table-edit").on( 'click',function(){
    operation = "edit";
    var table_selected_row = table.row('.selected').data();
     var modal_controls = "";
      $("#modaltitle").text("Edit data");
    $.each(cols,function(value,key){
       if(key.title == "Date")
        {
          modal_controls += '<div class="form-group"><label for="'+key.title+'">'+key.title+':</label><input data-provide="datepicker" class="form-control datepicker" id="'+key.title+'" value="'+table_selected_row[value]+'" placeholder="Enter '+key.title+'" data-date-format="mm/yyyy"><input type="hidden" id="my_hidden_input"></div>'; 
        }else
        {
          modal_controls += '<div class="form-group"><label for="'+key.title+'">'+key.title+':</label><input type="text" class="form-control" id="'+key.title+'" value="'+table_selected_row[value]+'" placeholder="Enter '+key.title+'"></div>'; 
        }
    });
    $("#modal_inputs").html(modal_controls);
       // $('#myModal').removeClass( "modal-success" ).removeClass( "modal-danger" ).addClass("modal-info");
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
    
        // $('#myModal').removeClass( "modal-info" ).removeClass( "modal-success" ).addClass("modal-danger");
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

$("#table-print-paid").on( 'click',function(){
    var link = "report/membership.php?id="+def_bg;
    window.open(link, "Report Window", "toolbar=no,titlebar=no,scrollbars=no,status=no,resizable=no,menubar=no,width=100,height=100");
});

$("#table-print-unpaid").on( 'click',function(){
     
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

$('#sel1').on('change', function (e) {
    var optionSelected = $("option:selected", this);
    def_bg = optionSelected.val();
    console.log(def_bg);
   update_rec();
   

});

function update_rec()
{
 
table.ajax.url( "modules/membership/membership_processing.php?bg="+def_bg ).load();
 
}

//# sourceURL=Table.Membership.js



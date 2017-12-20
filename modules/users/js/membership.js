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
var uname ;





   $.getJSON('modules/users/getallmodules.php',function(d,s){
    $.each(d, function (i, item) {
/*
    $('#mod_sel').append($('<option>', { 
        value: item,
        text : item
    }));
        */
      
       if(item.name == 'home')
       {
           $("#mod_list").append('<li class="list-group-item" ><label><div><input class="mcheck" type="checkbox" id="'+item.name+'" value="'+item.name+'" disabled checked="checked">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'+item.view_name+'</div></label></li>');
       }else
       {
                    if(uname == "Admin")
               {
                    $("#mod_list").append('<li class="list-group-item" ><label><div><input class="mcheck" type="checkbox" id="'+item.name+'" value="'+item.name+'" disabled checked="checked">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'+item.view_name+'</div></label></li>');
               }else{
               $("#mod_list").append('<li class="list-group-item" ><label></div><input class="mcheck" type="checkbox" id="'+item.name+'" value="'+item.name+'">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'+item.view_name+'</div></label></li>');
               //console.log(item);
           }
        }
    });
    
    
   
    
});



$.getJSON('modules/users/getusers.php',function(d,s){
    $.each(d, function (i, item) {
    $('#user_sel').append($('<option>', { 
        value: item.username,
        text : item.username 
    }));
    });
 
  uname = d[0].username;
   // alert(uname);
   // table.ajax.url("modules/users/membership_processing.php?u="+uname).load();
   // table.draw();

       $.getJSON('modules/users/getusermodules.php?u='+uname,function(d,s){
      //  $("#mod_list").empty();
    $.each(d, function (i, item) {
/*
    $('#mod_sel').append($('<option>', { 
        value: item,
        text : item
    }));
        */
     //  $("#mod_list").append('<li class="list-group-item" draggable="true"><strong>'+item+'</strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button style="float:right;"  class="btn btn-sm btn-danger">Remove</button></li>');
       //console.log(item);
       $('#home').prop('checked', true);
       $('#'+item).prop('checked', true);
       console.log(item);
       
    });
    
    
    
    
});
 
});

//$('#user_sel').val('');
//var uname = $('#user_sel').find(":selected").text();







$("#table-controls").hide();
$("#add-controls").show();




document.title = "Module Users";
var cols = [
     //{ title: "Position" },
            { title: "Modules" ,
                 type:"text",
                cname:"username"
             },
            
             { title: "Control" , type:"text",
                cname:"username"}//,
           // { title: "Office" },
          //  { title: "Extn" },
           // { title: "Date" },
           // { title: "Amount" },
           // { title: "Paid" }
        ];
        
/*
var table = $('#example').DataTable( {
        
        dom: 'lBfrtip',
        // bSort: false,
           // aoColumns: [ { sWidth: "10%" }, { sWidth: "10%" }, { sWidth: "10%", bSearchable: false, bSortable: false } ],
       // data: dataSet,
        "processing": true,
		"serverSide": true,
		"ajax": "modules/users/membership_processing.php?u="+uname,
        columns:cols,
          colReorder: true,
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

*/


$('.list-group-sortable').sortable({
  placeholderClass: 'list-group-item'
});


var date =  $('.datepicker').datepicker({
    format: 'mm/yyyy' ,
    startDate: '-3d',
    todayBtn: "linked"
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
          //  table.$('tr.selected').removeClass('selected');
            $(this).addClass('selected');
            $("#table-controls").show();
            $("#add-controls").hide();
        }
} );
$("#table-add").on( 'click',function(){
    
    /*
    operation = "add";
   // alert('hh');
    uname = $('#user_sel').find(":selected").text();

$.getJSON('modules/users/getmodules.php?u='+uname,function(d,s){

    $("#mod_sel").empty();
    $.each(d, function (i, item) {
console.log(item);
    $('#mod_sel').append($('<option>', { 
        value: item,
        text : item
    }));
    });
    
    
    $("#modaltitle").text("Add new data");
    
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
    
   */ 
    
    var checkedVals = $('.mcheck:checkbox:checked').map(function() {
    return this.value;
}).get();
var mdata = {};
mdata.data = checkedVals;
mdata.user = uname;
$.post("modules/users/membership_add.php",{data:mdata},function(d1,s1){
 alert(d1);
    uname = $('#user_sel').find(":selected").text();
refresh(uname);
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
      //  $('#myModal').removeClass( "modal-success" ).removeClass( "modal-danger" ).addClass("modal-info");
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
$.post("modules/users/membership_delete.php",{"id":from_data}, function(data, status){
         alert("Data: " + data + "\nStatus: " + status);
        // table.row('.selected').remove().draw(false);
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
      //  table.draw();
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
        alert("Data: " + data + "\nStatus: " + status );
        
      //  table.draw();
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
/*if(table.data().count() == 0)
{
$("#table-controls").hide();
$("#add-controls").show();   
}
else
{
 $("#table-controls").show();
 $("#add-controls").hide();   
} */
}


$('#user_sel').on('change',function () {
    
    uname = $(this).find("option:selected").text();
refresh(uname);
       

});


function refresh(u)
{
      $.getJSON('modules/users/getusermodules.php?u='+u,function(d,s){
      //  $("#mod_list").empty();
      
      $('input:checkbox.mcheck').each(function () {
       var sThisVal = (this.checked = false);
      });
    $.each(d, function (i, item) {
/*
    $('#mod_sel').append($('<option>', { 
        value: item,
        text : item
    }));
        */
     //  $("#mod_list").append('<li class="list-group-item" draggable="true"><strong>'+item+'</strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button style="float:right;"  class="btn btn-sm btn-danger">Remove</button></li>');
       //console.log(item);
       $('#'+item).prop('checked', true);
      // console.log(item);
      
    });
    
    
      $('#home').prop('checked', true);
    
});
}
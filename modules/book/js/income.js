var operation = "";
var modal_cols = 3;
var modal;


/*
var spicker = $('.selectpicker').selectpicker({
  style: 'btn-info',
  size: 4
});
*/

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
var income_types = [];



$.post("modules/book/income_type_p.php",{op:'all_read',data:'all'},function(d,s){
    if($.parseJSON(d.trim()).length > 0)
    {
    $.each($.parseJSON(d.trim()), function(idx, obj) {
	//$('#ward_table tbody').append('<tr><td>'+obj.name+'</td><td><button type="button" id="'+obj.id+'" class="btn delbtncls btn-danger">Delete</button></td></tr>');
       income_types.push(obj.type);
    });
    }
});



//$.post("modules/table/cat_p.php",{op:'all',data:'ward'},function(d,s){
//    $.each($.parseJSON(d.trim()), function(idx, obj) {
//	//$('#ward_table tbody').append('<tr><td>'+obj.name+'</td><td><button type="button" id="'+obj.id+'" class="btn delbtncls btn-danger">Delete</button></td></tr>');
//        cat.push(obj.name);
//    });
//});



var cols = [
            { 
                title:"Income Type",
                type:"select",
                cname:'type',
                options:income_types,
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
	"ajax": "modules/book/income_processing.php",
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
var date =  $('.datepicker').datetimepicker({
    format: 'DD/MM/YYYY',
    
    todayBtn: "linked"//,
    //defaultDate: new Date()
});
//date.datepicker('update', new Date());
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
       
       if(key.ui){
            var modal_controls = "";
            
            if(key.type == "date")
            {
              modal_controls +=  '<div class="form-group"><label for="'+key.cname+'">'+key.title+':</label><input type="date"  class="form-control req" id="datepicker" name="'+key.cname+'" required/></div>';                                                    //'<div class="form-group"><label for="'+key.title+'">'+key.title+':</label><input data-provide="datepicker" class="form-control datepicker" id="'+key.title+'" placeholder="Enter '+key.title+'" name="'+key.cname+'"><input type="hidden"  id="my_hidden_input"></div>'; 
            }
            if(key.type == "select")
            {
                var selects ="";

              $.each(key.options,function(opt_index,opt_val){
                  if(opt_val != undefined)
                  {

                       selects = selects + "<option data-tokens="+"'"+opt_val+"'"+">" + opt_val + "</option>"; // 
                  }

              });
              
             
              modal_controls += '<div class="form-group"><label for="'+key.title+'">'+key.title+':</label>  <select class="input-large selectpicker form-control"  data-live-search="true" style="width:100%;" name="'+key.cname+'" id="'+key.title+'" data-style="btn-primary" title="'+key.title+'" required>'+selects+'</select></div>';   
             // console.log( modal_controls);
              //spicker.selectpicker('refresh');
            }
            if(key.type == "text")
            {
              modal_controls += '<div class="form-group"><label for="'+key.title+'">'+key.title+':</label><input type="text" class="form-control req" name="'+key.cname+'" id="'+key.title+'" placeholder="Enter '+key.title+'" required></div>'; 
            }
            
            if(key.type == "textarea")
            {
              modal_controls += '<div class="form-group"><label for="'+key.title+'">'+key.title+':</label><textarea class="form-control req" name="'+key.cname+'" id="'+key.title+'" placeholder="Enter '+key.title+'" required></textarea></div>'; 
            }
            
            if(key.type == "number")
            {
              modal_controls += '<div class="form-group"><label for="'+key.title+'">'+key.title+':</label><input type="number" class="form-control req" name="'+key.cname+'" id="'+key.title+'" placeholder="Enter '+key.title+'" required></div>'; 
            }
            
            if(key.type == "email")
            {
              modal_controls += '<div class="form-group"><label for="'+key.title+'">'+key.title+':</label><input type="email" class="form-control req" name="'+key.cname+'" id="'+key.title+'" placeholder="Enter '+key.title+'" required></div>'; 
            }
            
            modal_controls += "";
            //modal_cont += modal_controls;
      
            
        
        //createcontrol();
        //modal_cont += "";
        
        md_cols.push(modal_controls);
    }
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
    
     modal =   $('#myModal').modal({
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
    var md_cols = [];
    var table_selected_row = table.row('.selected').data();
    //console.log(table_selected_row);
    var modal_cont = "";
    $("#modaltitle").text("Edit data");
    $.each(table_selected_row,function(val,key){
        if(val !== 'DT_RowId' && cols[val].ui == true)
        {
            //console.log(key);
            var type = cols[val].type;
            var cname = cols[val].cname;
            var title = cols[val].title; //data-provide="datepicker"
            var modal_controls = ""; 
            /*
            if(type === "date")
            {
              modal_controls += '<div class="form-group"><label for="'+cname+'">'+title+':</label><input type="date" class="form-control" id="'+cname+'" placeholder="Enter '+cname+'" value="'+key+'"><input type="hidden" id="my_hidden_input"></div>'; 
            }*/
            
            if(type == "date")
            {
              modal_controls +=  '<div class="form-group"><label for="'+cname+'">'+title+':</label><input type="date"  class="form-control " id="datepicker" name="'+cname+'" value="'+key+'"></div>';                                                    //'<div class="form-group"><label for="'+key.title+'">'+key.title+':</label><input data-provide="datepicker" class="form-control datepicker" id="'+key.title+'" placeholder="Enter '+key.title+'" name="'+key.cname+'"><input type="hidden"  id="my_hidden_input"></div>'; 
            }
            if(type === "select")
            {
              var selects ="";
              $.each(cols[val].options,function(opt_index,opt_val){
                  if(opt_val != undefined)
                  {
                      if(opt_val === key)
                      {
                        selects = selects + "<option checked>" + opt_val + "</option>"; //   
                      }else
                      {
                         selects = selects + "<option>" + opt_val + "</option>"; //
                      }
                       
                  }

              });
              modal_controls += '<div class="form-group"><label for="'+cname+'">'+title+':</label>  <select class="input-large form-control" style="width:100%;" name="'+cname+'" id="'+cname+'" data-style="btn-primary" title="'+cname+'">'+selects+'</select></div>';   
             // console.log( modal_controls);
            }
            if(type === "text")
            {
              modal_controls += '<div class="form-group"><label for="'+cname+'">'+title+':</label><input type="text" class="form-control" name="'+cname+'" id="'+title+'" placeholder="Enter '+cname+'" value="'+key+'"></div>'; 
            }
            
             if(key.type == "textarea")
            {
              modal_controls += '<div class="form-group"><label for="'+key.title+'">'+key.title+':</label><textarea class="form-control req" name="'+key.cname+'" id="'+key.title+'" placeholder="Enter '+key.title+'" required></textarea></div>'; 
            }
            
            if(type == "number")
            {
              modal_controls += '<div class="form-group"><label for="'+title+'">'+title+':</label><input type="number" class="form-control" name="'+cname+'" id="'+title+'" value="'+key+'"></div>'; 
            }
            
            if(type == "email")
            {
              modal_controls += '<div class="form-group"><label for="'+title+'">'+title+':</label><input type="email" class="form-control" name="'+cname+'" id="'+title+'" value="'+key+'"></div>'; 
            }
           
           
           md_cols.push(modal_controls);
           
        }
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
    
     modal =  $('#myModal').modal({
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

var form_valid = true;

$("#modal_sub").on('click',function(){        
var from_data =  table.row('.selected').id();
if(operation == "del")
{
$.post("modules/book/income_delete.php",{"id":from_data}, function(data, status){
         alert("Data: " + data + "\nStatus: " + status);
         table.row('.selected').remove().draw(false);
         $("#table-controls").hide();
         $("#add-controls").show();
});
operation = "";
}
if(operation == "add")
{

var form_valid = validateAll('req');


var result = { };
$.each($("#modal_form").serializeArray(), function() {
    
    result[this.name] = this.value;
});

console.log(result);

if(form_valid)
{
$.post("modules/book/income_db.php",
{
  op:"add",
  data:result
},function(d,s){
    alert(d);
    table.draw();
    modal.modal('hide');
    
operation = "";
});
}else
{
    //alert("Important data missing! Please fill all the required data");
}

 // console.log( result );

}
if(operation == "edit")
{

var r_id = table.row('.selected').id();  
r_id  = r_id.replace("row_", "").trim();
var result = { };
$.each($("#modal_form").serializeArray(), function() {
    result[this.name] = this.value;
});

console.log(result);


$.post("modules/book/income_db.php",
{
  op:"edit",
  id:r_id,
  data:result
},function(d,s){
    alert(d);
   
    $('#example tbody tr').removeClass('selected');
    
     table.draw();
     $("#table-controls").hide();
            $("#add-controls").show();
            modal.modal('hide');
});
        
        
operation = "";
}
});
$("#table-delete").on( 'click',function(){
    var r = confirm("Do you want to delete this entry");
    if(r)
    {
         var table_selected_row = table.row('.selected').id();
         table_selected_row = table_selected_row.replace("row_","");
         if(table_selected_row != undefined)
         {
         console.log(table_selected_row);
         $.post("modules/book/income_delete.php",{id:table_selected_row},function(d,s){
             
             if(d.trim() === 'ok')
             {
                 alert("Success !");
                table.row('.selected').remove().draw(false); 
             }
         });
        }
    }
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



function validateAll(className)
{
    var val = false;
    $( "."+className ).each(function() {
          if($(this).prop('required')){
              var formGroup = $(this).closest('.form-group');
              if(!$(this).val())
              {
                   formGroup.addClass('has-error'); 
                   val = false;
              }
              else
              {
                  formGroup.removeClass('has-error');
                  val = true;
              }
          }
      
    });
      return val;
}

$("#table-print").on( 'click',function(){
     var table_selected_row = table.row('.selected').id();
         table_selected_row = table_selected_row.replace("row_","");
         if(table_selected_row != undefined)
         {
             window.open("report/voucher.php?id="+table_selected_row+"&type=income","_blank");
         }
});
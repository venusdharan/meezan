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

var modal;
$("#table-controls").hide();
$("#add-controls").show();

var cols = [
            { 
                title:"Members ID",
                type:"text",
                cname:'housename',
                ui:false
            },
            { 
                title:"HouseName",
                type:"text",
                cname:'housename',
                ui:true
            },
            { 
                title:"Name",
                type:"text",
                cname:'uname',
                ui:true
            },
            { 
                title:"Phone",
                type:"text",
                cname:"phone",
                ui:true
            },
            { 
                title:"DOB(YMD)",
                type:"date",
                cname:"bdate",
                ui:true
            },
            { 
                title:"BloodGroup",
                type:"select",
                cname:'bloodgroup',
                options:["A-","A+","B+","B-","O+","O-","AB+","AB-"],
                ui:true
            },
            { 
                title:"Gender",
                type:"select",
                cname:'gender',
                options:["Male","Female"],
                ui:true
            },
            { 
                title: "House owner",
                type:"select",
                cname:'owner',
                options:["No","Yes"],
                ui:true
            },
            { 
                title: "Married",
                type:"select",
                cname:'married',
                options:["Yes","No"],
                ui:true
            },
            { 
                title: "Email",
                cname:'email',
                type:"email",
                ui:true
            },
            { 
                title: "Disability",
                type:"select",
                cname:'dis',
                options:["No","Yes"],
                ui:true
            },
            
            { 
                title: "Madrasa",
                type:"text",
                cname:'mad',
                ui:true
            },
            { 
                title: "Education",
                type:"text",
                cname:'edu',
                ui:true
            },
            { 
                title: "Base Membership",
                type:"number",
                cname:'base_mem',
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
	"ajax": "modules/utilities/voucher_processing.php",
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
$.post("modules/table/members_delete.php",{"id":from_data}, function(data, status){
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
var bod = $("#datepicker").val();

var result = { };
$.each($("#modal_form").serializeArray(), function() {
    
    result[this.name] = this.value;
});
result.bdate = bod;
console.log(result);

if(form_valid)
{
$.post("modules/table/members_db.php",
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
    var bod = $("#datepicker").val();
var r_id = table.row('.selected').id();  
r_id  = r_id.replace("row_", "").trim();
var result = { };
$.each($("#modal_form").serializeArray(), function() {
    result[this.name] = this.value;
});
result.bdate = bod;
console.log(result);


$.post("modules/table/members_db.php",
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
         console.log(table_selected_row);
         $.post("modules/table/members_delete.php",{id:table_selected_row},function(d,s){
             
             if(d.trim() === 'ok')
             {
                 alert("Success !");
                table.row('.selected').remove().draw(false); 
             }
         });
    }
});















//# sourceURL=voucher.js
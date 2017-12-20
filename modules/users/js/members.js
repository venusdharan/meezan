document.title = "Members List";
var operation = "";
var modal_cols = 3;
$("#table-controls").hide();
$("#add-controls").show();

var cols = [
            { 
                title: "Username",
                type:"text",
                cname:"username"
            },
            { 
                title: "Email",
                type:"text",
                cname:"email"
            },
            { 
                title: "Password",
                type:"text",
                cname:"password"
            },
            { 
                title: "Name",
                type:"text",
                cname:"mname"
            },
            { 
                title: "Address",
                type:"text",
                cname:"address"
            },
            { 
                title: "Phone",
                type:"text",
                cname:"phone"
            },
            { 
                title: "Designation",
                type:"text",
                cname:"designation"
            },
            { 
                title: "Read Only",
                type:"select",
                options:["No","Yes"],
                cname:"read_only"
            },
            { 
                title: "Admin",
                type:"select",
                options:["Yes","No"],
                cname:"admin"
            }
        ];

var table = $('#example').DataTable( {
        
        dom: 'lBfrtip',
        bSort: false,
           // aoColumns: [ { sWidth: "10%" }, { sWidth: "10%" }, { sWidth: "10%", bSearchable: false, bSortable: false } ],
       // data: dataSet,
        "processing": true,
	"serverSide": true,
	"ajax": "modules/users/members_processing.php",
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
        ]
        
} );
var date =  $('.datepicker').datepicker({
    format: "dd/mm/yyyy"
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
});
$("#table-add").on( 'click',function(){
    operation = "add";
    $("#modaltitle").text("Add new data");
    var modal_cont = "";
    var md_cols = [];
    $.each(cols,function(value,key){
       
       
            var modal_controls = "";
            
            if(key.type == "date")
            {
              modal_controls += '<div class="form-group"><label for="'+key.title+'">'+key.title+':</label><input data-provide="datepicker" name="'+key.cname+'" class="form-control datepicker" id="'+key.title+'" placeholder="Enter '+key.title+'"><input type="hidden" id="my_hidden_input"></div>'; 
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
              modal_controls += '<div class="form-group"><label for="'+key.title+'">'+key.title+':</label>  <select class="input-large form-control" style="width:100%;" name="'+key.cname+'" id="'+key.cname+'" data-style="btn-primary" title="'+key.title+'">'+selects+'</select></div>';   
             // console.log( modal_controls);
            }
            if(key.type == "text")
            {
              modal_controls += '<div class="form-group"><label for="'+key.cname+'">'+key.title+':</label><input type="text" class="form-control" name="'+key.cname+'" id="'+key.cname+'" placeholder="Enter '+key.title+'"></div>'; 
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
    var table_sr = table.row('.selected').data();
    //console.log(table_selected_row);
    $("#modaltitle").text("Add new data");
    var modal_cont = "";
    var md_cols = [];
    $.each(cols,function(value,key){
       
       
            var modal_controls = "";
            
            if(key.type == "date")
            {
              modal_controls += '<div class="form-group"><label for="'+key.title+'">'+key.title+':</label><input data-provide="datepicker" name="'+key.cname+'" class="form-control datepicker" id="'+key.title+'" placeholder="Enter '+key.title+'"><input type="hidden" id="my_hidden_input"></div>'; 
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
              modal_controls += '<div class="form-group"><label for="'+key.title+'">'+key.title+':</label>  <select class="input-large form-control" style="width:100%;" name="'+key.cname+'" id="'+key.cname+'" data-style="btn-primary" title="'+key.title+'">'+selects+'</select></div>';   
             // console.log( modal_controls);
            }
            if(key.type == "text")
            {
              modal_controls += '<div class="form-group"><label for="'+key.cname+'">'+key.title+':</label><input type="text" value="'+table_sr[value]+'" class="form-control" name="'+key.cname+'" id="'+key.cname+'" placeholder="Enter '+key.title+'"></div>'; 
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

$("#modal_sub").on('click',function(){        
var from_data =  table.row('.selected').id();
if(operation == "del")
{
    var r = confirm("Do you want to delete selected user account? ");
    if(r){
    $.post("modules/users/members_delete.php",{"id":from_data}, function(data, status){
             alert("Data: " + data + "\nStatus: " + status);
             if(data.trim() == "Record deleted successfully")
             {
             table.row('.selected').remove().draw(false);
             }
             control_check();
    });
    }
operation = "";
}
if(operation == "add")
{
    /*
var username = $("#Username").val();
var email = $('#Email').val();
var phone = $("#Phone").val();
var name = $("#Name").val();
var password = $("#Password").val();
var address = $("#Address").val();
var designation = $("#Designation").val();
var married = $("#Married").val();
var email = $("#Email").val();
var ward = $("#Ward").val();
        */
 var formdata = $("#modal_form").serializeFormObject();// JSON.stringify();
        $.post("modules/users/members_add.php",{
        data: formdata}
        ,function(data, status){
                alert("Data: " + data + "\nStatus: " + status);
                table.draw();
               // table.row('.selected').remove().draw(false);
        });
 
       
     
operation = "";
}
if(operation == "edit")
{
 var formdata = $("#modal_form").serializeFormObject();// JSON.stringify();
 formdata.id = table.row('.selected').id(); 
 console.log(formdata);
        $.post("modules/users/members_edit.php",{
        data: formdata}
        ,function(data, status){
                alert("Data: " + data + "\nStatus: " + status);
                table.draw();
               // table.row('.selected').remove().draw(false);
        });
operation = "";
}
});

$("#table-delete").on( 'click',function(){
      var id = table.row('.selected').id();
    var r = confirm("Do you want to delete selected item?");
    if(r){
      //id = id.replace("row_","");
     $.post("modules/users/members_delete.php",
    {
        "id":id
    }
    ,function(data, status){
        /*
          alert("Data: " + data + "\nStatus: " + status);
           control_check();
            table.row('.selected').remove().draw(false);
             table.draw();
             */
            
            alert("Data: " + data + "\nStatus: " + status);
             if(data.trim() == "Record deleted successfully")
             {
             table.row('.selected').remove().draw(false);
             }
             control_check();
    });
    }
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
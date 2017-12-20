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
            { title: "Name" },
            { title: "Position" },
            { title: "Office" },
            { title: "Extn" },
            { title: "Start date" },
            { title: "Salary" }
        ];
var table = $('#example').DataTable( {
        
        dom: 'lBfrtip',
         bSort: false,
           // aoColumns: [ { sWidth: "10%" }, { sWidth: "10%" }, { sWidth: "10%", bSearchable: false, bSortable: false } ],
       // data: dataSet,
        "processing": true,
		"serverSide": true,
		"ajax": "modules/table/server_processing.php",
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
   
   
    //alert(table.row('.selected').data());
    //alert('hh'); <span class="glyphicon glyphicon-eye-open"></span>
    //var cols_json =  $.parseJSON(cols);
    $("#modaltitle").text("Add new data");
    var modal_controls = "";
    $.each(cols,function(value,key){
       modal_controls += '<div class="form-group"><label for="'+key.title+'">'+key.title+':</label><input type="text" class="form-control" id="'+key.title+'"  placeholder=""></div>';
       //console.log('mod'+key.title);
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

$("#table-edit").on( 'click',function(){
    var table_selected_row = table.row('.selected').data();
     var modal_controls = "";
      $("#modaltitle").text("Edit data");
    $.each(cols,function(value,key){
       modal_controls += '<div class="form-group"><label for="'+key.title+'">'+key.title+':</label><input type="text" name="'+key.title+'" class="form-control" id="'+key.title+'" value="'+table_selected_row[value]+'" placeholder=""></div>';
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
        //console.log(from_data);
              if(operation == "del")
              {
             /*
                    $.ajax({
                        url: "modules/table/delete.php",
                        method: 'POST',
                        data: from_data,
                        dataType: 'json',
                        success: function( data, status, xhr ) {
                            //contacts.rows( $('#contacts tr.active') ).remove().draw(false); { rows: selectedRows.toArray() }
                          //  table.row('.selected').remove().draw(false);
                            alert(data);
                        }
                    });
               */   
              
    
            $.post("modules/table/delete.php",{"id":from_data}, function(data, status){
                    alert("Data: " + data + "\nStatus: " + status);
                     table.row('.selected').remove().draw(false);
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
       modal_controls += '<div class="form-group"><label for="'+key.title+'">'+key.title+':</label><input type="text" name="'+key.title+'" class="form-control" id="'+key.title+'" value="'+table_selected_row[value]+'" placeholder="Enter '+key.title+'"></div>';
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

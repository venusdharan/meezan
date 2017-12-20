$('#myModal').modal({
            backdrop: 'static',
            keyboard: false,
            show:false
        });

$("#table-add").on("click",function(){
       $('#myModal').modal("show");
});

$.post("modules/book/expense_type_p.php",{op:'all',data:'ward'},function(d,s){
    $.each($.parseJSON(d.trim()), function(idx, obj) {
	$('#ward_table tbody').append('<tr><td>'+obj.type+'</td><td><button type="button" id="'+obj.id+'" class="btn delbtncls btn-danger">Delete</button></td></tr>');
    });
});

$(document).on("click",".delbtncls",function(){
    var id = $(this).attr('id');
   var result = confirm("Want to delete?");
    if (result) {
        $.post("modules/book/expense_type_p.php",{op:'del',data:id},function(d,s){
            if(d.trim() == "Record deleted successfully")
            {
                 $('#'+id).closest('tr').remove();
            }
            alert(d.trim());
        });
    }
      
   
});

$("#modal_sub").on("click",function(){
    var ward = $("#ward").val();
    if(ward !== "")
    {
    $.post("modules/book/expense_type_p.php",{op:'add',data:ward},function(d,s){
       if(d.trim() !== "Failed")
       {
           //alert(d);
           $('#ward_table tbody').append('<tr><td>'+ward+'</td><td><button type="button" id="'+d+'" class="btn delbtncls btn-danger">Delete</button></td></tr>');
           $("#ward").val('');
            $('#myModal').modal("hide");
       }
    });
    }
});

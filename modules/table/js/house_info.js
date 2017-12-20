$("#house_search").on("click",function(){
    if($("#sel1").val())
    {
        var num = $("#sel1").val();
        $.post("modules/table/house_info_pro.php",{h_num:num},function(d,s){
            $("#res").html(d);
        });
    }else
    {
        $("#res").html('');
    }
});
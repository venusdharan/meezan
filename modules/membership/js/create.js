/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

Date.prototype.toDateInputValue = (function() {
    var local = new Date(this);
    local.setMinutes(this.getMinutes() - this.getTimezoneOffset());
    return local.toJSON().slice(0,10);
});

//$("#m_date").val(new Date().toDateInputValue());

$("#table-add").on("click",function(){
    var m_name     = $("#m_name").val();
    var m_date     = $("#m_date").val();
    var m_house    = $("#m_house").val();
    var m_dis      = $("#m_dis").val();
    var m_gender   = $("#m_gender").val();
    var m_base_mem = $("#m_base_mem").val();
    var m_amt      = $("#m_amt").val();
    
    var valid = true;
    
    if(m_name == undefined || m_name == "")
    {
       //valid =  showError("A");   
    }
    
    if(m_date == undefined || m_date == "")
    {
       //valid =  showError("Date is mandatory");   
    }
    
    if(m_name == undefined || m_name == "")
    {
       //valid =  showError("Date is mandatory");   
    }
    
});

function showError(error)
{
    $("#status").html('<div class="alert alert-danger"><strong>Danger!</strong>'+error+'</div>');
    return false;
}

$("#modal_form").on("submit",function(){
    var result = { };
    $.each($("#modal_form").serializeArray(), function() {
        result[this.name] = this.value;
    });
    console.log(result);
    
    $.post("modules/membership/create_membership.php",{data:result},function(d,s){
        alert(d);
    });
    
    return false;
});
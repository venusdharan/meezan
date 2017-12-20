/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


function GenerateFormControls(data)
{
    var out_t = '';
    switch(data.type)
    {
        case 'text':
        out_t =  '<div class="form-group"><label for="'+data.cname+'">'+data.title+':</label><input type="'+data.type+'" name="'+data.cname+'" class="form-control '+data.cls+'" id="'+data.id+'" placeholder="Enter '+data.title+'"></div>'; 
        break;
        
        case 'password':
        out_t =  '<div class="form-group"><label for="'+data.cname+'">'+data.title+':</label><input type="'+data.type+'" name="'+data.cname+'" class="form-control '+data.cls+'" id="'+data.id+'" placeholder="Enter '+data.title+'"></div>'; 
        break;
        
        case 'textarea':
        out_t =  '<div class="form-group"><label for="'+data.cname+'">'+data.title+':</label><textarea name="'+data.cname+'" class="form-control '+data.cls+'" id="'+data.id+'" >Enter '+data.title+'</textarea></div>'; 
        break;
        
        case 'select':
        out_t =  '<div class="form-group"><label for="'+data.cname+'">'+data.title+':</label><select name="'+data.cname+'" class="form-control '+data.cls+'" id="'+data.id+'" >';
        
         var sel = '';
         $.each(data.options,function(i,e){
             
                 if(data.sel == e)
                 {
                    sel = sel + '<option selected value="'+e+'">'+e+'</option>';
                 }
                 else
                 {
                     sel = sel + '<option  value="'+e+'">'+e+'</option>'; 
                 }
             
         });
            
        out_t = out_t + sel +'</select></div>'; 
        break;
        
    }
    return out_t;
}

function LoadSidebarMenu()
{
    
}


function createcontrol(title_val,data_val,type_val,class_val,id_val,attr_val)
{
    var control = "";
    switch (type)
    {
       case "button":
       control = '<div class="form-group"><label for="'+title_val+'">'+title_val+':</label><input type="'+type_val+'" name="'+title_val+'" class="form-control '+class_val+'" id="'+id_val+'" value="'+data_val+'" placeholder="Enter '+title_val+'" '+attr_val+'></div>';
       break;
       case "checkbox":
       control = '<div class="form-group"><label for="'+title_val+'">'+title_val+':</label><input type="'+type_val+'" name="'+title_val+'" class="form-control '+class_val+'" id="'+id_val+'" value="'+data_val+'" placeholder="Enter '+title_val+'" '+attr_val+'></div>';
       break;
       case "color":
       control = '';
       break;
       case "date":
       control = '<div class="form-group"><label for="'+title_val+'">'+key.title+':</label><input data-provide="datepicker" class="form-control datepicker" id="'+key.title+'" value="'+table_selected_row[value]+'" placeholder="Enter '+key.title+'"><input type="hidden" id="'+key.title+'_date"></div>';
       break;
       case "datetime-local":
       control = '';
       break;
       case "email":
       control = '<div class="form-group"><label for="'+title_val+'">'+key.title+':</label><input data-provide="datepicker" class="form-control datepicker" id="'+key.title+'" value="'+table_selected_row[value]+'" placeholder="Enter '+key.title+'"><input type="hidden" id="'+key.title+'_date"></div>';
       break;
       case "file":
       control = '';
       break;
       case "hidden":
       control = '';
       break;
       case "image":
       control = '';
       break;
       case "month":
       control = '';
       break;
       case "number":
       control = '';
       break;
       case "password":
       control = '';
       break;
       case "radio":
       control = '';
       break;
       case "range":
       control = '';
       break;
       case "reset":
       control = '';
       break;
       case "search":
       control = '';
       break;
       case "submit":
       control = '';
       break;
       case "tel":
       control = '';
       break;
       case "time":
       control = '';
       break;
       case "url":
       control = '';
       break;
       case "week":
       control = '';
       break;
    }
    return control;
}


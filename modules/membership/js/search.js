document.title = "Membership Search";

var cols = [
            
            { 
                title:"Membership Name",
                type:"text",
                cname:'housename'
            },
            { 
                title:"Date",
                type:"text",
                cname:'uname'
            },
            { 
                title:"House Owner",
                type:"text",
                cname:"phone"
            },
            { 
                title:"Disabled Member",
                type:"date",
                cname:"bdate"
            },
            { 
                title:"Gender",
                type:"select",
                cname:'bloodgroup',
                options:["A-","A+","B+","B-","O+","O-","AB+","AB-"]
            },
            { 
                title:"Min Age",
                type:"select",
                cname:'gender',
                options:["Male","Female"]
            },
            { 
                title: "NRI",
                type:"select",
                cname:'owner',
                options:["Yes","No"]
            },
            { 
                title: "Amount",
                type:"select",
                cname:'married',
                options:["Yes","No"]
            },
            { 
                title: "Base Membership",
                type:"select",
                cname:'married',
                options:["Yes","No"]
            },
            { 
                title: "Included Members",
                type:"select",
                cname:'married',
                options:["Yes","No"]
            }
        ];


$.post("modules/membership/getplan.php",{op:'all',data:'ward'},function(d,s){
    var selects = '<label for="sel1">Select Bloodgroup:</label> <select class="form-control" id="sel1">' + "<option>" + "Select Membership Plan" + "</option>";
   // console.log(d);
    if(d.length > 0){
    $.each($.parseJSON(d.trim()), function(idx, opt_val) {
	//$('#ward_table tbody').append('<tr><td>'+obj.name+'</td><td><button type="button" id="'+obj.id+'" class="btn delbtncls btn-danger">Delete</button></td></tr>');
        //wards.push(obj.name);
        selects = selects + "<option data-tokens="+"'"+opt_val.mem_name+"'"+">" + opt_val.mem_name + "</option>";
       // console.log(opt_val);
    });
}
    selects = selects + "</select>";
    
    $("#sel1_div").html(selects);
});


$("#table-controls").hide();
$("#add-controls").show();
var def_bg = '0';
var table = $('#example').DataTable( {
        
        dom: 'lBfrtip',
        bSort: false,
        "bFilter": false,
           // aoColumns: [ { sWidth: "10%" }, { sWidth: "10%" }, { sWidth: "10%", bSearchable: false, bSortable: false } ],
       // data: dataSet,
        "processing": true,
	"serverSide": true,
	//"ajax": "modules/membership/search_processing.php?bg="+def_bg,
        "ajax":  {
                "url": "modules/membership/search_processing.php",
                "type": "POST",
                "data": function(d) {
                    d.bg = def_bg;
                    //d.Bar = "foo";
                    //d.FooBar = "foobarz";
                }
            },
            "serverSide":true,
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

control_check();

var table_row="";
 $('#example tbody').on( 'click', 'tr', function () {
    if(table.data().count()>0){
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
    }
} );

$(document).on('change','#sel1', function (e) {
    var optionSelected = $("option:selected", this);
    def_bg = this.value;

   update_rec();
   

});

$("#table-add").on('click',function(){
     var r_id = table.row('.selected').id(); 
       if(r_id != undefined){
        r_id  = r_id.replace("row_", "").trim();

        $.post("modules/membership/update_members.php",{id:r_id},function(d1,s1){
            alert(d1.trim());
          

   update_rec();
        });
    }
});

$("#table-delete").on("click",function(){
    if(confirm("Do you want to delete the selected Item"))
    {
        var r_id = table.row('.selected').id(); 
        if(r_id != undefined){
        r_id  = r_id.replace("row_", "").trim();

        $.post("modules/membership/membership_delete.php",{id:r_id},function(d1,s1){
            if(s1.trim() == "success")
            {

                $.post("modules/membership/getplan.php",{op:'all',data:'ward'},function(d,s){
                    def_bg = '0';
                    var selects = '<label for="sel1">Select Bloodgroup:</label> <select class="form-control" id="sel1">' + "<option>" + "Select Membership Plan" + "</option>";
                    $.each($.parseJSON(d.trim()), function(idx, opt_val) {
                        //$('#ward_table tbody').append('<tr><td>'+obj.name+'</td><td><button type="button" id="'+obj.id+'" class="btn delbtncls btn-danger">Delete</button></td></tr>');
                        //wards.push(obj.name);
                        selects = selects + "<option data-tokens="+"'"+opt_val.mem_name+"'"+">" + opt_val.mem_name + "</option>";
                       // console.log(opt_val);
                    });
                    selects = selects + "</select>";
                    $("#sel1_div").html(selects);
                    update_rec();
                });
            }
        });
    }
    }
    
});

function update_rec()
{
 
table.ajax.reload();//.url( "modules/membership/search_processing.php?bg="+def_bg ).load();
 
}



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


//# sourceURL=members.js
var operation = "";
var modal_cols = 3;

var contries = [
    {
        "name": "Afghanistan",
        "code": "AF"
    },
    {
        "name": "Åland Islands",
        "code": "AX"
    },
    {
        "name": "Albania",
        "code": "AL"
    },
    {
        "name": "Algeria",
        "code": "DZ"
    },
    {
        "name": "American Samoa",
        "code": "AS"
    },
    {
        "name": "AndorrA",
        "code": "AD"
    },
    {
        "name": "Angola",
        "code": "AO"
    },
    {
        "name": "Anguilla",
        "code": "AI"
    },
    {
        "name": "Antarctica",
        "code": "AQ"
    },
    {
        "name": "Antigua and Barbuda",
        "code": "AG"
    },
    {
        "name": "Argentina",
        "code": "AR"
    },
    {
        "name": "Armenia",
        "code": "AM"
    },
    {
        "name": "Aruba",
        "code": "AW"
    },
    {
        "name": "Australia",
        "code": "AU"
    },
    {
        "name": "Austria",
        "code": "AT"
    },
    {
        "name": "Azerbaijan",
        "code": "AZ"
    },
    {
        "name": "Bahamas",
        "code": "BS"
    },
    {
        "name": "Bahrain",
        "code": "BH"
    },
    {
        "name": "Bangladesh",
        "code": "BD"
    },
    {
        "name": "Barbados",
        "code": "BB"
    },
    {
        "name": "Belarus",
        "code": "BY"
    },
    {
        "name": "Belgium",
        "code": "BE"
    },
    {
        "name": "Belize",
        "code": "BZ"
    },
    {
        "name": "Benin",
        "code": "BJ"
    },
    {
        "name": "Bermuda",
        "code": "BM"
    },
    {
        "name": "Bhutan",
        "code": "BT"
    },
    {
        "name": "Bolivia",
        "code": "BO"
    },
    {
        "name": "Bosnia and Herzegovina",
        "code": "BA"
    },
    {
        "name": "Botswana",
        "code": "BW"
    },
    {
        "name": "Bouvet Island",
        "code": "BV"
    },
    {
        "name": "Brazil",
        "code": "BR"
    },
    {
        "name": "British Indian Ocean Territory",
        "code": "IO"
    },
    {
        "name": "Brunei Darussalam",
        "code": "BN"
    },
    {
        "name": "Bulgaria",
        "code": "BG"
    },
    {
        "name": "Burkina Faso",
        "code": "BF"
    },
    {
        "name": "Burundi",
        "code": "BI"
    },
    {
        "name": "Cambodia",
        "code": "KH"
    },
    {
        "name": "Cameroon",
        "code": "CM"
    },
    {
        "name": "Canada",
        "code": "CA"
    },
    {
        "name": "Cape Verde",
        "code": "CV"
    },
    {
        "name": "Cayman Islands",
        "code": "KY"
    },
    {
        "name": "Central African Republic",
        "code": "CF"
    },
    {
        "name": "Chad",
        "code": "TD"
    },
    {
        "name": "Chile",
        "code": "CL"
    },
    {
        "name": "China",
        "code": "CN"
    },
    {
        "name": "Christmas Island",
        "code": "CX"
    },
    {
        "name": "Cocos (Keeling) Islands",
        "code": "CC"
    },
    {
        "name": "Colombia",
        "code": "CO"
    },
    {
        "name": "Comoros",
        "code": "KM"
    },
    {
        "name": "Congo",
        "code": "CG"
    },
    {
        "name": "Congo, The Democratic Republic of the",
        "code": "CD"
    },
    {
        "name": "Cook Islands",
        "code": "CK"
    },
    {
        "name": "Costa Rica",
        "code": "CR"
    },
    {
        "name": "Cote D\"Ivoire",
        "code": "CI"
    },
    {
        "name": "Croatia",
        "code": "HR"
    },
    {
        "name": "Cuba",
        "code": "CU"
    },
    {
        "name": "Cyprus",
        "code": "CY"
    },
    {
        "name": "Czech Republic",
        "code": "CZ"
    },
    {
        "name": "Denmark",
        "code": "DK"
    },
    {
        "name": "Djibouti",
        "code": "DJ"
    },
    {
        "name": "Dominica",
        "code": "DM"
    },
    {
        "name": "Dominican Republic",
        "code": "DO"
    },
    {
        "name": "Ecuador",
        "code": "EC"
    },
    {
        "name": "Egypt",
        "code": "EG"
    },
    {
        "name": "El Salvador",
        "code": "SV"
    },
    {
        "name": "Equatorial Guinea",
        "code": "GQ"
    },
    {
        "name": "Eritrea",
        "code": "ER"
    },
    {
        "name": "Estonia",
        "code": "EE"
    },
    {
        "name": "Ethiopia",
        "code": "ET"
    },
    {
        "name": "Falkland Islands (Malvinas)",
        "code": "FK"
    },
    {
        "name": "Faroe Islands",
        "code": "FO"
    },
    {
        "name": "Fiji",
        "code": "FJ"
    },
    {
        "name": "Finland",
        "code": "FI"
    },
    {
        "name": "France",
        "code": "FR"
    },
    {
        "name": "French Guiana",
        "code": "GF"
    },
    {
        "name": "French Polynesia",
        "code": "PF"
    },
    {
        "name": "French Southern Territories",
        "code": "TF"
    },
    {
        "name": "Gabon",
        "code": "GA"
    },
    {
        "name": "Gambia",
        "code": "GM"
    },
    {
        "name": "Georgia",
        "code": "GE"
    },
    {
        "name": "Germany",
        "code": "DE"
    },
    {
        "name": "Ghana",
        "code": "GH"
    },
    {
        "name": "Gibraltar",
        "code": "GI"
    },
    {
        "name": "Greece",
        "code": "GR"
    },
    {
        "name": "Greenland",
        "code": "GL"
    },
    {
        "name": "Grenada",
        "code": "GD"
    },
    {
        "name": "Guadeloupe",
        "code": "GP"
    },
    {
        "name": "Guam",
        "code": "GU"
    },
    {
        "name": "Guatemala",
        "code": "GT"
    },
    {
        "name": "Guernsey",
        "code": "GG"
    },
    {
        "name": "Guinea",
        "code": "GN"
    },
    {
        "name": "Guinea-Bissau",
        "code": "GW"
    },
    {
        "name": "Guyana",
        "code": "GY"
    },
    {
        "name": "Haiti",
        "code": "HT"
    },
    {
        "name": "Heard Island and Mcdonald Islands",
        "code": "HM"
    },
    {
        "name": "Holy See (Vatican City State)",
        "code": "VA"
    },
    {
        "name": "Honduras",
        "code": "HN"
    },
    {
        "name": "Hong Kong",
        "code": "HK"
    },
    {
        "name": "Hungary",
        "code": "HU"
    },
    {
        "name": "Iceland",
        "code": "IS"
    },
    {
        "name": "India",
        "code": "IN"
    },
    {
        "name": "Indonesia",
        "code": "ID"
    },
    {
        "name": "Iran, Islamic Republic Of",
        "code": "IR"
    },
    {
        "name": "Iraq",
        "code": "IQ"
    },
    {
        "name": "Ireland",
        "code": "IE"
    },
    {
        "name": "Isle of Man",
        "code": "IM"
    },
    {
        "name": "Israel",
        "code": "IL"
    },
    {
        "name": "Italy",
        "code": "IT"
    },
    {
        "name": "Jamaica",
        "code": "JM"
    },
    {
        "name": "Japan",
        "code": "JP"
    },
    {
        "name": "Jersey",
        "code": "JE"
    },
    {
        "name": "Jordan",
        "code": "JO"
    },
    {
        "name": "Kazakhstan",
        "code": "KZ"
    },
    {
        "name": "Kenya",
        "code": "KE"
    },
    {
        "name": "Kiribati",
        "code": "KI"
    },
    {
        "name": "Korea, Democratic People\"S Republic of",
        "code": "KP"
    },
    {
        "name": "Korea, Republic of",
        "code": "KR"
    },
    {
        "name": "Kuwait",
        "code": "KW"
    },
    {
        "name": "Kyrgyzstan",
        "code": "KG"
    },
    {
        "name": "Lao People\"S Democratic Republic",
        "code": "LA"
    },
    {
        "name": "Latvia",
        "code": "LV"
    },
    {
        "name": "Lebanon",
        "code": "LB"
    },
    {
        "name": "Lesotho",
        "code": "LS"
    },
    {
        "name": "Liberia",
        "code": "LR"
    },
    {
        "name": "Libyan Arab Jamahiriya",
        "code": "LY"
    },
    {
        "name": "Liechtenstein",
        "code": "LI"
    },
    {
        "name": "Lithuania",
        "code": "LT"
    },
    {
        "name": "Luxembourg",
        "code": "LU"
    },
    {
        "name": "Macao",
        "code": "MO"
    },
    {
        "name": "Macedonia, The Former Yugoslav Republic of",
        "code": "MK"
    },
    {
        "name": "Madagascar",
        "code": "MG"
    },
    {
        "name": "Malawi",
        "code": "MW"
    },
    {
        "name": "Malaysia",
        "code": "MY"
    },
    {
        "name": "Maldives",
        "code": "MV"
    },
    {
        "name": "Mali",
        "code": "ML"
    },
    {
        "name": "Malta",
        "code": "MT"
    },
    {
        "name": "Marshall Islands",
        "code": "MH"
    },
    {
        "name": "Martinique",
        "code": "MQ"
    },
    {
        "name": "Mauritania",
        "code": "MR"
    },
    {
        "name": "Mauritius",
        "code": "MU"
    },
    {
        "name": "Mayotte",
        "code": "YT"
    },
    {
        "name": "Mexico",
        "code": "MX"
    },
    {
        "name": "Micronesia, Federated States of",
        "code": "FM"
    },
    {
        "name": "Moldova, Republic of",
        "code": "MD"
    },
    {
        "name": "Monaco",
        "code": "MC"
    },
    {
        "name": "Mongolia",
        "code": "MN"
    },
    {
        "name": "Montserrat",
        "code": "MS"
    },
    {
        "name": "Morocco",
        "code": "MA"
    },
    {
        "name": "Mozambique",
        "code": "MZ"
    },
    {
        "name": "Myanmar",
        "code": "MM"
    },
    {
        "name": "Namibia",
        "code": "NA"
    },
    {
        "name": "Nauru",
        "code": "NR"
    },
    {
        "name": "Nepal",
        "code": "NP"
    },
    {
        "name": "Netherlands",
        "code": "NL"
    },
    {
        "name": "Netherlands Antilles",
        "code": "AN"
    },
    {
        "name": "New Caledonia",
        "code": "NC"
    },
    {
        "name": "New Zealand",
        "code": "NZ"
    },
    {
        "name": "Nicaragua",
        "code": "NI"
    },
    {
        "name": "Niger",
        "code": "NE"
    },
    {
        "name": "Nigeria",
        "code": "NG"
    },
    {
        "name": "Niue",
        "code": "NU"
    },
    {
        "name": "Norfolk Island",
        "code": "NF"
    },
    {
        "name": "Northern Mariana Islands",
        "code": "MP"
    },
    {
        "name": "Norway",
        "code": "NO"
    },
    {
        "name": "Oman",
        "code": "OM"
    },
    {
        "name": "Pakistan",
        "code": "PK"
    },
    {
        "name": "Palau",
        "code": "PW"
    },
    {
        "name": "Palestinian Territory, Occupied",
        "code": "PS"
    },
    {
        "name": "Panama",
        "code": "PA"
    },
    {
        "name": "Papua New Guinea",
        "code": "PG"
    },
    {
        "name": "Paraguay",
        "code": "PY"
    },
    {
        "name": "Peru",
        "code": "PE"
    },
    {
        "name": "Philippines",
        "code": "PH"
    },
    {
        "name": "Pitcairn",
        "code": "PN"
    },
    {
        "name": "Poland",
        "code": "PL"
    },
    {
        "name": "Portugal",
        "code": "PT"
    },
    {
        "name": "Puerto Rico",
        "code": "PR"
    },
    {
        "name": "Qatar",
        "code": "QA"
    },
    {
        "name": "Reunion",
        "code": "RE"
    },
    {
        "name": "Romania",
        "code": "RO"
    },
    {
        "name": "Russian Federation",
        "code": "RU"
    },
    {
        "name": "RWANDA",
        "code": "RW"
    },
    {
        "name": "Saint Helena",
        "code": "SH"
    },
    {
        "name": "Saint Kitts and Nevis",
        "code": "KN"
    },
    {
        "name": "Saint Lucia",
        "code": "LC"
    },
    {
        "name": "Saint Pierre and Miquelon",
        "code": "PM"
    },
    {
        "name": "Saint Vincent and the Grenadines",
        "code": "VC"
    },
    {
        "name": "Samoa",
        "code": "WS"
    },
    {
        "name": "San Marino",
        "code": "SM"
    },
    {
        "name": "Sao Tome and Principe",
        "code": "ST"
    },
    {
        "name": "Saudi Arabia",
        "code": "SA"
    },
    {
        "name": "Senegal",
        "code": "SN"
    },
    {
        "name": "Serbia and Montenegro",
        "code": "CS"
    },
    {
        "name": "Seychelles",
        "code": "SC"
    },
    {
        "name": "Sierra Leone",
        "code": "SL"
    },
    {
        "name": "Singapore",
        "code": "SG"
    },
    {
        "name": "Slovakia",
        "code": "SK"
    },
    {
        "name": "Slovenia",
        "code": "SI"
    },
    {
        "name": "Solomon Islands",
        "code": "SB"
    },
    {
        "name": "Somalia",
        "code": "SO"
    },
    {
        "name": "South Africa",
        "code": "ZA"
    },
    {
        "name": "South Georgia and the South Sandwich Islands",
        "code": "GS"
    },
    {
        "name": "Spain",
        "code": "ES"
    },
    {
        "name": "Sri Lanka",
        "code": "LK"
    },
    {
        "name": "Sudan",
        "code": "SD"
    },
    {
        "name": "Suriname",
        "code": "SR"
    },
    {
        "name": "Svalbard and Jan Mayen",
        "code": "SJ"
    },
    {
        "name": "Swaziland",
        "code": "SZ"
    },
    {
        "name": "Sweden",
        "code": "SE"
    },
    {
        "name": "Switzerland",
        "code": "CH"
    },
    {
        "name": "Syrian Arab Republic",
        "code": "SY"
    },
    {
        "name": "Taiwan, Province of China",
        "code": "TW"
    },
    {
        "name": "Tajikistan",
        "code": "TJ"
    },
    {
        "name": "Tanzania, United Republic of",
        "code": "TZ"
    },
    {
        "name": "Thailand",
        "code": "TH"
    },
    {
        "name": "Timor-Leste",
        "code": "TL"
    },
    {
        "name": "Togo",
        "code": "TG"
    },
    {
        "name": "Tokelau",
        "code": "TK"
    },
    {
        "name": "Tonga",
        "code": "TO"
    },
    {
        "name": "Trinidad and Tobago",
        "code": "TT"
    },
    {
        "name": "Tunisia",
        "code": "TN"
    },
    {
        "name": "Turkey",
        "code": "TR"
    },
    {
        "name": "Turkmenistan",
        "code": "TM"
    },
    {
        "name": "Turks and Caicos Islands",
        "code": "TC"
    },
    {
        "name": "Tuvalu",
        "code": "TV"
    },
    {
        "name": "Uganda",
        "code": "UG"
    },
    {
        "name": "Ukraine",
        "code": "UA"
    },
    {
        "name": "United Arab Emirates",
        "code": "AE"
    },
    {
        "name": "United Kingdom",
        "code": "GB"
    },
    {
        "name": "United States",
        "code": "US"
    },
    {
        "name": "United States Minor Outlying Islands",
        "code": "UM"
    },
    {
        "name": "Uruguay",
        "code": "UY"
    },
    {
        "name": "Uzbekistan",
        "code": "UZ"
    },
    {
        "name": "Vanuatu",
        "code": "VU"
    },
    {
        "name": "Venezuela",
        "code": "VE"
    },
    {
        "name": "Viet Nam",
        "code": "VN"
    },
    {
        "name": "Virgin Islands, British",
        "code": "VG"
    },
    {
        "name": "Virgin Islands, U.S.",
        "code": "VI"
    },
    {
        "name": "Wallis and Futuna",
        "code": "WF"
    },
    {
        "name": "Western Sahara",
        "code": "EH"
    },
    {
        "name": "Yemen",
        "code": "YE"
    },
    {
        "name": "Zambia",
        "code": "ZM"
    },
    {
        "name": "Zimbabwe",
        "code": "ZW"
    }
]





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
var wards = [];
var cat = [];
var cont = [];
$.each(contries ,function(i,d){
    cont.push(d.name);

});
  console.log(cont);
$.post("modules/table/ward_p.php",{op:'all',data:'ward'},function(d,s){
    $.each($.parseJSON(d.trim()), function(idx, obj) {
	//$('#ward_table tbody').append('<tr><td>'+obj.name+'</td><td><button type="button" id="'+obj.id+'" class="btn delbtncls btn-danger">Delete</button></td></tr>');
        wards.push(obj.name);
    });
});



$.post("modules/table/cat_p.php",{op:'all',data:'ward'},function(d,s){
    $.each($.parseJSON(d.trim()), function(idx, obj) {
	//$('#ward_table tbody').append('<tr><td>'+obj.name+'</td><td><button type="button" id="'+obj.id+'" class="btn delbtncls btn-danger">Delete</button></td></tr>');
        cat.push(obj.name);
    });
});



var cols = [
            
            { 
                title: "HouseName",
                type:"text",
                cname:'housename'
            },
            { 
                title: "Name",
                type:"text",
                cname:'uname'
            },
            { 
                title: "Phone",
                type:"text",
                cname:"phone"
            },
            { 
                title: "DOB(YMD)",
                type:"date",
                cname:"bdate"
            },
            { 
                title: "BloodGroup",
                type:"select",
                cname:'bloodgroup',
                options:["A-","A+","B+","B-","O+","O-","AB+","AB-"]
            },
            { 
                title: "Gender",
                type:"select",
                cname:'gender',
                options:["Male","Female"]
            },
            { 
                title: "Owner",
                type:"select",
                cname:'owner',
                options:["Yes","No"]
            },
            { 
                title: "Married",
                type:"select",
                cname:'married',
                options:["Yes","No"]
            },
            { 
                title: "Email",
                cname:'email',
                type:"text"
            },
            { 
                title: "Ward",
                type:"select",
                cname:"ward",
                options:wards
            },
            { 
                title: "Category",
                type:"select",
                cname:'category',
                options:cat
            },
            { 
                title: "Disability",
                type:"text",
                cname:'dis'
            },
            { 
                title: "NRI",
                type:"select",
                cname:'nri',
                options:cont
            },
            { 
                title: "Madrasa",
                type:"text",
                cname:'mad'
            },
            { 
                title: "Education",
                type:"text",
                cname:'edu'
            }
        ];

var table = $('#example').DataTable( {
        
        dom: 'lBfrtip',
        bSort: false,
           // aoColumns: [ { sWidth: "10%" }, { sWidth: "10%" }, { sWidth: "10%", bSearchable: false, bSortable: false } ],
       // data: dataSet,
        "processing": true,
	"serverSide": true,
	"ajax": "modules/table/members_processing.php",
        columns:cols ,
        buttons: [
            {
                extend: 'colvis',
                columns: ':not(:first-child)'
            }/*,
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
            }*/
        ]
        
} );
var date =  $('.datepicker').datepicker({
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
       
       
            var modal_controls = "";
            
            if(key.type == "date")
            {
              modal_controls +=  '<div class="form-group"><label for="'+key.cname+'">'+key.title+':</label><div class="input-group date"><div class="input-group-addon"><i class="fa fa-calendar"></i></div><input type="text" data-provide="datepicker" class="form-control datepicker " id="datepicker" name="'+key.cname+'"></div></div>';                                                    //'<div class="form-group"><label for="'+key.title+'">'+key.title+':</label><input data-provide="datepicker" class="form-control datepicker" id="'+key.title+'" placeholder="Enter '+key.title+'" name="'+key.cname+'"><input type="hidden"  id="my_hidden_input"></div>'; 
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
              modal_controls += '<div class="form-group"><label for="'+key.title+'">'+key.title+':</label>  <select class="input-large form-control" style="width:100%;" name="'+key.cname+'" id="'+key.title+'" data-style="btn-primary" title="'+key.title+'">'+selects+'</select></div>';   
             // console.log( modal_controls);
            }
            if(key.type == "text")
            {
              modal_controls += '<div class="form-group"><label for="'+key.title+'">'+key.title+':</label><input type="text" class="form-control" name="'+key.cname+'" id="'+key.title+'" placeholder="Enter '+key.title+'"></div>'; 
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
    var md_cols = [];
    var table_selected_row = table.row('.selected').data();
    //console.log(table_selected_row);
    var modal_cont = "";
    $("#modaltitle").text("Edit data");
    $.each(table_selected_row,function(val,key){
        if(val !== 'DT_RowId')
        {
            var type = cols[val].type;
            var cname = cols[val].cname;
            var title = cols[val].title;
            var modal_controls = ""; 
            if(type === "date")
            {
              modal_controls += '<div class="form-group"><label for="'+cname+'">'+title+':</label><input data-provide="datepicker" class="form-control datepicker" id="'+cname+'" placeholder="Enter '+cname+'" value="'+key+'"><input type="hidden" id="my_hidden_input"></div>'; 
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
              modal_controls += '<div class="form-group"><label for="'+cname+'">'+title+':</label><input type="text" class="form-control" id="'+cname+'" placeholder="Enter '+cname+'"></div>'; 
            }
           
           md_cols.push(modal_controls);
           
        }
    });
      
      
    /* 
    $.each(cols,function(value,key){
        
        var modal_controls = ""; 
        if(key.type == "date")
        {
          modal_controls += '<div class="form-group"><label for="'+key.title+'">'+key.title+':</label><input data-provide="datepicker" class="form-control datepicker" id="'+key.title+'" placeholder="Enter '+key.title+'"><input type="hidden" id="my_hidden_input"></div>'; 
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
          modal_controls += '<div class="form-group"><label for="'+key.title+'">'+key.title+':</label>  <select class="input-large form-control" style="width:100%;" name="'+key.title+'" id="'+key.title+'" data-style="btn-primary" title="'+key.title+'">'+selects+'</select></div>';   
         // console.log( modal_controls);
        }
        if(key.type == "text")
        {
          modal_controls += '<div class="form-group"><label for="'+key.title+'">'+key.title+':</label><input type="text" class="form-control" id="'+key.title+'" placeholder="Enter '+key.title+'"></div>'; 
        }
        
        md_cols.push(modal_controls);
        
    });
    */
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
$.post("modules/table/members_delete.php",{"id":from_data}, function(data, status){
         alert("Data: " + data + "\nStatus: " + status);
         table.row('.selected').remove().draw(false);
         control_check();
});
operation = "";
}
if(operation == "add")
{

var bod = $("#datepicker").val();

/*
$.post("modules/table/members_add.php",
{
    "name":name,
    "housename":housename,
    "phone":phone,
    "age":age,
    "bloodgroup":bloodgroup,
    "gender":gender,
    "owner":owner,
    "married":married,
    "email":email,
    "ward":ward
}
,function(data, status){
        alert("Data: " + data + "\nStatus: " + status);
        table.draw();
        //table.row('.selected').remove().draw(false);
});
*/
var result = { };
$.each($("#modal_form").serializeArray(), function() {
    result[this.name] = this.value;
});
result.bdate = bod;
console.log(result);


$.post("modules/table/members_db.php",
{
  op:"add",
  data:result
},function(d,s){
    alert(d);
    table.draw();
});
   

 // console.log( result );

operation = "";
}
if(operation == "edit")
{
var name = $("#Name").val();
var housename = $('#HouseName').val();
var phone = $("#Phone").val();
var age = $("#Age").val();
var bloodgroup = $("#BloodGroup").val();
var gender = $("#Gender").val();
var owner = $("#Owner").val();
var married = $("#Married").val();
var email = $("#Email").val();
var ward = $("#Ward").val();
$.post("modules/table/members_edit.php",
{
    "id":from_data,
    "name":name,
    "housename":housename,
    "phone":phone,
    "age":age,
    "bloodgroup":bloodgroup,
    "gender":gender,
    "owner":owner,
    "married":married,
    "email":email,
    "ward":ward
}
,function(data, status){
        alert("Data: " + data + "\nStatus: " + status);
        table.draw();
        //table.row('.selected').remove().draw(false);
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


var prevresource = "",path="";
var prevmain = "";
var module = "";
var tempm = "";
var submodule = "";   

$(document).ready(function(){

 $(document).on("click", ".cre", function(e) {
          var href = $(this).attr('data-href');
   callbackObj.openProcess(href);
        return false;
    });

  $(document).ajaxStart(function () {
    Pace.restart()
  });
  $('.dropdown-toggle').dropdown();

     $.post("",{'load_module':"all"}, function(a, b) {
      
        if("success" == b.trim() )
        {
        $(".sidebar-menu").append(a);
        }
        var hash = gethash();
        if(hash == "")
        {
            puthash("home/");
        }
        var urls = geturl(hash);
        if(urls == undefined)
        {
           puthash("home/"); 
        }
        hash = gethash();
        if(hash.indexOf("family") != -1){
            hash = hash.split('?')[0];
          //alert(hash);
        }
        urls = geturl(hash);
        var umodule = urls[0];
        var usbmodule ="";
        //console.log(JSON.parse('{"' + decodeURI(hash = hash.split('?')[1].replace(/&/g, "\",\"").replace(/=/g,"\":\"")) + '"}'));
        if(urls[1] != undefined)
        {
           var usbmodule = urls[1];
           
        }
         
         path = umodule+"/"+usbmodule;
        //console.log(path);
       // alert($(this).attr("data-path")+$(this).attr("data-sub-path"));
        content_loading_anim();
        $.get("./theme/pageloader.php", { module: umodule,sub_module: usbmodule }, function(a, b) {
               if("success" == b.trim())
               {
               $("#main_content").html(a);//.css("visibility","hidden");
               // console.log(a);
               
                     $.get("./theme/resourceloader.php", {
                            module: umodule,
                            sub_module: usbmodule
                        }, function(a, b) {
                            if ("success" == b.trim() && "" != a.trim()) {
                                //alert(a);
                               if(a.trim() != prevresource)
                               {
                                  prevresource = a.trim();
                                  getassets(prevresource);
                               }else
                               {
                                  removeassets(prevresource);
                                  prevresource = a.trim();
                                  getassets(prevresource);
                               }

                                puthash(path);
                                console.log('get datap'+path);

                            }


                        });
               
               }
        });
       
       
    
   
    /*
    
     
    
    
    */
    
   

/*
    $.get("./theme/pageloader.php",queryStringToJSON(tempm ,module,submodule), function(a, b) {
        "success" == b.trim() && $("#main_content").html(a)
    });
    $.get("./theme/resourceloader.php",queryStringToJSON(tempm ,module,submodule), function(a, b) {
        if ("success" == b.trim() && "" != a.trim()) {
            var c = $.parseJSON(a);
           window.location.hash =path;
            "" === prevresource ? ($.each(c.css, function(a, b) {
                loadjscssfile(c.basecss + b, "css")
            }), $.getMultiScripts(c.js, c.basejs).done(function() {
                $.getScript(c.basemain, function() {})
            }), prevresource = c) : ($.each(prevresource.css, function(a, b) {
                removejscssfile(prevresource.basecss + b, "css")
            }), $.getMultiScripts(c.js, c.basejs).done(function() {
                $.getScript(c.basemain, function() {})
            }), prevresource = "")
        }
       return false;
    });
    
    
        var load = $(".menu_link").find("[data-path='" + module + "']");
        load.trigger("click");
        remove_active();
        var parent_el = load.parent(load);
        parent_el.addClass("active");
         
         */
          //   $("#main_content").css("visibility","none");
                     window.location.hash = path;
});

     
     
    $(document).on("click", ".menu_link", function(e) {
       e.preventDefault();
       path = $(this).attr("data-path")+"/"+$(this).attr("data-sub-path");
       // alert($(this).attr("data-path")+$(this).attr("data-sub-path"));
        console.log(path);
       if(path == "" || path == '/')
       {
           return false;
       }
            content_loading_anim();
        $.get("./theme/pageloader.php", {
            module: $(this).attr("data-path"),
            sub_module: $(this).attr("data-sub-path")
           }, function(a, b) {
               if("success" == b.trim())
               {
                $("#main_content").html(a);//.css("visibility","hidden");
               }
        });
       
        $.get("./theme/resourceloader.php", {
            module: $(this).attr("data-path"),
            sub_module: $(this).attr("data-sub-path")
        }, function(a, b) {
            if ("success" == b.trim() && "" != a.trim()) {
               // alert(a);
               if(a.trim() != prevresource)
               {
                  prevresource = a.trim();
                  getassets(prevresource);
               }else
               {
                  removeassets(prevresource);
                  prevresource = a.trim();
                  getassets(prevresource);
               }
                   puthash(path);
               
               
                 }
             
        
        });
        
        
        
    });
    
    
    
});
   

     //  var search = window.location.href.split("?");
     //  var g_data = queryStringToJSON(tempm ,module,submodule);
     //  console.log(g_data);
     /*
       $.get("./theme/pageloader.php", g_data, function(a, b) {
            "success" == b.trim() && $("#main_content").html(a);
           
       });
       
        $.get("./theme/resourceloader.php", g_data, function(a, b) {
            if ("success" == b.trim() && "" != a.trim()) {
                var c = $.parseJSON(a);
                "" == prevresource ? ($.each(c.css, function(a, b) {
                    loadjscssfile(c.basecss + b, "css")
                }), $.getMultiScripts(c.js, c.basejs).done(function() {
                    $.getScript(c.basemain, function() {})
                }), prevresource = c) : ($.each(prevresource.js, function(a, b) {
                    removejscssfile(prevresource.basejs + b, "js")
                }), $.each(prevresource.css, function(a, b) {
                    removejscssfile(prevresource.basecss + b, "css")
                }), $.each(c.css, function(a, b) {
                    loadjscssfile(c.basecss + b, "css")
                }), $.getMultiScripts(c.js, c.basejs).done(function() {
                    $.getScript(c.basemain, function() {})
                }), prevresource = c);
                
                 //window.location.hash = $(this).attr("data-path")+"/"+$(this).attr("data-sub-path");
                   //window.location.hash =path;
               //window.history.pushState("", "", window.location+'/'+path);
                  // console.log(path);
               
            }
        });
 
      */

   
function remove_active()
{
    var listItems = $(".sidebar-menut li");
    listItems.each(function(idx, li) {
    var product = $(li);
    if(product.hasClass('active'))
    // and the rest of your code
    {
        product.removeClass('active');
    }
    });
}

function queryStringToJSON(qs , modle ,sub_modle) {
  //S  qs = qs || location.search.slice(1);
    var result = {};
if(qs !== "")
{
    var pairs = qs.split('&');
    console.log(pairs);

    pairs.forEach(function(pair) {
        var pair = pair.split('=');
        var key = pair[0];
        var value = decodeURIComponent(pair[1] || '');

        if( result[key] ) {
            if( Object.prototype.toString.call( result[key] ) === '[object Array]' ) {
                result[key].push( value );
            } else {
                result[key] = [ result[key], value ];
            }
        } else {
            result[key] = value;
        }
    });
    }
   
    var res =  JSON.parse(JSON.stringify(result));
    res["module"] = modle;
    if(sub_modle !== "")
    {
    res["sub_module"] = sub_modle;
    }else
    {
      res["sub_module"] = "";  
    }
     var r =  JSON.stringify(res);
         console.log(r);
     return JSON.parse(r);
    
};

function content_loading_anim()
{
   $("#main_content").html('<div id="root"><div class="content-anim"><i class="fa fa-refresh fa-spin fa-5x fa-fw"></i></div></div>'); 
}

function setTitle(title)
{
    window.document.title = title;
}

function getTitle()
{
    return window.document.title;
}
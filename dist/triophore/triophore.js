(function ( $ ) {
 
    $.fn.ModuleLoader = function() {
       // var data_path =  $(this).attr("data-path");
        $(this).html('<button class="" >Get</button>')
    };
 
}( jQuery ));



function Triophore(){
    this.title = "Asterda";
    this.debug = false;
    this.ReloadMenu = function (){
       $.post("",{'load_module':"all"}, function(a, b) {
        if("success" == b.trim() )
        {
             $(".sidebar-menu").html("");
        $(".sidebar-menu").append(a);
        }
        }); 
    };
    
    this.ChangeUrl = function(page, url){
         if (typeof (history.pushState) != "undefined") {
            var obj = { Page: page, Url: url };
            history.pushState(obj, obj.Page, obj.Url);
        } else {
            alert("Browser does not support HTML5.");
        }
    };
    
    this.RemoveJsCssFile = function(filename, filetype){
         var targetelement=(filetype=="js")? "script" : (filetype=="css")? "link" : "none" //determine element type to create nodelist from
        var targetattr=(filetype=="js")? "src" : (filetype=="css")? "href" : "none" //determine corresponding attribute to test for
        var allsuspects=document.getElementsByTagName(targetelement)
        for (var i=allsuspects.length; i>=0; i--){ //search backwards within nodelist for matching elements to remove
        if (allsuspects[i] && allsuspects[i].getAttribute(targetattr)!=null && allsuspects[i].getAttribute(targetattr).indexOf(filename)!=-1)
            allsuspects[i].parentNode.removeChild(allsuspects[i]) //remove element by calling parentNode.removeChild()
        }
    };
    
    this.LoadJsCssFile = function(){
         if (filetype=="js"){ //if filename is a external JavaScript file
        var filerefjs=document.createElement('script');
        filerefjs.setAttribute("type","text/javascript");
        filerefjs.setAttribute("src", filename);
        
    }
    else if (filetype=="css"){ //if filename is an external CSS file
        var fileref=document.createElement("link");
        fileref.setAttribute("rel", "stylesheet");
        fileref.setAttribute("type", "text/css");
        fileref.setAttribute("href", filename);
         if (typeof fileref!="undefined")  document.getElementsByTagName("head")[0].appendChild(fileref);
    }
    };
    
    this.GetUrl = function (hash)
    {
        if(hash != "")
        {
            var paths = hash.split('/');
        }
        return paths;
    };
    
    this.PutHash = function(hash)
    {
        window.location.hash = '#'+hash;
    };
    
    this.GetFromData = function(fname)
    {
        var result = { };
        $.each($(fname).serializeArray(), function() {
            result[this.name] = this.value;
        });
        return result;
    };

    this.GroupArray = function(data,size)
    {
        var arrays = [];

            while (data.length > 0)
            {
            arrays.push(data.splice(0, size));
            }
           // console.log(arrays);
            return arrays;
    }
    
    this.Debug = function(data){
        if(this.debug)
        {
            console.log("Asterda Debug:"+data+"  :"+new Date);
        }
    };
}
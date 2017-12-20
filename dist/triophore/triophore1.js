"use stricts"
$.loadScript = function (url, callback) {
    $.ajax({
        url: url,
        dataType: 'script',
        success: callback,
        async: true
    });
}
 
    $.getMultiScripts = function(arr, path) {
    var _arr = $.map(arr, function(scr) {
        return $.getScript( (path||"") + scr );
    });

    _arr.push($.Deferred(function( deferred ){
        $( deferred.resolve );
    }));

    return $.when.apply($, _arr);
    } ;
    
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

$.fn.serializeFormObject = function() {
    var o = {};
    //    var a = this.serializeArray();
    $(this).find('input[type="hidden"], input[type="text"], input[type="password"], input[type="checkbox"]:checked, input[type="radio"]:checked, select').each(function() {
        if ($(this).attr('type') == 'hidden') { //if checkbox is checked do not take the hidden field
            var $parent = $(this).parent();
            var $chb = $parent.find('input[type="checkbox"][name="' + this.name.replace(/\[/g, '\[').replace(/\]/g, '\]') + '"]');
            if ($chb != null) {
                if ($chb.prop('checked')) return;
            }
        }
        if (this.name === null || this.name === undefined || this.name === '')
            return;
        var elemValue = null;
        if ($(this).is('select'))
            elemValue = $(this).find('option:selected').val();
        else elemValue = this.value;
        if (o[this.name] !== undefined) {
            if (!o[this.name].push) {
                o[this.name] = [o[this.name]];
            }
            o[this.name].push(elemValue || '');
        } else {
            o[this.name] = elemValue || '';
        }
    });
    return o;
}


function seturl(url)
{
   // window.location.hash =url ;
  // window.history.pushState("", "", '/url');
}

function ChangeUrl(page, url) {
        if (typeof (history.pushState) != "undefined") {
            var obj = { Page: page, Url: url };
            history.pushState(obj, obj.Page, obj.Url);
        } else {
            alert("Browser does not support HTML5.");
        }
}


function removejscssfile(filename, filetype){
    var targetelement=(filetype=="js")? "script" : (filetype=="css")? "link" : "none" //determine element type to create nodelist from
    var targetattr=(filetype=="js")? "src" : (filetype=="css")? "href" : "none" //determine corresponding attribute to test for
    var allsuspects=document.getElementsByTagName(targetelement)
    for (var i=allsuspects.length; i>=0; i--){ //search backwards within nodelist for matching elements to remove
    if (allsuspects[i] && allsuspects[i].getAttribute(targetattr)!=null && allsuspects[i].getAttribute(targetattr).indexOf(filename)!=-1)
        allsuspects[i].parentNode.removeChild(allsuspects[i]) //remove element by calling parentNode.removeChild()
    }
}

function loadjscssfile(filename, filetype){
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
   
}

/*
 * 
 * credits to http://www.javascriptkit.com/javatutors/
 */

function getassets(data)
{
                  var c = $.parseJSON(data);
                
               // if( true)
               // {
                $.each(c.css, function(a, b) {
                    loadjscssfile(c.basecss + b, "css");
                   // alert(a+b);
                });
            $.getMultiScripts(c.js,c.basejs).done(function() {
                // all scripts loaded
                $.getMultiScripts(c.basemain,c.basejs).done(function() {
                // all scripts loaded
                console.log("js loaded");
                //alert('jjjjj');
                });
            });                
}

function removeassets(data)
{
     var c = $.parseJSON(data);
    $.each(c.css, function(a, b) {
                   removejscssfile(c.basecss + b, "css");
                
     });
     $.each(c.js, function(a, b) {
                   removejscssfile(c.basejs + b, "js");
                
     });
     removejscssfile(c.basejs + c.basemain, "js");
}

function geturl(hash)
{
    if(hash != "")
    {
        var paths = hash.split('/');
    }
    return paths;
}

function gethash()
{
    if(window.location.hash) {
      var hash = window.location.hash.substring(1); //Puts hash in variable, and removes the # character
      return (hash);
      // hash found
  } else {
     return "";
  }
}

function puthash(hash)
{
    window.location.hash = '#'+hash;
}



    $.fn.serializeObject = function(){

        var self = this,
            json = {},
            push_counters = {},
            patterns = {
                "validate": /^[a-zA-Z][a-zA-Z0-9_]*(?:\[(?:\d*|[a-zA-Z0-9_]+)\])*$/,
                "key":      /[a-zA-Z0-9_]+|(?=\[\])/g,
                "push":     /^$/,
                "fixed":    /^\d+$/,
                "named":    /^[a-zA-Z0-9_]+$/
            };


        this.build = function(base, key, value){
            base[key] = value;
            return base;
        };

        this.push_counter = function(key){
            if(push_counters[key] === undefined){
                push_counters[key] = 0;
            }
            return push_counters[key]++;
        };

        $.each($(this).serializeArray(), function(){

            // skip invalid keys
            if(!patterns.validate.test(this.name)){
                return;
            }

            var k,
                keys = this.name.match(patterns.key),
                merge = this.value,
                reverse_key = this.name;

            while((k = keys.pop()) !== undefined){

                // adjust reverse_key
                reverse_key = reverse_key.replace(new RegExp("\\[" + k + "\\]$"), '');

                // push
                if(k.match(patterns.push)){
                    merge = self.build([], self.push_counter(reverse_key), merge);
                }

                // fixed
                else if(k.match(patterns.fixed)){
                    merge = self.build([], k, merge);
                }

                // named
                else if(k.match(patterns.named)){
                    merge = self.build({}, k, merge);
                }
            }

            json = $.extend(true, json, merge);
        });

        return json;
};

function GetFromData(fname)
{
    var result = { };
    $.each($(fname).serializeArray(), function() {
        result[this.name] = this.value;
    });
    return result;
}


function reloadmenu(){
    $.post("",{'load_module':"all"}, function(a, b) {
      
        if("success" == b.trim() )
        {
             $(".sidebar-menu").html("");
        $(".sidebar-menu").append(a);
        }
    });
}


function Triophore(){
    this.title = "Asterda";
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
	this.Debug = function(data){
        if(true)
        {
            console.log("Asterda Debug:"+data+"  :"+new Date);
        }
    };
}

function getURLParameters()
{
    var sURL = window.document.URL.toString();
    if (sURL.indexOf("?") > 0)
    {
        var arrParams = sURL.split("?");
        var arrURLParams = arrParams[1].split("&");
        var arrParamNames = new Array(arrURLParams.length);
        var arrParamValues = new Array(arrURLParams.length);

        var i = 0;
        for (i = 0; i<arrURLParams.length; i++)
        {
            var sParam =  arrURLParams[i].split("=");
            arrParamNames[i] = sParam[0];
            if (sParam[1] != "")
                arrParamValues[i] = unescape(sParam[1]);
            else
                arrParamValues[i] = "No Value";
        }

        for (i=0; i<arrURLParams.length; i++)
        {
            
                alert("Parameter:" + arrParamValues[i]);
                
            
        }
        return "No Parameters Found";
    }
}


var app = new Triophore();
$("#modal_form").on("submit",function(e){
    var result = { };
    $.each($("#modal_form").serializeArray(), function() {
        result[this.name] = this.value;
    });
    url = Object.keys(result).map(function(k) {
    return encodeURIComponent(k) + '=' + encodeURIComponent(result[k])
}).join('&');
   console.log(url);
   window.open("report/custom_members.php?"+url);
    e.preventDefault();
    return false;
});


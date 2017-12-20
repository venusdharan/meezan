$('.el-link').on('click',function(e){
    
    var link = $(this).attr('href');
    myWindow = window.open(link, "Report Window", "toolbar=no,titlebar=no,scrollbars=no,status=no,resizable=no,menubar=no,width=100,height=100");
    
    e.preventDefault();
    e.stopPropagation();
    return false;
});
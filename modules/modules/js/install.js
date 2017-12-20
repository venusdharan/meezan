//var myDropzone = new Dropzone("#my-awesome-dropzone", { url: "/file/post"});
$('#myWizard').wizard();
$("#uploader").dropzone({ url: "modules/modules/uploader.php" ,  success: function(file, response){
            //$('#up_status').html(response);
           $('#myWizard').wizard('next');
           $.get('modules/modules/review.php',function(data,status){
               $('#up_status').html(data);
           });
        },
        maxFilesize: 256,
        maxFiles: 1,
        dictDefaultMessage: "Drag and drop Asterda Module Package (.amp) File",
        acceptedFiles:".amp"
});

$(document).on('click','#btninstall', function() {
    //alert('install');
    $.get('modules/modules/installer.php',function(data,status){
                $('#myWizard').wizard('next');
                $('#post_status').html(data);
    });
});
function addsteps()
{
    
}
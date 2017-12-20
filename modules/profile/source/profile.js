/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


    $('.iframe-btn').fancybox({	
		'maxWidth'	: 800,
		'maxHeight'	: 600,
		'fitToView'	: false,
		'width'		: '70%',
		'height'		: '70%',
		'autoSize'	: false,
		'closeClick'	: false,
		'openEffect'	: 'none',
                 'type'		: 'iframe',
		'closeEffect'	: 'none'
    });
    
    function responsive_filemanager_callback(field_id){
	console.log(field_id);
	var url=jQuery('#'+field_id).val();
	//alert('update '+field_id+" with "+url);
        $("#profile").attr('src', url);
	//your code
    }
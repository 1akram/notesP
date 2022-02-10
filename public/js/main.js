 
$(document).ready( _ => {

    //copysharelink

    $('.js-copy-share-link').click(function()  {
        elem=$(this) ;
        console.log(elem);
        navigator.clipboard.writeText(elem.attr('data-shareLink')); 
        elem.addClass('tooltip');
        setTimeout(function(){
            console.log(elem);
            elem.removeClass('tooltip');
        }, 1000);
    });
    //end copysharelink
    //  password input icon 
    $('.js-eye-icon').hover(function () {
        $(this).addClass('fa-eye color-third cursor-pointer');
        $( this).parent().prev().attr('type','text');
        $(this).removeClass('fa-eye-slash'); 
    }, function () {
        $(this).addClass('fa-eye-slash');
        $( this).parent().prev().attr('type','password');
        $(this).removeClass('fa-eye color-third cursor-pointer');
    });
    // end  password input icon 

    // alert close 
    $(".js-alert-click").click(event =>{
        console.log($(event.target));
        $($(event.target)).closest('div[data-alert="alert-holder"]').remove();
    })
    // end alert close 
    
   
     

    // sidbar menu active 
    $('.js-menu-btn').click(event =>{
        console.log('dd');
        $('.sidebar').toggleClass('active');
        $(event.target).toggleClass('active');
    });
    // end sidbar menu active 




 
});


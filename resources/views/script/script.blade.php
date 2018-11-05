
<script >
/*Js Added for autocomplete*/
$(document).ready(function() {
    src = "{{ route('celebrity/searchajax') }}";
     $("#search").autocomplete({
        source: function(request, response) {
            $.ajax({
                url: src,
                dataType: "json",
                data: {
                    term : request.term
                },
                success: function(data) {
                    response(data);
                   console
                }
            });
        },
        minLength:1,
  
    });
    $('#search').on('keyup', function(){
        if($(this).val()!='')
            $('.advance-search').show(1000);
        else
            $('.advance-search').hide(1000);
    });
    $('.registerhere').click(function(){
        $('.loginsection').hide(1000);
        $('.registersection').show(1000);
    });
    $('.loginhere').click(function(){
        $('.registersection').hide(1000);
        $('.loginsection').show(1000);
    });
});

$('body').on('click', '#submitForm', function(){
        var registerForm = $("#Register");
        registersrc = "{{ route('ajax_register') }}";
        var formData = registerForm.serialize();
        $( '#name-error' ).html( "" );
        $( '#email-error' ).html( "" );
        $( '#password-error' ).html( "" );

        $.ajax({
            url:registersrc,
            type:'POST',
            data:formData,
            success:function(data) {
                console.log('result='+data);
                if(data.errors) {
                    console.log('in if='+data);
                    if(data.errors.name){
                        $( '#name-error' ).html( data.errors.name[0] );
                    }
                    if(data.errors.email){
                        $( '#email-error' ).html( data.errors.email[0] );
                    }
                    if(data.errors.password){
                        $( '#password-error' ).html( data.errors.password[0] );
                    }
                    
                }
                else
                {
                    console.log('inelse='+data);
                    $( '#rname' ).val( "" );
                    $( '#remail' ).val( "" );
                    $( '#rpassword' ).val( "" );
                    $( '#rcpassword' ).val( "" );
                    $('#success-msg').removeClass('hide');
                    setInterval(function(){ 
                        $('#SignUp').modal('hide');
                        $('#success-msg').addClass('hide');
                    }, 3000);  
                }
                /*if(data.success) {
                    $('#success-msg').removeClass('hide');
                    setInterval(function(){ 
                        $('#SignUp').modal('hide');
                        $('#success-msg').addClass('hide');
                    }, 3000);
                }*/
            },
        });
    });


$('body').on('click', '#submitLoginForm', function(){
   var loginForm = $("#Login");
        registersrc = "{{ route('login') }}";
        var formData = loginForm.serialize();

   $.ajax({
    url:"{{ route('ajax_login') }}",
    type:'POST',
    data:formData,
    success:function(data){
         console.log(data);
         if(data.errors) {
            if(data.errors[0]){
                $( '#loginerror' ).html( data.errors[0] );
            }
         }
         if(data.error) {
                $( '#loginerror' ).html( data.errors );
         }
         if(data.success==true)
          window.location.reload();
       // window.location.href = '/'
    },
    error: function (data) {
        console.log('failed');
    }
    });
});

</script>
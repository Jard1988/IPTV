$(document).ready(function() {
    //Examples of how to assign the Colorbox event to elements
    $(".iframe").colorbox({iframe: true, width: "90%", height: "90%"});
    $(".inline").colorbox({inline: true, width: "90%", height: "95%"});
    //Example of preserving a JavaScript event for inline calls.
    $("#click").click(function () {
    $('#click').css({
        "background-color": "#f00",
        "color": "#fff",
        "cursor": "inherit"
    }).text("Open this window again and this message will still be here.");
        return false;
    });

    $(window).scroll(function () {
        if ($(this).scrollTop()) {
            $('#toTop').fadeIn();
        } else {
            $('#toTop').fadeOut();
        }
    });

    $("#toTop").click(function () {
        $("html, body").animate({scrollTop: 0}, 1000);
    });

    $( "#forgotbutton" ).click(function( event ) {
        var email = document.getElementById("forgot-email").value;
        event.preventDefault();
        $.ajax({
            url: "forgotpassword.php",
            type: "post",
            data: {
            email: email
        },
        datatype: "html",
        contenttype: 'application/html; charset=utf-8',
        async: true,
        success : function(response1) {
            if (response1 == 1){
                $('#outputforgot').html("Recuperação efectuado com Sucesso. Verifique o Email.");
            //location.reload(true);
            }
            if (response1 == 2) {
                $('#outputforgot').html("Recuperação não efetuada. Tente novamente.");
            }
            if (response1 == 0) {
                $('#outputforgot').html("Email inexistente. Tente novamente.");
             }
        //$('#outputlogin').html(response);
        },
        beforeSend: function () {
            $('#loader').show();
        },
        complete: function () {
            $('#loader').hide();
        }
        });
    });

    $( "#contactbutton" ).click(function( event ) {
        var nome = document.getElementById("contactName").value;
        var telefone = document.getElementById("contactPhone").value;
        var email = document.getElementById("contactEmail").value;
        var mensagem = document.getElementById("contactMsg").value;
        event.preventDefault();
        $.ajax({
            url: "contact.php",
            type: "post",
            data: {
            name: nome,
            email: email,
            phone: telefone,
            msg: mensagem
        },
        datatype: "html",
        contenttype: 'application/html; charset=utf-8',
        async: true,
        success : function(response) {
            if (response == 1){
            //$('#outputContact').html("Contato efectuado com Sucesso");
            location.reload(true);
            }else {
                $('#outputContact').html("Contacto não efetuado");
            }
            //$('#outputlogin').html(response);
        },
        beforeSend: function () {
            $('#loader').show();
        },
        complete: function () {
            $('#loader').hide();
        }
        });
    });

    $( "#loginbutton" ).click(function( event ) {
        var loginemail = document.getElementById("signin-email").value;
        var loginpwd = document.getElementById("signin-pwd").value;

        event.preventDefault();
        $.ajax({
            url: "login.php",
            type: "POST",
            data:{email:loginemail,password:loginpwd},
            dataType : 'html', // Returns HTML as plain text; included script tags are evaluated when inserted in the DOM.
            success : function(response) {
            if (response == 1){
                // $('#outputlogin').html("Login efectuado com Sucesso");
                location.reload(true);
            }else {
                $('#outputlogin').html("Login não efetuado");
            }
                //$('#outputlogin').html(response);
            },
            beforeSend: function () {
                $('#loader').show();
            },
            complete: function () {
                $('#loader').hide();
            }
        });
    });

    $( "#signupbutton" ).click(function( event ) {
        var email = document.getElementById("signup-email").value;
        var pwd = document.getElementById("signup-pwd").value;
        var pwd2 = document.getElementById("signup-pwd2").value;
        event.preventDefault();
        $.ajax({
            url: "register.php",
            type: "POST",
            data:{email:email,password:pwd,password2:pwd2},
            dataType : 'html', // Returns HTML as plain text; included script tags are evaluated when inserted in the DOM.
            success : function(response3) {
                if (response3 == 1){
                    $('#outputsignup').html("Registo efectuado com Sucesso. Verifique o Email.");
                    //location.reload(true);
                }
                if (response3 == 3) {
                    $('#outputsignup').html("Registo não efetuado. Tente novamente.");
                }
                if (response3 == 0) {
                    $('#outputsignup').html("Passwords não coincidem. Tente novamente.");
                }
            },
            beforeSend: function () {
                $('#loader').show();
            },
            complete: function () {
                $('#loader').hide();
            }
        });
    });

});
//--- end document ready

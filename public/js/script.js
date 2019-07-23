(function($) {
    "use strict"; // Start of use strict
  
    $('#visibility').on('click', function(e) {
        var id = $(this).data('carid');
        console.log(id);
        $.ajax({
            method: "POST",
            url: "/changeCarVisibility",
            data: { id: id }
          })
            .done(function( msg ) {
              $.toast({
                heading: 'Information',
                text: msg,
                icon: 'info',
                loader: true,        // Change it to false to disable loader
                loaderBg: '#9EC600'  // To change the background
            })
            });
    });
    function validateEmail(email) {
      var re = /^(([^<>()\[\]\.,;:\s@\"]+(\.[^<>()\[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/;
      return re.test(String(email).toLowerCase());
    }
    $("#emailNewsletter").on("input", function(){
      console.log("change", validateEmail($(this).val));
      if(validateEmail($(this).val())){
        $("#submitNewsletter").removeClass("disabled");
      }else{
        $("#submitNewsletter").addClass("disabled");
      }
    })

    $("#submitNewsletter").on('click', function(){
      // if($("#emailNewsletter").val(undefined)){
      //   $.toast({
      //     heading: 'Information',
      //     text: 'Veuillez rentrer un email',
      //     icon: 'info',
      //     loader: true,        // Change it to false to disable loader
      //     loaderBg: '#9EC600'  // To change the background
      //   })
      // }else if(validateEmail($("#emailNewsletter").val())){
      // console.log("coucou");
      //   $.toast({
      //     heading: 'Information',
      //     text: 'Veuillez rentrer un mail valide',
      //     icon: 'info',
      //     loader: true,        // Change it to false to disable loader
      //     loaderBg: '#9EC600'  // To change the background
      //   })
      // }else{
        var email = $("#emailNewsletter").val();
        $.ajax({
          method:"POST",
          url:"/home/newsletterSubscribed",
          data:{email:email},
        }).done(function(result){
          $.toast({
            heading: 'Information',
            text: result,
            icon: 'info',
            loader: true,        // Change it to false to disable loader
            loaderBg: '#9EC600'  // To change the background
          })
        })
      // }

    })

    $(document).ready(function(){
       
        // // Du code pour gérer le retour de l'appel AJAX.
        // feed = $( "#feed" ).data('feed');
        // $.each(feed.data, function (i, val) {
        //       var message = val.message;
        //       if(message === undefined){
        //         return;
        //       }
        //       var substr = message.length >= 100 ? 200 : 100;
        //       var content = message.substring(0, substr);
        //       content.length < message.length ? content+='...' : '';
              
        //       $( "#feed" ).append( "<div class='feed-box'><img class='feed-img' src=''/><p>"+content+"</p> <a href='https://www.facebook.com/"+val.id+"' target='blank'>Plus d'infos</a></div>" );
        
        //   })
    });
      
  
  })(jQuery); // End of use strict
  
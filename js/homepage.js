$(document).ready(function() {

    // LOGIN
    if(sessionStorage.getItem('usn') != null) {
        $("#signin-nee-onii-chan").css({'display':'none'});
        $("#onii-chan-no-profile").css({'display':'block'});

        if(sessionStorage.getItem('usn').length <= 7) {
          $("#onii-chan-no-profile span").html(sessionStorage.getItem('usn'));
        }
        else {
          var oniichan = '';
          for(var i in sessionStorage.getItem('usn')) {
            if(i < 7) oniichan += sessionStorage.getItem('usn')[i];
            else {
              oniichan += ". . .";
              break;
            }    
          }
          $("#onii-chan-no-profile span").html(oniichan);
        }
      }
      else {
        $("#signin-nee-onii-chan").css({'display':'block'});
        $("#onii-chan-no-profile").css({'display':'none'});
      }

    // SUBCRIBE
    $("#subcribe").click(function(){
        swal({
            title : "ฅ^•ω•^ฅ Thanks!!", 
            text : "You will receive the latest notice from us" , 
            icon : "success",
            button: "Yayy!" ,
        });
    });


    // SLIDE
    $(".owl-carousel").owlCarousel({
        margin: 5,
        loop: true,
        autoplay : true , 
        autoplayTimeOut : 8000 ,
        nav : true ,
        responsive: {
          0: {items: 1},
          300: {items: 2},
          600: {items: 3},
          1000: {items: 4}
        }
      });

    $(".owl-prev").html('<i style="font-size: 36px ;" class="fa fa-chevron-left"></i>');
    $(".owl-next").html('<i style="font-size: 36px ;" class="fa fa-chevron-right"></i>');








});
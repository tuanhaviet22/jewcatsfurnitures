$(document).ready(function() {
    var forEach=function(t,o,r){
        if("[object Object]"===Object.prototype.toString.call(t))for(var c in t)Object.prototype.hasOwnProperty.call(t,c)&&o.call(r,t[c],c,t);
        else for(var e=0,l=t.length;l>e;e++)o.call(r,t[e],e,t)
      };
    
      var hamburgers = document.querySelectorAll(".hamburger");
      if (hamburgers.length > 0) {
        forEach(hamburgers, function(hamburger) {
          hamburger.addEventListener("click", function() {
            this.classList.toggle("is-active");
          }, false);
        });
      }
    
    
        $('.xham').click(function(){
            $('.hide-menu').toggle();
        });
        
        // SCROLL
        $(document).scroll(function(){
          if($(document).scrollTop() > 10 ){
              $('.header').addClass('fixed');
          }else {
              $('.header').removeClass('fixed');
          }
        });

        // RELOAD
        $(document).ready(function() {
          if($(document).scrollTop() > 10 ){
            $('.header').addClass('fixed');
          }else {
            $('.header').removeClass('fixed');
          }
        });
    
        // SUBCRIBE EVENT
        $("#subcribe").click(function(){
            swal({
            title : "ฅ^•ω•^ฅ Thanks!!", 
            text : "You will receive the latest notice from us" , 
            icon : "success",
            button: "Yayy!" ,
            });
        });
        
                     
        // LOGIN                 
        if(sessionStorage.getItem('usn') != null) {
          $("#signin-nee-onii-chan").css({'display':'none'});
          $("#onii-chan-no-profile").css({'display':'inline'});

          if(sessionStorage.getItem('usn').length <= 10) {
            $("#onii-chan-no-profile").html("<i style='font-size:10px;color:white' class='fas fa-user'></i> " + sessionStorage.getItem('usn'));
          }
          else {
            var oniichan = '';
            for(var i in sessionStorage.getItem('usn')) {
              if(i <= 9) oniichan += sessionStorage.getItem('usn')[i];
              else {
                oniichan += "...";
                break;
              }    
            }
            $("#onii-chan-no-profile").html("<i style='font-size:10px;color:white' class='fas fa-user'></i> " + oniichan);
          }
        }
        else {
          $("#signin-nee-onii-chan").css({'display':'inline'});
          $("#onii-chan-no-profile").css({'display':'none'});
        }
                         
                     
});

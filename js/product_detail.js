$(document).ready(function() {

    // MODAL
    for (var i = 0; i < $('.demo01').length; i++){
      $('.demo01').eq(i).animatedModal({
        animatedIn: 'zoomIn' ,
        animatedOut: 'bounceOut' ,
      }); 
    }
    
    

    // SLIDE
    $('.owl-sosanh').owlCarousel({
        margin: 5 ,
        loop: false,
        autoplay : true , 
        autoplayTimeout : 3000 ,
        slideSpeed: 300,
        paginationSpeed: 500,
 
        responsive: {
          0: {
            items: 1
          },
          600: {
            items: 3
          },
          1000: {
            items: 4
          }
        }
        });

    // EXPORT FILE
    $("#exportHTML").click(function() {
    // function exportHTML(){
      var header = "<html xmlns:o='urn:schemas-microsoft-com:office:office' "+
           "xmlns:w='urn:schemas-microsoft-com:office:word' "+
           "xmlns='http://www.w3.org/TR/REC-html40'>"+
           "<head><meta charset='utf-8'></head><body>";
      var footer = "</body></html>";
      var sourceHTML = header+document.getElementById("home").innerHTML+footer;
      
      var source = 'data:application/vnd.ms-word;charset=utf-8,' + encodeURIComponent(sourceHTML);
      var fileDownload = document.createElement("a");
      document.body.appendChild(fileDownload);
      fileDownload.href = source;
      fileDownload.download = 'f4w5e8tts7rth.doc';
      fileDownload.click();
      document.body.removeChild(fileDownload);
    // }
    });
});
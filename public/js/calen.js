
//  $('.calendar').mouseleave(
//     function(){
//          var self=$(this);
//       self.css("display","none");
//     }
//   )


function clickFunction() {
    var $hlinks = $('nav.greedy .hidden-links');
    $('[id^="calendar"]').fullCalendar('today');
    $('#top-cart').toggleClass("top-cart-open");
    $('body').removeClass("top-search-open");
    $hlinks.addClass('hidden');
}



var max768 = window.matchMedia("(max-width: 768px)");
function checkMedia(max768) {
    if (max768.matches) {

        // document.body.style.backgroundColor = "yellow";
        // console.log('less then 768');
        document.getElementById("top-cart-trigger").addEventListener("click", clickFunction);

    } else {

        // document.body.style.backgroundColor = "pink";
        // console.log('great then 768');
        document.getElementById("top-cart-trigger").removeEventListener("click", clickFunction);

    }
}

  checkMedia(max768) // Call listener function at run time
  max768.addListener(checkMedia) // Attach listener function on state changes


  var $hlinks = $('nav.greedy .hidden-links');
  $('[id^="calendar"]').mouseleave(

      function(){
          $('#top-cart').toggleClass("top-cart-open");
          $('body').removeClass("top-search-open");
          $hlinks.addClass('hidden');
      // $('.calendar').css("display","none").toggleClass("highlight");
      }
  )
  var k=0;
  $("#top-cart-trigger").mouseover(
      function() {
          $hlinks.addClass('hidden');
          $('body').removeClass("top-search-open");

          k++;
          if(k==1){
              //alert("aaaaaaa");
              $('[id^="calendar"]').fullCalendar('today');
          }
          $('#top-cart').toggleClass("top-cart-open");
          //$('.calendar').css("display","block").toggleClass("highlight");
      }
  )


  /* close subs-background on click "close" */
  $('.close.close-subs-note').click( function() {
      $('.subs-response').css('display','none');
  })

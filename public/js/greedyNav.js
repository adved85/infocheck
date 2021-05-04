$(function() {

  var $nav = $('nav.greedy');
  var $btn = $('nav.greedy button');
  var $btn2 = $('.burger2');
  var $vlinks = $('nav.greedy .links');
  var $hlinks = $('nav.greedy .hidden-links');
  var $hlinks2 = $('#header-wrap .hidden-links');
  var $minus = 250;

  var numOfItems = 0;
  var totalSpace = 0;
  var breakWidths = [];

  // Get initial state
  $vlinks.children().outerWidth(function(i, w) {
    totalSpace += w;
    numOfItems += 1;
    breakWidths.push(totalSpace);
  });

  var availableSpace, numOfVisibleItems, requiredSpace;

  function check() {


    if ($(window).width() < 753) {

        $minus = 2500;

    }else if($(window).width() < 992){
        $minus = 100;
    }
    else {
        $minus = 250;
    }



    // Get instant state
    availableSpace = $vlinks.width() - $minus; /*defult  -10 */
    numOfVisibleItems = $vlinks.children().length;
    requiredSpace = breakWidths[numOfVisibleItems - 1];

    // There is not enought space
    if (requiredSpace > availableSpace) {
      $vlinks.children().last().prependTo($hlinks);
      numOfVisibleItems -= 1;
      check();
      // There is more than enough space
    } else if (availableSpace > breakWidths[numOfVisibleItems]) {
      $hlinks.children().first().appendTo($vlinks);
      numOfVisibleItems += 1;
    }
    // Update the button accordingly
    $btn.attr("count", numOfItems - numOfVisibleItems);
    if (numOfVisibleItems === numOfItems) {
      $btn.addClass('hidden');
    } else $btn.removeClass('hidden');
  }

  // Window listeners
  $(window).resize(function() {
    check();
  });

  $btn.on('click', function() {
    $hlinks.toggleClass('hidden');
  });

  $btn2.on('click', function() {
    $hlinks.toggleClass('hidden');
  });

  check();

});



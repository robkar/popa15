jQuery(document).ready(function() {
  // update location when scrolling on front page
  jQuery(window).on('activate.bs.scrollspy', function (e) {
      history.replaceState({}, "", jQuery("a[href^='#']", e.target).attr("href"));
  });

  // close menu when clicked (on mobile screen)
  jQuery(document).on('click','.navbar-collapse.in',function(e) {
    if( jQuery(e.target).is('a') ) {
        jQuery(this).collapse('hide');
    }
  });

  // smooth scrolling on front page
  jQuery(".home #site-navigation-menu ul li a[href^='#']").on('click', function(e) {
    // prevent default anchor click behavior
    e.preventDefault();

    // store hash
    var hash = this.hash;

    // animate
    jQuery('html, body').animate({
      scrollTop: jQuery(hash).offset().top
    }, 300, function(){

      // when done, add hash to url
      // (default click behaviour)
      window.location.hash = hash;
    });

  });
});

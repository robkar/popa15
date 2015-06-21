jQuery(document).ready(function() {
  // update location when scrolling on front page
  jQuery(window).on('activate.bs.scrollspy', function (e) {
      history.replaceState({}, "", jQuery("a[href^='#']", e.target).attr("href"));
  });
});

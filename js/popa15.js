function popuplink(e) {
  var w=800;
  var h=600;
  var l = (screen.width - w) / 2;
  var t = (screen.height - h) / 2;
  window.open(e.href || this.href, '', 'width='+w+', height='+h+', scrollbars=yes, left='+l+', top='+t+'');
  return false;
}

function popuptickster(e) {
  popuplink(this);
  ga('send', 'pageview','/outgoing/secure.tickster.com');
  return false;
}

jQuery(document).ready(function($) {
  // Inside of this function, $() will work as an alias for jQuery()
  // and other libraries also using $ will not be accessible under this shortcut

  // popup links
  $("#biljettbubbla, .buytix a").click(popuptickster);
  $(".popup").click(popuplink);

  // update location when scrolling on front page
  $(window).on('activate.bs.scrollspy', function (e) {
      history.replaceState({}, "", $("a[href^='#']", e.target).attr("href"));
  });

  // close menu when clicked (on mobile screen)
  $(document).on('click','.navbar-collapse.in',function(e) {
    if( $(e.target).is('a') ) {
        $(this).collapse('hide');
    }
  });

  // smooth scrolling on front page
  $(".home #site-navigation-menu ul li a[href^='#']").on('click', function(e) {
    // prevent default anchor click behavior
    e.preventDefault();

    // store hash
    var hash = this.hash;

    // animate
    $('html, body').animate({
      scrollTop: $(hash).offset().top
    }, 300, function(){

      // when done, add hash to url
      // (default click behaviour)
      window.location.hash = hash;
    });

  });

  // expand artist panels to full width on click (and shrink again on collapse)
  $('.artist').on('show.bs.collapse', function (e) {
    var theimg = $(e.target).prev();
    //theimg.css("max-height","410px");
    theimg.data("thumb", theimg.attr("src"));
    theimg.attr("src", theimg.data("fullimage"));
    $(e.target).parent().toggleClass("col-xs-6 col-md-4 col-xs-12");
  });
  $('.artist').on('shown.bs.collapse', function (e) {
    var theimg = $(e.target).prev();
    $('html, body').animate({
        scrollTop: theimg.parent().offset().top - 55
    }, 300);
  });
  $('.artist').on('hide.bs.collapse', function (e) {
    var theimg = $(e.target).prev();
    theimg.attr("src", theimg.data("thumb"));
    $(e.target).parent().toggleClass("col-xs-6 col-md-4 col-xs-12");
  });

  // expand faq and English faq entries when shown (and contract when hidden)
  $('.faq').on('show.bs.collapse', function(e) {
    $(e.target).parent().parent().toggleClass("col-md-6");
  });
  $('.faq').on('hide.bs.collapse', function(e) {
    $(e.target).parent().parent().toggleClass("col-md-6");
  })

  // dynamic news loading
  var more_posts = $('<a />', {'class': 'btn btn-lg', 'text':'Visa tidigare nyheter'}).
    prepend('<span class="glyphicon glyphicon-menu-down"></span> ').
    append(' <span class="glyphicon glyphicon-menu-down"></span>');
  var more_posts_html = more_posts.html();
  more_posts.click(function() { $.ajax({
		url: ajaxpagination.ajaxurl,
		type: 'post',
		data: {
			action: 'ajax_pagination',
      page: parseInt(ajaxpagination.page) + 1
		},
    beforeSend: function() {
      more_posts.text('Hämtar...');
    },
		success: function( result ) {
      more_posts.html( more_posts_html );
      ajaxpagination.page++;
			more_posts.parent().before( result );
		}
	})});
  $('#more_posts').html(more_posts);

});

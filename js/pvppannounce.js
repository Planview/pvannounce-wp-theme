// @codekit-prepend ../bower_components/bootstrap-sass-official/assets/javascripts/bootstrap.js


// global. currently active menu item 
var current_item = 0;


window.sectionShowing = null;

// jQuery stuff
jQuery(document).ready(function($) {
    $(document).on('gform_post_render',function(){
        $('.gfield').each(function(){
            $(this).find('input, textarea, select').not('input[type="checkbox"], input[type="radio"]').addClass('form-control');
        });
        $('.gfield_checkbox, .gfield_radio').find('input[type="checkbox"], input[type="radio"]').each(function(){
            var sib = $(this).siblings('label');
            $(this).prependTo(sib);
        }).end().each(function(){
            $(this).after('<span class="help-block"></span>');
            if($(this).is('.gfield_checkbox')){
                $(this).addClass('checkbox');
            } else {
                $(this).addClass('radio');
            }
        });
    });
	

    // few settings
    var section_hide_time = 1300;
    var section_show_time = 1300;

    // Switch section
    var switchSection = function (newSectionId, callback, histButton) {
        var $newSection = $(newSectionId);
        if (window.sectionShowing) {
            $('.section:visible').fadeOut( section_hide_time, function() { 
                $newSection.fadeIn( section_show_time );
                histButton ? $.noop() : History.pushState(null,  null, newSectionId );
                window.sectionShowing = newSectionId;
                (callback || $.noop)();
            } );
        } else {
            $('.section:visible').hide();
            $newSection.show(function () {
                histButton ? $.noop() : History.pushState(null, null, newSectionId);
                window.sectionShowing = newSectionId;
                (callback || $.noop)();
            });
        }
        $('a', '.mainmenu').removeClass( 'active' );
        $('a[href="' + newSectionId + '"]', '.mainmenu').addClass( 'active' );
    }

	$('.section-link a, a.section-link').on('click', function (e) {
		if( !$(this).hasClass('active') ) { 
			e.preventDefault();
			var newSectionId = $(this).attr('href');
            switchSection(newSectionId);
		} 
	});

    $('.modal-link a, a.modal-link').on('click', function (e) {
        e.preventDefault();
        var modal = $(this).attr('href');
        $(modal).modal('show');
    });


    var $hashItem = $(window.location.hash);
    if (window.location.hash && $hashItem.hasClass('section')) {
        switchSection(window.location.hash);
    } else {
        var callback = $.noop;
        if ($hashItem.hasClass('modal')) {
            callback = function () { $hashItem.modal('show'); };
        }
        var firstSection = '#' + $('.section').first().attr('id');
        switchSection(firstSection, callback);
    }

    $(document).on('hide.bs.modal', function () {
        History.replaceState( null, null, "#" + $('.section:visible').attr('id') );
    });

    $(window).on('hashchange', function (e) {
        var $hashItem = $(window.location.hash);
        if ($hashItem.hasClass('section')) {
            switchSection(window.location.hash, $.noop, true);
        } else if ($hashItem.hasClass('modal')) {
            $hashItem.modal('show');
        }
    });
});


// Limelight Video
jQuery(document).ready(function ($) {
  $(window).on('resize', function(e) {
    $('.limelight-video-respond').each(function () {
      var $wrapper = $(this),
          $video = $(this).find('*[width]'),
          controlsHeight = $(this).data('controlsHeight') || 0,
          controlsWidth = $(this).data('controlsWidth') || 0,
          newHeight,
          newWidth;

      //  See if we have the aspect ratio already
      if ( ! $wrapper.data('aspectRatio') ) {
        var aspectRatio = ( $video.attr('height') - controlsHeight ) /
          ( $video.attr('width') - controlsWidth );
        $wrapper.data('aspectRatio', aspectRatio );
      }

      newWidth = $wrapper.width();
      newHeight = (newWidth - controlsWidth) * $wrapper.data('aspectRatio') + controlsHeight;

      $video.attr('height', newHeight);
      $video.attr('width', newWidth)
    });
  });
  $(window).trigger('resize');
});
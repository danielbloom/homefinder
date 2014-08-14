function numberWithCommas(x) {
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}

$(document).ready(function() {

    $("#searchButton").click(function() {
        var $errorMessage = $('#errorMessage'),
            $summary = $('#summary'),
            $pagination = $('#pagination'),
            errorFlag = 0,
            errorText;
        
        // validate input
        if ($('input[name="area"]').val().length < 2) {
            errorText = 'Please enter a valid area to search.';
            errorFlag = 1;
        } else if ($('select[name="price_min"]').val() > $('select[name="price_max"]').val()) {
            errorText = 'Max price must be higher than min price.';
            errorFlag = 1;
        }

        if (errorFlag) {
            $errorMessage.text(errorText).show();
            return;
        }

        // remove any current messages
        $errorMessage.hide();
        $summary.hide();
        $pagination.hide()

        // retrieve listing data
        $.ajax({
            url: 'search.php',
            data: $('#filter').serialize(),
            dataType: 'json',
            success: function (data) {
                if (data.status.code == 200) {
                    var homeTemplate = $('#homeTemplate').html(),
                        $container = $("#container");
                    console.log(data.data.meta.totalMatched);
                    console.log(data.data.meta.totalPages);
                    console.log(data.data.meta.searchResultsUrl);
                    $('#summary').text(data.data.meta.totalMatched + ' listings found').show();
                    $container.html('');
                    $container.html(_.template(homeTemplate,{listings: data.data.listings}));
                    $("img").unveil();

                    // pagination
                    if (data.data.meta.totalPages > 1) {
                        var paginationText = 'Page: ';
                        for (i = 1; i <= data.data.meta.totalPages; i++) {
                            paginationText += "<span class='page' data-page=" + i + ">" + i + "</span> ";
                            if (i >= 10) {
                                i += 9;
                            }
                        };
                        $('#pagination').html(paginationText).show();
                        console.log(data.data.meta.currentPage);
                        console.log($('.pages[data-page="'+ data.data.meta.currentPage+'"]'));
                        $('.page[data-page="'+ data.data.meta.currentPage+'"]').css('font-weight', 'bold')
                    }
                } else {
                    // something went wrong
                    $errorMessage.text(data.status.errorStack[0].message).show();
                }
            },
            error: function() {
                    $errorMessage.text('It looks like something went wrong in our system. Please try again later.').show();
            }
        });
    });

    
});

$(document).on('click','.page',function(){
    var val = $(this).data('page');
    console.log(val);
    $('input[name="page"]').val(val);
    $("#searchButton").trigger('click');
});



/**
 * jQuery Unveil
 * A very lightweight jQuery plugin to lazy load images
 * http://luis-almeida.github.com/unveil
 *
 * Licensed under the MIT license.
 * Copyright 2013 Luís Almeida
 * https://github.com/luis-almeida
 */

;(function($) {

  $.fn.unveil = function(threshold, callback) {

    var $w = $(window),
        th = threshold || 0,
        retina = window.devicePixelRatio > 1,
        attrib = retina? "data-src-retina" : "data-src",
        images = this,
        loaded;

    this.one("unveil", function() {
      var source = this.getAttribute(attrib);
      source = source || this.getAttribute("data-src");
      if (source) {
        this.setAttribute("src", source);
        if (typeof callback === "function") callback.call(this);
      }
    });

    function unveil() {
      var inview = images.filter(function() {
        var $e = $(this);
        if ($e.is(":hidden")) return;

        var wt = $w.scrollTop(),
            wb = wt + $w.height(),
            et = $e.offset().top,
            eb = et + $e.height();

        return eb >= wt - th && et <= wb + th;
      });

      loaded = inview.trigger("unveil");
      images = images.not(loaded);
    }

    $w.on("scroll.unveil resize.unveil lookup.unveil", unveil);

    unveil();

    return this;

  };

})(window.jQuery || window.Zepto);
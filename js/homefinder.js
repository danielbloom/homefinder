function numberWithCommas(x) {
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ',');
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
        $pagination.hide();

        // retrieve listing data
        $.ajax({
            url: 'search',
            data: $('#filter').serialize(),
            dataType: 'json',
            success: function (data) {
                if (data.status.code == 200) {
                    var homeTemplate = $('#homeTemplate').html(),
                        $container = $('#container');

                    $('#summary').text(data.data.meta.totalMatched + ' listings found').show();
                    $container.html('');
                    $container.html(_.template(homeTemplate,{listings: data.data.listings}));
                    $('img').unveil();

                    // pagination
                    if (data.data.meta.totalPages > 1) {
                        var paginationText = 'Page: ';
                        for (i = 1; i <= data.data.meta.totalPages; i++) {
                            paginationText += '<span class="page" data-page=' + i + '>' + i + '</span> ';
                            if (i >= 10) {
                                i += 9;
                            }
                        }
                        $('#pagination').html(paginationText).show();
                        $('.page[data-page="'+ data.data.meta.currentPage+'"]').css('font-weight', 'bold');
                    }
                } else {
                    // something went wrong
                    errorText = (data.status.code == 606) ? 'Please be more specific by including a state e.g. New Haven, CT' : data.status.errorStack[0].message;
                    $errorMessage.text(errorText).show();
                }
            },
            error: function() {
                    $errorMessage.text('It looks like something went wrong in our system. Please try again later.').show();
            }
        });
    });

    
});

// make clicking on a page number trigger a refresh
$(document).on('click','.page',function(){
    var page = $(this).data('page');
    $('input[name="page"]').val(page);
    $('#searchButton').trigger('click');
});
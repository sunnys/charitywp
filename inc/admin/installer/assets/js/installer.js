(function ($) {
    $(document).ready(function () {
        $('.thim-button-link').on('click', function () {
            var $button = $(this);
            $button.addClass('updating-message').attr('disabled', true);
            window.location.href = $button.attr('data-href');
        })
    });
})(jQuery);
(function ($, wp) {
    var onClickDismiss = function () {
        wp.ajax.post('thim_core_installer_dismiss_notice');
    };

    var _ready = function () {
        var $notice = $('.thim-core-installer-notice');

        if (!$notice || !$notice.length) {
            return;
        }

        $(document).on('click', '.thim-core-installer-notice .notice-dismiss', function (e) {
            onClickDismiss();
        });
    };

    $(document).ready(function () {
        _ready();
    });
})(jQuery, wp);
import 'cropper/dist/cropper.min'
import * as Cropper from '../../public/bundles/prestaimage/js/cropper.js';

(function (w, $) {

    'use strict';

    $(function () {
        $('.cropper').each(function () {
            new Cropper($(this));
        });
    });

})(window, jQuery);
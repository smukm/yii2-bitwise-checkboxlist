if (typeof vv68 === 'undefined' || !vv68) {
    var vv68 = {};
}
vv68.bwWidget = (function ($) {
    'use strict';
    return {
        register: function (elementId) {
            $('#field-' + elementId +' input[type="checkbox"]').change(function() {
                var val = 0;
                $('#field-'+ elementId +' input[type="checkbox"]').each(function () {
                    if(this.checked) {
                        val += parseInt($(this).val(), 10);
                    }
                });
                $('#' + elementId).val(val);
            });
        }
    }
})(jQuery);
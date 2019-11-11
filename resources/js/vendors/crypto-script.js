/* Template: UserCenter v1.0.1 @ICO Crypto */
(function($){
	'use strict';
    // Select
    let $selectbox = $('.input-select, select');
    if ($selectbox.length > 0) {
        $selectbox.each(function() {
            var $this = $(this);
            $this.select2();
        });
    }
})(jQuery);

/**
 * jQuery.placeholder - Placeholder plugin for input fields
 * Written by Blair Mitchelmore (blair DOT mitchelmore AT gmail DOT com)
 * Licensed under the WTFPL (http://sam.zoy.org/wtfpl/).
 * Date: 2008/10/14
 *
 * @author Blair Mitchelmore
 * @version 1.0.1
 *
 **/
new function(jQuery) {
    jQuery.fn.placeholder = function(settings) {
        settings = settings || {};
        var key = settings.dataKey || "placeholderValue";
        var attr = settings.attr || "placeholder";
        var className = settings.className || "placeholder";
        var values = settings.values || [];
        var block = settings.blockSubmit || false;
        var blank = settings.blankSubmit || false;
        var submit = settings.onSubmit || false;
        var value = settings.value || "";
        var position = settings.cursor_position || 0;

        
        return this.filter(":input").each(function(index) { 
            jQuery.data(this, key, values[index] || jQuery(this).attr(attr)); 
        }).each(function() {
            if (jQuery.trim(jQuery(this).val()) === "")
                jQuery(this).addClass(className).val(jQuery.data(this, key));
        }).focus(function() {
            if (jQuery.trim(jQuery(this).val()) === jQuery.data(this, key)) 
                jQuery(this).removeClass(className).val(value)
                if (jQuery.fn.setCursorPosition) {
                  jQuery(this).setCursorPosition(position);
                }
        }).blur(function() {
            if (jQuery.trim(jQuery(this).val()) === value)
                jQuery(this).addClass(className).val(jQuery.data(this, key));
        }).each(function(index, elem) {
            if (block)
                new function(e) {
                    jQuery(e.form).submit(function() {
                        return jQuery.trim(jQuery(e).val()) != jQuery.data(e, key)
                    });
                }(elem);
            else if (blank)
                new function(e) {
                    jQuery(e.form).submit(function() {
                        if (jQuery.trim(jQuery(e).val()) == jQuery.data(e, key)) 
                            jQuery(e).removeClass(className).val("");
                        return true;
                    });
                }(elem);
            else if (submit)
                new function(e) { jQuery(e.form).submit(submit); }(elem);
        });
    };
}(jQuery);

(function ($) {
    "use strict";
    

    function jQueryCloneWithSelectAndTextAreaValues(elmToClone, withDataAndEvents, deepWithDataAndEvents) {
        
        
        var $elmToClone = $(elmToClone),
            $result           = $elmToClone.clone(withDataAndEvents, deepWithDataAndEvents),
            $myTextareas     = $elmToClone.find('textarea').add($elmToClone.filter('textarea')),
            $resultTextareas = $result.find('textarea').add($result.filter('textarea')),
            $mySelects       = $elmToClone.find('select').add($elmToClone.filter('select')),
            $resultSelects   = $result.find('select').add($result.filter('select')),
            i, l, j, m;

        for (i = 0, l = $myTextareas.length; i < l; ++i) {
            $($resultTextareas[i]).val($($myTextareas[i]).val());
        }
        for (i = 0, l = $mySelects.length;   i < l; ++i) {
            for (j = 0, m = $mySelects[i].options.length; j < m; ++j) {
                if ($mySelects[i].options[j].selected === true) {
                    $resultSelects[i].options[j].selected = true;
                }
            }
        }
        return $result;
    }

    function getjQueryObject(string) {
        
        var jqObj = $("");
        try {
            jqObj = jQueryCloneWithSelectAndTextAreaValues(string);
        } catch (e) {
            jqObj = $("<span />")
                .html(string);
        }
        return jqObj;
    }

    function printFrame(frameWindow, content, options) {
        
        var def = $.Deferred();
        try {
            frameWindow = frameWindow.contentWindow || frameWindow.contentDocument || frameWindow;
            var wdoc = frameWindow.document || frameWindow.contentDocument || frameWindow;
            if(options.doctype) {
                wdoc.write(options.doctype);
            }
            wdoc.write(content);
            wdoc.close();
            var printed = false,
                callPrint = function () {
                    if(printed) {
                        return;
                    }
                    
                    frameWindow.focus();
                    try {
                        
                        if (!frameWindow.document.execCommand('print', false, null)) {
                            
                            frameWindow.print();
                        }
                        
                        $('body').focus();
                    } catch (e) {
                        frameWindow.print();
                    }
                    frameWindow.close();
                    printed = true;
                    def.resolve();
                };
            
            $(frameWindow).on("load", callPrint);
            
            setTimeout(callPrint, options.timeout);
        } catch (err) {
            def.reject(err);
        }
        return def;
    }

    function printContentInIFrame(content, options) {
        var $iframe = $(options.iframe + "");
        var iframeCount = $iframe.length;
        if (iframeCount === 0) {
            
            $iframe = $('<iframe height="0" width="0" border="0" wmode="Opaque"/>')
                .prependTo('body')
                .css({
                    "position": "absolute",
                    "top": -999,
                    "left": -999
                });
        }
        var frameWindow = $iframe.get(0);
        return printFrame(frameWindow, content, options)
            .done(function () {
                
                setTimeout(function () {
                    
                    if (iframeCount === 0) {
                        
                        $iframe.remove();
                    }
                }, 1000);
            })
            .fail(function (err) {
                
                console.error("Failed to print from iframe", err);
                printContentInNewWindow(content, options);
            })
            .always(function () {
                try {
                    options.deferred.resolve();
                } catch (err) {
                    console.warn('Error notifying deferred', err);
                }
            });
    }

    function printContentInNewWindow(content, options) {
        
        var frameWindow = window.open();
        return printFrame(frameWindow, content, options)
            .always(function () {
                try {
                    options.deferred.resolve();
                } catch (err) {
                    console.warn('Error notifying deferred', err);
                }
            });
    }

    function isNode(o) {
        
        return !!(typeof Node === "object" ? o instanceof Node : o && typeof o === "object" && typeof o.nodeType === "number" && typeof o.nodeName === "string");
    }
    $.print = $.fn.print = function () {
        
        var options, $this, self = this;
        
        if (self instanceof $) {
            
            self = self.get(0);
        }
        if (isNode(self)) {
            
            
            $this = $(self);
            if (arguments.length > 0) {
                options = arguments[0];
            }
        } else {
            if (arguments.length > 0) {
                
                $this = $(arguments[0]);
                if (isNode($this[0])) {
                    if (arguments.length > 1) {
                        options = arguments[1];
                    }
                } else {
                    
                    options = arguments[0];
                    $this = $("html");
                }
            } else {
                
                $this = $("html");
            }
        }
        
        var defaults = {
            globalStyles: true,
            mediaPrint: false,
            stylesheet: null,
            noPrintSelector: ".no-print",
            iframe: true,
            append: null,
            prepend: null,
            manuallyCopyFormValues: true,
            deferred: $.Deferred(),
            timeout: 750,
            title: null,
            doctype: '<!doctype html>'
        };
        
        options = $.extend({}, defaults, (options || {}));
        var $styles = $("");
        if (options.globalStyles) {
            
            $styles = $("style, link, meta, base, title");
        } else if (options.mediaPrint) {
            
            $styles = $("link[media=print]");
        }
        if (options.stylesheet) {
            
            $styles = $.merge($styles, $('<link rel="stylesheet" href="' + options.stylesheet + '">'));
        }
        
        var copy = jQueryCloneWithSelectAndTextAreaValues($this);
        
        copy = $("<span/>")
            .append(copy);
        
        copy.find(options.noPrintSelector)
            .remove();
        
        copy.append(jQueryCloneWithSelectAndTextAreaValues($styles));
        
        if (options.title) {
            var title = $("title", copy);
            if (title.length === 0) {
                title = $("<title />");
                copy.append(title);                
            }
            title.text(options.title);            
        }
        
        copy.append(getjQueryObject(options.append));
        
        copy.prepend(getjQueryObject(options.prepend));
        if (options.manuallyCopyFormValues) {
            
            
            copy.find("input")
                .each(function () {
                    var $field = $(this);
                    if ($field.is("[type='radio']") || $field.is("[type='checkbox']")) {
                        if ($field.prop("checked")) {
                            $field.attr("checked", "checked");
                        }
                    } else {
                        $field.attr("value", $field.val());
                    }
                });
            copy.find("select").each(function () {
                var $field = $(this);
                $field.find(":selected").attr("selected", "selected");
            });
            copy.find("textarea").each(function () {
                
                var $field = $(this);
                $field.text($field.val());
            });
        }
        
        var content = copy.html();
        
        try {
            options.deferred.notify('generated_markup', content, copy);
        } catch (err) {
            console.warn('Error notifying deferred', err);
        }
        
        copy.remove();
        if (options.iframe) {
            
            try {
                printContentInIFrame(content, options);
            } catch (e) {
                
                console.error("Failed to print from iframe", e.stack, e.message);
                printContentInNewWindow(content, options);
            }
        } else {
            
            printContentInNewWindow(content, options);
        }
        return this;
    };
})(jQuery);

var textBoxId = '';
var IncDecDivElement = '';
var result;
var isFunctionCall = false;
$(function() {
    $.widget("create.IncDecBox", {
        options: {
            autoOpen: false
        },
        _create: function() {
            textBoxId = (this.element).attr('class');
            IncDecDivElement = this.element;
            this._IncDec = $(
                "<div class='IncDecDiv'><input type='button' name='btnMinus' class='btnMinus' value='-'><input type='text' name='txtArea' id='txtAnswer' class='txtAnswer' value='0'><input type='button' name='btnPlus' class='btnPlus' value='+'></div>"
            );
            this._IncDec.width((this.element).width());
            this._IncDec.height((this.element).height());
            var pos = this.element.position();
            console.log(pos);
            this._IncDec.css("position", "absolute");
            this._IncDec.css("z-index", "1060");
            this._IncDec.css({
                top: pos.top + (this.element).height() + 7,
                left: pos.left
            });
            $(this.element).after(this._IncDec);
            this._IncDec.hide();
            $(this.element).attr('autocomplete', 'off');
        },
        _init: function() {
            this.element.on("focus", function() {
                if ($('.IncDecDiv').length >= 0) {
                    $('.IncDecDiv').hide();
                }
                $(this).next('.IncDecDiv').show();
            });
            if (this.options.autoOpen) {
                this.open();
            }
        },
        _getCreateEventData: function() {
            return this.options;
        },
        _destroy: function() {
            this._IncDec.remove();
        }
    });

    $(document).ready(function() {
        $("input:button").click(function() {
            IncrementDecrement(this);
        });
    });

    $(document).on('focusout', 'body .IncDecDiv', function() {
        var Divdestroy = $('.IncDecDiv').length;
        if (Divdestroy != 0) {
            if (isFunctionCall) {
                $(this).prev().val(result);
                isFunctionCall = false;
            }
        }
    });
    $(document).click(function(event) {
        console.log(event);
        if (!$(event.target).is("input")) {
            if (!$(event.target).is(".IncDecDiv")) {
                $('.IncDecDiv').hide();
            }
        }
    });
});

function IncrementDecrement(ele) {
    isFunctionCall = true;
    var ele;
    this.ele = ele;
    var op = ele.value;
    result = $(ele).parent().children('.txtAnswer').val();
    if (op == '+') {
        parseFloat(result);
        result++;
        $(ele).parent().children('.txtAnswer').val(result);
    } else if (op == '-') {
        parseFloat(result);
        result = result - 1;
        $(ele).parent().children('.txtAnswer').val(result);
    }
}

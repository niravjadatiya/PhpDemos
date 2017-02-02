$(function() {
    var textBoxId = '';
    var IncDecDivElement = '';

    $.widget("create.IncDecBox", {
        options: {
            autoOpen: false
        },
        _create: function() {
            textBoxId = (this.element).attr('id');
            IncDecDivElement = this.element;
            // console.log(textBoxId);
            this._IncDec = $(
                "<div class='IncDecDiv'><input type='button' name='btnMinus' id='btnMinus' value='-'><input type='text' name='txtArea' id='txtAnswer' class='txtAnswer' value='0'><input type='button' name='btnPlus' id='btnPlus' value='+'></div>"
            );
            this._IncDec.width((this.element).width());
            this._IncDec.height((this.element).height());
            this._IncDec.css("position", "inherit");
            $(this.element).after(this._IncDec);
            this._IncDec.hide();
            $(this.element).attr('autocomplete', 'off');
            // var position = (this.element).position();
            // console.log(position.top + " " + position.left)
            // this._IncDec.css("margin-top", position.top*3);
            // this._IncDec.css("margin-right", position.left);
            if (this.options.autoOpen) {
                this._IncDec.show();
            }
        },
        _destroy: function() {
            this._IncDec.remove();
        }
    });

    $(document).ready(function() {

        $(IncDecDivElement).on('click', function() {
            // console.log(IncDecDivElement);
            $('.IncDecDiv').toggle();
            // IncDecDiv("init");
        });
        $(this).val(IncrementDecrement(this));
    });

    $(document).on('focusout', 'body .IncDecDiv', function() {
        var Divdestroy = $('.IncDecDiv').length;
        if (Divdestroy != 0) {
            $(IncDecDivElement).val($('.txtAnswer').val());
            $('.IncDecDiv').hide();
            // console.log("gone");
        }
    });
});

function IncrementDecrement(ele) {
    var result = $('.txtAnswer').val();
    $('#btnPlus').on('click', function() {
        parseFloat(result);
        result++;
        $('.txtAnswer').val(result);
    });
    $('#btnMinus').on('click', function() {
        parseFloat(result);
        result--;
        $('.txtAnswer').val(result);
    });
}

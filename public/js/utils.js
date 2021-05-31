function formatNumber(value) {
    return parseFloat(value || 0).toLocaleString('en');
}

function defaultIfNaN(number, defaultValue = 0) {
    if (typeof number !== 'number') {
        number = Number(number);
    }

    return isNaN(number) ? defaultValue : number;
}

function getUrlParams(key = null) {
    const searchParams = new URLSearchParams(window.location.search);

    if (key) {
        return searchParams.get(key);
    }

    let returnObject = {};

    for (let key of searchParams.keys()) {
        returnObject[key] = searchParams.get(key);
    }

    return returnObject;
}

function nl2br (str, is_xhtml) {
    if (typeof str === 'undefined' || str === null) {
        return '';
    }
    var breakTag = (is_xhtml || typeof is_xhtml === 'undefined') ? '<br />' : '<br>';
    return (str + '').replace(/([^>\r\n]?)(\r\n|\n\r|\r|\n)/g, '$1' + breakTag + '$2');
}

function getLabel(value, textConfig = {}, colorConfig = {}) {
    return `<span class="label bg-${colorConfig[value]}">${textConfig[value]}</span>`;
}

// Format number on input
$.fn.formatNumber = function() {
    return this.each(function () {
        // get value
        var name = $(this).attr('name');
        var id = $(this).attr('id');
        var newId = id.replace('[', '\\[').replace(']', '\\]') + '-hidden';
        var old_val = $(this).attr('value');

        // change old element
        $(this).removeAttr('name');
        $(this).attr('type', 'text');
        $(this).attr('autocomplete', 'off');
        $(this).val(function(index, value) {
            var parts = value.toString().split(".");
            parts[0] = parts[0].replace(/[^0-9.]/g, '').replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            return parts.join(".");
        });
        // add new hidden element
        var appendInput = "<input type=\'hidden\' id=\'" + (id + '-hidden') + "\' name=\'" + name + "\'>";
        $(this).parent().append(appendInput);
        $('#'+newId).val(old_val);

        // listen change data
        $(this).on('keyup change', function(){
            $(this).val(function(index, value) {
                var parts = value.toString().split(".");
                parts[0] = parts[0].replace(/[^0-9.]/g, '').replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                return parts.join(".");
            });
            var amount = $(this).val();
            if(amount != ''){
                amount = parseFloat(amount.replace(/,/g, ''));
            } else {
                amount = '';
            }
            $('#'+newId).val(amount);
        });
    })
};
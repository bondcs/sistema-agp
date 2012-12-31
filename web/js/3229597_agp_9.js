function initDataTable(table, dtProps)
{     
    var dtDefaults = {
        "bInfo": true,
        "bLengthChange": true,
        "bRetrieve": false,
        "bDestroy": true,
        "sDom": "<'row-fluid'<'span6'l><'span6'f>r>t<'row-fluid'<'span6'i><'span6'p>>",
            
    }

    var settings = $.extend(dtDefaults, dtProps);
    return $(table).dataTable(settings);
}

function initDataTableTools(table, dtProps)
{     
    var dtDefaults = {
        "bInfo": false,
        "bLengthChange": true,
        "bRetrieve": false,
        "bDestroy": true,
        "sDom": "<'row-fluid'<'span9'T><'span3'f>r>t<'row-fluid'<'span6'i><'span6'p>>",
            "oTableTools": {
                "aButtons": [
                    "copy",
                    "print",
                    {
                            "sExtends":    "collection",
                            "sButtonText": 'Save <span class="caret" />',
                            "aButtons":    [ "csv", "xls", "pdf" ]
                    }
                ]
            }
        }

    var settings = $.extend(dtDefaults, dtProps);
    return $(table).dataTable(settings);

}

$(document).ready(function ()
{  
    
    /* dataTable Plugin definição */
    oTable = initDataTable('table.simpletable', null);
    
    /* dataTableTools Plugin definicao*/
    tTable = initDataTableTools('table.toolstable', null);
    
    /*Flecha para cima, para baixo*/
    $(".icon-chevron-down").on("click", function(e)
    {
        if ($(this).hasClass("icon-chevron-up")){
              $(this).removeClass("icon-chevron-up");
              $(this).addClass("icon-chevron-down")
        } else {
              $(this).removeClass("icon-chevron-down");
              $(this).addClass("icon-chevron-up")
        }
        e.preventDefault()
    })
    
    /* menu Cookie */
    var tabsCookie = $.cookie("tab-item");
    if (tabsCookie != null) {
            $('.sub-menu ul li ').removeClass('active');
            $('.sub-menu .nav-tabs > li:eq('+tabsCookie+')').addClass('active')
    }
    $('.sub-menu ul.nav-tabs > li > a').click(function(e) {
        var tabIndex = $('.sub-menu .nav-tabs a').index(this);
        $.cookie("tab-item", tabIndex, {path:"/"});
        $('.sub-menu ul li ').removeClass('active');
        $(this).parents('li:first').addClass('active');
    });
    
    /*Confirm Action*/
    $(".confirm-action").on("click", function(e)
    {
        $(".confirm-link").attr("href", $(this).data("href"));
        e.preventDefault();
    });

    /* datepicker JqueryUI*/
    $.datepicker.regional['pt-BR'] = {
               closeText: 'Fechar',
               prevText: '&#x3c;Anterior',
               nextText: 'Pr&oacute;ximo&#x3e;',
               currentText: 'Hoje',
               monthNames: ['Janeiro','Fevereiro','Mar&ccedil;o','Abril','Maio','Junho',
               'Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
               monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun',
               'Jul','Ago','Set','Out','Nov','Dez'],
               dayNames: ['Domingo','Segunda-feira','Ter&ccedil;a-feira','Quarta-feira','Quinta-feira','Sexta-feira','Sabado'],
               dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','Sab'],
               dayNamesMin: ['Dom','Seg','Ter','Qua','Qui','Sex','Sab'],
               weekHeader: 'Sm',
               dateFormat: 'dd/mm/yy',
               defaultDate: '00/00/00',
               firstDay: 0,
               isRTL: false,
               showMonthAfterYear: false,
               yearSuffix: ''           
     };

     $.datepicker.setDefaults($.datepicker.regional['pt-BR']);
     $('.datepicker').datepicker();
     
});

    /* Formata número */
    function number_format (number, decimals, dec_point, thousands_sep) {
        number = (number + '').replace(/[^0-9+\-Ee.]/g, '');
        var n = !isFinite(+number) ? 0 : +number,
            prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
            sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
            dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
            s = '',
            toFixedFix = function (n, prec) {
                var k = Math.pow(10, prec);
                return '' + Math.round(n * k) / k;
            };
        // Fix for IE parseFloat(0.55).toFixed(0) = 0;
        s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
        if (s[0].length > 3) {
            s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
        }
        if ((s[1] || '').length < prec) {
            s[1] = s[1] || '';
            s[1] += new Array(prec - s[1].length + 1).join('0');
        }
        return s.join(dec);
    }

    function formataDinheiro(value){
        return "R$ " + number_format(value.replace(',','.'), 2, ',','');
    }

    function desformataDinheiro(value){
        return value.replace(",", ".").slice(3) * 1;
    }

    function formataDinheiroTabela(value){
        return number_format(value.replace(',','.'), 2, ',','');
    }

    function formataQtdTabela(value){
        return number_format(value.replace(',','.'), 2, '.','');
    }
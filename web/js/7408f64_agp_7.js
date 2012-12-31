function initDataTable(table, dtProps)
{     
    var dtDefaults = {
        "bJQueryUI": false,
        "sPaginationType": "full_numbers",
        "bInfo": false,
        "bLengthChange": true,
        "bRetrieve": false,
        "bDestroy": true,
        "sDom": "<lfrtip>",
        "oLanguage": {
            "sProcessing":   "Processando...",
            "sLengthMenu":   "_MENU_",
            "sZeroRecords":  "Não foram encontrados resultados",
            "sInfo":         "Mostrando de _START_ até _END_ de _TOTAL_ registros",
            "sInfoEmpty":    "Mostrando de 0 até 0 de 0 registros",
            "sInfoFiltered": "(filtrado de _MAX_ registros no total)",
            "sInfoPostFix":  "",
            "sSearch":       "",
            "sUrl":          "",
            "oPaginate": {
                "sFirst": "|<<",
                "sLast": ">>|",
                "sNext": ">",
                "sPrevious": "<"
              },
            "iDisplayLength": 25
        }     
    }

    var settings = $.extend(dtDefaults, dtProps);
    return $(table).dataTable(settings);
}

$(document).ready(function ()
{  
    
    /* menu cookie */
    var checkCookie = $.cookie("nav-item");
    if (checkCookie != "") {
            $('#side-menu > li:eq('+checkCookie+')').addClass('active').next().show();
    }

    $('#side-menu > li > a').on("click", function()
    {
          //var navIndex = $('#side-menu > li > a').index(this);
          //$.cookie("nav-item", navIndex, {path:"/"});
          $.cookie("tab-item", null, {path:"/"});
          //$('#side-menu li ').removeClass('active');
          //$(this).parents('li:first').addClass('active');
    });
    
    $("#side-menu .icon-chevron-down").on("click", function(e)
    {
        var submenu = $(this).parent().next();
        if (submenu.is(":visible")){
              submenu.slideUp();
        } else {
              submenu.slideToggle();
        }
        e.preventDefault()
    })

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
    
    /* dataTable Plugin definição */
    oTable = initDataTable('table.stdtable', null);
    
     
     /*Menu Cookie*/
     var checkMenuCookie = $.cookie("menu-href");
         if (checkMenuCookie != "") 
         {
             $(".menu-acc .collapse").removeClass("in");
             $("#"+checkMenuCookie).addClass('in');
         }    
     $(".menu-acc").on("shown", function()
     {
         var menuHref = $(".menu-acc .in").attr("id");
         $.cookie("menu-href", menuHref, {path:"/"});
         $.cookie("tab-item", "", {path:"/"});
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

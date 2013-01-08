 $(document).ready(function() {
    $(document).ajaxError(function (event, jqXHR) {
    if (403 === jqXHR.status) {
        window.location.reload();
    }

    });
});

function initDataTable(table, dtProps)
{     
    var dtDefaults = {
        "aaSorting": [ ],
        "iDisplayLength": 100,
        "aLengthMenu": [[100, 250, 500], [100, 250, 500]],
        "bInfo": true,
        "bLengthChange": true,
        "bRetrieve": false,
        "bDestroy": true,
        "bDeferRender": true,
        "sDom": "<'row-fluid'<'span1 length'l><'span3 tools-p'T><'span3 pull-right find'f>r>t<'row-fluid'<'span6 info'i><'span6 pull-right page'p>>",
        "oTableTools":{ 
            "sSwfPath": path+"/agpfront/js/copy_csv_xls_pdf.swf",
            "aButtons": [
                    "copy",
                    "print",
                    "pdf",
            ]
        }
    }

    var settings = $.extend(dtDefaults, dtProps);
    return $(table).dataTable(settings);
}

function initDataTableTools(table, dtProps, toolsProps)
{   
    
    var toolsDefaults = {
        "sSwfPath": path+"/agpfront/js/copy_csv_xls_pdf.swf",
        "aButtons": [
            "copy",
            "print",
            "pdf",
        ]
    }
    
   var settingsTools = $.extend(toolsDefaults, toolsProps);
    
   var dtDefaults = {
        "aaSorting": [ ],
        "bInfo": false,
        "bLengthChange": true,
        "bDestroy": true,
        "sServerMethod": "POST",
        "sDom": "<'row-fluid'<'span6 tools'T><'span3 pull-right find'f>r>t<'row-fluid'<'span6 info'i><'span6 pull-right page'p>>",
        "oTableTools" : settingsTools
        }
    
    var settings = $.extend(dtDefaults, dtProps);
    return $(table).dataTable(settings);

}

$(document).ajaxStart(function(){
     $(".ajaxLoader").show();
}).ajaxStop(function(){
     $(".ajaxLoader").hide();

});



$(document).ready(function ()
{  
    /* dataTable Plugin definição */
    oTable = initDataTable('table.simpletable', null);
    
    /* dataTableTools Plugin definicao*/
    tTable = initDataTableTools('table.toolstable', null);
    
    /*Flecha para cima, para baixo*/
//    $(".icon-chevron-down").on("click", function(e)
//    {
//        if ($(this).hasClass("icon-chevron-up")){
//              $(this).removeClass("icon-chevron-up");
//              $(this).addClass("icon-chevron-down")
//        } else {
//              $(this).removeClass("icon-chevron-down");
//              $(this).addClass("icon-chevron-up")
//        }
//        e.preventDefault()
//    })
    
    $(".alert").delay(4000).slideUp("slow");
    
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
     
    var btn = $('button[type="submit"]')
    btn.attr("disabled", "disabled")
    $(document).ajaxStart(function(){
      btn.attr("disabled", "disabled")
    }).ajaxStop(function(){
      
      setTimeout(function(){btn.removeAttr("disabled")}, 5000);
    }); 
     
     
});

function onReady()
{ 
    var btn = $('button[type="submit"]')
    btn.attr("disabled", "disabled")
    $(document).ajaxStart(function(){
      btn.attr("disabled", "disabled")
    }).ajaxStop(function(){
      
      setTimeout(function(){btn.removeAttr("disabled")}, 500);
    }); 

/* Form Handlers*/
    
     
//    $(function() {
//        $("#ajax-form").submit(function(e){
//            e.preventDefault();
//                var url = $('#ajax-form').attr("action");
//                $.ajax({
//                    type: 'POST',
//                    url: url,
//                    data: $('#ajax-form').serialize(),
//                    success: function(result){
//                        if (result["status"] == "sucesso"){
//                            tTable.dataTable().fnReloadAjax();
//                            $("#dialog").dialog( "close" ); 
//                            notify("regular", "Sucesso", "Acão foi efetuada!")
//                            
//                            if (result["form"]){
//                                $("#dialog").html(result['form']);
//                                onReady()
//                                $("#dialog").dialog( "open" ); 
//                            }
//                            
//                            $(".checkAll").attr("checked", false);
//                            return false;
//                        }
//                        
//                        $("#dialog").html(result);
//                        onReady()
//                    }
//                })
//                
//            return false;
//        })
//    })
    
    $(function(){
        $(".moeda").each(function(){
            if($(this).val()){
                $(this).val(formataDinheiro($(this).val()));
            }
        });
    })
    
    $('.datepicker').datepicker();
    $(".chzn-select").chosen({no_results_text: "Nenhum resultado"});
    showHide($(".vinculo"), "Permanente", $(".temporario"));
    
    $(".telefone").mask("(99) 9999-9999");
    $(".cpf").mask("999.999.999-99");
    $(".cnpj").mask("99.999.999/9999-99");
    $(".cep").mask("99999-999")
    $(".data").mask("99/99/9999")
    
}

// Acao em grupo
function formSubmitTableGroup(form, url){ 
    $.ajax({
        type: 'POST',
        url: url,
        data: form.serialize(),
        success: function(result){
            if (result['status'] == "sucesso"){
                tTable.dataTable().fnReloadAjax();
                notify("regular", "Sucesso", "Acão foi efetuada!")
                $(".check-button").addClass("hidden");
                $(".checkAll").attr("checked", false);
                return false;
            }
            $("#dialog").html(result);
            onReady();
        }
    })
}

// Comfirm para Delete em grupo
function formConfirmGroupDelete(form, url){ 
    
    $("#dialog-confirm").dialog( "option", "buttons", [ 
          { 
                text: "Deletar", 
                click: function() { 
                    formSubmitTableGroup(form, url)
                    $( this ).dialog( "close" ); 
                }
          },
          {
                text: "Cancelar",
                click: function() {
                      $( this ).dialog( "close" );
              }
          }
      ] );
      
      $("#dialog-confirm").dialog("option", "title", "Deletar registros.")
      $("#dialog-confirm").dialog("option", "dialogClass", "dialog-confirm")
      $("#dialog-confirm").html("Realmente deseja deletar estes registros?");
      $(".dialog-confirm .ui-dialog-buttonset button").addClass("btn");
      $("#dialog-confirm").dialog('open');
}

// Edit em grupo
function formSubmitTableEdit(form, url){ 
    $.ajax({
        type: 'POST',
        url: url,
        data: form.serialize()
    })
}



/* checkbox das tabelas */
$(document).on('click', '#formTable .check-table', function(e){
    // alterar a cor do fundo da linha
    $(this).closest("tr").toggleClass('row_selected');
    if ($('.check-table').is(":checked")){
        $(".check-button").removeClass("hidden");
    }else{
        $(".check-button").addClass("hidden");
    }

});

/* evento para abri dialog de edição*/
$(document).on('click', '.action-edit', function(e){
       e.preventDefault();
       ajaxLoadDialog($(this).attr("href"), $(this).attr("title"))
}) 

/* ajax para deletar com dialog*/
function ajaxDeleteDialog(url){
    $.ajax({
            type: 'POST',
            url: url,
            success: function(){
                $("#dialog-confirm").dialog( "close" );
                tTable.dataTable().fnReloadAjax();
                $(".check-button").addClass("hidden");
                $(".checkAll").attr("checked", false);
                return false;
            }
    })
}

/* ajax para adicionar e deletar em dialogs*/
function ajaxLoadDialog(url, title){
    $.ajax({
            type: 'GET',
            url: url,
            success: function(result){
                $("#dialog").html(result);
                $("#dialog").dialog( "option", "title", title || "" );
                $("#dialog").dialog('open');
                $(".check-button").addClass("hidden");
                onReady();
                return false;
            }
    })
}

/* Dialogs */
$(function() {
    $( "#dialog" ).dialog({
        autoOpen: false,
        show: "fade",
        hide: "fade",
        resizable: false
     });
});

$(function() {
    $( "#dialog-fast" ).dialog({
        autoOpen: false,
        show: "fade",
        hide: "fade",
        resizable: false
    });
});

/* Dialog de confirmação*/
$(function() {
    $("#dialog-confirm").dialog({
        resizable: false,
        autoOpen: false,
        show: "fade",
        hide: "fade",
    });
    
    $(document).on('click', '.action-confirm', function(e){
       e.preventDefault();
       var url = $(this).data("href");
       $("#dialog-confirm").dialog( "option", "buttons", [ 
          { 
                text: "Deletar", 
                click: function() { 
                    ajaxDeleteDialog(url);
                    $( this ).dialog( "close" ); 
                }
          },
          {
                text: "Cancelar",
                click: function() {
                      $( this ).dialog( "close" );
              }
          }
      ] );
      $("#dialog-confirm").dialog("option", "title", $(this).attr("title"))
      $("#dialog-confirm").dialog("option", "dialogClass", "dialog-confirm")
      $("#dialog-confirm").html($(this).data("texto"));
      $(".dialog-confirm .ui-dialog-buttonset button").addClass("btn");
      $("#dialog-confirm").dialog('open');
    })  
 });
    
    /* Botão fechar*/
$(document).on('click', '.close-dialog', function(e){
   e.preventDefault();
   $("#dialog").dialog( "close" );
   $("#dialog-fast").dialog( "close" );
})  
    /* Botão fechar dialog-fast*/
$(document).on('click', '.close-dialog-fast', function(e){
   e.preventDefault();
   $("#dialog-fast").dialog( "close" );
})  



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

$(function(){
    $(document).on('focus', '.moeda', function(e){
        if($(this).val() != '')
	    $(this).val(desformataDinheiro($(this).val()));
    })  
    
    $(document).on('blur', '.moeda', function(e){
        if($(this).val() != '')
	    $(this).val(formataDinheiro($(this).val()));
    })
    
    $(document).on('each', '.moeda', function(e){
        if($(this).val() != '')
	    $(this).val(formataDinheiro($(this).val()));
    })
    
    $(".moeda").each(function(){
        if($(this).val() != '')
	    $(this).val(formataDinheiro($(this).val()));
    })
    

})

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

function formataDate(date, tipo){
    
    var ano = date.slice(0,4)
    var mes = date.slice(5,7)
    var dia = date.slice(8,10)
    var hora = date.slice(11,13)
    var minuto = date.slice(14,16)
    var sec = date.slice(17,20)
    
    if(tipo == "datetime"){
        return dia+"/"+mes+"/"+ano+" "+hora+":"+minuto+":"+sec;
    }else{
        return dia+"/"+mes+"/"+ano;
    }
    
    
}

var collectionHolder = $('ul.collectionItens');

    $(document).ready(function() {
               
        $(document).on('click', '.add-item', function(e){
            e.preventDefault();
            addItemForm(collectionHolder);
            //$(".chzn-select").chosen();
        });
        
        $(document).on('click', '.remove-item', function(e){
            e.preventDefault();
            parentLi = $(this).closest('li');
            parentLi.next().remove();
            parentLi.remove();
        });
    });

function addItemForm(collectionHolder) {

    var prototype = collectionHolder.attr('data-prototype');
    var newForm = prototype.replace(/__name__/g, Math.floor(Math.random()*100000000001));

    var $newFormLi = $('<li></li>').append(newForm);
    collectionHolder.append("<li><h4>"+collectionHolder.attr('data-nomeCollection')+"<a href='#' class='remove-item btn btn-danger pull-right'><i class='icon-remove'></i>Remover</a></h4><hr></li>");
    collectionHolder.append($newFormLi);
}

function notify(tipo, title, msg){
    
    $.pnotify.defaults.history = false;
    
    $.pnotify({
        title: title,
        text: msg,
        type: tipo
    });
}

function showHide(choice, value, elementShowHide){
    
    if (choice.val() == value){
        elementShowHide.hide()
    }else{
        elementShowHide.show()
    }
    
}

$(function(){

    $('.checkAll').change( function() {
        $('input', tTable.fnGetNodes()).attr('checked',this.checked);
        
        if(this.checked){
           $(".check-button").removeClass("hidden"); 
           $('input', tTable.fnGetNodes()).closest("tr").addClass('row_selected');
        }else{
           $(".check-button").addClass("hidden");
           $('input', tTable.fnGetNodes()).closest("tr").removeClass('row_selected');
        }
        
    } );
     
})

function preencheZeros(param,tamanho)  
{  
   var contador = param.length;  

   if (param.length != tamanho)  
   {  
      do  
      {  
         param = "0" + param;  
         contador += 1;  

      }while (contador < tamanho)  
   }
   
   return param
} 

$(function(){
    $(document).on('click', '.add-rapido', function(e){
        ajaxLoadDialogFast(Routing.generate($(this).data("rota")) , ($(this).attr("title")));
    })
})

function ajaxLoadDialogFast(url, title){
    $.ajax({
            type: 'GET',
            url: url,
            success: function(result){
                $("#dialog-fast").html(result);
                $("#dialog-fast").dialog( "option", "title", title || "" );
                $("#dialog-fast").dialog('open');
                $(".check-button").addClass("hidden");
                onReady()
                return false;
            }
    })   
}

$(function(){
    $(document).on('submit', '#ajax-form', function(e){
        e.preventDefault();
        var url = $(this).attr("action");
        $.ajax({
            type: 'POST',
            url: url,
            data: $(this).serialize(),
            success: function(result){
                if (result["status"] == "sucesso"){
                    tTable.dataTable().fnReloadAjax();
                    $("#dialog").dialog( "close" ); 
                    notify("regular", "Sucesso", "Acão foi efetuada!")

                    if (result["form"]){
                        $("#dialog").html(result['form']);
                        onReady()
                        $("#dialog").dialog( "open" ); 
                    }

                    $(".checkAll").attr("checked", false);
                    return false;
                }

                $("#dialog").html(result);
                onReady()
            }
        })
                
        return false;

    })
})

$(function(){
    $(document).on('click', "#submit-form-fast", function(e){
        e.preventDefault();
        var form = $("#ajax-form-fast");
        var url = form.attr("action");
        var rota = ($(this).data("rota"));
        var select = $('.'+($(this).data("select")));
        var dialog = $("#dialog-fast");
        
        $.ajax({
            type: 'POST',
            url: url,
            data: form.serialize(),
            success: function(result){
                if (result["status"] == "sucesso"){
                    dialog.dialog( "close" ); 
                    notify("regular", "Sucesso", "Registro cadastrado!")
                    if (result["form"]){
                        dialog.html(result['form']);
                        dialog.dialog( "open" ); 
                    }
                    
                    atualizaSelect(rota, select)
                    return false;

                }
                $("#dialog-fast").html(result);
                onReady()
            }
        })
        return false;
    })
    
})

function atualizaSelect(rota, select)
{
    $.ajax({
        type: 'POST',
        url: Routing.generate(rota),
        success: function(result){
            select.empty();
            var options = '';
            $.each(result, function(key, value){
                options += '<option value="'+value['id']+'">'+value['nome']+'</option>';

            })
            select.html(options);
            select.trigger("liszt:updated");
        }
    })

}


 
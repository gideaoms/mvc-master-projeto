$(document).ready(function(){    
    $('#enviar_arte').click(function(){
        var data = {};
        var itens = [];
        var pageSize = {width: $('#galery-images').width(), height: $('#galery-images').height()};
        $('#galery-images').find('.img').each(function(){
            var obj = $(this);
            item = {
                src: obj.data('src'),
                width: obj.width(),
                height: obj.height(),
                x: obj.position().left,
                y: obj.position().top
            }
            itens.push(item);
        });
        data.area = pageSize;
        data.itens = itens;
        $.ajax({
            type: 'post',
            url: "publicacao/gerarImagem",
            dataType: 'json',
            data: data,
            success: function(link) {
                $('#imagem-nova').append("<img src='" + link.url + "' />");
            }
        });
    });
    $("#coment-buttom").click(function(){
        $("#galery-images").append("<div class='coment img' data-src='assets/img/coment-01.png'>" + $("#coment-textarea").val() + "</div>");
        $(".coment:last").draggable({
            //addClasses: true,
            snap: true,
            revert: "invalid",
            drag: function(){
                $(this).width('auto').height('auto');
            }
        });
    });

    /* Quando usuario clica em enviar formulario */
    $('form').ajaxForm({
        beforeSubmit: function () {
            if (!validate('form')) {
                swal("Atenção", "Preencha os campos em vermelho!", "error");
                return false;
            }
        },
        url: this.action,
        type: this.method,
        dataType: 'json',
        success: function (data) {
            if(data.message !== "no-message") {
                swal({
                    title: data.message,   
                    type: "success",
                    closeOnConfirm: false
                }, function(isConfirm){
                    if (data.redirect !== "no-redirect") {
                        updateURL(data.redirect);
                    }
                });
            }
        }
    });
    /*quando usuario clicar em voltar no formulario */
    $("input[type='reset']").click(function(){
        updateURL($("input[type='reset']").parent().parent().attr('action').replace('gravar', 'listar').replace('atualizar', 'listar'));
    });

    /*JavaScript referente ao plugin contextMenu (menu da listagem)*/

    var contexto = ".table > tbody > tr";
    $.contextMenu({
        selector: contexto,
        trigger: 'left',
        callback: function(key, options) {

        },
        items: {
            "novo" : {
                name : "Novo",
                icon : "add",
                callback : function(key, options){
                    updateURL("admin/menu/cadastrar");
                }
            },
            "editar" : {
                name : "Editar",
                icon : "edit",
                callback : function(key, options){
                    var id = $(this).attr('id');
                    updateURL("admin/menu/editar/" + id);
                },
                disabled : function(){
                    //alert('teste');
                }
            },
            "excluir" : {
                name : "Excluir",
                icon : "delete",
                callback : function(key, options){
                    var id = $(this).attr('id');
                    confirmQuestion(id);                    
                }
            }
        }
    });
});

function enviarImagemForm() {
    $('#formImagem').ajaxForm({
        dataType: 'json',
        success: function (data) {
            $(data).each(function (index, value) {
                $('#galery-images').append('<img class="img" data-src="upload/imagens_originais/' + value + '" src="upload/imagens_originais/' + value + '" />');
            });
        }
    }).submit();
}

function validate(form) {
    var required = true;
    $(form).find('.required').each(function () {
        if (this.value === '') {
            $(this).addClass('border-red');
            required = false;
        } else {
            $(this).removeClass('border-red');
        }
    });
    return required;
}

function updateURL(url) {
    window.location.href = url;
}

function confirmQuestion(id) {
    swal({
        title: "Atenção",
        text: "Deseja excluir o registro?",
        type: "warning",
        showCancelButton: true,
        cancelButtonText: "Não",
        confirmButtonColor: "#009900",
        confirmButtonText: "Sim",
        closeOnConfirm: false 
    }, function(isConfirm){
        if (isConfirm) {
            $.ajax({
                url: "/admin/menu/excluir",
                type: "POST",
                dataType: 'json',
                data: {
                    id: id
                },
                success: function(data) {
                    swal({
                        title: data.message,
                        type: "success",
                        closeOnConfirm: false
                    },function(){
                            updateURL(data.redirect);
                        }
                    );
                    
                }
            });
        } else {
            //swal("Cancelled", "Your imaginary file is safe :)", "error");
        }
    });
}

function showMessage(message) {
    swal(message, "success");
}
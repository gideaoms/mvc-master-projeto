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
                alert('Por favor, preencha os campos em vermelho!');
                return false;
            }
        },
        url: this.action,
        type: this.method,
        dataType: 'json',
        success: function (data) {
            if(data.message !== "no-message") {
                alert(data.message);
            }
            if (data.redirect === "no-redirect") {
                return false;
            }
            window.location.href = data.redirect;
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
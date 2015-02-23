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
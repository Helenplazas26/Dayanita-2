$(document).ready(function(){

    $(document).on("click","#cambiarImagen",function(){
        let url_imagen = $("#imagen").attr('src');

        $("#imagen").css("display","none");
    //    $("#imagen").remove();
        $(this).css("display","none");  

        $("#nuevaImagen").html(
            "<input type='file' name='imagenProduc'>"
            +"<input type='hidden' name='imagenVieja' value='"+url_imagen+"'>"
        );
    });
    
    $(document).on("keyup","#filtro",function(){
        let buscar=$(this).val();
        let url= $(this).attr('data-url');
        $.ajax({
            url:url,
            data: "buscar="+buscar,
            type: "POST",
            success:function (resp) {
                $('#test').html(resp);
                //console.log(resp);
            }
        })
    })


})
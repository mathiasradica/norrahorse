$(document).ready(function () {
    $.get("api/products", {}, function (data) {
        $.each(data, function(index, product){
            $(".price."+product.url).html(product.price+" &euro;")
            $(".vat."+product.url).text(`Sis. ALV:n (${parseInt(product.vat)}%)`)
            if($(".in-store")){
                $(".in-store-circle."+product.url).addClass("fas fa-circle").css("opacity", 1)
                $(".in-store."+product.url).text(product.inStore).css("opacity", 1)
            }
        })
    }, 'json')
})
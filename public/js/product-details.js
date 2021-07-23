$(document).ready(function () {
    $.get("api/products", {}, function (data) {
        $.each(data, function (index, product) {
            $(".quantity-controls").removeClass("invisible")
            $(".order-btn").css("opacity", 1)
            if ($(".in-store")) {
                $(".in-store-circle." + product.url).addClass("fas fa-circle").css("opacity", 1)
                $(".in-store." + product.url).text(product.inStore).css("opacity", 1)
                $(".product-details-wait-spinner-border").addClass("d-none")
            }
            setTimeout(function () {
                $(".vat." + product.url).text(`Sis. ALV:n (${parseInt(product.vat)}%)`)
                $(".price." + product.url).html(product.price + " &euro;")
            },1000)
        })
    }, 'json')
})
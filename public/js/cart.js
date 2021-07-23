$(document).ready(function () {
    $.get("api/cart", {}, function (data) {
        $("form").removeClass("invisible")
        if (data.items.length>0) {
            $(".shopping-cart-summary").removeClass("invisible")
            $(".shopping-cart-items-count").text(data.items.length)
            $(".shopping-cart-total").html(data.total.toFixed(2) + "&nbsp;&euro;")
        }
    }, 'json')
})

function addToCart() {
    $(".order-btn").css("opacity", 0.5)
    $(".order-btn span").addClass("d-none")
    $(".order-btn-spinner-border").removeClass("d-none")
    $.post("api/add",
        { 'product': $('#url-input').val(), 'quantity': $('#quantity-input').val() },
        function (data) {
            if (data) {
                $(".add-cart-confirmed").removeClass("d-none")
                $(".shopping-cart-summary").removeClass("invisible")
                $(".shopping-cart-items-count").text(data.items.length)
                $(".shopping-cart-total").html(data.total.toFixed(2) + "&nbsp;&euro;")
                $(".order-btn").css("opacity", 1)
                $(".order-btn span").addClass("d-none")
                $(".order-btn-spinner-border").addClass("d-none")
                $(".order-btn span").removeClass("d-none")
            }
        },
        'json')
}
function validateReduceQuantity() {
    let input = document.getElementById('quantity-input')
    if(parseInt(input.value)> 0){
        input.value=parseInt(input.value)-1
    } 
}

function validateIncreaseQuantity() {
    let input = document.getElementById('quantity-input')
    if(parseInt(input.value)< 98){
        input.value=parseInt(input.value)+1
    }
    
}
function validateReduceQuantity() {
    let input = document.getElementById('quantity-input')

    if(input){
        
        if(parseInt(input.value)> 0){
            
            input.value=parseInt(input.value)-1
            
            loadPage()
        }
        if(parseInt(input.value)=== 0){
            
            $('.nonpositive-quantity-warning').removeClass('d-none')
            
            return false
        }
    }   
}

function validateIncreaseQuantity() {
    let input = document.getElementById('quantity-input')

    if(input){

        if(parseInt(input.value)< 98){
            
            input.value=parseInt(input.value)+1

            loadPage()
        }
    }    
}

function validateQuantity(){
    let input = document.getElementById('quantity-input')
    
    if(input){
        
        if(parseInt(input.value)<1){
            
            $('.nonpositive-quantity-warning').removeClass('d-none')

        }else{
            
            $('.nonpositive-quantity-warning').addClass('d-none')
        }
    }   
}

function loadPage(){

    if($('.promo-code-container')){
                
        $('.page-container').css('opacity', 0.5)

        $('.spinner-border').removeClass('d-none')

        $(window).load(function(){
            $('.page-container').css('opacity', 1)
            $('.spinner-border').addClass('d-none')
        })
    }
}
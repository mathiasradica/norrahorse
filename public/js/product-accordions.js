// Product accordion and tabs

let productAcc = document.getElementsByClassName('product_accordion_button')
let productPanels = document.getElementsByClassName('product_panel')
let tabs = document.getElementsByClassName('tab')

for (let i = 0; i < productAcc.length; i++) {
  productAcc[i].addEventListener('click', function() {
    
    let tabList = document.getElementById('tab-list')
    tabList.className = ''

    for (let i = 0; i < productAcc.length; i++) {
      
      if (this !== productAcc[i]) {
        
        tabs[i].classList.add('d-none')
        productPanels[i].style.maxHeight = null
        productAcc[i].classList.remove('open')
      } else {
        tabList.classList.add('tab' + productAcc[i].id.substring('product-accordion-button'.length))
        document.getElementById('tab' + productAcc[i].id.substring('product-accordion-button'.length)).classList.remove('d-none')
        productPanels[i].style.maxHeight = productPanels[i].scrollHeight + "px"
        this.classList.add('open')
      }
    }
  })
}

// Product features accordion

let productFeaturesAcc = document.getElementsByClassName('product_features_accordion_button')

for (let i = 0; i < productFeaturesAcc.length; i++) {
  productFeaturesAcc[i].addEventListener('click', (function () {
    this.classList.toggle("open")

    let productPanel1 = this.parentElement.parentElement
    let productFeaturesPanel1 = this.nextElementSibling
    let productPanel2 = productFeaturesAcc[(i + 1) % 1].parentElement.parentElement
    let productFeaturesPanel2 = productFeaturesAcc[(i + 1) % 1].nextElementSibling

    if (productFeaturesPanel1.style.maxHeight) {
      productFeaturesPanel1.style.maxHeight = null
    } else {
      if ($(".product-features-table").html() === "") {
        $(".product-features-spinner-border").removeClass("d-none")
        let url = window.location.pathname.split("/").pop()

        $.get("api/products/" + url, {}, function (data) {
          $(".product-features-spinner-border").addClass("d-none")
          $.each(data.features, function (key, value) {
            $(".product-features-table").html(`<tr><td>${key}</td><td>${value}</td></tr>`)
          })
          productFeaturesPanel1.style.maxHeight = productFeaturesPanel1.scrollHeight + "px"
          productPanel1.style.maxHeight = productFeaturesPanel1.scrollHeight + productPanel1.scrollHeight + "px"
          productFeaturesPanel2.style.maxHeight = productFeaturesPanel1.scrollHeight + "px"
          productPanel2.style.maxHeight = productFeaturesPanel1.scrollHeight + productPanel1.scrollHeight + "px"
        }, 'json')
      }   
      productFeaturesPanel1.style.maxHeight = productFeaturesPanel1.scrollHeight + "px"
      productPanel1.style.maxHeight = productFeaturesPanel1.scrollHeight + productPanel1.scrollHeight + "px"
      productFeaturesPanel2.style.maxHeight = productFeaturesPanel1.scrollHeight + "px"
      productPanel2.style.maxHeight = productFeaturesPanel1.scrollHeight + productPanel1.scrollHeight + "px"
    }
  })
  )
}
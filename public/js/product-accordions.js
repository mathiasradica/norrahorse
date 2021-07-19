let productAcc = document.getElementsByClassName('product_accordion_button');
let productPanels = document.getElementsByClassName('product_panel');

for (let i = 0; i < productAcc.length; i++) {
  productAcc[i].addEventListener('click', function () {

    for (let i = 0; i < productAcc.length; i++) {

      if (this !== productAcc[i]) {
        productPanels[i].style.maxHeight = null
        productAcc[i].classList.remove('open')
      } else {
        productPanels[i].style.maxHeight = productPanels[i].scrollHeight + "px"
        this.classList.add('open')
      }
    }
  })
}

let productFeaturesAcc = document.getElementsByClassName("product_features_accordion_button")[0]

if (productFeaturesAcc) {
  productFeaturesAcc.addEventListener("click", function () {
    this.classList.toggle("open")
    let panel = this.nextElementSibling
    if (panel.style.maxHeight) {
      panel.style.maxHeight = null
    } else {
      panel.style.maxHeight = panel.scrollHeight + "px"
    }
  })

  let productFeatures2Acc = document.getElementsByClassName("product_features_2_accordion_button")[0]

  productFeatures2Acc.addEventListener("click", function () {
    this.classList.toggle("open")

    let productPanel = this.parentElement.parentElement
      let productFeaturesPanel = this.nextElementSibling
      if (productFeaturesPanel.style.maxHeight) {
        productFeaturesPanel.style.maxHeight = null
      } else {
        productFeaturesPanel.style.maxHeight = productFeaturesPanel.scrollHeight + "px"
        productPanel.style.maxHeight = productPanel.scrollHeight + productFeaturesPanel.scrollHeight + "px"
      }
  })
}

function toggle(tab) {
    let tabList = document.getElementById('tab-list')
    let productPanels = document.getElementsByClassName('product_panel')
    let tabs = document.getElementsByClassName('tab')

    tabList.className = ""
    tabList.classList.add(tab)
    
    for (let i = 0; i < tabs.length; i++) {
        tabs[i].classList.add('d-none')

        if (productAcc[i].id !== 'product-accordion-button' + tab.substring('tab'.length)) {
            productPanels[i].style.maxHeight = null
            productAcc[i].classList.remove('open')
        } else {
            productPanels[i].style.maxHeight = productPanels[i].scrollHeight + "px"
            productAcc[i].classList.add('open')
        }
    }

    document.getElementById(tab).classList.remove('d-none')
}

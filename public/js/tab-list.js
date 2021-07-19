function toggle(tab){
    let tabList=document.getElementById('tab-list')
    tabList.className=""
    tabList.classList.add(tab)

    let tabs=document.getElementsByClassName('tab')
    for(i=0; i<tabs.length; i++){
        tabs[i].classList.add('d-none')
    }

    document.getElementById(tab).classList.remove('d-none')
}
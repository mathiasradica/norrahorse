document.querySelector('#productCarousel .carousel-item').classList.add('active')

let minPerSlide
let items = document.querySelectorAll('#productCarousel .carousel-item')
let itemsLength = items.length
let nextLink = document.getElementsByClassName('carousel-control-next')

function handleNextLink() {

    let currentIndex = $('#productCarousel .active').index()

    if (currentIndex + 1 === itemsLength - minPerSlide) {
        nextLink[0].classList.add("disabled")
    } else {
        nextLink[0].classList.remove("disabled")
    }
}
function handlePreviousLink() {
    nextLink[0].classList.remove("disabled")
}

function myFunction(x) {
    if (x.matches) {

        if (x.media == "(max-width: 575px)") {
            minPerSlide = 2

        } else if (x.media == "(min-width: 576px) and (max-width: 767px)") {
            minPerSlide = 3

        } else if (x.media == "(min-width: 768px) and (max-width: 991px)") {
            minPerSlide = 4

        } else if (x.media == "(min-width: 992px)") {
            minPerSlide = 5

        }

        myFunction2()
    }
}

function myFunction2() {

    let numPerSlide = items[0].childElementCount
    if (numPerSlide === 1) {

        items.forEach((el) => {
            let next = el.nextElementSibling

            for (let i = 1; i < minPerSlide; i++) {
                if (!next) {
                    next = items[0]
                }

                let cloneChild = next.cloneNode(true)
                el.appendChild(cloneChild.children[0])
                next = next.nextElementSibling
            }
        })
    } else if (numPerSlide < minPerSlide) {

        items.forEach((el) => {
            let next = el.nextElementSibling

            if (!next) {
                next = items[0]

            }

            let i = numPerSlide

            while (i < minPerSlide) {
                let cloneChild = next.cloneNode(true)
                let j = numPerSlide - 1
                let nextChild = cloneChild.children[j]

                while (nextChild && i < minPerSlide) {
                    el.appendChild(nextChild)
                    nextChild = cloneChild.children[++j]
                    i++
                }

                next = next.nextElementSibling

                if (!next) {
                    next = items[0]

                }
            }
        })

        $('#productCarousel .active')[0].classList.remove('active')
        $('#productCarousel .carousel-item')[0].classList.add('active')
        nextLink[0].classList.remove("disabled")

    } else if (numPerSlide > minPerSlide) {
        items.forEach((el) => {
            for (let i = numPerSlide - 1; i > minPerSlide - 1; i--) {
                el.removeChild(el.children[i])
            }
        })

        $('#productCarousel .active')[0].classList.remove('active')
        $('#productCarousel .carousel-item')[0].classList.add('active')
        nextLink[0].classList.remove("disabled")
    }
}

let xs = window.matchMedia("(max-width: 575px)")
let sm = window.matchMedia("(min-width: 576px) and (max-width: 767px)")
let md = window.matchMedia("(min-width: 768px) and (max-width: 991px)")
let lg = window.matchMedia("(min-width: 992px)")

myFunction(xs)
myFunction(sm)
myFunction(md)
myFunction(lg)

xs.addListener(myFunction)
sm.addListener(myFunction)
md.addListener(myFunction)
lg.addListener(myFunction)
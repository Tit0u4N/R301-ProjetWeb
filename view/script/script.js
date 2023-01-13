// const Title = module.require("view/script/Title");
// const basket = module.require("view/script/basket/basket");

function openPanel(id){
    closePanel()
    card = document.querySelector('#'+id)
    card.classList.toggle("hide", false)
    card.classList.toggle("slideIn",true)
    Title.autoSizeTitles()
}

function closePanel(){
    cardList = document.querySelectorAll("main .default-panel:not(.hide)")
    cardList.forEach(card => hidePanel(card))
}

function hidePanel(card){
    card.classList.toggle("slideOut",true)
    setTimeout(() =>{
        card.classList.add("hide")
        card.classList.toggle("slideOut",false)
        card.classList.toggle("slideIn",false)
    },510)

}

function toggleConnexion() {
    document.getElementById('switchConnexion').classList.toggle("hide")
    sectionList = document.querySelectorAll("main > section")
    sectionList.forEach(section => {
        section.classList.toggle('hide')
    })

}

document.addEventListener("keydown", (event) => {
    if(event.key === 'Escape')
        closePanel()
})

window.onresize = () => {
    console.log("boot")
}
Title.createTitles()
setTimeout(() => {
    Title.autoSizeTitles()
}, 50)

window.onresize = () => {
    if(window.screen.width < 1201)
        Title.autoSizeTitles()
}

let panier = new Basket();

let images = document.querySelectorAll("main img")

const imageLoader = new IntersectionObserver(entries => {
    entries.forEach(entry => {
        if(entry.isIntersecting)
            entry.target.src = entry.target.dataset.src;
        else
            entry.target.src = "";
    })
})

imageLoader.root = document.querySelector("main")

images.forEach(img => imageLoader.observe(img))

// test = document.querySelector("main > .catalog .productCard .productTitle > h3 ")
// console.log(test + " : " + title.splitSpan(test))
// test = document.querySelector("main > .catalog .productCard .productTitle")
// test = window.getComputedStyle(test, null).paddingLeft;
// console.log(test)

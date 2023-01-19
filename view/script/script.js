// const Title = module.require("view/script/Title");
// const basket = module.require("view/script/basket/basket");

function openPanel(id){
    closePanel()

    card = document.querySelector('#'+id)
    card.classList.toggle("hide", false)
    card.classList.toggle("slideIn",true)
    card.addEventListener("animationend", () => {
        Title.autoSizeTitles()
    })
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

document.addEventListener("keydown", (event) => {
    if(event.key === 'Escape')
        closePanel()
})

Title.createTitles()
setTimeout(() => {
    Title.autoSizeTitles()
}, 50)

window.onresize = () => {
    if(window.screen.width < 1201)
        Title.autoSizeTitles()
}

const basket = new Basket();


function openDescCard(id){
    closeDescCard()
    card = document.querySelector('#'+id)
    card.classList.toggle("hide", false)
    card.classList.toggle("slideIn",true)
}

function closeDescCard(){
    cardList = document.querySelectorAll("#descCardsContainer > .productCard:not(.hide)")
    cardList.forEach(card => hideDescCard(card))
}

function hideDescCard(card){
    card.classList.toggle("slideOut",true)
    setTimeout(() =>{
        card.classList.add("hide")
        card.classList.toggle("slideOut",false)
        card.classList.toggle("slideIn",false)
    },510)

}

document.addEventListener("keydown", (event) => {
    if(event.key === 'Escape')
        closeDescCard()
})

function autoFontSizeTitle() {
    let textParent = document.querySelectorAll('.productCard .titleCard');
    textParent.forEach((elementParent) => {
        let text = elementParent.querySelector('h3');
        let i = 30 // let's start with 30px
        let overflow = text.clientWidth < text.scrollWidth;
        const maxSize = 60;
        while (!overflow && i <= maxSize) {
            text.style.fontSize = `${i}px`
            overflow = text.clientWidth < text.scrollWidth;
            i++
        }
        text.style.fontSize = `${i-2}px`
    })

}

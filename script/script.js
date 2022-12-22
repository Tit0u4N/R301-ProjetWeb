
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

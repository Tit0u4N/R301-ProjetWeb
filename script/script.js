
function openDescCard(id){
    closeDescCard()
    document.querySelector('#'+id).classList.remove("hide")
}

function closeDescCard(){
    cardList = document.querySelectorAll("#descCardsContainer > .productCard:not(.hide)")
    cardList.forEach(card => card.classList.add("hide"))
}

document.addEventListener("keydown", (event) => {
    if(event.key === 'Escape')
        closeDescCard()
})


function openPanel(id){
    closePanel()
    card = document.querySelector('#'+id)
    card.classList.toggle("hide", false)
    card.classList.toggle("slideIn",true)
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



class Title {
    static minSize = 16;
    static maxSize = 60;
    static listTitles = []

    constructor(box) {
        this.text = box.querySelector("h3");
        this.lenght = 0;
        this.text.querySelectorAll("span").forEach(elm => this.lenght += elm.textContent.length);

    }

    static createTitles(){
        document.querySelectorAll('.productCard .productTitle').forEach((titleBox) => {
            Title.listTitles.push(new Title(titleBox))
        })
        Title.autoSizeTitles()
    }

    static autoSizeTitles(){
        Title.listTitles.forEach(elmTitle => elmTitle.autoSize())
    }

    autoSize(){
        let overflow = this.text.scrollWidth > this.text.clientWidth;
        let i = Title.minSize;
        while (!overflow && i <= Title.maxSize) {
            this.text.style = `--fontSizeTitle : ${i}px`;
            overflow = this.text.scrollWidth > this.text.clientWidth;
            i++
        }
        this.text.style = `--fontSizeTitle : ${i-2}px`;
    }
}


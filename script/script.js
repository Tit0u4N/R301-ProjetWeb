
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




function autoFontSizeTitles() {
    console.log("bom")
    let textParent = document.querySelectorAll('.productCard .productTitle');
    textParent.forEach((elementParent) => {
        autoSize(elementParent)
    })
}

function autoSize(elementParent){
    //récupere la taille de l'élément parent à l'interieur du padding
    let widthParent = elementParent.clientWidth - (window.getComputedStyle(elementParent, null).paddingLeft)*2
    let text = elementParent.querySelector('h3');
    let i = 30 // let's start with 30px
    let overflow = text.scrollWidth > widthParent;
    const maxSize = 60;
    while (!overflow && i <= maxSize) {
        text.style.fontSize = `${i}px`;
        overflow = text.scrollWidth > widthParent;
        // console.log(text.scrollWidth + " | " + widthParent + " = " + overflow)
        i++
    }
    text.style.fontSize = `${i-2}px`
}


class title {
    static minSize = 20;
    static maxSize = 60;
    static listTitles = []

    constructor(box) {
        this.box = box;
        this.padding = window.getComputedStyle(box).paddingLeft.replace('px','');
        this.boxWidth = box.clientWidth - this.padding*2;
        this.text = box.querySelector("h3");
        this.tabSpan = this.splitSpan(box);
        this.length = this.tabSpan[this.tabSpan.length - 1];
        this.isDivide = this.length > 20;
        // if (this.isDivide)
        //     this.divideText()
    }

    static createTitles(){
        document.querySelectorAll('.productCard .productTitle').forEach((titleBox) => {
            title.listTitles.push(new title(titleBox))
        })
    }

    static autoSizeTitles(){
        console.log("boom")
        title.listTitles.forEach(elmTitle => elmTitle.autoSize())
    }

    divideText(){
        let i = 0;
        while (this.tabSpan[i] < this.length/2){
            i++;
        }
        i++ ;
        let br = document.createElement("br")
        this.text.insertBefore(br, this.text.querySelectorAll("span")[i])

    }

    autoSize(){
        let overflow = this.text.scrollWidth > this.boxWidth
        let i = title.minSize;
        while (!overflow && i <= title.maxSize) {
            this.text.style.fontSize = `${i}px`;
            overflow = this.text.scrollWidth > this.boxWidth;
            // console.log(text.scrollWidth + " | " + widthParent + " = " + overflow)
            i++
        }
        this.text.style.fontSize = `${i-2}px`
    }

    splitSpan(box){
        let cpt = 0;
        let tab = [];
        box.querySelectorAll("span").forEach(elm => {
            cpt += elm.textContent.length;
            tab.push(cpt);
        });
        return tab
    }



}


// function autoFontSizeTitles() {
//     console.log("bom")
//     let textParent = document.querySelectorAll('.productCard .productTitle');
//     textParent.forEach((elementParent) => {
//         autoSize(elementParent)
//     })
// }



// function autoFontSizeTitle() {
//     let textParent = document.querySelectorAll('.productCard .productTitle');
//     textParent.forEach((elementParent) => {
//         let text = elementParent.querySelector('h3');
//         let i = 30 // let's start with 30px
//         let overflow = text.clientWidth < (text.scrollWidth);
//         const maxSize = 60;
//         while (!overflow && i <= maxSize) {
//             text.style.fontSize = `${i}px`
//             overflow = text.clientWidth < (text.scrollWidth);
//             i++
//         }
//         text.style.fontSize = `${i-2}px`
//     })
//
// }


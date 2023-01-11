
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

document.addEventListener("keydown", (event) => {
    if(event.key === 'Escape')
        closePanel()
})



class Title {
    static minSize = 16;

    static listTitles = []

    constructor(box, baskteTitle = false) {
        this.text = box.querySelector("h3");
        this.lenght = 0;
        this.text.querySelectorAll("span").forEach(elm => this.lenght += elm.textContent.length);
        if(this.lenght > 25)
            this.maxSize = 32;
        else if (baskteTitle)
            this.maxSize = 30;
        else
            this.maxSize = 60;
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
        while (!overflow && i <= this.maxSize) {
            this.text.style = `--fontSizeTitle : ${i}px`;
            overflow = this.text.scrollWidth > this.text.clientWidth;
            i++
        }
        this.text.style = `--fontSizeTitle : ${i-2}px`;
    }
}

class Article {

    #nbProduit;
    #idCard;
    #idCardDesc;
    #idCardBasket;
    #price;
    #card

    constructor(idArticle, nbProduit = 1, card = null) {
        let box = document.getElementById(idArticle)
        this.#idCard = box.id;
        this.#idCardDesc = "desc-"+box.id;
        this.#idCardBasket = "basket-"+box.id;
        this.#nbProduit = nbProduit;
        this.#price = parseFloat(box.querySelector(".priceContainer > h4").textContent).toFixed(2);
        if(card !== null)
            this.#card = card;
        else
            this.#card = this.createHTMLCardBasket(box)
        this.addEventsButtons()
    }

    addProduit(){
        this.#nbProduit++;
        this.#changeNbProduitHTML()
    }

    subProduit(){
        this.#nbProduit--;
        this.#changeNbProduitHTML()
    }

    #changeNbProduitHTML(){
        document.querySelector("#"+this.idCardBasket+" .productCounter div > h4").textContent = this.#nbProduit
    }

    getCardBasketHTML(){
        return this.#card
    }

    createHTMLCardBasket(box){
        let cardHTML = document.createElement("article");
        cardHTML.classList.add("productCard")
        cardHTML.id = this.#idCardBasket

        let img = box.querySelector("img").cloneNode()

        //div productTitle
        let productTitle = box.querySelector(".productTitle").cloneNode()
            let editor = document.createElement("h4")
            editor.textContent = "kana"
            productTitle.appendChild(editor)

            let title = document.createElement("h3")
                title.textContent = box.querySelector(".productTitle h3").textContent.replaceAll(" ", "&nbsp;");
            productTitle.appendChild(title)
            productTitle.appendChild(box.querySelector(".productTitle h4").cloneNode(true))

        Title.listTitles.push(new Title(productTitle, true))

        //div productCounter
        let rect = document.createElement("rect")
        rect.textContent = "&nbsp;"

        let divCounter = document.createElement("div")
        divCounter.classList.add("productCounter")
            let div1 = document.createElement("div")
                let button1 =  document.createElement("button")
                    button1.appendChild(rect.cloneNode())

                let divText = document.createElement("div")
                    let nbProduit = document.createElement("h4")
                        nbProduit.textContent = this.nbProduit
                divText.appendChild(nbProduit)

                let button2 =  document.createElement("button")
                    button2.appendChild(rect.cloneNode())
                    button2.appendChild(rect.cloneNode())

            div1.appendChild(button1)
            div1.appendChild(divText)
            div1.appendChild(button2)
        divCounter.appendChild(div1)

        //div priceContainer
        let divPriceContainer = document.createElement("div")
        divPriceContainer.classList.add("priceContainer")
            let price = document.createElement("h4")
            price.textContent = this.#price
        divPriceContainer.appendChild(price)

        cardHTML.appendChild(img)
        cardHTML.appendChild(productTitle)
        cardHTML.appendChild(divCounter)
        cardHTML.appendChild(divPriceContainer)

        return cardHTML;
    }

    addEventsButtons(){
        this.#card.querySelector(".productCounter div button:first-of-type").addEventListener("click",() => panier.removeArticle(this.#idCard))
        this.#card.querySelector(".productCounter div button:last-of-type").addEventListener("click",() => panier.addArticle(this.#idCard))
    }

    get idCardBasket() {
        return this.#idCardBasket;
    }

    get nbProduit() {
        return this.#nbProduit;
    }

    get price() {
        return this.#price;
    }

    equals(id){
        return id === this.#idCard || id === this.#idCardDesc || id === this.#idCardBasket;
    }
}

class Basket {
    #listArticle;
    #totalBasket;
    #nbArticle;

    constructor() {
        this.carrousel = document.querySelector("#basket .caroussel");
        this.#totalBasket = 0;
        this.#nbArticle = 0;
        this.#listArticle = [];
        this.initBasket()
        this.actuBasket()
    }

    initBasket(){
        let basketBox = document.querySelectorAll("#basket .caroussel > article.productCard");
        basketBox.forEach( art => {
            let id = art.id
            id = id.replace("basket-", "")
            let nbProduit = parseInt(art.querySelector(".productCounter div > h4 ").textContent)
            let article = new Article(id, nbProduit, art)
            this.#listArticle.push(article)
        })
    }

    addArticle(idArticle) {
        let iArticle = this.#listArticle.findIndex(article => article.equals(idArticle));
        console.log(iArticle)
        if (iArticle !== -1) {
            this.#listArticle[iArticle].addProduit();
        } else {
            let article = new Article(idArticle)
            this.#listArticle.push(new Article(idArticle))
            this.carrousel.appendChild(article.getCardBasketHTML())
            Title.autoSizeTitles()
        }
        this.actuBasket()
    }

    removeArticle(idArticle){
        let iArticle = this.#listArticle.findIndex(article => article.equals(idArticle));
        console.log("removeArticle called iarticle = " + iArticle)
        if (this.#listArticle[iArticle] !== -1) {
            this.#listArticle[iArticle].subProduit();
            if(this.#listArticle[iArticle].nbProduit === 0){
                document.getElementById(this.#listArticle[iArticle].idCardBasket).remove()
                this.#listArticle.splice(iArticle, 1);
            }
        }
        this.actuBasket()
    }

    actuBasket(){
        let temp = 0;
        let cpt = 0;
        this.#listArticle.forEach(article => {
            temp += article.nbProduit * article.price;
            cpt += article.nbProduit;
        });
        this.#totalBasket = temp.toFixed(2);
        document.querySelector("#totalBasket div > h4").textContent = this.#totalBasket+"€";
        this.#nbArticle = cpt;
        document.querySelector("#totalBasket div div > span").textContent = this.#nbArticle
    }


    // get #listArticle () {
    //     return this.#listArticle;
    // }
}
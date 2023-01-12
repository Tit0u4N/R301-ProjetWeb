// module.exports = Article;

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
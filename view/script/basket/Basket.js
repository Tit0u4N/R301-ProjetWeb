// module.exports = basket;

// const Article = module.require('view/script/basket/article')

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

}
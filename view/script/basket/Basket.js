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
        //console.log(basketBox);
        basketBox.forEach( art => {
            let id = art.id
            console.log(id);
            id = id.replace("basket-", "")
            console.log(id);
            let nbProduit = parseInt(art.querySelector(".productCounter div > h4 ").textContent)
            let article = new Article(id, nbProduit, art, true)
            this.#listArticle.push(article)
        })
    }

    addArticle(idArticle) {
        this.#actuBasketServer(idArticle, 0);
    }

    removeArticle(idArticle){
        this.#actuBasketServer(idArticle, 1);
    }

    #actuBasketData(response){
        console.log(response)
        if (response["idArticle"] === -1 || response["nbArticle"] === -1)
            return
        let iArticle = this.#listArticle.findIndex(article => article.equals(response["idArticle"]));
        if(iArticle !== -1){
            if(response["nbArticle"] === 0){
                document.getElementById(this.#listArticle[iArticle].idCardBasket).remove()
                this.#listArticle.splice(iArticle, 1);

            } else {
                this.#listArticle[iArticle].setNbProduit(response["nbArticle"]);
            }
        } else {
            let article = new Article(response["idArticle"],response["nbArticle"] )
            this.#listArticle.push(article)
            this.carrousel.appendChild(article.getCardBasketHTML())
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
        Title.autoSizeTitles();
    }

    #actuBasketServer(idPorduit, type){
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "controller/controllerBasketAjax.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.send("basketActuIdProduit="+idPorduit+"&basketActuType="+type);
        let tempThis = this
        xhr.onreadystatechange = function() {
            if (this.readyState === 4 && this.status === 200) {
                tempThis.#actuBasketData(JSON.parse(this.response))
            }
        };

    }




}
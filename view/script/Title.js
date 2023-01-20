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
        document.querySelectorAll('.catalog .productCard .productTitle, .descCardContainer .productCard .productTitle').forEach((titleBox) => {
            Title.listTitles.push(new Title(titleBox))
        })
        document.querySelectorAll('#basket .productCard .productTitle').forEach((titleBox) => {
            Title.listTitles.push(new Title(titleBox, true))
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
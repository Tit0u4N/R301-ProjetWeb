let images = document.querySelectorAll("main img")

const imageLoader = new IntersectionObserver(entries => {
    entries.forEach(entry => {
        if(entry.isIntersecting)
            entry.target.src = entry.target.dataset.src;
        else
            entry.target.src = "";
    })
});

imageLoader.root = document.querySelector("main")

images.forEach(img => imageLoader.observe(img))
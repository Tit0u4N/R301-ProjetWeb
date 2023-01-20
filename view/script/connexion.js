function toggleConnexion() {
    document.getElementById('switchConnexion').classList.toggle("hide")
    sectionList = document.querySelectorAll("main > div > section")
    sectionList.forEach(section => {
        section.classList.toggle('hide')
    })

}

<?php
    if (isset($_GET["dev"])){
        $quote = "Il y avait une femme, c'était la première fois que je rencontrais quelqu'un qui était vraiment en vie. Au moins, c'est ce que je pensais. Elle était… la partie de moi que j'ai perdue quelque part en cours de route, la partie qui manquait, la partie que je voulais.";
        $authorQuote = "Spike";
    }

?>
<footer>
    <div>
        <h3><span>Manga</span><span>Flow</span></h3>
    </div>
    <div id="quote">
        <p><?= $quote ?></p>
        <span><?= $authorQuote ?></span>
    </div>
    <div class="socialNetwork">
        <a href="https://github.com/nickspool">
            <img src="/view/ressources/icons/githubIcon.svg" alt="Icon de gitHub">
            <span>Tamas</span>
            <span>Palotas</span>
        </a>
        <a href="https://github.com/Tit0u4N">
            <img src="/view/ressources/icons/githubIcon.svg" alt="Icon de gitHub">
            <span>Titouan</span>
            <span>Lacombe--Fabre</span>
        </a>
    </div>

</footer>

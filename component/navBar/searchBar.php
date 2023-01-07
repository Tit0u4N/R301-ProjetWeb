<?php
function getSelected(String $value){
  if($_GET['categories'] == $value){
    return " selected";
  }
}
?>

<form action="index.php" method="get">
  <input type="search" name="search" value="<?= $_GET['search'] ?>" placeholder="ex : BOICHI">
  <select name="categories">
    <option value="categorie"<?= getSelected("categorie") ?>>Categories</option>
    <option value="manga"<?= getSelected("manga") ?>>Manga</option>
    <option value="auteur"<?= getSelected("auteur") ?>>Auteur</option>
    <option value="drawer"<?= getSelected("drawer") ?>>Dessinateur</option>
    <option value="type"<?= getSelected("type") ?>>Type</option>
    <option value="genre"<?= getSelected("genre") ?>>Genre</option>
    <option value="editeur"<?= getSelected("editeur") ?>>Editeur</option>
  </select>
  <button type="submit" accesskey="enter" value="AA">
    <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
      <g clip-path="url(#clip0_14_602)">
        <path d="M12.1867 22.3733C17.8126 22.3733 22.3733 17.8126 22.3733 12.1867C22.3733 6.56073 17.8126 2 12.1867 2C6.56073 2 2 6.56073 2 12.1867C2 17.8126 6.56073 22.3733 12.1867 22.3733Z"
              stroke="var(--background)" stroke-width="3" stroke-miterlimit="10"/>
        <path d="M30 30L19.1866 19.1867" stroke="var(--background)" stroke-width="3"
              stroke-miterlimit="10"/>
      </g>
      <defs>
        <clipPath id="clip0_14_602">
          <rect width="32" height="32" fill="var(--background)"/>
        </clipPath>
      </defs>
    </svg>
  </button>
</form>
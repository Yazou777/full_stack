En route vers le MVC

Nous allons réaliser ici un mini blog à titre d'exemple. Il ne sera pas très fonctionnel mais l'objectif est de comprendre l’architecture MVC.
Mise en place du blog en version procédurale

Pour la persistance, nous allons utiliser la base de donnée suivante:

base_blog

Vous pouvez utiliser ce script pour créer et alimenter votre base.

Affichons simplement la liste des billet dans une page d'accueil:

// index.php

<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <title>Mon blog</title>
</head>
<body>
<div id="global">
    <header>
        <a href="index.php"><h1 id="titreBlog">Mon Blog</h1></a>
        <p>Hello et bienvenue !!!!</p>
    </header>
    <div id="contenu">
        <?php
        $bdd = new PDO("mysql:host=database:3306;dbname=boggy;charset=utf8",'VOTRE USER','VOTRE MDP');
        $billets  = $bdd->query('SELECT BIL_ID as id, BIL_DATE as date, BIL_TITRE as titre, BIL_CONTENU as contenu FROM T_BILLET order by BIL_ID desc');
        foreach($billets as $billet): ?>
            <article>
                <header>
                    <h1 class="titreBillet">
                        <?= $billet['titre']?>
                    </h1>
                    <time><?= $billet['date']?></time>
                </header>
                <p><?= $billet['contenu']?></p>
            </article>
            <hr>

        <?php endforeach; ?>
    </div>
    <footer id="piedBlog">
        Blog exercice
    </footer>
</div>
</body>
</html>

Et voici la feuille de style qui va avec

/* style.css */

/*  Pour pouvoir utiliser une hauteur (height) ou une hauteur minimale
   (min-height) sur un bloc, il faut que son parent direct ait lui-même une
   hauteur déterminée (donc toute valeur de height sauf "auto": hauteur en
   pixels, em, autres unités...).
   Si la hauteur du parent est en pourcentage, elle se réfère alors à la
   hauteur du «grand-père», et ainsi de suite.
   Pour pouvoir utiliser un "min-height: 100%" sur div#global, il nous faut:
   - un parent (body) en "height: 100%";
   - le parent de body également en "height: 100%". */
html, body {
    height: 100%;
}

body {
    color: #bfbfbf;
    background: black;
    font-family: 'Futura-Medium', 'Futura', 'Trebuchet MS', sans-serif;
}

h1 {
    color: white;
}

.titreBillet {
    margin-bottom : 0px;
}

a:link {
    text-decoration: none;
}

#global {
    min-height: 100%;  /* Voir commentaire sur html et body plus haut */
    background: #333534;
    width: 70%;
    margin: auto;    /* Permet de centrer la div */
    text-align: justify;
    padding: 5px 20px;
}

#contenu {
    margin-bottom : 30px;
}

#titreBlog, #piedBlog {
    text-align: center;
}

Et si tout fonctionne vous avez ça:

blog
Les défauts

index.php contient du php et du html. De plus son code parait difficilement réutilisable et surtout va devenir difficile à maintenir au fil du temps et des évolution de l'application.

En fait, en général, une application va devoir gérer plusieurs problématiques:

    la présentation : interaction avec l'extérieur.
    le traitement : tout ce qui est calculs en lien avec les règles métier.
    les données : tout ce qui est accès et manipulations des données.

Nous allons donc être obligé de ranger tout ça.





En route vers le MVC
Mise en place du blog en version procédurale
    Les défauts
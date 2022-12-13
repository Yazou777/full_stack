<?php

class Produit
{
private $nom;
private $quantite ;
private $prix;
private $rupture ;

public function ajouterProduit(){
    $this->quantite++;
    if ($this->quantite > 0) $this->rupture = false;
}

public function __toString()
{
    return
    "Nom: ".$this->nom."<br/>".
    "Quantité: ".$this->quantite."<br/>".
    "Prix: ".$this->prix."<br/>".
    (($this->rupture)?"Rupture de stock":"En stock");
}

public function supprimerProduit(int $nb = 1){
    $this->quantite -= $nb;
    if ($this->quantite <= 0) {
        $this->rupture = true;
        $this->quantite = 0;
    }
}
/**
 * Get the value of nom
 */ 
public function getNom()
{
return $this->nom;
}

/**
 * Set the value of nom
 *
 * @return  self
 */ 
public function setNom($nom)
{
$this->nom = $nom;

return $this;
}


public function setQuantite($quantite)
{
    $this->quantite = $quantite;
    return $this;
}

public function setPrix($prix)
{
    $this->prix = $prix;
    return $prix;
}

public function setRupture($rupture)
{
    $this->rupture = $rupture;
    return $rupture;
}
public function __construct($nom, $prix, $quantite=0)
{
    $this->nom = $nom;
    $this->quantite = $quantite;
    $this->prix = $prix;
    $this->rupture = $quantite=0;
}

}
?>

<?php
// ICI déclarez la classe

// $mobile = new Produit; //Instanciation

// $mobile->setNom("iphone");
// $mobile->setQuantite(10);
// $mobile->setPrix(900);
// $mobile->setRupture(false);
// echo $mobile;
// $mobile->supprimerProduit(10);
// echo "<br/><hr>";
// echo $mobile;

// echo $mobile->__toString();


$mobile = new Produit("iphone",900,10); //Instanciation

$imprimante = new Produit("hp",300);
var_dump($mobile);
echo $mobile;
echo "<br/><hr>";
echo $imprimante;

$mobile->supprimerProduit(10);

echo "<br/><hr>";
var_dump($mobile);
echo $mobile;
?>
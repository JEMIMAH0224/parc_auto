<?php
$server = "localhost";
$dbname = "parc_auto";
$user = "root";
$pwd = "JEMIMAh@2001";

try {
    $bdd = new PDO("mysql:host=$server;dbname=$dbname", $user, $pwd);
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Échec de la connexion : " . $e->getMessage();
}


$stmt = $bdd->prepare("SELECT COUNT(*) FROM vehicule");
$stmt->execute();
$totalVehicule = $stmt->fetchcolumn();
//var_dump($totalVehicule);

$stmt = $bdd->prepare("SELECT COUNT(*) FROM personne");
$stmt->execute();
$totalOwners = $stmt->fetchColumn();
//var_dump($totalOwners);

$stmt = $bdd->prepare("SELECT SUM(contravention.montant) FROM contravention");
$stmt->execute();
$sumAmends = $stmt->fetchColumn();
//var_dump($sumAmends);

$stmt = $bdd->prepare("SELECT COUNT(*) FROM entretien");
$stmt->execute();
$totalEntretien = $stmt->fetchColumn();

//var_dump($totalEntretien);

$stmt = $bdd->prepare("SELECT
    vehicule.immatriculation AS immatriculation,
    entretien.cout AS entretien_cout,
    SUM(contravention.montant) AS total_amendes
FROM
    vehicule
    LEFT JOIN entretien ON entretien.vehicule_id = vehicule.id
    LEFT JOIN contravention ON contravention.vehicule_id = vehicule.id
GROUP BY
    vehicule.id,
    entretien_cout
HAVING
    entretien_cout > 300
    AND total_amendes > 200
ORDER BY immatriculation
LIMIT 2;
");
$stmt->execute();
$carRisks = $stmt->fetchAll(PDO::FETCH_ASSOC);

//var_dump($carRisks);


$stmt = $bdd->prepare("SELECT
    date_contravention AS date,
    vehicule.immatriculation AS immatriculation,
    CONCAT(
        personne.prenom,
        ' ',
        personne.nom
    ) AS conducteur,
    contravention.montant AS montant
FROM
    contravention
    JOIN vehicule ON vehicule.id = contravention.vehicule_id
    JOIN personne ON personne.id = contravention.conducteur_id
ORDER BY date DESC
LIMIT 4;");
$stmt->execute();
$recentContravations = $stmt->fetchAll(PDO::FETCH_ASSOC);
//var_dump($recentContravations);


$stmt = $bdd->prepare("SELECT
    vehicule.immatriculation AS immatriculation,
    entretien.date_entretien AS date_entretien,
    entretien.description AS description,
    garage.nom AS garage_nom,
    entretien.cout AS entretien_cout
FROM
    entretien
    JOIN vehicule ON vehicule.id = entretien.vehicule_id
    JOIN garage ON garage.id = entretien.garage_id
ORDER BY date_entretien DESC
LIMIT 3;");
$stmt->execute();
$lastEntretiens = $stmt->fetchAll(PDO::FETCH_ASSOC);
//var_dump($lastEntretien);

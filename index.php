<?php
require "database.php";



?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <main>
        <div class="container">
            <div class="top">
                <div class="veh">
                    <div class="vh">
                        <P class="veh_t">Total Véhicules</P>
                        <P class="veh_num"><?php echo htmlspecialchars($totalVehicule); ?></P>
                    </div>
                    <div class="veh_img">
                        <img src="./assets/images/car.svg" alt="vehical" class="v">
                    </div>
                </div>

                <div class="pro">
                    <div class="pr">
                        <p class="pro_t">Total Propriétaires</p>
                        <p class="pro_num"><?php echo htmlspecialchars($totalOwners); ?></p>
                    </div>
                    <div class="pro_img">
                        <img src="./assets/images/person.svg" alt="user" class="p">
                    </div>
                </div>

                <div class="ama">
                    <div class="ma">
                        <p class="ama_t">Amandes en Cours</p>
                        <p class="ama_num"><?php echo htmlspecialchars($sumAmends); ?> €</p>
                    </div>
                    <div class="ama_img">
                        <img src="./assets/images/danger.svg" alt="debt" class="am">
                    </div>
                </div>
                <div class="entre">
                    <div class="ent">
                        <p class="entre_t">Entretiens</p>
                        <p class="entre_num"><?php echo htmlspecialchars($totalEntretien); ?></p>
                    </div>
                    <div class="entre_img">
                        <img src="./assets/images/spare.svg" alt="entre" class="en">
                    </div>
                </div>
            </div>

            <div class="down1">
                <div class="vc">
                    <div class="risique">
                        <div class="risk_veh">
                            <h2>Véhicules à Risque (>300€ Entr. & >200€ Amendes)</h2>
                            <img src="./assets/images/data.svg" alt="veh_cont" class="vcont">
                        </div>
                        <div>
                            <div class="rv_title">
                                <div>IMMATRICULATION</div>
                                <div>COÛT <br> ENTR.</div>
                                <div>TOTAL <br> AMENDES</div>
                                <div>STATUS</div>
                            </div>
                            <?php foreach ($carRisks as $carRisk): ?>
                                <div class="dwn1">
                                    <div><?php echo htmlspecialchars($carRisk['immatriculation']); ?></div>
                                    <div class="one"><?php echo htmlspecialchars($carRisk['entretien_cout']); ?></div>
                                    <div class="two"><?php echo htmlspecialchars($carRisk['total_amendes']); ?></div>
                                    <div class="action"><?php if ($carRisks > 300 && $carRisks) {
                                                            echo "action requise";
                                                        } ?></div>
                                </div>

                            <?php endforeach; ?>

                        </div>
                    </div>
                    <div class="recent">
                        <div class="recent_cont">
                            <h2>Contraventions Récentes</h2>
                            <img src="./assets/images/data.svg" alt="cont_rec" class="crec">
                        </div>
                        <div class="rc_title">
                            <div>DATE</div>
                            <div>VÉHICULE</div>
                            <div>CONDUCTEUR</div>
                            <div class="mtn">MONTANT</div>
                        </div>
                        <div>
                            <?php foreach ($recentContravations as $recentContravation): ?>
                                <div class="dwn2">
                                    <div><?php echo htmlspecialchars($recentContravation['date']) ?></div>
                                    <div><?php echo htmlspecialchars($recentContravation['immatriculation']) ?></div>
                                    <div class="con"><?php echo htmlspecialchars($recentContravation['conducteur']) ?></div>
                                    <div class="mtn1"><?php echo htmlspecialchars($recentContravation['montant']) ?></div>
                                </div>
                            <?php endforeach; ?>

                        </div>

                    </div>
                </div>
            </div>
            <div class="down2">
                <div class="last">
                    <div class="last_ent">
                        <h2>Derniers Entretiens</h2>
                        <img src="./assets/images/data.svg" alt="den_ent" class="dent">
                    </div>
                    <div class="dwn3">
                        <?php foreach ($lastEntretiens as $lastEntretien): ?>
                            <div class="book">
                                <div class="book_plate">
                                    <span><?php echo htmlspecialchars($lastEntretien['immatriculation']) ?></span>
                                    <p class="d_e"><?php echo htmlspecialchars($lastEntretien['date_entretien']) ?></p>
                                </div>
                                <div class="desc"><?php echo htmlspecialchars($lastEntretien['description']) ?></div>
                                <div class="book_g_c">
                                    <div class="book_img_g">
                                        <img src="./assets/images/spare.svg" alt="book_img" class="big">
                                        <p><?php echo htmlspecialchars($lastEntretien['garage_nom']) ?></p>
                                    </div>
                                    <div>
                                        <p><?php echo htmlspecialchars($lastEntretien['entretien_cout']) ?></p>
                                    </div>
                                </div>

                            </div>
                        <?php endforeach; ?>

                    </div>
                </div>
            </div>
        </div>
    </main>

</body>

</html>
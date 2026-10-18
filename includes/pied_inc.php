<?php
/*
 * Auteur : KHADIJA EL HIMER 
 * Objectif : pied de page (date du jour, jours avant fin de semestre, checkdate)
 * Date : 18/10/2026
 */
// 6.3.1 date du jour
$aujourdhui = date('d/m/Y');

// 6.3.2 jours restants avant la fin du semestre 
$fin_semestre = new DateTime('2027-01-31');
$maintenant = new DateTime('today');
$diff = $maintenant->diff($fin_semestre);
$jours = $diff->invert ? 0 : $diff->days;   
?>
<hr>
<footer>
    <p>Date du jour : <?= $aujourdhui ?> —
       Il reste <?= $jours ?> jour(s) avant la fin du semestre (31/01/2027).</p>

    <?php
    // 6.3.3 validation d'une date saisie avec checkdate()
    if (isset($_GET['jour'], $_GET['mois'], $_GET['annee'])) {
        $j = (int) $_GET['jour'];
        $m = (int) $_GET['mois'];
        $a = (int) $_GET['annee'];
        if (checkdate($m, $j, $a)) {   
            echo "<p>La date $j/$m/$a est valide.</p>";
        } else {
            echo "<p style='color:red'>La date $j/$m/$a est invalide.</p>";
        }
    }
    ?>
    <form method="get" action="">
        Vérifier une date :
        <input type="number" name="jour" placeholder="jj" min="1" max="31" required>
        <input type="number" name="mois" placeholder="mm" min="1" max="12" required>
        <input type="number" name="annee" placeholder="aaaa" required>
        <button type="submit">Valider</button>
    </form>
</footer>
</body>
</html>

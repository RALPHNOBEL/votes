<!DOCTYPE html>
<html lang="fr">
<head>
    <?php include "views/includes/head.php"; ?>
    <style>
        .results-table { width:100%; border-collapse:collapse; margin-bottom:24px;}
        .results-table th, .results-table td { padding:12px; border-bottom:1px solid #eee;}
        .results-table th { background:#2980b9; color:#fff;}
        .winner-row { background:#d4efdf; font-weight:bold;}
        .total-votes { text-align:right; margin-top:12px;}
    </style>
</head>
<body>
    <?php include "views/includes/sidebar.php"; ?>
    <section class="home-section mx-auto px-3 py-30">
        <?php include "views/includes/nav.php"; ?>
        <div class="home-content">
            <h1>Résultats de l'élection</h1>
            <table class="results-table">
                <thead>
                    <tr>
                        <th>Candidat</th>
                        <th>Votes</th>
                        <th>Pourcentage</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $max_votes = 0;
                    foreach($candidates as $c) {
                        if ($c['votes'] > $max_votes) $max_votes = $c['votes'];
                    }
                    foreach($candidates as $c):
                        $percent = $total_votes > 0 ? round(($c['votes']/$total_votes)*100,2) : 0;
                        $is_winner = ($c['votes'] == $max_votes && $max_votes > 0);
                    ?>
                    <tr<?php if($is_winner) echo  class="winner-row"; ?>>
                        <td><?php echo htmlspecialchars($c['nom']); ?><?php if($is_winner): ?> 🏆<?php endif; ?></td>
                        <td><?php echo $c['votes']; ?></td>
                        <td><?php echo $percent; ?> %</td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <div class="total-votes">
                <strong>Total des votes :</strong> <?php echo $total_votes; ?>
            </div>
        </div>
    </section>
</body>
</html>
<!DOCTYPE html>
<html lang="fr" data-theme="light">
<head>
   <?php include "views/includes/head.php"; ?>
</head>

<body class="bg-gray-200 flex min-h-screen">
    <?php include "views/includes/sidebar.php"; ?>

    <div class="container mx-auto px-3 py-20 absolute top-0 left-0 right-0 z-10 flex-1 p-6">
        
        <!-- En-tête -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-800">
                <i class="fas fa-chart-line mr-3 text-blue-600"></i>
                Tableau de Bord
            </h1>
            <p class="text-gray-600">Gérez votre plateforme de vote en temps réel</p>
        </div>

        <!-- Statistiques -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <div class="custom-card rounded-2xl p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-600 text-sm font-medium">Total Votes</p>
                        <p class="text-3xl font-bold text-blue-600"><?= $nb_votes ?></p>
                    </div>
                    <div class="icon-wrapper bg-blue-100">
                        <i class="fas fa-vote-yea text-blue-600 text-2xl"></i>
                    </div>
                </div>
            </div>

            <div class="custom-card rounded-2xl p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-600 text-sm font-medium">Candidats</p>
                        <p class="text-3xl font-bold text-green-600"><?= $nb_candidates ?></p>
                    </div>
                    <div class="icon-wrapper bg-green-100">
                        <i class="fas fa-users text-green-600 text-2xl"></i>
                    </div>
                </div>
                <div class="mt-4">
                    <a href="<?= PATH ?>candidate" class="text-blue-600 text-sm font-medium">
                        <i class="fas fa-plus mr-1"></i> Ajouter candidat
                    </a>
                </div>
            </div>

            <div class="custom-card rounded-2xl p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-600 text-sm font-medium">Étudiants</p>
                        <p class="text-3xl font-bold text-purple-600"><?= $nb_etudiantes ?></p>
                    </div>
                    <div class="icon-wrapper bg-purple-100">
                        <i class="fas fa-user-check text-purple-600 text-2xl"></i>
                    </div>
                </div>
                <div class="mt-4">
                    <a href="<?= PATH ?>etudiante" class="text-purple-600 text-sm font-medium">
                        <i class="fas fa-eye mr-1"></i> Voir détails
                    </a>
                </div>
            </div>

            <div class="custom-card rounded-2xl p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-600 text-sm font-medium">Participation</p>
                        <p class="text-3xl font-bold text-orange-600"><?= $participation ?>%</p>
                    </div>
                    <div class="icon-wrapper bg-orange-100">
                        <i class="fas fa-chart-pie text-orange-600 text-2xl"></i>
                    </div>
                </div>
                <div class="mt-4">
                    <span class="text-orange-600 text-sm font-medium">
                        <i class="fas fa-clock mr-1"></i> En temps réel
                    </span>
                </div>
            </div>
        </div>

        <!-- Actions rapides -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
            <a href="<?= PATH ?>candidate" class="btn btn-gradient pulse-hover">
                <i class="fas fa-user-plus mr-2"></i> Ajouter Candidat
            </a>
            <a href="<?= PATH ?>etudiante" class="btn btn-outline btn-primary pulse-hover">
                <i class="fas fa-user-check mr-2"></i> Ajouter Électeur
            </a>
            <a href="<?= PATH ?>resultats" class="btn btn-outline btn-success pulse-hover">
                <i class="fas fa-chart-bar mr-2"></i> Voir Résultats
            </a>
            <a href="<?= PATH ?>vote" class="btn btn-outline btn-warning pulse-hover">
                <i class="fas fa-cog mr-2"></i> Gérer Élection
            </a>
        </div>

        <!-- Graphiques -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
            <div class="custom-card rounded-2xl p-6">
                <h3 class="text-xl font-bold mb-4">
                    <i class="fas fa-chart-line mr-2 text-blue-600"></i>
                    Évolution des Votes
                </h3>
                <canvas id="votes-chart" width="400" height="200"></canvas>
            </div>

            <div class="custom-card rounded-2xl p-6">
                <h3 class="text-xl font-bold mb-4">
                    <i class="fas fa-chart-pie mr-2 text-green-600"></i>
                    Répartition des Votes
                </h3>
                <canvas id="candidates-chart" width="400" height="200"></canvas>
            </div>
        </div>

        <!-- Tableaux -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Candidats -->
            <div class="custom-card rounded-2xl p-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-xl font-bold">
                        <i class="fas fa-users mr-2 text-blue-600"></i> Candidats
                    </h3>
                    <a href="<?= PATH ?>candidate" class="btn btn-sm btn-primary">
                        <i class="fas fa-plus mr-1"></i> Ajouter
                    </a>
                </div>
                <div class="overflow-x-auto">
                    <table class="table table-zebra w-full">
                        <thead>
                            <tr>
                                <th>Photo</th>
                                <th>Nom</th>
                                <th>Description</th>
                                <th>Votes</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($repartition as $r): ?>
                            <tr>
                                <td>
                                    <?php if(!empty($r['photo'])): ?>
                                        <img src="<?= PATH ?>assets/img/<?= $r['photo'] ?>" width="40" height="40" style="border-radius:50%; object-fit:cover;">
                                    <?php else: ?>
                                        <i class="fas fa-user-circle text-2xl text-gray-300"></i>
                                    <?php endif; ?>
                                </td>
                                <td><?= $r['nom_c'] ?></td>
                                <td><?= $r['description'] ?? '' ?></td>
                                <td><span class="badge badge-primary"><?= $r['votes'] ?></span></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Électeurs -->
            <div class="custom-card rounded-2xl p-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-xl font-bold">
                        <i class="fas fa-user-check mr-2 text-green-600"></i> Électeurs
                    </h3>
                    <a href="<?= PATH ?>etudiante" class="btn btn-sm btn-success">
                        <i class="fas fa-plus mr-1"></i> Ajouter
                    </a>
                </div>
                <div class="overflow-x-auto">
                    <table class="table table-zebra w-full">
                        <thead>
                            <tr>
                                <th>Nom</th>
                                <th>Email</th>
                                <th>Filière</th>
                                <th>Niveau</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach(Etudiante::getAllEtudiantes() as $e): ?>
                            <tr>
                                <td><?= $e['nom_e'] ?> <?= $e['prenom_e'] ?></td>
                                <td><?= $e['email'] ?></td>
                                <td><?= $e['filiere'] ?></td>
                                <td><?= $e['niveau'] ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const labels = <?= json_encode(array_column($repartition, 'nom_c')) ?>;
        const votes = <?= json_encode(array_column($repartition, 'votes')) ?>;
        const colors = labels.map((_, i) => `hsl(${i * 60}, 70%, 60%)`);

        // Graphique camembert
        new Chart(document.getElementById('candidates-chart').getContext('2d'), {
            type: 'doughnut',
            data: {
                labels: labels,
                datasets: [{ data: votes, backgroundColor: colors, borderWidth: 2 }]
            },
            options: {
                responsive: true,
                plugins: { legend: { position: 'bottom' } }
            }
        });

        // Graphique barres
        new Chart(document.getElementById('votes-chart').getContext('2d'), {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Votes par candidat',
                    data: votes,
                    backgroundColor: colors,
                    borderRadius: 8
                }]
            },
            options: {
                responsive: true,
                plugins: { legend: { display: false } },
                scales: { y: { beginAtZero: true, ticks: { stepSize: 1 } } }
            }
        });
    </script>
</body>
</html>
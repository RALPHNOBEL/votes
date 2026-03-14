<!DOCTYPE html>
<html lang="fr" data-theme="light">
<head>
   <?php include "views/includes/head.php"; ?>
</head>

<body class="bg-gray-200 flex min-h-screen">
    <!-- Navigation -->
  <?php include "views/includes/sidebar.php"; ?>

    <!-- Contenu principal -->
    <div class="container mx-auto px-3 py-20 absolute top-0 left-0 right-0 z-10 flex-1 p-6">
        <!-- En-tête avec statistiques -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-800 ">
                <i class="fas fa-chart-line mr-3 text-blue-600"></i>
                Tableau de Bord
            </h1>
            <p class="text-gray-600">Gérez votre plateforme de vote en temps réel</p>
        </div>

        <!-- Statistiques principales -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <div class="custom-card rounded-2xl p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-600 text-sm font-medium">Total Votes</p>
                        <p class="text-3xl font-bold text-blue-600" id="total-votes-admin"><?= $nb_votes ?></p>
                    </div>
                    <div class="icon-wrapper bg-blue-100">
                        <i class="fas fa-vote-yea text-blue-600 text-2xl"></i>
                    </div>
                </div>
                <div class="mt-4">
                    <span class="text-green-600 text-sm font-medium">
                        <i class="fas fa-arrow-up mr-1"></i>
                        +12% depuis hier
                    </span>
                </div>
            </div>

            <div class="custom-card rounded-2xl p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-600 text-sm font-medium">Candidats</p>
                        <p class="text-3xl font-bold text-green-600" id="total-candidates-admin"><?= $nb_candidates ?> </p>
                    </div>
                    <div class="icon-wrapper bg-green-100">
                        <i class="fas fa-users text-green-600 text-2xl"></i>
                    </div>
                </div>
                <div class="mt-4">
                    <span class="text-blue-600 text-sm font-medium">
                        <i class="fas fa-plus mr-1"></i>
                        Ajouter candidat
                    </span>
                </div>
            </div>

            <div class="custom-card rounded-2xl p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-600 text-sm font-medium">etudiante</p>
                        <p class="text-3xl font-bold text-purple-600" id="total-voters-admin"> <?= $nb_etudiantes ?></p>
                    </div>
                    <div class="icon-wrapper bg-purple-100">
                        <i class="fas fa-user-check text-purple-600 text-2xl"></i>
                    </div>
                </div>
                <div class="mt-4">
                    <span class="text-purple-600 text-sm font-medium">
                        <i class="fas fa-eye mr-1"></i>
                        Voir détails
                    </span>
                </div>
            </div>

            <div class="custom-card rounded-2xl p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-600 text-sm font-medium">Participation</p>
                        <p class="text-3xl font-bold text-orange-600" id="participation-admin">0%</p>
                    </div>
                    <div class="icon-wrapper bg-orange-100">
                        <i class="fas fa-chart-pie text-orange-600 text-2xl"></i>
                    </div>
                </div>
                <div class="mt-4">
                    <span class="text-orange-600 text-sm font-medium">
                        <i class="fas fa-trending-up mr-1"></i>
                        En temps réel
                    </span>
                </div>
            </div>
        </div>

        <!-- Actions rapides -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
            <button class="btn btn-gradient pulse-hover" onclick="openModal('add-candidate-modal')" >
                <i class="fas fa-user-plus mr-2">
                <a href="<?= PATH ?>candidate"  > Ajouter Candidat</a>
                </i>
                
               
            </button>
            <button class="btn btn-outline btn-primary pulse-hover" onclick="openModal('add-voter-modal')">
                <i class="fas fa-user-check mr-2">
                     <a href="<?= PATH ?>etudiante"  >  Ajouter Électeur</a>
                </i>
               
            </button>
            <button class="btn btn-outline btn-success pulse-hover" onclick="showResults()">
                <i class="fas fa-chart-bar mr-2">
                     <a href="<?= PATH ?>result"  >  Voir Résultats</a>
                </i>
               
            </button>
            <button class="btn btn-outline btn-warning pulse-hover" onclick="exportData()">
                <i class="fas fa-download mr-2">
                     <a href="<?= PATH ?>candidate"  > Exporter Données</a>
                </i>
               
            </button>
        </div>

        <!-- Graphiques et tableaux -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
            <!-- Graphique des votes -->
            <div class="custom-card rounded-2xl p-6">
                <h3 class="text-xl font-bold mb-4">
                    <i class="fas fa-chart-line mr-2 text-blue-600"></i>
                    Évolution des Votes
                </h3>
                <div class="container">
        <h1>Ventes Trimestrielles 2023</h1>
        <div class="chart-container">
            <canvas id="myChart"></canvas>
        </div>
        <div class="controls">
            <button id="addData">Ajouter des données</button>
            <button id="removeData">Supprimer des données</button>
            <button id="changeAnimation">Changer l'animation</button>
        </div>
        <div class="data-badge" id="dataValue">Dernier point: 0</div>
                <canvas id="votes-chart" width="400" height="200">
    </div>

                </canvas>
            </div>

            <!-- Répartition par candidat -->
            <div class="custom-card rounded-2xl p-6">
                <h3 class="text-xl font-bold mb-4">
                    <i class="fas fa-chart-pie mr-2 text-green-600"></i>
                    Répartition des Votes
                </h3>
                <canvas id="candidates-chart" width="400" height="200"></canvas>
            </div>
        </div>

        <!-- Tableaux de gestion -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Gestion des candidats -->
            <div class="custom-card rounded-2xl p-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-xl font-bold">
                        <i class="fas fa-users mr-2 text-blue-600"></i>
                        Candidats
                    </h3>
                    <button class="btn btn-sm btn-primary" onclick="openModal('add-candidate-modal')">
                        <i class="fas fa-plus mr-1"></i>
                        <a href="<?= PATH ?>candidate">
                        Ajouter
                        </a>
                    </button>
                </div>
                <div class="overflow-x-auto">
                    <table class="table table-zebra w-full">
                        <thead>
                            <tr>
                                <th>Photo</th>
                                <th>Nom</th>
                                <th>Parti</th>
                                <th>Votes</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="candidates-table">
                            <!-- Les candidats seront ajoutés dynamiquement -->
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Gestion des électeurs -->
            <div class="custom-card rounded-2xl p-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-xl font-bold">
                        <i class="fas fa-user-check mr-2 text-green-600"></i>
                        Électeurs
                    </h3>
                    <button class="btn btn-sm btn-success" onclick="openModal('add-voter-modal')">
                        <i class="fas fa-plus mr-1"></i>
                                              <a href="<?= PATH ?>etudiante">
                        Ajouter
                        </a>
                    </button>
                </div>
                <div class="overflow-x-auto">
                    <table class="table table-zebra w-full">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nom</th>
                                <th>Email</th>
                                <th>Statut</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="voters-table">
                            <!-- Les électeurs seront ajoutés dynamiquement -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Ajouter Candidat -->
    <dialog id="add-candidate-modal" class="modal">
        <div class="modal-box modal-box-custom max-w-2xl">
            <h3 class="font-bold text-lg mb-4" id="#btnPrint">
                <i class="fas fa-user-plus mr-2 text-blue-600"></i>
                Ajouter un Candidat
            </h3>
            <form id="add-candidate-form" class="space-y-4">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="label">
                            <span class="label-text font-medium">
                                Nom complet</span>
                        </label>
                        <input type="text" name="name" class="input input-bordered w-full" required>
                    </div>
                    <div>
                        <label class="label">
                            <span class="label-text font-medium">Parti politique</span>
                        </label>
                        <input type="text" name="party" class="input input-bordered w-full" required>
                    </div>
                </div>
                <div>
                    <label class="label">
                        <span class="label-text font-medium">Description</span>
                    </label>
                    <textarea name="description" class="textarea textarea-bordered w-full h-24" placeholder="Décrivez le candidat..."></textarea>
                </div>
                <div>
                    <label class="label">
                        <span class="label-text font-medium">Photo (URL)</span>
                    </label>
                    <input type="url" name="photo" class="input input-bordered w-full" placeholder="https://...">
                </div>
                <div class="modal-action">
                    <button type="button" class="btn" onclick="closeModal('add-candidate-modal')">Annuler</button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save mr-2"></i>
                        Enregistrer
                    </button>
                </div>
            </form>
        </div>
        <form method="dialog" class="modal-backdrop">
            <button>close</button>
        </form>
    </dialog>

    <!-- Modal Ajouter Électeur -->
    <dialog id="add-voter-modal" class="modal">
        <div class="modal-box modal-box-custom max-w-2xl">
            <h3 class="font-bold text-lg mb-4">
                <i class="fas fa-user-check mr-2 text-green-600"></i>
                Ajouter un Électeur
            </h3>
            <form id="add-voter-form" class="space-y-4">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="label">
                            <span class="label-text font-medium">Nom complet</span>
                        </label>
                        <input type="text" name="name" class="input input-bordered w-full" required>
                    </div>
                    <div>
                        <label class="label">
                            <span class="label-text font-medium">Email</span>
                        </label>
                        <input type="email" name="email" class="input input-bordered w-full" required>
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="label">
                            <span class="label-text font-medium">Numéro d'identification</span>
                        </label>
                        <input type="text" name="id-number" class="input input-bordered w-full" required>
                    </div>
                    <div>
                        <label class="label">
                            <span class="label-text font-medium">Téléphone</span>
                        </label>
                        <input type="tel" name="phone" class="input input-bordered w-full">
                    </div>
                </div>
                <div>
                    <label class="label">
                        <span class="label-text font-medium">Adresse</span>
                    </label>
                    <textarea name="address" class="textarea textarea-bordered w-full h-20" placeholder="Adresse complète..."></textarea>
                </div>
                <div class="modal-action">
                    <button type="button" class="btn" onclick="closeModal('add-voter-modal')">Annuler</button>
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-save mr-2"></i>
                        Enregistrer
                    </button>
                </div>
            </form>
        </div>
        <form method="dialog" class="modal-backdrop">
            <button>close</button>
        </form>
    </dialog>

    <!-- Notifications -->
    <div id="notification-container" class="fixed top-4 right-4 z-50 space-y-2">
        <!-- Les notifications seront ajoutées dynamiquement -->
    </div>

    <!-- Scripts JavaScript -->
    <script src="js/admin-dashboard.js"></script>
    <script type="text/javascript">
        var btnPrint = document.querySelector('#btnPrint');
        btnPrint.addEventListener('click', () => {
            $candidate();
        });
    </script>
</body>
</html>


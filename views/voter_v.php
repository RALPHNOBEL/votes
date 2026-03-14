<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GesVotes - Plateforme de Vote Électronique</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            font-family: 'Poppins', sans-serif;
        }
        
        .candidate-card {
            transition: all 0.3s ease;
            transform: translateY(0);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        }
        
        .candidate-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
        }
        
        .vote-btn {
            transition: all 0.3s ease;
            background: linear-gradient(45deg, #3B82F6, #6366F1);
            box-shadow: 0 4px 6px rgba(79, 70, 229, 0.3);
        }
        
        .vote-btn:hover:not(:disabled) {
            transform: scale(1.05);
            box-shadow: 0 6px 10px rgba(79, 70, 229, 0.5);
        }
        
        .vote-btn:active:not(:disabled) {
            transform: scale(0.98);
        }
        
        .pulse {
            animation: pulse 2s infinite;
        }
        
        @keyframes pulse {
            0% { box-shadow: 0 0 0 0 rgba(79, 70, 229, 0.4); }
            70% { box-shadow: 0 0 0 10px rgba(79, 70, 229, 0); }
            100% { box-shadow: 0 0 0 0 rgba(79, 70, 229, 0); }
        }
        
        .fade-in {
            animation: fadeIn 0.6s ease-in;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .stagger-delay:nth-child(1) { animation-delay: 0.1s; }
        .stagger-delay:nth-child(2) { animation-delay: 0.2s; }
        .stagger-delay:nth-child(3) { animation-delay: 0.3s; }
        .stagger-delay:nth-child(4) { animation-delay: 0.4s; }
        .stagger-delay:nth-child(5) { animation-delay: 0.5s; }
    </style>
</head>
<body class="bg-gradient-to-br from-blue-50 to-indigo-50 min-h-screen flex flex-col items-center pt-8 pb-16 px-4">
    <!-- Header avec logo et titre -->
    <div class="w-full max-w-6xl mb-8">
        <div class="flex items-center justify-center mb-2">
            <div class="w-14 h-14 rounded-full bg-indigo-600 flex items-center justify-center text-white mr-3">
                <i class="fas fa-vote-yea text-2xl"></i>
            </div>
            <h1 class="text-4xl font-bold text-indigo-800">GesVotes</h1>
        </div>
        <p class="text-center text-gray-600">Plateforme sécurisée de vote électronique</p>
    </div>

    <!-- Message de confirmation -->
    <?php if(!empty($message)): ?>
    <div class="max-w-2xl w-full mb-8 fade-in">
        <div class="px-5 py-4 rounded-lg bg-green-100 text-green-800 border border-green-200 flex items-center">
            <i class="fas fa-check-circle mr-3 text-green-600"></i>
            <?= $message ?>
        </div>
    </div>
    <?php endif; ?>

    <!-- Titre principal -->
    <h2 class="text-3xl font-bold mb-2 text-gray-800 text-center">🗳️ Votez pour votre candidat</h2>
    <p class="text-gray-600 mb-10 text-center max-w-2xl">Votre voix compte! Sélectionnez le candidat de votre choix en cliquant sur le bouton "Voter"</p>

    <!-- Grille des candidats -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 w-full max-w-6xl">
        <?php foreach($candidats as $index => $candidat): ?>
            <div class="candidate-card bg-white rounded-2xl overflow-hidden fade-in stagger-delay">
                <!-- Photo du candidat -->
                <div class="relative">
                    <?php if(!empty($candidat['photo'])): ?>
                        <img src="<?= $candidat['photo'] ?>" alt="<?= $candidat['nom_c'] ?>" 
                             class="w-full h-60 object-cover">
                    <?php else: ?>
                        <div class="w-full h-60 bg-gradient-to-r from-blue-100 to-indigo-100 flex items-center justify-center">
                            <i class="fas fa-user-circle text-6xl text-indigo-300"></i>
                        </div>
                    <?php endif; ?>
                    
                    <!-- Indicateur visuel si déjà voté -->
                    <?php if($candidateModel->hasVoted($id_el)): ?>
                    <div class="absolute top-4 right-4 bg-indigo-600 text-white text-xs font-semibold px-3 py-1 rounded-full">
                        <i class="fas fa-check mr-1"></i> Déjà voté
                    </div>
                    <?php endif; ?>
                </div>
                
                <!-- Informations du candidat -->
                <div class="p-6">
                    <h3 class="text-xl font-semibold text-gray-800 mb-2"><?= $candidat['nom_c'] ?: "Sans nom" ?></h3>
                    
                    <div class="flex items-center text-sm text-gray-500 mb-4">
                        <i class="fas fa-id-card mr-2"></i>
                        <span>Candidat #<?= $candidat['id_c'] ?></span>
                    </div>
                    
                    <p class="text-gray-600 mb-6 leading-relaxed">
                        <?= !empty($candidat['description']) ? $candidat['description'] : "Ce candidat n'a pas encore fourni de description." ?>
                    </p>

                    <form method="post" class="mt-auto">
                        <button type="submit" name="id_c" value="<?= $candidat['id_c'] ?>"
                            <?= ($candidateModel->hasVoted($id_el)) ? "disabled" : "" ?>
                            class="vote-btn w-full text-white font-medium py-3 px-4 rounded-lg flex items-center justify-center <?= ($candidateModel->hasVoted($id_el)) ? 'opacity-50 cursor-not-allowed' : 'pulse' ?>">
                            
                            <?php if($candidateModel->hasVoted($id_el)): ?>
                                <i class="fas fa-check-circle mr-2"></i> Déjà voté
                            <?php else: ?>
                                <i class="fas fa-vote-yea mr-2"></i> Voter maintenant
                            <?php endif; ?>
                        </button>
                    </form>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
                                <!-- Bouton Voir les résultats -->
<div class="w-full max-w-6xl mb-8 text-center">
    <a href="/votes/resultats" 
       class="inline-block bg-gradient-to-r from-indigo-600 to-blue-500 text-white font-semibold py-3 px-6 rounded-lg shadow-lg transform transition-transform hover:scale-105 hover:shadow-xl">
        <i class="fas fa-chart-bar mr-2"></i> Voir les résultats
    </a>
</div>

    <footer class="mt-12 text-center text-gray-500 text-sm">
        <p>© 2025 GesVotes - Tous droits réservés</p>
        <p class="mt-1">Système sécurisé de vote électronique</p>
    </footer>

    <script>

        document.addEventListener('DOMContentLoaded', function() {
            const candidateCards = document.querySelectorAll('.candidate-card');
            
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.style.opacity = 1;
                        observer.unobserve(entry.target);
                    }
                });
            }, { threshold: 0.1 });
            
            candidateCards.forEach(card => {
                card.style.opacity = 0;
                card.style.transition = 'opacity 0.5s ease-in-out, transform 0.3s ease';
                observer.observe(card);
            });
        });
    </script>
</body>
</html>
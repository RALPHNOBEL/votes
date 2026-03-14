<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Résultats des Votes - GesVotes</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }
        
        body {
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
        }
        
        .header {
            background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
            color: white;
            padding: 2rem 0;
            text-align: center;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            margin-bottom: 2rem;
        }
        
        .logo-container {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1rem;
        }
        
        .logo {
            background: rgba(255, 255, 255, 0.2);
            width: 70px;
            height: 70px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
            font-size: 28px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
        }
        
        .results-container {
            max-width: 1000px;
            margin: 0 auto 40px;
            padding: 30px;
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            animation: fadeIn 0.8s ease;
        }
        
        .results-title {
            text-align: center;
            color: #4f46e5;
            margin-bottom: 30px;
            font-weight: 700;
            font-size: 28px;
            position: relative;
            padding-bottom: 15px;
        }
        
        .results-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 4px;
            background: linear-gradient(90deg, #4f46e5, #7c3aed);
            border-radius: 2px;
        }
        
        .stats-box {
            display: flex;
            justify-content: space-between;
            margin-bottom: 30px;
            flex-wrap: wrap;
            gap: 15px;
        }
        
        .stat-card {
            flex: 1;
            min-width: 200px;
            background: #f8fafc;
            padding: 20px;
            border-radius: 12px;
            text-align: center;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            border-left: 4px solid #4f46e5;
        }
        
        .stat-number {
            font-size: 32px;
            font-weight: 700;
            color: #4f46e5;
            margin-bottom: 5px;
        }
        
        .stat-label {
            color: #64748b;
            font-size: 14px;
        }
        
        .results-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            margin-bottom: 20px;
        }
        
        .results-table th {
            background: #4f46e5;
            color: white;
            padding: 16px;
            text-align: left;
            font-weight: 600;
        }
        
        .results-table th:first-child {
            border-top-left-radius: 12px;
        }
        
        .results-table th:last-child {
            border-top-right-radius: 12px;
        }
        
        .results-table td {
            padding: 16px;
            border-bottom: 1px solid #e2e8f0;
        }
        
        .results-table tr:last-child td {
            border-bottom: none;
        }
        
        .candidate-info {
            display: flex;
            align-items: center;
        }
        
        .candidate-avatar {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: linear-gradient(135deg, #4f46e5, #7c3aed);
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
            color: white;
            font-size: 20px;
            flex-shrink: 0;
        }
        
        .candidate-details {
            flex-grow: 1;
        }
        
        .candidate-name {
            font-weight: 600;
            color: #1e293b;
        }
        
        .candidate-desc {
            font-size: 13px;
            color: #64748b;
            margin-top: 3px;
        }
        
        .vote-count {
            font-weight: 600;
            color: #4f46e5;
        }
        
        .vote-percent {
            color: #64748b;
            font-weight: 500;
        }
        
        .progress-bar {
            height: 8px;
            background: #e2e8f0;
            border-radius: 4px;
            overflow: hidden;
            margin-top: 5px;
        }
        
        .progress-fill {
            height: 100%;
            background: linear-gradient(90deg, #4f46e5, #7c3aed);
            border-radius: 4px;
            transition: width 1.5s ease-in-out;
        }
        
        .winner-badge {
            background: linear-gradient(135deg, #10b981, #059669);
            color: white;
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            margin-top: 5px;
        }
        
        .winner-badge i {
            margin-right: 4px;
            font-size: 10px;
        }
        
        .winner-row {
            background-color: rgba(16, 185, 129, 0.08);
            position: relative;
        }
        
        .winner-row::after {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            height: 100%;
            width: 4px;
            background: #10b981;
            border-radius: 2px;
        }
        
        .btn-back {
            display: inline-flex;
            align-items: center;
            background: linear-gradient(135deg, #4f46e5, #7c3aed);
            color: white;
            padding: 12px 24px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 4px 6px rgba(79, 70, 229, 0.3);
            margin-top: 20px;
        }
        
        .btn-back:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(79, 70, 229, 0.4);
        }
        
        .btn-back i {
            margin-right: 8px;
        }
        
        footer {
            text-align: center;
            padding: 20px;
            color: #64748b;
            font-size: 14px;
            margin-top: 40px;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        @keyframes growProgress {
            from { width: 0%; }
        }
        
        .stagger-animation {
            opacity: 0;
            animation: fadeIn 0.6s ease forwards;
        }
        
        .stagger-animation:nth-child(1) { animation-delay: 0.1s; }
        .stagger-animation:nth-child(2) { animation-delay: 0.2s; }
        .stagger-animation:nth-child(3) { animation-delay: 0.3s; }
        .stagger-animation:nth-child(4) { animation-delay: 0.4s; }
        
        @media (max-width: 768px) {
            .results-container {
                padding: 20px;
            }
            
            .stats-box {
                flex-direction: column;
            }
            
            .stat-card {
                min-width: 100%;
            }
            
            .results-table {
                display: block;
                overflow-x: auto;
            }
            
            .candidate-info {
                flex-direction: column;
                align-items: flex-start;
            }
            
            .candidate-avatar {
                margin-bottom: 10px;
            }
        }
    </style>
</head>
<body>
    <header class="header">
        <div class="logo-container">
            <div class="logo">
                <i class="fas fa-vote-yea"></i>
            </div>
            <h1>GesVotes - Résultats</h1>
        </div>
        <p>Résultats officiels de l'élection</p>
    </header>

    <div class="results-container">
        <h2 class="results-title">📊 Résultats de l'Élection</h2>
        
        <?php if(empty($candidates)): ?>
            <div class="text-center py-10">
                <div class="text-5xl text-gray-300 mb-4">
                    <i class="fas fa-box-open"></i>
                </div>
                <p class="text-gray-500 text-lg">Aucun candidat pour le moment.</p>
            </div>
        <?php else: ?>
            <?php
                $votes_array = array_column($candidates, 'votes');
                $max_votes = !empty($votes_array) ? max($votes_array) : 0;
                $total_votes = array_sum($votes_array);
            ?>
            
            <div class="stats-box">
                <div class="stat-card stagger-animation">
                    <div class="stat-number"><?= count($candidates) ?></div>
                    <div class="stat-label">Candidats</div>
                </div>
                
                <div class="stat-card stagger-animation">
                    <div class="stat-number"><?= $total_votes ?></div>
                    <div class="stat-label">Total des Votes</div>
                </div>
                
                <div class="stat-card stagger-animation">
                    <div class="stat-number"><?= $max_votes ?></div>
                    <div class="stat-label">Votes pour le Gagnant</div>
                </div>
            </div>
            
            <table class="results-table">
                <thead>
                    <tr>
                        <th>Candidat</th>
                        <th>Votes</th>
                        <th>Pourcentage</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($candidates as $index => $candidate): 
                        $percent = $total_votes > 0 ? round(($candidate['votes'] / $total_votes) * 100, 2) : 0;
                        $is_winner = ($candidate['votes'] == $max_votes && $max_votes > 0);
                    ?>
                        <tr class="<?= $is_winner ? 'winner-row' : '' ?> stagger-animation">
                            <td>
                                <div class="candidate-info">
                                    <div class="candidate-avatar">
                                        <i class="fas fa-user"></i>
                                    </div>
                                    <div class="candidate-details">
                                        <div class="candidate-name"><?= htmlspecialchars($candidate['nom_c']) ?></div>
                                        <div class="candidate-desc"><?= htmlspecialchars($candidate['description']) ?></div>
                                        <?php if($is_winner): ?>
                                            <div class="winner-badge">
                                                <i class="fas fa-trophy"></i> Gagnant
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </td>
                            <td class="vote-count"><?= $candidate['votes'] ?></td>
                            <td>
                                <div class="vote-percent"><?= $percent ?>%</div>
                                <div class="progress-bar">
                                    <div class="progress-fill" style="width: <?= $percent ?>%"></div>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            
            <div class="text-center">
                <a href="/votes/voter" class="btn-back">
                    <i class="fas fa-arrow-left"></i> Retour à la page de vote
                </a>
            </div>
        <?php endif; ?>
    </div>

    <footer>
        © 2025 Plateforme de Vote Sécurisée - Ville de Douala
    </footer>

    <script>
        // Animation des barres de progression
        document.addEventListener('DOMContentLoaded', function() {
            const progressBars = document.querySelectorAll('.progress-fill');
            
            progressBars.forEach(bar => {
                // Sauvegarder la largeur originale
                const originalWidth = bar.style.width;
                // Réinitialiser pour l'animation
                bar.style.width = '0%';
                
                // Déclencher l'animation après un court délai
                setTimeout(() => {
                    bar.style.width = originalWidth;
                }, 300);
            });
            
            // Animation d'apparition progressive
            const staggerItems = document.querySelectorAll('.stagger-animation');
            
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.style.opacity = 1;
                        observer.unobserve(entry.target);
                    }
                });
            }, { threshold: 0.1 });
            
            staggerItems.forEach(item => {
                item.style.opacity = 0;
                item.style.transition = 'opacity 0.5s ease-in-out';
                observer.observe(item);
            });
        });
    </script>
</body>
</html>
<!DOCTYPE html>
<html lang="en" data-theme="aqua">

<head>
    <?php include "views/includes/head.php"; ?>
       <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #adb1c5 100%);
            min-height: 100vh;
            padding: 20px;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            overflow: hidden;
        }

        .header {
            background: rgba(255, 254, 254, 0.1);
            padding: 30px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .header h1 {
            color: black;
            font-size: 2.5em;
            font-weight: 300;
            margin-bottom: 10px;
        }

        .header p {
            color: rgba(255, 255, 255, 0.8);
            font-size: 1.1em;
        }

        .content {
            display: flex;
            min-height: 600px;
        }

        .sidebar {
            width: 280px;
            background: rgba(0, 0, 0, 0.1);
            padding: 30px 0;
            border-right: 1px solid rgba(255, 255, 255, 0.1);
        }

        .nav-item {
            display: block;
            padding: 15px 30px;
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            transition: all 0.3s ease;
            border-left: 3px solid transparent;
            cursor: pointer;
        }

        .nav-item:hover {
            background: rgba(255, 255, 255, 0.1);
            color: black;
        }

        .nav-item.active {
            background: rgba(255, 255, 255, 0.15);
            color: black;
        }

        .nav-item i {
            margin-right: 12px;
            width: 20px;
        }

        .main-content {
            flex: 1;
            padding: 30px;
            overflow-y: auto;
        }

        .section {
            display: none;
            animation: fadeIn 0.3s ease-in-out;
        }

        .section.active {
            display: block;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .section-title {
            color: black;
            font-size: 1.8em;
            margin-bottom: 25px;
            font-weight: 300;
        }

        .settings-group {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 15px;
            padding: 25px;
            margin-bottom: 25px;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .group-title {
            color: black;
            font-size: 1.2em;
            margin-bottom: 20px;
            font-weight: 500;
        }

        .setting-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .setting-item:last-child {
            margin-bottom: 0;
            padding-bottom: 0;
            border-bottom: none;
        }

        .setting-info {
            flex: 1;
        }

        .setting-label {
            color: black;
            font-weight: 500;
            margin-bottom: 5px;
        }

        .setting-description {
            color: rgba(255, 255, 255, 0.7);
            font-size: 0.9em;
        }

        .setting-control {
            margin-left: 20px;
        }

        .toggle {
            position: relative;
            display: inline-block;
            width: 50px;
            height: 24px;
        }

        .toggle input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(255, 255, 255, 0.3);
            transition: .4s;
            border-radius: 24px;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 18px;
            width: 18px;
            left: 3px;
            bottom: 3px;
            background-color: black;
            transition: .4s;
            border-radius: 50%;
        }

        input:checked + .slider {
            background-color: #4CAF50;
        }

        input:checked + .slider:before {
            transform: translateX(26px);
        }

        .btn {
            background: linear-gradient(135deg, #4CAF50, #45a049);
            color: black;
            border: none;
            padding: 12px 25px;
            border-radius: 25px;
            cursor: pointer;
            font-size: 1em;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.3);
        }

        .btn-secondary {
            background: rgba(255, 255, 255, 0.2);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        .btn-danger {
            background: linear-gradient(135deg, #f44336, #d32f2f);
        }

        .input-field {
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 8px;
            padding: 10px 15px;
            color: black;
            width: 200px;
        }

        .input-field::placeholder {
            color: rgba(255, 255, 255, 0.5);
        }

        .select-field {
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 8px;
            padding: 10px 15px;
            color: black;
            width: 200px;
            cursor: pointer;
        }

        .select-field option {
            background: #333;
            color: black;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 25px;
        }

        .stat-card {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 15px;
            padding: 20px;
            text-align: center;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .stat-value {
            font-size: 2em;
            font-weight: bold;
            color: #4CAF50;
            margin-bottom: 5px;
        }

        .stat-label {
            color: rgba(255, 255, 255, 0.8);
            font-size: 0.9em;
        }

        .notification {
            background: rgba(76, 175, 80, 0.2);
            border: 1px solid #4CAF50;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 20px;
            color: black;
            display: none;
        }

        .notification.show {
            display: block;
            animation: slideIn 0.3s ease-out;
        }

        @keyframes slideIn {
            from { transform: translateX(100%); }
            to { transform: translateX(0); }
        }

        .avatar-upload {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .avatar {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background: linear-gradient(135deg, #4CAF50, #45a049);
            display: flex;
            align-items: center;
            justify-content: center;
            color: black;
            font-size: 2em;
            font-weight: bold;
        }

        @media (max-width: 768px) {
            .content {
                flex-direction: column;
            }
            
            .sidebar {
                width: 100%;
                padding: 20px 0;
            }
            
            .nav-item {
                padding: 12px 20px;
            }
        }
    </style>
</head>
</head>

<body>
    <div class="navbar-start ">
            <div class="dropdown">
                <div  tabindex="0" role="button" class="btn btn-ghost  ">
                    <i class="fas fa-bars"></i>
                </div>
                <ul tabindex="0" class="menu menu-sm dropdown-content mt-3 z-[1] p-2 shadow bg-base-100 rounded-box w-52">
                    <li><a href="<?= PATH ?>dashboard">Dashboard</a></li>
                    <li><a href="<?= PATH ?>candidate">Candidats</a></li>
                    <li><a href="<?= PATH ?>etudiante">Electeur</a></li>
                    <li><a href="<?= PATH ?>vote">Votes</a></li>
                    <li><a href="<?= PATH ?>parametre">Paramètres</a></li>
                </ul>
            </div>
          
           
            
       
        
        </div>
                  <div class="navbar-center hi
    <section class="home-section">
        <?php include "views/includes/nav.php"; ?>
        <div class="home-content">
            <div class="overview-boxes boxes-elt">
                <div class="box">
                    <form action="" method="POST">
                        <div class="form-group">
                         
<body>
    <div class="container">
        <div class="header">
            <h1>Paramètres</h1>
            <p>Configurez votre dashboard selon vos préférences</p>
        </div>
        
        <div class="content">
            <nav class="sidebar">
                <a href="#" class="nav-item active" onclick="showSection('general')">
                    <i>⚙️</i> Général
                </a>
                <a href="views/profil_v.php" class="nav-item" onclick="showSection('profile')">
                    <i>👤</i> Profil
                </a>
                <a href="#" class="nav-item" onclick="showSection('notifications')">
                    <i>🔔</i> Notifications
                </a>
                <a href="#" class="nav-item" onclick="showSection('dashboard')">
                    <i>📊</i> Dashboard
                </a>
                <a href="#" class="nav-item" onclick="showSection('security')">
                    <i>🔒</i> Sécurité
                </a>
                <a href="#" class="nav-item" onclick="showSection('integrations')">
                    <i>🔗</i> Intégrations
                </a>
                <a href="#" class="nav-item" onclick="showSection('advanced')">
                    <i>🛠️</i> Avancé
                </a>
            </nav>
            
            <main class="main-content">
                <div id="notification" class="notification">
                    Paramètres sauvegardés avec succès !
                </div>

                <!-- Section Général -->
                <section id="general" class="section active">
                    <h2 class="section-title">Paramètres généraux</h2>
                    
                    <div class="settings-group">
                        <h3 class="group-title">Préférences d'affichage</h3>
                        
                        <div class="setting-item">
                            <div class="setting-info">
                                <div class="setting-label">Mode sombre</div>
                                <div class="setting-description">  <input type="checkbox" value="synthwave" class="toggle theme-controller" />
  <svg
    xmlns="http://www.w3.org/2000/svg"
    width="20"
    height="20"
    viewBox="0 0 24 24"
    fill="none"
    stroke="currentColor"
    stroke-width="2"
    stroke-linecap="round"
    stroke-linejoin="round">
    <path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"></path>
  </svg></div>
                            </div>
                          
                        </div>
                        
                        <div class="setting-item">
                            <div class="setting-info">
                                <div class="setting-label">Langue</div>
                                <div class="setting-description">Choisir la langue de l'interface</div>
                            </div>
                            <div class="setting-control">
                                <select class="select-field">
                                    <option value="fr">Français</option>
                                    <option value="en">English</option>
                                    <option value="es">Español</option>
                                    <option value="de">Deutsch</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="setting-item">
                            <div class="setting-info">
                                <div class="setting-label">Fuseau horaire</div>
                                <div class="setting-description">Définir votre fuseau horaire local</div>
                            </div>
                            <div class="setting-control">
                                <select class="select-field">
                                    <option value="Europe/Paris">Europe/Paris (GMT+1)</option>
                                    <option value="America/New_York">America/New_York (GMT-5)</option>
                                    <option value="Asia/Tokyo">Asia/Tokyo (GMT+9)</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    <div class="settings-group">
                        <h3 class="group-title">Performance</h3>
                        
                        <div class="setting-item">
                            <div class="setting-info">
                                <div class="setting-label">Animations</div>
                                <div class="setting-description">Activer les animations d'interface</div>
                            </div>
                            <div class="setting-control">
                                <label class="toggle">
                                    <input type="checkbox" checked>
                                    <span class="slider"></span>
                                </label>
                            </div>
                        </div>
                        
                        <div class="setting-item">
                            <div class="setting-info">
                                <div class="setting-label">Actualisation automatique</div>
                                <div class="setting-description">Fréquence de mise à jour des données</div>
                            </div>
                            <div class="setting-control">
                                <select class="select-field">
                                    <option value="30">30 secondes</option>
                                    <option value="60" selected>1 minute</option>
                                    <option value="300">5 minutes</option>
                                    <option value="0">Manuelle</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Section Profil -->
                <section id="profile" class="section">
                    <h2 class="section-title">Informations du profil</h2>
                    
                    <div class="settings-group">
                        <h3 class="group-title">Photo de profil</h3>
                        
                        <div class="avatar-upload">
                            <div class="avatar">JD</div>
                            <div>
                                <button class="btn btn-secondary">Changer la photo</button>
                                <p style="color: rgba(255,255,255,0.7); font-size: 0.9em; margin-top: 10px;">
                                    JPG, PNG ou GIF. Taille max : 2MB
                                </p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="settings-group">
                        <h3 class="group-title">Informations personnelles</h3>
                        
                        <div class="setting-item">
                            <div class="setting-info">
                                <div class="setting-label">Nom complet</div>
                                <div class="setting-description">Votre nom et prénom</div>
                            </div>
                            <div class="setting-control">
                                <input type="text" class="input-field" value="Jean Dupont" placeholder="Nom complet">
                            </div>
                        </div>
                        
                        <div class="setting-item">
                            <div class="setting-info">
                                <div class="setting-label">Email</div>
                                <div class="setting-description">Adresse email principale</div>
                            </div>
                            <div class="setting-control">
                                <input type="email" class="input-field" value="jean.dupont@email.com" placeholder="Email">
                            </div>
                        </div>
                        
                        <div class="setting-item">
                            <div class="setting-info">
                                <div class="setting-label">Fonction</div>
                                <div class="setting-description">Votre titre ou fonction</div>
                            </div>
                            <div class="setting-control">
                                <input type="text" class="input-field" value="Manager" placeholder="Fonction">
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Section Notifications -->
                <section id="notifications" class="section">
                    <h2 class="section-title">Notifications</h2>
                    
                    <div class="settings-group">
                        <h3 class="group-title">Notifications par email</h3>
                        
                        <div class="setting-item">
                            <div class="setting-info">
                                <div class="setting-label">Alertes système</div>
                                <div class="setting-description">Recevoir les alertes critiques par email</div>
                            </div>
                            <div class="setting-control">
                                <label class="toggle">
                                    <input type="checkbox" checked>
                                    <span class="slider"></span>
                                </label>
                            </div>
                        </div>
                        
                        <div class="setting-item">
                            <div class="setting-info">
                                <div class="setting-label">Rapports hebdomadaires</div>
                                <div class="setting-description">Recevoir un résumé chaque semaine</div>
                            </div>
                            <div class="setting-control">
                                <label class="toggle">
                                    <input type="checkbox" checked>
                                    <span class="slider"></span>
                                </label>
                            </div>
                        </div>
                        
                        <div class="setting-item">
                            <div class="setting-info">
                                <div class="setting-label">Notifications marketing</div>
                                <div class="setting-description">Recevoir les nouveautés et promotions</div>
                            </div>
                            <div class="setting-control">
                                <label class="toggle">
                                    <input type="checkbox">
                                    <span class="slider"></span>
                                </label>
                            </div>
                        </div>
                    </div>
                    
                    <div class="settings-group">
                        <h3 class="group-title">Notifications push</h3>
                        
                        <div class="setting-item">
                            <div class="setting-info">
                                <div class="setting-label">Notifications bureau</div>
                                <div class="setting-description">Afficher les notifications sur le bureau</div>
                            </div>
                            <div class="setting-control">
                                <label class="toggle">
                                    <input type="checkbox" checked>
                                    <span class="slider"></span>
                                </label>
                            </div>
                        </div>
                        
                        <div class="setting-item">
                            <div class="setting-info">
                                <div class="setting-label">Sons de notification</div>
                                <div class="setting-description">Jouer un son lors des notifications</div>
                            </div>
                            <div class="setting-control">
                                <label class="toggle">
                                    <input type="checkbox">
                                    <span class="slider"></span>
                                </label>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Section Dashboard -->
                <section id="dashboard" class="section">
                    <h2 class="section-title">Configuration du Dashboard</h2>
                    
                    <div class="stats-grid">
                        <div class="stat-card">
                            <div class="stat-value">12</div>
                            <div class="stat-label">Widgets actifs</div>
                        </div>
                        <div class="stat-card">
                            <div class="stat-value">3</div>
                            <div class="stat-label">Tableaux de bord</div>
                        </div>
                        <div class="stat-card">
                            <div class="stat-value">24h</div>
                            <div class="stat-label">Rétention données</div>
                        </div>
                    </div>
                    
                    <div class="settings-group">
                        <h3 class="group-title">Affichage des widgets</h3>
                        
                        <div class="setting-item">
                            <div class="setting-info">
                                <div class="setting-label">Widget graphiques</div>
                                <div class="setting-description">Afficher les graphiques en temps réel</div>
                            </div>
                            <div class="setting-control">
                                <label class="toggle">
                                    <input type="checkbox" checked>
                                    <span class="slider"></span>
                                </label>
                            </div>
                        </div>
                        
                        <div class="setting-item">
                            <div class="setting-info">
                                <div class="setting-label">Widget statistiques</div>
                                <div class="setting-description">Afficher les KPIs principaux</div>
                            </div>
                            <div class="setting-control">
                                <label class="toggle">
                                    <input type="checkbox" checked>
                                    <span class="slider"></span>
                                </label>
                            </div>
                        </div>
                        
                        <div class="setting-item">
                            <div class="setting-info">
                                <div class="setting-label">Widget activités</div>
                                <div class="setting-description">Afficher le flux d'activités</div>
                            </div>
                            <div class="setting-control">
                                <label class="toggle">
                                    <input type="checkbox">
                                    <span class="slider"></span>
                                </label>
                            </div>
                        </div>
                    </div>
                    
                    <div class="settings-group">
                        <h3 class="group-title">Données</h3>
                        
                        <div class="setting-item">
                            <div class="setting-info">
                                <div class="setting-label">Période par défaut</div>
                                <div class="setting-description">Période d'affichage des données</div>
                            </div>
                            <div class="setting-control">
                                <select class="select-field">
                                    <option value="1d">Dernières 24h</option>
                                    <option value="7d" selected>7 derniers jours</option>
                                    <option value="30d">30 derniers jours</option>
                                    <option value="90d">3 derniers mois</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Section Sécurité -->
                <section id="security" class="section">
                    <h2 class="section-title">Sécurité</h2>
                    
                    <div class="settings-group">
                        <h3 class="group-title">Mot de passe</h3>
                        
                        <div class="setting-item">
                            <div class="setting-info">
                                <div class="setting-label">Changer le mot de passe</div>
                                <div class="setting-description">Dernière modification il y a 30 jours</div>
                            </div>
                            <div class="setting-control">
                                <button class="btn btn-secondary">Modifier</button>
                            </div>
                        </div>
                    </div>
                    
                    <div class="settings-group">
                        <h3 class="group-title">Authentification à deux facteurs</h3>
                        
                        <div class="setting-item">
                            <div class="setting-info">
                                <div class="setting-label">2FA</div>
                                <div class="setting-description">Activer l'authentification à deux facteurs</div>
                            </div>
                            <div class="setting-control">
                                <label class="toggle">
                                    <input type="checkbox">
                                    <span class="slider"></span>
                                </label>
                            </div>
                        </div>
                    </div>
                    
                    <div class="settings-group">
                        <h3 class="group-title">Sessions actives</h3>
                        
                        <div class="setting-item">
                            <div class="setting-info">
                                <div class="setting-label">Déconnexion automatique</div>
                                <div class="setting-description">Se déconnecter après inactivité</div>
                            </div>
                            <div class="setting-control">
                                <select class="select-field">
                                    <option value="15">15 minutes</option>
                                    <option value="30" selected>30 minutes</option>
                                    <option value="60">1 heure</option>
                                    <option value="0">Jamais</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="setting-item">
                            <div class="setting-info">
                                <div class="setting-label">Sessions actives</div>
                                <div class="setting-description">Gérer les appareils connectés</div>
                            </div>
                            <div class="setting-control">
                                <button class="btn btn-secondary">Voir tout</button>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Section Intégrations -->
                <section id="integrations" class="section">
                    <h2 class="section-title">Intégrations</h2>
                    
                    <div class="settings-group">
                        <h3 class="group-title">API et Webhooks</h3>
                        
                        <div class="setting-item">
                            <div class="setting-info">
                                <div class="setting-label">Clé API</div>
                                <div class="setting-description">Gérer vos clés d'accès API</div>
                            </div>
                            <div class="setting-control">
                                <button class="btn btn-secondary">Gérer</button>
                            </div>
                        </div>
                        
                        <div class="setting-item">
                            <div class="setting-info">
                                <div class="setting-label">Webhooks</div>
                                <div class="setting-description">Configurer les notifications automatiques</div>
                            </div>
                            <div class="setting-control">
                                <button class="btn btn-secondary">Configurer</button>
                            </div>
                        </div>
                    </div>
                    
                    <div class="settings-group">
                        <h3 class="group-title">Services connectés</h3>
                        
                        <div class="setting-item">
                            <div class="setting-info">
                                <div class="setting-label">Google Analytics</div>
                                <div class="setting-description">Connecté - Dernière sync il y a 2 min</div>
                            </div>
                            <div class="setting-control">
                                <button class="btn btn-danger">Déconnecter</button>
                            </div>
                        </div>
                        
                        <div class="setting-item">
                            <div class="setting-info">
                                <div class="setting-label">Slack</div>
                                <div class="setting-description">Non connecté</div>
                            </div>
                            <div class="setting-control">
                                <button class="btn">Connecter</button>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Section Avancé -->
                <section id="advanced" class="section">
                    <h2 class="section-title">Paramètres avancés</h2>
                    
                    <div class="settings-group">
                        <h3 class="group-title">Données et sauvegarde</h3>
                        
                        <div class="setting-item">
                            <div class="setting-info">
                                <div class="setting-label">Exporter les données</div>
                                <div class="setting-description">Télécharger toutes vos données</div>
                            </div>
                            <div class="setting-control">
                                <button class="btn btn-secondary">Exporter</button>
                            </div>
                        </div>
                        
                        <div class="setting-item">
                            <div class="setting-info">
                                <div class="setting-label">Sauvegarde automatique</div>
                                <div class="setting-description">Sauvegarder régulièrement vos configurations</div>
                            </div>
                            <div class="setting-control">
                                <label class="toggle">
                                    <input type="checkbox" checked>
                                    <span class="slider"></span>
                                </label>
                            </div>
                        </div>
                    </div>
                    
                    <div class="settings-group">
                        <h3 class="group-title">Zone de danger</h3>
                        
                        <div class="setting-item">
                            <div class="setting-info">
                                <div class="setting-label">Réinitialiser les paramètres</div>
                                <div class="setting-description">Remettre tous les paramètres par défaut</div>
                            </div>
                            <p>candidate</p>
                        </div>
                        <div class="drawer">
  <input id="my-drawer" type="checkbox" class="drawer-toggle" />
  <div class="drawer-content">
    <!-- Page content here -->
    <label for="my-drawer" class="btn btn-primary drawer-button mt-60 flex justify-center  w-40 mx-auto   ">ouvrir la barre</label>
  </div>
  <div class="drawer-side">
    <label for="my-drawer" aria-label="close sidebar" class="drawer-overlay"></label>
    <ul class="menu bg-base-200 text-base-content min-h-full w-80 p-4"><br><br><br><br><br>
      <!-- Sidebar content here -->
      <li><a href="views/generaux_v.php">parametre generaux</a></li><br><br><br>
      <li><a>Sidebar Item 2</a></li>
      <li><a>Sidebar Item 1</a></li>
      <li><a>Sidebar Item 1</a></li><br><br><br>
      <li><a>  <label class="flex cursor-pointer gap-2">
  <svg
    xmlns="http://www.w3.org/2000/svg"
    width="20"
    height="20"
    viewBox="0 0 24 24"
    fill="none"
    stroke="currentColor"
    stroke-width="2"
    stroke-linecap="round"
    stroke-linejoin="round">
    <circle cx="12" cy="12" r="5" />
    <path
      d="M12 1v2M12 21v2M4.2 4.2l1.4 1.4M18.4 18.4l1.4 1.4M1 12h2M21 12h2M4.2 19.8l1.4-1.4M18.4 5.6l1.4-1.4" />
  </svg>
  <input type="checkbox" value="synthwave" class="toggle theme-controller" />
  <svg
    xmlns="http://www.w3.org/2000/svg"
    width="20"
    height="20"
    viewBox="0 0 24 24"
    fill="none"
    stroke="currentColor"
    stroke-width="2"
    stroke-linecap="round"
    stroke-linejoin="round">
    <path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"></path>
  </svg>
</label></a></li>

    </ul>
    
  
  </div>
</div>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vérification du Code - GesVotes</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
            flex-direction: column;
        }
        
        .logo {
            margin-bottom: 30px;
            text-align: center;
            animation: fadeIn 1s ease;
        }
        
        .logo i {
            font-size: 48px;
            color: #fff;
            background: rgba(255, 255, 255, 0.2);
            width: 90px;
            height: 90px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 15px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
            backdrop-filter: blur(5px);
        }
        
        .logo h1 {
            color: white;
            font-weight: 700;
            font-size: 32px;
            letter-spacing: 1px;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        }
        
        .container {
            background-color: white;
            border-radius: 16px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 450px;
            padding: 40px;
            text-align: center;
            position: relative;
            overflow: hidden;
            animation: slideUp 0.5s ease;
        }
        
        .container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 6px;
            background: linear-gradient(90deg, #28a745, #20c997);
        }
        
        h2 {
            color: #333;
            margin-bottom: 10px;
            font-weight: 600;
            font-size: 24px;
        }
        
        .subtitle {
            color: #666;
            margin-bottom: 30px;
            font-size: 15px;
        }
        
        .form-group {
            margin-bottom: 25px;
            text-align: left;
        }
        
        label {
            display: block;
            margin-bottom: 8px;
            color: #444;
            font-weight: 500;
            font-size: 14px;
        }
        
        .input-wrapper {
            position: relative;
        }
        
        input[type="text"] {
            width: 100%;
            padding: 16px 16px 16px 48px;
            border: 2px solid #e5e7eb;
            border-radius: 12px;
            font-size: 16px;
            transition: all 0.3s ease;
            outline: none;
            letter-spacing: 8px;
            font-weight: bold;
            text-align: center;
        }
        
        input[type="text"]:focus {
            border-color: #28a745;
            box-shadow: 0 0 0 3px rgba(40, 167, 69, 0.2);
        }
        
        .input-icon {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: #9ca3af;
        }
        
        button {
            background: linear-gradient(135deg, #28a745, #20c997);
            color: white;
            padding: 16px 24px;
            border: none;
            border-radius: 12px;
            cursor: pointer;
            font-size: 16px;
            font-weight: 600;
            width: 100%;
            transition: all 0.3s ease;
            box-shadow: 0 4px 6px rgba(40, 167, 69, 0.3);
            position: relative;
            overflow: hidden;
        }
        
        button:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(40, 167, 69, 0.4);
        }
        
        button:active {
            transform: translateY(0);
        }
        
        .loading-overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(255, 255, 255, 0.9);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 1000;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
        }
        
        .loading-overlay.active {
            opacity: 1;
            visibility: visible;
        }
        
        .loading-spinner {
            width: 60px;
            height: 60px;
            position: relative;
        }
        
        .loading-spinner div {
            box-sizing: border-box;
            display: block;
            position: absolute;
            width: 100%;
            height: 100%;
            border: 6px solid #e5e7eb;
            border-radius: 50%;
            animation: spinner 1.2s cubic-bezier(0.5, 0, 0.5, 1) infinite;
            border-color: #28a745 transparent transparent transparent;
        }
        
        .loading-spinner div:nth-child(1) {
            animation-delay: -0.45s;
        }
        
        .loading-spinner div:nth-child(2) {
            animation-delay: -0.3s;
        }
        
        .loading-spinner div:nth-child(3) {
            animation-delay: -0.15s;
        }
        
        @keyframes spinner {
            0% {
                transform: rotate(0deg);
            }
            100% {
                transform: rotate(360deg);
            }
        }
        
        .loading-text {
            margin-top: 20px;
            font-size: 18px;
            color: #28a745;
            font-weight: 600;
        }
        
        .message {
            margin-top: 20px;
            padding: 12px 16px;
            border-radius: 8px;
            font-size: 14px;
            display: none;
        }
        
        .message.success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        
        .message.error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
        
        .resend {
            margin-top: 25px;
            color: #6c757d;
            font-size: 14px;
        }
        
        .resend a {
            color: #28a745;
            text-decoration: none;
            font-weight: 500;
        }
        
        .resend a:hover {
            text-decoration: underline;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        
        @keyframes slideUp {
            from { 
                opacity: 0;
                transform: translateY(20px);
            }
            to { 
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            10%, 30%, 50%, 70%, 90% { transform: translateX(-5px); }
            20%, 40%, 60%, 80% { transform: translateX(5px); }
        }
        
        .shake {
            animation: shake 0.5s;
        }
        
        @media (max-width: 480px) {
            .container {
                padding: 30px 20px;
            }
            
            h2 {
                font-size: 20px;
            }
            
            .logo h1 {
                font-size: 26px;
            }
        }
    </style>
</head>
<body>
    <div class="logo">
        <i class="fas fa-vote-yea"></i>
        <h1>GesVotes</h1>
    </div>
    
    <div class="container">
        <h2>Vérification du Code</h2>
        <p class="subtitle">Entrez le code de vérification envoyé à votre adresse email</p>
        
        <form id="codeForm">
            <div class="form-group">
                <label for="code">Code de vérification</label>
                <div class="input-wrapper">
                    <i class="fas fa-key input-icon"></i>
                    <input type="text" name="code" id="code" placeholder="Ex: 4 5 8 2 1 9" maxlength="7" required>
                </div>
            </div>
            
            <button type="submit" id="submitBtn">
                <span class="button-text">Vérifier le code</span>
            </button>
            
            <div id="message" class="message"></div>
            
            <div class="resend">
                Vous n'avez pas reçu le code? <a href="#" id="resendLink">Renvoyer</a>
            </div>
        </form>
    </div>
    
    <div class="loading-overlay" id="loadingOverlay">
        <div class="loading-content">
            <div class="loading-spinner">
                <div></div>
                <div></div>
                <div></div>
            </div>
            <div class="loading-text">Vérification en cours...</div>
        </div>
    </div>

    <script>
        document.getElementById('codeForm').addEventListener('submit', async (e) => {
            e.preventDefault();
            
            const code = document.getElementById('code').value.trim();
            const messageEl = document.getElementById('message');
            const submitBtn = document.getElementById('submitBtn');
            const loadingOverlay = document.getElementById('loadingOverlay');
            
            // Validation basique du code
            if (!code || code.length !== 6) {
                showMessage('Veuillez entrer un code de 6 chiffres', 'error');
                document.getElementById('code').classList.add('shake');
                setTimeout(() => {
                    document.getElementById('code').classList.remove('shake');
                }, 500);
                return;
            }
            
            // Afficher l'animation de chargement
            loadingOverlay.classList.add('active');
            submitBtn.disabled = true;
            
            try {
                // Simuler un délai réseau (à retirer en production)
                await new Promise(resolve => setTimeout(resolve, 2000));
                
                const response = await fetch('controllers/verifiercode_c.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({ code }),
                });
                
                const data = await response.json();
                
                if (data.success) {
                    showMessage(data.message, 'success');
                    
                    // Redirection après un délai
                    setTimeout(() => {
                        window.location.href = '/votes/voter';
                    }, 1500);
                } else {
                    showMessage(data.message || 'Code de vérification incorrect.', 'error');
                    loadingOverlay.classList.remove('active');
                    submitBtn.disabled = false;
                }
            } catch (error) {
                console.error('Erreur:', error);
                showMessage('Une erreur est survenue. Veuillez réessayer.', 'error');
                loadingOverlay.classList.remove('active');
                submitBtn.disabled = false;
            }
        });
        
        // Fonction pour renvoyer le code
        document.getElementById('resendLink').addEventListener('click', async (e) => {
            e.preventDefault();
            
            try {
                const response = await fetch('controllers/renvoyer_code.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    }
                });
                
                const data = await response.json();
                
                if (data.success) {
                    showMessage('Un nouveau code a été envoyé à votre adresse email.', 'success');
                } else {
                    showMessage('Erreur lors de l\'envoi du code. Veuillez réessayer.', 'error');
                }
            } catch (error) {
                console.error('Erreur:', error);
                showMessage('Une erreur est survenue. Veuillez réessayer.', 'error');
            }
        });
        
        function showMessage(text, type) {
            const messageEl = document.getElementById('message');
            messageEl.textContent = text;
            messageEl.className = `message ${type}`;
            messageEl.style.display = 'block';
        }
        
        // Formatage automatique du code (ajout d'espaces)
        document.getElementById('code').addEventListener('input', function(e) {
            let value = e.target.value.replace(/\s/g, '').replace(/\D/g, '');
            
            if (value.length > 8) {
                value = value.substring(0, 7);
            }
            
            // Ajouter un espace tous les 2 caractères
            // value = value.replace(/(.{2})/g, '$1 ').trim();
            // e.target.value = value;
        });
    </script>
</body>
</html>
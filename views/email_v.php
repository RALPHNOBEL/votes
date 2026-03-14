<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmation du mail - GesVotes</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        body {
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
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
        }
        
        .logo i {
            font-size: 40px;
            color: #4f46e5;
            background: white;
            width: 80px;
            height: 80px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 15px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
        
        .logo h1 {
            color: #4f46e5;
            font-weight: 700;
            font-size: 28px;
            letter-spacing: 0.5px;
        }
        
        .container {
            background-color: white;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            width: 100%;
            max-width: 450px;
            padding: 40px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }
        
        .container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 6px;
            background: linear-gradient(90deg, #4f46e5, #7c3aed);
        }
        
        h2 {
            color: #1f2937;
            margin-bottom: 25px;
            font-weight: 600;
            font-size: 24px;
        }
        
        .form-group {
            margin-bottom: 25px;
            text-align: left;
        }
        
        label {
            display: block;
            margin-bottom: 8px;
            color: #374151;
            font-weight: 500;
            font-size: 14px;
        }
        
        .input-wrapper {
            position: relative;
        }
        
        input[type="email"] {
            width: 100%;
            padding: 16px 16px 16px 48px;
            border: 2px solid #e5e7eb;
            border-radius: 12px;
            font-size: 16px;
            transition: all 0.3s ease;
            outline: none;
        }
        
        input[type="email"]:focus {
            border-color: #4f46e5;
            box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.2);
        }
        
        .input-icon {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: #9ca3af;
        }
        
        button {
            background: linear-gradient(135deg, #4f46e5, #7c3aed);
            color: white;
            padding: 16px 24px;
            border: none;
            border-radius: 12px;
            cursor: pointer;
            font-size: 16px;
            font-weight: 600;
            width: 100%;
            transition: all 0.3s ease;
            box-shadow: 0 4px 6px rgba(79, 70, 229, 0.3);
            position: relative;
            overflow: hidden;
        }
        
        button:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(79, 70, 229, 0.4);
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
            border-color: #4f46e5 transparent transparent transparent;
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
            color: #4f46e5;
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
            background-color: #ecfdf5;
            color: #065f46;
            border: 1px solid #a7f3d0;
        }
        
        .message.error {
            background-color: #fef2f2;
            color: #b91c1c;
            border: 1px solid #fecaca;
        }
        
        .footer {
            margin-top: 30px;
            color: #6b7280;
            font-size: 14px;
        }
        
        @media (max-width: 480px) {
            .container {
                padding: 30px 20px;
            }
            
            h2 {
                font-size: 20px;
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
        <h2>Connectez-vous à votre compte</h2>
        
        <form id="" method="POST">
            <div class="form-group">
                <label for="email">Adresse email</label>
                <div class="input-wrapper">
                    <i class="fas fa-envelope input-icon"></i>
                    <input type="email" name="email" id="email" placeholder="Entrez votre adresse email" required>
                </div>
            </div>
            
            <button type="submit" name="submitBtn" id="">
                <span class="button-text">Envoyer le code de vérification</span>
            </button>
            <?php
                $message = $_SESSION['message'] ?? null;
                $type = $_SESSION['type'] ?? null;
            ?>
            <?php if($message): ?>
                <div id="message" class="message <?= $type; ?>" style="display: block;">
                    <?php echo $message; ?>
                </div>
            <?php endif; ?>
        </form>
        
        <div class="footer">
            <p>En continuant, vous acceptez nos conditions d'utilisation</p>
        </div>
    </div>
    
    <div class="loading-overlay" id="loadingOverlay">
        <div class="loading-content">
            <div class="loading-spinner">
                <div></div>
                <div></div>
                <div></div>
            </div>
            <div class="loading-text">Envoi en cours...</div>
        </div>
    </div>

    <script>
        document.getElementById('emailForm').addEventListener('submit', async (e) => {
            //e.preventDefault();
            
            const email = document.getElementById('email').value;
            const submitBtn = document.getElementById('submitBtn');
            const messageDiv = document.getElementById('message');
            const loadingOverlay = document.getElementById('loadingOverlay');
            
            // Validation basique de l'email
            if (!validateEmail(email)) {
                showMessage('Veuillez entrer une adresse email valide', 'error');
                return;
            }
            
            // Afficher l'animation de chargement
            loadingOverlay.classList.add('active');
            submitBtn.disabled = true;
            
            try {
                // Simuler un délai réseau (à retirer en production)
                await new Promise(resolve => setTimeout(resolve, 2000));
                
                const response = await fetch('controllers/email_c.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({ email }),
                });
                
                const data = await response.json();
                
                if (data.success) {
                    showMessage(data.message, 'success');
                    
                    // Redirection après un délai
                    setTimeout(() => {
                        window.location.href = '/votes/verifiercode';
                    }, 2000);
                } else {
                    showMessage(data.message || 'Erreur lors de l\'envoi de l\'e-mail.', 'error');
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
        
        function validateEmail(email) {
            const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return re.test(email);
        }
        
    </script>
</body>
</html>
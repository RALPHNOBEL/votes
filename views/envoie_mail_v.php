<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>confirmation du mail</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            flex-direction: column;
        }
        h1 {
            color: #333;
            margin-bottom: 20px;
        }
        form {
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        label {
            display: block;
            margin-bottom: 10px;
            color: #555;
            font-weight: bold;
        }
        input[type="email"] {
            width: 100%;
            padding: 12px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-sizing: border-box;
            font-size: 16px;
        }
        button {
            background-color: #007bff;
            color: white;
            padding: 12px 25px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }
        button:hover {
            background-color: #0056b3;
        }
        p {
            margin-top: 15px;
            font-size: 14px;
        }
    </style>
    
</head>
<body>
    <h1>connectez vous</h1>
    <form action="" method="post">
        
        <label for="email">Email :</label>
        <input type="email" name="email" id="email" placeholder="entrez votre mail">
        <button type="submit">Envoyer</button>
     

    </form>
    <script>
      // verifier et envoyer les donnes au backend en api
        document.querySelector('form').addEventListener('submit', async (e) => {
            e.preventDefault();
            const email = document.getElementById('email').value;
            try {
                const response = await fetch('../_classes/Envoie_mail_m.php', { // Remplacez par votre endpoint API
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({ email }),
                });
                const data = await response.json();
                if (response.ok) {
                    alert(data.message);
                    // Rediriger ou afficher un message de succès
                } else {
                    alert(data.error || 'une erreur nous es parvenue a cause de cet email');
                }
            } catch (error) {
                console.error('Erreur:', error);
                alert('Une erreur est survenue. Veuillez réessayer.');
            }
        });
        
    
    </script>

</body>
</html>
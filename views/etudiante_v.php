<!DOCTYPE html>
<html lang="en" >

<head>
    <?php include "views/includes/head.php"; ?>
</head>
<link
    href="https://cdn.jsdelivr.net/npm/daisyui@5"
    rel="stylesheet"
    type="text/css" />
<script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
<link
    href="https://cdn.jsdelivr.net/npm/daisyui@5/themes.css"
    rel="stylesheet"
    type="text/css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<style>
    option {
        width: 50%;

    }

    input,
    select {
        box-shadow: 0 0 5px;
        border: solid black;
        margin: 10px 0;
        box-sizing: border-box;
        width: 30em;
        padding: 8px 5px;
        border-radius: 5px;
        height: 3.1em;
        border: 1px solid var(--color-bg);
        

    }

    .forms {
        justify-content: space-between;
        display: flex;
        margin-left: auto;
        margin-right: auto;

    }
    .for1,.for2{
        margin-left: auto;
        margin-right: auto;

    }





    .boxes-elt form input[type="submit"] {
        background-color: blue;
        color: var(--color-white);
        cursor: pointer;
        height: 40px;
        border: 1px solid var(--color-accent);
        font-size: 18px;
        padding: 5px;
        width: 50%;
    }

    .overview-boxes,
    table {
        width: 90%;
        border-radius: 5px;
        box-shadow: 0 0 5px;
        text-align: center;
        align-items: center;
        margin-left: auto;
        margin-right: auto;
        padding-bottom: 4em;



    }
    .cercle{
        padding-bottom: 2em;
        width: 16%;
        height: 7%;
        border-bottom-right-radius:60px ;
        background-color: blue;
        
    }
    .cercles{
         width: 50%;
        border: 1px solid blue;
         margin-left: auto;
        margin-right: auto;
        background-color: blue;


    }
   

 .box-topic{
    font-size: var(--font-size-large);
    font-weight:bold;
}

 .box .number{
    font-size: 18px;
    font-weight: bold;
}

.home-content .box .cart{
    font-size: 32px;
    height: 50px;
    width: 50px;
    line-height: 50px;
    text-align: center;
    border-radius:5px;
    margin: -15px 0 0 6px;
}

.home-content .box .cart.one{
    background: yellow;
    color: var(--color-cart-one);
}

.home-content .box .cart.two{
    background: var(--color-cart-two-bg);
    color: var(--color-cart-two);
}

.home-content .box .cart.three{
    background: var(--color-cart-three-bg);
    color: var(--color-cart-three);
}

.home-content .box .cart.four{
    background: var(--color-cart-four-bg);
    color: var(--color-cart-four);
}



.box .right-side{
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
}

   
</style>


<body>
    <?php include "views/includes/sidebar.php"; ?>
    <section class="home-section h-screen mx-auto px-3 py-30 ">
        <?php include "views/includes/nav.php"; ?>
        <div class="home-content ">
                <div class="debut">

           <div class="flex w-200 gap-5 mx-auto -p-10">
  <div class="card bg-base-300  grid h-15 grow place-items-center w-5 bg-green">  <div class="box">
                    <div class="right-side">
                        <div class="box-topic">etudiants</div>
                        <div class="number"><?= $nb_etudiantes ?></div>
                    </div>
                    <i class="bx bx-user cart three"></i>
                </div></div>
  <div class="card bg-base-300  grid h-15 grow place-items-center  w-">  <div class="box">
                    <div class="right-side">
                        <div class="box-topic">users supprimer</div>
                        <div class="number">120</div>
                    </div>
                    <i class="bx bx-user cart three"></i>
                </div></div>
  <div class="card bg-base-300  grid h-15 grow place-items-center  w-10">  <div class="box">
                    <div class="right-side">
                        <div class="box-topic">user modifier</div>
                        <div class="number">120</div>
                    </div>
                    <i class="bx bx-user cart three"></i>
                </div></div><br>

</div><br><br>
                </div>

            <div class="overview-boxes boxes-elt">
                <div class="cercle"></div>
                <div class="box">
                    <h1 style="color: blue;">ENREGISTREMENT DES ETUDIANT</h1>
                <div class="cercles"></div><br>

                    <form action="" method="POST" id="myForm">
                        <div class="forms">
                            <div class="for1">
                                <div class="form-group">
                            <i class="fas fa-user mr-2" style="margin-right: 28em;font-size:14px">Etudiante:</i><br>

                                    <input type="text" name="nom_e" value="<?= isset($etudiante) ? $etudiante['nom_e'] : ''  ?>" placeholder="entrez votre nom" required> <br><br>
                                </div>
                                <div class="form-group">
                                    <input type="text" name="prenom_e" value="<?= isset($etudiante) ? $etudiante['prenom_e'] : ''  ?>" placeholder="entrez votre prenom" required><br><br>
                                </div>

                                <input type="email" name="email" value="<?= isset($etudiante) ? $etudiante['email'] : ''  ?>" placeholder="entrez votre email" required><br><br>
                                <div class="form-group">
                                    <input type="date" name="birthdate" value="<?= isset($etudiante) ? $etudiante['birthdate'] : ''  ?>" placeholder="entrez votre birthdate" required><br><br>
                                </div>
                            </div>

                            <div class="for2">

                                <div class="form-group">
                                    <input type="text" name="tel_e" value="<?= isset($etudiante) ? $etudiante['tel_e'] : ''  ?>" placeholder="entrez votre tel" required> <br> <br>
                                </div>
                                <div class="form-group">
                                    <input type="text" name="matricule" value="<?= isset($etudiante) ? $etudiante['matricule'] : ''  ?>" placeholder="entrez votre matrricule" required><br><br>
                                </div>
                                <div class="form-group">
                                    <input type="text" name="filiere" value="<?= isset($etudiante) ? $etudiante['filiere'] : ''  ?>" placeholder="entrez votre filiere" required><br><br>
                                </div>
                                <div class="form-group">
                                    <select name="niveau" required>
                                        <option value="niveau 1">Niveau 1</option>
                                        <option value="niveau 2">Niveau 2</option>
                                        <option value="niveau 3">Niveau 3</option>
                                    </select>
                                </div>
                            </div><br>
                            <br>
                        </div>




                        <div class="form-group">
                            <input type="submit" value="<?= isset($etudiante) ? 'update etudiantes' : 'add etudiantes'  ?>" name="<?= isset($etudiante) ? 'update' : 'add' ?>">
                        </div>

                    </form>
                </div>
            </div><br><br><br>
            <div class="box">
                <table class="table table-xs ">
                    <thead>
                        <tr>
                            <th>numero</th>
                            <th>etudiante name</th>
                            <th>etudiante name</th>
                            <th> email</th>
                            <th>tel</th>
                            <th>matricule</th>
                            <th>filiere</th>
                            <th>birthdate</th>
                            <th>niveau</th>
                            <th>Actions</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($etudiantes as $etudiante): ?>
                            <tr>
                                <td><?= $etudiante['id_e'] ?></td>

                                <td><?= $etudiante['nom_e'] ?></td>
                                <td><?= $etudiante['prenom_e'] ?></td>
                                <td><?= $etudiante['email'] ?></td>
                                <td><?= $etudiante['tel_e'] ?></td>
                                <td><?= $etudiante['matricule'] ?></td>
                                <td><?= $etudiante['filiere'] ?></td>
                                <td><?= $etudiante['birthdate'] ?></td>
                                <td><?= $etudiante['niveau'] ?></td>
                                <td>
                                    <a href="<?= PATH ?>etudiante?edit=<?= $etudiante['id_e'] ?>" class="btn btn-edit">Edit</a>
                                    <a href="<?= PATH ?>etudiante?delete=<?= $etudiante['id_e'] ?>" class="btn btn-delete">Delete</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        <div class="overflow-x-auto">


                        </div>
                    </tbody>
                </table>
            </div>
        </div>
        </div>
    </section>
    <script src="<?= PATH ?>assets/js/script.js"></script>
    <script>
        document.getElementById("myForm").addEventListener("submit", function(event) {
            let valid = true;
            //verification du nom
            const nom = document.getElementById("nom");
            if (nom.value.trim() === "") {
                document.getElementById("errorNom").style.display = "block";
                valid = false;
            } else {
                document.getElementById("errorNom").style.dispaly = "none";
            }
            //VERIFICATION DU PRENOM
            const prenom = document.getElementById("prenom");
            if (prenom.value.trim() === "") {
                document.getElementById("errorprenomNom").style.display = "block";
                valid = false;
            } else {
                document.getElementById("errorprenomNom").style.dispaly = "none";
            }
            //VERIFICATION DU email

            const email = document.getElementById("email");
            if (prenom.value.trim() === "") {
                document.getElementById("erroremail").style.display = "block";
                valid = false;
            } else {
                document.getElementById("erroremail").style.dispaly = "none";
            }
            const filiere = document.getElementById("filiere");
            if (prenom.value.trim() === "") {
                document.getElementById("errorfiliere").style.display = "block";
                valid = false;
            } else {
                document.getElementById("errorfiliere").style.dispaly = "none";
            }
            const tel = document.getElementById("tel");
            if (prenom.value.trim() === "") {
                document.getElementById("errorprenomNom").style.display = "block";
                valid = false;
            } else {
                document.getElementById("errorprenomNom").style.dispaly = "none";
            }
            const birthdate = document.getElementById("bithdate");
            if (prenom.value.trim() === "") {
                document.getElementById("errorprenomNom").style.display = "block";
                valid = false;
            } else {
                document.getElementById("errorprenomNom").style.dispaly = "none";
            }
            const matricule = document.getElementById("matricule");
            if (prenom.value.trim() === "") {
                document.getElementById("errorprenomNom").style.display = "block";
                valid = false;
            } else {
                document.getElementById("errorprenomNom").style.dispaly = "none";
            }
        })
    </script>
</body>

</html>
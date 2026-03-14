<!DOCTYPE html>
<html lang="en">

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
        width: 25em;
        padding: 8px 5px;
        border-radius: 5px;
        height: 3.1em;
        border: 1px solid var(--color-bg);


    }






    .boxes-elt form input[type="submit"] {
        background-color: blue;
        color: var(--color-white);
        cursor: pointer;
        height: 38px;
        border: 1px solid var(--color-accent);
        font-size: 16px;
        padding: 5px;
    }

    form,
    table {
        width: 90%;
        border-radius: 5px;
        box-shadow: 0 0 5px;
        text-align: center;
        align-items: center;
        margin-left: auto;
        margin-right: auto;
        padding: 2em;
    }

    .cercles {
        width: 50%;
        border: 1px solid blue;
        margin-left: auto;
        margin-right: auto;
        background-color: blue;


    }

    .cercle {
        padding-bottom: 2em;
        width: 16%;
        height: 7%;
        border-bottom-right-radius: 60px;
        background-color: blue;

    }
    .container{
        display: flex;
        justify-content: space-around;
    }
</style>

<body>
    <?php include "views/includes/sidebar.php"; ?>
    <section class="home-section h-screen mx-auto px-3 py-30">
        <?php include "views/includes/nav.php"; ?>
        <div class="home-content ">
            <div class="overview-boxes boxes-elt">
                <div class="container">
                    <div class="box1">
                        <form action="" method="POST" style="  width: 86%; margin-left: 5em;">
                            <div class="cercle"></div>

                            <h1 style="color:blue ;">ENREGISTREMENT DES CANDIDATS</h1>
                            <div class="cercles"></div><br>


                            <div class="form-group">
                                <select name="id_e" id="id_e">
                                    <option value="">slectionner le candidat</option>
                                    <?php foreach ($etudiantes_niveau1 as $etudiante): ?>
                                        <option value="<?= $etudiante['id_e']; ?>">
                                            <?= $etudiante['nom_e']; ?>
                                            <?= $etudiante['prenom_e']; ?>



                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div><br><br>

                            <div class="form-group">
                                <input type="text" name="description" value="<?= isset($candidate) ? $candidate['description'] : ''  ?>" placeholder="entrez la description"   required>
                            </div><br><br>






                            <div class="form-group">
                                <input type="submit" value="<?= isset($candidate) ? 'update candidates' : 'add candidates'  ?>" name="<?= isset($candidate) ? 'update' : 'add' ?>">

                            </div>

                        </form>
                    </div>

                    <div class="flex w-100 gap-5 mx-auto -p-10" >

                        <div class="card bg-base-300  grid h-15 grow place-items-center w-5 bg-green" >
                            <div class="box">
                                <div class="right-side">
                                    <div class="box-topic">Candidates</div>
                                    <div class="number " style="text-align: center;"><?= $nb_candidates?></div>
                                </div>
                                <i class="bx bx-user cart three"></i>
                            </div><br>
                                              <h3 class="text-xl font-bold mb-4" style="text-align: center;">
                    <i class="fas fa-chart-line mr-2 text-blue-600"></i>
                    Évolution des candidats
                </h3>
                        </div>
                    </div>
                </div><br><br><br>

                <div class="box">
                    <table class="table">
                        <thead>
                            <tr>

                                <th> NOM</th>

                                <th>DESCRIPTION</th>
                                <th>Actions</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($candidates as $candidate): ?>
                                <tr>
                                    <td><?= $candidate['nom_e'] ?></td>

                                    <td><?= $candidate['description'] ?></td>

                                    <td>
                                        <a href="<?= PATH ?>candidate?edit=<?= $candidate['id_c'] ?>" class="btn btn-edit">Edit</a>
                                        <a href="<?= PATH ?>candidate?delete=<?= $candidate['id_c'] ?>" class="btn btn-delete">Delete</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
    <script src="<?= PATH ?>assets/js/script.js"></script>
</body>

</html>
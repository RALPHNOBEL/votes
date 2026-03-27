<!DOCTYPE html>
<html lang="fr">
<head>
    <?php include "views/includes/head.php"; ?>
</head>
<body>
    <?php include "views/includes/sidebar.php"; ?>
    <section class="home-section mx-auto px-3 py-30">
        <?php include "views/includes/nav.php"; ?>
        <div class="home-content">
            <div class="overview-boxes boxes-elt">
                <div class="box" style="max-width: 600px; margin: 2em auto; padding: 2em; border-radius: 12px; box-shadow: 0 0 15px rgba(0,0,0,0.1);">
                    
                    <h2 style="color: #4f46e5; text-align: center; margin-bottom: 1.5em; font-size: 22px; font-weight: 700;">
                        <i class="fas fa-calendar-alt"></i> Planification de l'Élection
                    </h2>

                    <?php if(isset($success)): ?>
                        <div style="background:#d4edda; color:#155724; padding:12px; border-radius:8px; margin-bottom:1em; text-align:center;">
                            <i class="fas fa-check-circle"></i> <?= $success ?>
                        </div>
                    <?php endif; ?>

                    <?php if(isset($error)): ?>
                        <div style="background:#f8d7da; color:#721c24; padding:12px; border-radius:8px; margin-bottom:1em; text-align:center;">
                            <i class="fas fa-exclamation-circle"></i> <?= $error ?>
                        </div>
                    <?php endif; ?>

                    <form action="" method="POST">
                        
                        <div style="margin-bottom: 1.5em;">
                            <label style="display:block; font-weight:600; margin-bottom:6px; color:#444;">
                                <i class="fas fa-heading"></i> Titre de l'élection
                            </label>
                            <input type="text" name="title" placeholder="Ex: Élection du délégué 2025"
                                value="<?= isset($election) ? $election['title'] : '' ?>"
                                style="width:100%; padding:10px; border:1px solid #ddd; border-radius:8px; font-size:15px;" required>
                        </div>

                        <div style="margin-bottom: 1.5em;">
                            <label style="display:block; font-weight:600; margin-bottom:6px; color:#444;">
                                <i class="fas fa-align-left"></i> Description
                            </label>
                            <input type="text" name="description" placeholder="Description de l'élection"
                                value="<?= isset($election) ? $election['description'] : '' ?>"
                                style="width:100%; padding:10px; border:1px solid #ddd; border-radius:8px; font-size:15px;" required>
                        </div>

                        <div style="display:flex; gap:1em; margin-bottom:1.5em;">
                            <div style="flex:1;">
                                <label style="display:block; font-weight:600; margin-bottom:6px; color:#444;">
                                    <i class="fas fa-calendar"></i> Date d'ouverture
                                </label>
                                <input type="date" name="start_date"
                                    value="<?= isset($election) ? $election['start_date'] : '' ?>"
                                    style="width:100%; padding:10px; border:1px solid #ddd; border-radius:8px; font-size:15px;" required>
                            </div>
                            <div style="flex:1;">
                                <label style="display:block; font-weight:600; margin-bottom:6px; color:#444;">
                                    <i class="fas fa-clock"></i> Heure d'ouverture
                                </label>
                                <input type="time" name="start_time"
                                    value="<?= isset($election) ? $election['start_time'] : '' ?>"
                                    style="width:100%; padding:10px; border:1px solid #ddd; border-radius:8px; font-size:15px;" required>
                            </div>
                        </div>

                        <div style="display:flex; gap:1em; margin-bottom:1.5em;">
                            <div style="flex:1;">
                                <label style="display:block; font-weight:600; margin-bottom:6px; color:#444;">
                                    <i class="fas fa-calendar-times"></i> Date de clôture
                                </label>
                                <input type="date" name="end_date"
                                    value="<?= isset($election) ? $election['end_date'] : '' ?>"
                                    style="width:100%; padding:10px; border:1px solid #ddd; border-radius:8px; font-size:15px;" required>
                            </div>
                            <div style="flex:1;">
                                <label style="display:block; font-weight:600; margin-bottom:6px; color:#444;">
                                    <i class="fas fa-clock"></i> Heure de clôture
                                </label>
                                <input type="time" name="end_time"
                                    value="<?= isset($election) ? $election['end_time'] : '' ?>"
                                    style="width:100%; padding:10px; border:1px solid #ddd; border-radius:8px; font-size:15px;" required>
                            </div>
                        </div>

                        <div style="margin-bottom: 1.5em;">
                            <label style="display:block; font-weight:600; margin-bottom:6px; color:#444;">
                                <i class="fas fa-info-circle"></i> Statut
                            </label>
                            <select name="status" style="width:100%; padding:10px; border:1px solid #ddd; border-radius:8px; font-size:15px;" required>
                                <option value="">Sélectionner un statut</option>
                                <option value="ouvert" <?= (isset($election) && $election['status'] == 'ouvert') ? 'selected' : '' ?>>Ouvert</option>
                                <option value="fermé" <?= (isset($election) && $election['status'] == 'fermé') ? 'selected' : '' ?>>Fermé</option>
                                <option value="en attente" <?= (isset($election) && $election['status'] == 'en attente') ? 'selected' : '' ?>>En attente</option>
                            </select>
                        </div>

                        <button type="submit" name="<?= isset($election) ? 'update' : 'save' ?>"
                            style="width:100%; padding:14px; background:linear-gradient(135deg, #4f46e5, #7c3aed); color:white; border:none; border-radius:8px; font-size:16px; font-weight:600; cursor:pointer;">
                            <i class="fas fa-save"></i> <?= isset($election) ? 'Mettre à jour' : 'Enregistrer' ?>
                        </button>
                    </form>

                    <?php if(!empty($elections)): ?>
                    <br><br>
                    <h3 style="color:#4f46e5; font-weight:700; margin-bottom:1em;">
                        <i class="fas fa-list"></i> Élections enregistrées
                    </h3>
                    <table style="width:100%; border-collapse:collapse;">
                        <thead>
                            <tr style="background:#4f46e5; color:white;">
                                <th style="padding:10px;">Titre</th>
                                <th style="padding:10px;">Ouverture</th>
                                <th style="padding:10px;">Clôture</th>
                                <th style="padding:10px;">Statut</th>
                                <th style="padding:10px;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($elections as $el): ?>
                            <tr style="border-bottom:1px solid #eee; text-align:center;">
                                <td style="padding:10px;"><?= $el['title'] ?></td>
                                <td style="padding:10px;"><?= $el['start_date'] ?> <?= $el['start_time'] ?></td>
                                <td style="padding:10px;"><?= $el['end_date'] ?> <?= $el['end_time'] ?></td>
                                <td style="padding:10px;">
                                    <span style="background:<?= $el['status'] == 'ouvert' ? '#d4edda; color:#155724' : ($el['status'] == 'fermé' ? '#f8d7da; color:#721c24' : '#fff3cd; color:#856404') ?>; padding:4px 10px; border-radius:20px; font-size:13px;">
                                        <?= $el['status'] ?>
                                    </span>
                                </td>
                                <td style="padding:10px;">
                                    <a href="?edit=<?= $el['id_el'] ?>" style="color:#4f46e5; margin-right:10px;"><i class="fas fa-edit"></i></a>
                                    <a href="?delete=<?= $el['id_el'] ?>" style="color:#dc3545;" onclick="return confirm('Supprimer cette élection ?')"><i class="fas fa-trash"></i></a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <?php endif; ?>

                </div>
            </div>
        </div>
    </section>
    <script src="<?= PATH ?>assets/js/script.js"></script>
</body>
</html>
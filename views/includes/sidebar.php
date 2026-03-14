  <div class="navbar bg-white shadow-lg fixed top-0 z-50">
        <div class="navbar-start ">
            <div class="dropdown">
                <div  tabindex="0" role="button" class="btn btn-ghost lg:hidden">
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
          
            <a class="btn btn-ghost text-xl font-bold">
                <i class="fas fa-tachometer-alt mr-2 text-blue-600"></i>
                Dashboard Admin
            </a>
            
       
        
        </div>
                  <div class="navbar-center hidden lg:flex">
            <ul class="menu menu-horizontal px-1">
                <li><a href="<?= PATH ?>dashboard" class="active">Dashboard</a></li>
                <li><a href="<?= PATH ?>candidate">Candidats</a></li>
                <li><a href="<?= PATH ?>etudiante">Électeurs</a></li>
                <li><a href="<?= PATH ?>vote">Votes</a></li>
                <li><a href="<?= PATH ?>parametre">Paramètres</a></li>
            </ul>
        </div>
        <div class="navbar-end">
            <div class="dropdown dropdown-end">
                <div tabindex="0" role="button" class="btn btn-ghost btn-circle avatar">
                    <div class="w-10 rounded-full bg-blue-600 flex items-center justify-center">
                        <i class="fas fa-user text-white"></i>
                    </div>
                </div>
                <ul tabindex="0" class="menu menu-sm dropdown-content mt-3 z-[1] p-2 shadow bg-base-100 rounded-box w-52">
                    <li><a href="logout"><i class="fas fa-sign-out-alt mr-2"></i>Déconnexion</a></li>
                    <li><a href="parametre"><i class="fas fa-sign-out-alt mr-2"></i>Paremetre</a></li>

                </ul>
            </div>
        </div>


    </div>
     
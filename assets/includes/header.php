<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Ehos</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div id="toggletheme" class="mx-3">
                <span id="light-mode-icon" style="display: none;">
                <?php include('../assets/svg/light_mode.svg'); ?>
                </span>
                <span id="dark-mode-icon">
                <?php include('../assets/svg/dark_mode.svg'); ?>
                </span>
            </div>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="../assets/php/logout.php">Sair</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
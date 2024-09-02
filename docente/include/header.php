<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="../styles/main.css">

    <title>Sistema Escolar</title>
</head>
<body class="app sidebar-mini">
    <header class="app-header"><a class="app-header__logo" href="index.html">Sistema Escolar</a>
        <a class="app-sidebar__toggle" href="#" data-toggle="sidebar" aria-label="Hide Sidebar"></a>
        <!-- Navbar Right Menu-->
        <ul class="app-nav">
            <li class="app-search">
            <input class="app-search__input" type="search" placeholder="Search">
            <button class="app-search__button"><i class="bi bi-list"></i></button>
            </li>
            <!-- User Menu-->
            <li class="dropdown"><a class="app-nav__item" href="#" data-bs-toggle="dropdown" aria-label="Open Profile Menu"><i class="bi bi-person fs-4"></i></a>
                <ul class="dropdown-menu settings-menu dropdown-menu-right">
                    <li><a class="dropdown-item" href="page-user.html"><i class="bi bi-gear me-2 fs-5"></i> Settings</a></li>
                    <li><a class="dropdown-item" href="page-user.html"><i class="bi bi-person me-2 fs-5"></i> Profile</a></li>
                    <li><a class="dropdown-item" href="page-login.html"><i class="bi bi-box-arrow-right me-2 fs-5"></i> Logout</a></li>
                </ul>
            </li>
        </ul>
    </header>
    <?php 

    require_once "nav.php"
    
    ?>
</body>
</html>
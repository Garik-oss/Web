
<!-- Navigation Bar -->
<nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container">
        <a class="navbar-brand" href="#">My Website</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="home.php">Home</a>
                </li>
                <?php 
                    if (!isset($_SESSION['user'])) {
                        echo "<li class='nav-item'>
                                <a class='nav-link' href='registration.php'>Registration</a>
                                </li>
                                <li class='nav-item'>
                                    <a class='nav-link' href='login.php'>Login</a>
                            </li>";
                    } else {
                        echo "
                                <li class='nav-item'>
                                    <a class='nav-link' href='logout.php'>Logout</a>
                            </li>";
                    }
                    
                ?>
                
            </ul>
        </div>
    </div>
</nav>
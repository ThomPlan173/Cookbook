<footer>

    <div class="footer">

        <?php if(!isset($_SESSION['login'])): ?>
            <button class="button_footer" id="login" onclick="window.location.href = '/Projet_Recettes/pages/login.php';"><h1>Admin</h1></button>
        <?php else:?>
            <button class="button_footer" id="logout" onclick="window.location.href = '/Projet_Recettes/pages/logout.php';"><h1>Logout</h1></button>
        <?php endif;?>

        <span id="copyright"> <a>Copyright</a> © 2023 Constant Clément, Plantefève Thomas, Peron Alexandre.</span>

    </div>

</footer>




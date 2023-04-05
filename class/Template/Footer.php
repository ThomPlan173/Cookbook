<footer>

    <div class="footer">
        <span id="copyright"> <a>Copyright</a> © 2023 Constant Clément, Plantefève Thomas, Peron Alexandre. <br>
            src
        </span>
        <?php if(!isset($_SESSION['login'])): ?>
            <button class="button_footer" onclick="window.location.href = '/Projet_Recettes/pages/login.php';"><h1>Admin</h1></button>
        <?php else:?>
            <button class="button_footer" onclick="window.location.href = '/Projet_Recettes/pages/logout.php';"><h1>Logout</h1></button>
        <?php endif;?>
    </div>

</footer>




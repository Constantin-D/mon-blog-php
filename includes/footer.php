</main>
<footer class="site-footer">
    <div class="container">
        <div class="footer-content">
            <p>&copy; <?php echo date('Y'); ?> - Mon Blog PHP. Tous droits réservés.</p>
            <div class="footer-links">
                <a href="<?php echo $rootPath ?? ''; ?>/index.php">Accueil</a>
                <span class="separator">•</span>
                <a href="<?php echo $rootPath ?? ''; ?>/about.php">À propos</a>
                <span class="separator">•</span>
                <a href="<?php echo $rootPath ?? ''; ?>/contact.php">Contact</a>
                <span class="separator">•</span>
                <a href="<?php echo $rootPath ?? ''; ?>/privacy.php">Confidentialité</a>
            </div>
            <p class="footer-tech">Développé en PHP</p>
        </div>
    </div>
</footer>
</body>

</html>
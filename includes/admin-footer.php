<?php
/**
 * Admin-specific footer inclusion
 * This file contains only the necessary scripts and closing tags for the admin layout,
 * without the visual footer element.
 */
?>
    </div> <!-- End Container -->

    <?php if (isLoggedIn() && isAdmin()): ?>
        </div> <!-- End Admin Main Content -->
    <?php endif; ?>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Custom JS -->
    <script src="<?php echo base_url('assets/js/validation.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/script.js'); ?>"></script>
</body>
</html>

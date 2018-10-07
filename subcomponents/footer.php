
<?php
if (isset($_SESSION['username']) && $_SESSION['rol'] != 'Administrador'){
  include 'chat.php';
}
?>
    <footer class="footer"></footer>
  </body>
</html>

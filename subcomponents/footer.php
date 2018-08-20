
    <!-- <footer class="footer">
      <div class="container">
        <span class="text-muted">Place sticky footer content here.</span>
      </div>
    </footer> -->
    <?php
    if (isset($_SESSION['username'])){
      include 'chat.php';
    } ?>
  </body>
</html>

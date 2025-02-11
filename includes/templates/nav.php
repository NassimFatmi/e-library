<header class="header-nav">
  <nav class="nav-bar">
    <div class="nav-mobile">
      <h2 class="nav-title"><a href="<?php echo $navLinks['home'] ?>">Library.<span>fr</span></a></h2>
      <button id="nav-button"><i class="fa fa-bars fa-2x"></i></button>
    </div>
    <ul class="nav-links" id="nav-menu">
      <li>
        <a href="<?php echo $navLinks['home'] ?>"
          class="<?php echo $pageName == $navLinks['home'] ? "active":"" ?>">Acceuil<i class="fa fa-home"></i></a>
      </li>
      <?php if ($_SESSION['is_active'] == 0) : ?>
      <li>
        <a href="<?php echo $navLinks['loan'] ?>" class="<?php echo $pageName == $navLinks['loan'] ? "active":"" ?>">Mes
          Livres<i class="fa fa-book-dead"></i></a>
      </li>
      <?php endif; ?>
      <li>
        <a href="<?php echo $navLinks['book'] ?>"
          class="<?php echo $pageName == $navLinks['book'] ? "active":"" ?>">Livres<i class="fa fa-book-reader"></i></a>
      </li>
      <?php if ($_SESSION['is_admin'] == 0) : ?>
      <li>
        <a href="<?php echo $navLinks['admin_book'] ?>"
          class="<?php echo $pageName == $navLinks['admin_book'] ? "active":"" ?>">Gestion des livres<i
            class="fa fa-book"></i></a>
      </li>
      <li>
        <a href="<?php echo $navLinks['admin_user'] ?>"
          class="<?php echo $pageName == $navLinks['admin_user'] ? "active":"" ?>">Gestion des utilisateurs<i
            class="fa fa-user-friends"></i></a>
      </li>
      <?php endif; ?>
      <li class="sub-nav">
        <button id="sub-nav-button"><?php echo $_SESSION['name'] ?><i class="fa fa-arrow-alt-circle-down"></i></button>
        <ul id="sub-nav-menu">
          <li><a href="<?php echo $navLinks['profile'] ?>">Profile<i class="fa fa-user-circle"></i></a></li>
          <li><a href="<?php echo $navLinks['logout'] ?>">Logout <i class="fa fa-sign-out-alt"></i></a></li>
        </ul>
      </li>
    </ul>
  </nav>
</header>

<?php if ($_SESSION['is_active'] == 1) : ?>
<div class="modal" id="modal">
  <div>
    <i class="fa fa-bell fa-5x"></i>
  </div>
  <p>Veuillez attendre l'activation de votre compte par l'admin</p>
  <button id="closeModal">Got it!</button>
</div>
<?php else: ?>
<?php 
    $stmt = $con->prepare("SELECT count(*) AS count FROM `borrow` WHERE user_id=:user_id AND expires_at <= CURRENT_TIMESTAMP");
    $stmt->bindParam(':user_id', $_SESSION["id"]);
    $stmt->execute();
    $count = $stmt->fetch(PDO::FETCH_OBJ)->count;

    if($count > 0):
?>
<div class="modal" id="modal">
  <div>
    <i class="fa fa-bell fa-5x"></i>
  </div>
  <p>Vous avez <?php echo $count?> Livres à nous rendre </p>
  <button id="closeModal">Got it!</button>
</div>
<?php  endif;endif; ?>
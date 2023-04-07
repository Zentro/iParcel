<?php 
defined('IN_APP') or exit('This file cannot be accessed directly.'); 

if (!empty($_SESSION["user"])) {
    $uid = $_SESSION["user"];

    $stmt = $dbConn->prepare("SELECT email_confirmed FROM users WHERE user_id= :user_id");
    $stmt->bindParam(":user_id", $uid);
    $stmt->execute();
    $u = $stmt->fetch();
}
?>
<?php if (!empty($_SESSION["user"])) : ?>
    <?php if ($u["email_confirmed"] == 0) : ?>
        <div class="alert alert-warning" role="alert">
            <i class="bi bi-exclamation-triangle-fill"></i>
            To use your account, you need to confirm the email address on your account. An email with an activation link has already been sent to you.
        </div>
    <?php endif; ?>
<?php endif; ?>
<?php
?>
<form action="<?php echo esc_url( $_SERVER['REQUEST_URI'] ); ?>" method="post">
    <p>
        First Name (required) <br />
        <input type="text" name="cf-first-name" pattern="[a-zA-Zа-яА-Я]+" value="<?php echo isset($_POST["cf-first-name"]) ? esc_attr($_POST["cf-first-name"]) : ''; ?>" size="40" />
    </p>
    <p>
        Last Name (required) <br />
        <input type="text" name="cf-last-name" pattern="[a-zA-Zа-яА-Я]+" value="<?php echo isset($_POST["cf-last-name"]) ? esc_attr($_POST["cf-last-name"]) : ''; ?>" size="40" />
    </p>
    <p>
        Subject (required) <br />
        <input type="text" name="cf-subject" value="<?php echo isset($_POST["cf-subject"]) ? esc_attr($_POST["cf-subject"]) : ''; ?>" size="40" />
    </p>
    <p>
        Message (required) <br />
        <textarea name="cf-message"><?php echo isset($_POST["cf-message"]) ? esc_textarea($_POST["cf-message"]) : ''; ?></textarea>
    </p>
    <p>
        Email (required) <br />
        <input type="email" name="cf-email" value="<?php echo isset($_POST["cf-email"]) ? esc_attr($_POST["cf-email"]) : ''; ?>" size="40" />
    </p>
    <p><input type="submit" name="cf-submitted" value="Send"></p>
</form>

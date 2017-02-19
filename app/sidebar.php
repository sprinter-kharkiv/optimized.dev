<section class="sidebar">
    <div class="login_form">
        <form action="" method="get" class="<?= $login_hidd ?>">
            <fieldset>
                <input type="text" name="user_name">
                <input type="password" name="user_password">
            </fieldset>
            <input type="submit" value="login">
        </form>
        <h3><?php
            if (isset($current_user) && $current_user !== '') {
                echo "Login as:" . $current_user;
            } else {
                echo '<a href="">link for registration</a>';
            };
            ?></h3>

        <form action="" method="get">
            <input type="text" name="logout" value="yes" hidden>
            <input type="submit" value="logout" class="<?= $logout_hidd ?>">
        </form>


    </div>
    <ul class="sidebar_menu">
        <li>menu item 1</li>
        <li>menu item 2</li>
        <li>menu item 3</li>
    </ul>
</section>
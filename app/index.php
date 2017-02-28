<?php
require "header.php";

/*--------------------
    login / logout
--------------------*/

$_SESSION['user'] = "alex";

$user = isset($_GET['user_name']) ? $_GET['user_name'] : null;
$logout = isset($_GET['logout']) ? $_GET['logout'] : null;

if ($user) {
    file_put_contents('user.txt', $user);
} elseif ($logout === 'yes') {
    file_put_contents('user.txt', '');
}
$current_user = file_get_contents('user.txt');


if (isset($current_user) && $current_user !== '') {
    $logout_hidd = 'visible';
    $login_hidd = 'hidden';
    $post_access = '';
} else {
    $logout_hidd = 'hidden';
    $login_hidd = 'visible';
    $post_access = 'disabled';
};

require "sidebar.php";
/*--------------------
    posts
--------------------*/
$data_base = "DB.txt";
$current_posts = array();
if (file_get_contents($data_base) != "") {
    $current_json_data = file_get_contents($data_base);
    $current_posts = json_decode($current_json_data, true);
}

if (!empty($_GET['post_title']) && !empty($_GET['post_text'])) {
    $new_post = array(
        'title' => htmlspecialchars($_GET['post_title']),
        'text' => htmlspecialchars($_GET['post_text']),
        'author' => $current_user,
    );
};
$new_post_title = '';
$new_post_title = $new_post['title'];

$refresh = array();
foreach ($current_posts as $key => $val) {
    if (in_array($new_post_title, $val)) {
        $refresh[] = 0;
    } else {
        $refresh[] = 1;
    }
};

if (!in_array(0, $refresh) && $new_post_title != '') {
    $current_posts[] = $new_post;
    $json_date = json_encode($current_posts);
    file_put_contents($data_base, $json_date);
};


$count_posts = count($current_posts);
?>
<pre>
    <?php
    //echo count($current_posts);
    echo $current_user;
    echo $_SESSION['user'];

    ?>
</pre>
<div class="content">
    <div class="posts_block">
        <form method="GET" class="add_posts_form">
            <input type="text" name="post_title">
            <textarea name="post_text"></textarea>
            <input type="submit" value="add post" <?= $post_access ?>>
        </form>
    </div>
    <?php for ($i = 0; $i < $count_posts; $i++) {

        require "post_block.php";
    } ?>
</div>


<?php
require "footer.php" ?>




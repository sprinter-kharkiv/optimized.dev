<?php
require "header.php";
require "sidebar.php";

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
        'author' => htmlspecialchars($_GET['post_title'])
    );
    $new_post_title = $new_post['title'];
    $refresh = 1;
    foreach ($current_posts as $key => $val) {
        if ($val === $new_post_title) {
        	$refresh = 0;
            break;
        }
    };
    if ($refresh === 1){
		$current_posts[] = $new_post;
	};
    $json_date = json_encode($current_posts);
    file_put_contents($data_base, $json_date);
};

$count_posts = count($current_posts);
?>
<pre>
    <?php
    echo count($current_posts);
    ?>
</pre>
<div class="content">
    <div>
        <form method="GET" class="add_posts_form">
            <input type="text" name="post_title">
            <textarea name="post_text"></textarea>
            <input type="submit" value="add post">
        </form>
    </div>
    <?php for ($i = 0; $i < $count_posts; $i++) {

        require "post_block.php";
    } ?>
</div>


<?php
require "footer.php" ?>




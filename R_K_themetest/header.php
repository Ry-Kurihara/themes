
<!DOCTYPE html><!--htmlで書かれていることを宣言-->
<html lang="ja"><!--日本語のサイトであることを指定-->
<head prefix="og: http://ogp.me/ns#"><!--prefixはSNS用-->
  <meta property="og:site_name" content="<?php bloginfo( 'name' ); ?>">
<meta property="og:locale" content="ja_JP">

<meta charset="utf-8"><!--エンコードがUTF-8であることを指定-->
<meta name="viewport"
content="width=device-width, initial-scale=1.0 "><!--viewportの設定-->
<link rel="stylesheet" href="<?php echo get_stylesheet_uri(); ?>"><!--スタイルシートの呼び出し-->
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous"><!--font-awesomeのスタイルシートの呼び出し-->

<!-- 検索エンジン用にメタデータを記述-->
<?php if(is_tag() || is_date() || is_search() || is_404()) : ?>
  <meta name="robots" content="noindex" />
<?php endif; ?>
<!--個別ページのメタデータ出力-->
<?php if( is_single() || is_page() ) : ?>
  <?php setup_postdata($post) ?>
  <meta name="description" content="<?php echo strip_tags( get_the_excerpt() );?>"/>
  <?php if(has_tag()): ?>
    <?php $tags = get_the_tags();
    $kwds = array();
    foreach($tags as $tag){
      $kwds[] = $tag->name;
    } ?>
    <meta name="keywords" content="<?php echo implode( ',', $kwds ); ?>">
  <?php endif; ?>
  <!--OGPタグ-->
  <meta property="og:type" content="article">
  <meta property="og:title" content="<?php the_title(); ?>">
  <meta property="og:url" content="<?php the_permalink(); ?>">
  <meta property="og:description" content="<?php echo strip_tags( get_the_excerpt() ); ?>">
  <?php if( has_post_thumbnail() ): ?>
    <?php $postthumb = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large' ); ?>
    <meta property="og:image" content="<?php echo $postthumb[0]; ?>">
  <?php endif; ?>

<!--個別ページ以外のメタデータ出力-->
<?php else: ?>
  <meta name="description" content="<?php bloginfo( 'description' ); ?>">
  <?php $allcats = get_categories();
  $kwds = array();
  foreach($allcats as $allcat) {
    $kwds[] = $allcat->name;
  } ?>
  <meta name="keywords" content="<?php echo implode( ',',$kwds ); ?>">
  <!--OGPタグ-->
  <meta property="og:type" content="website">
  <meta property="og:title" content="<?php bloginfo( 'name' ); ?>">
  <?php
  $http = is_ssl() ? 'https' . '://' : 'http' . '://';
  $url = $http . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
  ?>
  <meta property="og:url" content="<?php echo $url; ?>">
  <meta property="og:description" content="<?php bloginfo( 'description' ) ?>">
  <meta property="og:image" content="表示したい画像のパス">
<?php endif; ?>

<?php wp_head(); ?><!--システム・プラグイン用-->
</head>
<body <?php body_class(); ?>>
<header>
<div class="header-inner">
  <!--タイトルを画像で表示する-->
  <div class="site-title">
    <h1><a href="<?php echo home_url() ?>">
    <img src="<?php echo get_template_directory_uri(); ?>/images/1170-200headerサンプル1.jpg" alt="<?php bloginfo('name'); ?>" />
  </a></h1>
  </div>
  <!-- スマホ用メニューボタン-->
  <button type="button" id="navbutton">
    <i class="fas fa-list-ul"></i><
  </button>
</div>

<div class="nav-container">
  <!--ヘッダーメニュー、引数に配列（キー=>値）-->
  <?php wp_nav_menu( array(
    'theme_lacation' => 'header-nav',
    'container' => 'nav',
    'container_class' => 'header-nav',
    'container_id' => 'header-nav',
    'fallback_cb' => ''
  )); ?>
</div>

</header>

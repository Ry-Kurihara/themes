<?php get_header(); ?>
<div class="backcolor">
<div class="container">
  <div class="contents">

    <?php if(have_posts()): the_post(); ?>
<article <?php post_class( 'kiji' ); ?>>
  <!--投稿日・著者を表示-->
  <div class="kiji-info">
    <!--投稿日を取得-->
    <span class="kiji-date">
      <i class="fas fa-pencil-alt"></i>
      <time
      datetime="<?php echo get_the_date( 'Y-m-d' ); ?>">
      <?php echo get_the_date(); ?>
      </time>
    </span>
    <!--カテゴリ取得-->
    <?php if(has_category() ): ?>
    <span class="cat-data">
      <?php echo get_the_category_list( ' ' ); ?>
    </span>
    <?php endif; ?>
  </div>
  <!--タイトル-->
  <h1><?php the_title(); ?></h1>
  <!--アイキャッチ取得-->
  <div class="kiji-img">
  <?php if( has_post_thumbnail() ): ?>
    <?php the_post_thumbnail( 'large' ); ?>
  <!--アイキャッチ画像がない場合-->
  <?php else: ?>
     <img src="<?php echo get_template_directory_uri(); ?>/images/wordpress_lg.png" alt="NO_IMAGE" />
  <?php endif; ?>
  </div>
  <!--本文取得-->
  <?php the_content(); ?>
  <!--タグ-->
  <div class="kiji-tag">
    <?php the_tags('<ul><li>タグ： </li><li>','</li><li>','</li></ul>'
  ); ?>
  </div>
</article>
<?php endif; ?>

  </div>
  <?php get_sidebar(); ?>
</div>
</div><!--backcolor-->
<?php get_footer(); ?>

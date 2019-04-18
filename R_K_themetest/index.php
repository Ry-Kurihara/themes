<?php get_header(); ?>
<div class="backcolor">
<div class="container">
<div class="contents">

<!--plusersステップ5*/-->
<!--カテゴリタイトル-->
<?php if(is_category() || is_tag()): ?>
<h1><?php single_cat_title() ?>の記事一覧</h1>
<?php elseif(is_year()): ?>
<h1><?php the_time("Y年") ?>の記事一覧</h1>
<?php elseif(is_month()): ?>
<h1><?php the_time("Y年m月") ?>の記事一覧</h1>
<?php endif; ?>
<!--通常ループ-->
<?php if(have_posts()): while(have_posts()): the_post(); ?>
<article <?php post_class( 'kiji-list' ); ?>>
  <a href="<?php the_permalink(); ?>">
    <!--画像を追加-->
    <div class="indeximg"><!--atuweb見た目調整-->
      <?php if( has_post_thumbnail() ): ?>
        <?php the_post_thumbnail('thumbnail'); ?>
      <?php else: ?>
        <img src="<?php echo get_template_directory_uri(); ?>/images/wordpress_lg.png" alt="no-img"/>
      <?php endif; ?>
    </div>
    <div class="text">
      <!--投稿日を表示-->
      <span class="kiji-date">
        <i class="fas fa-pencil-alt"></i>
        <time datetime="<?php echo get_the_date( 'Y-m-d' ); ?>">
          <?php echo get_the_date(); ?>
        </time>
      </span>
      <!--カテゴリ-->
      <?php if (!is_category()): ?>
        <?php if( has_category() ): ?>
        <span class="cat-data">
          <?php $postcat=get_the_category(); echo $postcat[0]->name; ?>
        </span>
        <?php endif; ?>
      <?php endif; ?>
      <!--タイトル-->
      <h2><?php the_title(); ?></h2>
    </div>
  </a>
</article>
<?php endwhile; endif; ?><!--ループ終了-->
<!--ページネーション-->
<div class="pagination">
    <?php echo paginate_links( array(
      'type' => 'list',
      'mid_size' => '1',
      'prev_text' => '&laquo;',
      'next_text' => '&raquo;'
      ) ); ?>
</div>

</div>
<?php get_sidebar(); ?>
</div>
<!--下はbackcolorのdiv-->
</div>
<?php get_footer(); ?>

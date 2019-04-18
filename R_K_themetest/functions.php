<?php
//テーマのセットアップ
// titleタグをhead内に生成する
add_theme_support( 'title-tag' );
// HTML5でマークアップさせる
add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption' ) );
// Feedのリンクを自動で生成する
add_theme_support( 'automatic-feed-links' );
//アイキャッチ画像を使用する設定
add_theme_support( 'post-thumbnails' );

//カスタムメニュー
register_nav_menu('header-nav', 'ヘッダーナビ');
register_nav_menu('footer-nav', 'フッターナビ');

//メニューボタンjs呼び出し
function navbutton_scripts(){
  wp_enqueue_script('navbutton_script', get_template_directory_uri() .'/js/navbutton.js', array('jquery'));
}
add_action('wp_enqueue_scripts', 'navbutton_scripts');



//サイドバーにウィジェット追加
function widgetarea_init() {
register_sidebar(array(
  'name'=>'サイドバー',
  'id' => 'side-widget',
  'before_widget'=>'<div id="%1$s" class="%2$s sidebar-wrapper">',
  'after_widget'=>'</div>',
  'before_title' => '<h4 class="sidebar-title">',
  'after_title' => '</h4>'
  ));
}
add_action( 'widgets_init', 'widgetarea_init' );



/*サムネイル付きの新着記事表示ウィジェットを追加する*/
/*  最近の更新記事ウィジェット
---------------------------------------------*/
class widget_modify_update extends WP_Widget {
 /*コンストラクタ*/
  function __construct() {
    parent::__construct(
      'widget_modify_update',
      '*最近の更新記事ウィジェット*',
      array( 'description' => '最近更新した記事一覧を表示' )
    );
   }
  /*ウィジェット追加画面でのカスタマイズ欄の追加*/
  function form($instance) {
?>
  <p>
    <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('タイトル:'); ?></label>
    <input type="text" class="widefat" id="<?php echo $this->get_field_id('title'); ?>"
    name="<?php echo $this->get_field_name('title'); ?>"
    value="<?php echo esc_attr( $instance['title'] ); ?>">
  </p>
  <p>
    <label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('記事表示件数:'); ?></label>
    <input type="number" min="1" max="10" id="<?php echo $this->get_field_id('limit'); ?>"
    name="<?php echo $this->get_field_name('number'); ?>"
    value="<?php echo esc_attr( $instance['number'] ); ?>" size="3">
  </p>
<?php
  }
  /*カスタマイズ欄の入力内容が変更された場合の処理*/
  function update($new_instance, $old_instance) {
    $instance = $old_instance;
    $instance['title'] = strip_tags($new_instance['title']);
    $instance['number'] = is_numeric($new_instance['number']) ? $new_instance['number'] : 5;
      return $instance;
  }
  /*ウィジェットに出力される要素の設定*/
  function widget($args, $instance) {
    extract($args);
    echo $before_widget;
      if(!empty($instance['title'])) {
        $title = apply_filters('widget_title', $instance['title'] );
      }
      if ($title) {
        echo $before_title . $title . $after_title;
      } else {
        echo '<h3 class="widget-title">最近の更新記事</h3>';
      }
    $number = !empty($instance['number']) ? $instance['number'] : get_option('number');
?>
<!-- ウィジェットとして呼び出す要素 -->
<aside class="widget_modify_update">
  <ul>
  <?php
  $args = array(
      'order' => 'DESC',
      'orderby' => 'modified',
      'posts_per_page' => $number
    );
      $my_query = new WP_Query( $args );?>
      <?php
      $posts = get_posts($args);
      if($posts) : ?>
      <?php while ( $my_query->have_posts() ) : $my_query->the_post(); ?>
      <li class="clr">
       <a href="<?php the_permalink(); ?>">
       <!--サムネイル画像の追加-->
      <?php if (has_post_thumbnail()): // Check if Thumbnail exists?>
      <figure class="eyecatch">
        <?php the_post_thumbnail(array(130,80)); ?>
      </figure>
      <?php else: ?>
      <figure class="eyecatch noimg">
        <img src="<?php echo get_template_directory_uri(); ?>/images/wordpress_lg.png" width="130" height="80" alt="NO_IMAGE" />
      </figure>
      <?php endif; ?>
          <div class="widget_modify_update-title">
            <?php the_title(); ?>
            <!--カテゴリ-->
              <span class="cat-data">
               <?php if( has_category() ): ?>
                <?php $postcat=get_the_category(); echo $postcat[0]->name; ?>
               <?php endif; ?>
              </span>
              <span class="modify_date">
              <i class="fa fa-history fa-fw"></i><?php the_modified_date( 'Y年n月j日', '更新日: ' ); ?>
              </span>
          </div>
        </a>
      </li>
      <?php endwhile; ?>
    <?php wp_reset_postdata(); ?>
    <?php endif; ?>
 </ul>
</aside>
<?php echo $after_widget;
  }
}
register_widget('widget_modify_update');

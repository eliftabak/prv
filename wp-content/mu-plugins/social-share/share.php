<?php

class Share
{
  public function __construct()
  {
    $this->shortcode_hook();
  }


  public function shortcode_hook()
  {
    add_shortcode('social_share', array($this, 'html'));
  }

  public function html1()
  {

    global $post;
    $url = get_permalink($post->ID);
    $url = esc_url($url);
    $title = get_the_title($post->ID);

    $html = "<div class='social-share-wrapper'><div class='share-on'>Paylaş </div>";
    $html = $html . "<div class='facebook'><a target='_blank' href='http://www.facebook.com/sharer.php?u=" . $url . "&p[title]=" . $title . ">'>Facebook</a></div>";
    $html = $html . "<div class='twitter'><a target='_blank' href='https://twitter.com/share?text=" . $title . "&url=" . $url . "'>Twitter</a></div>";
    $html = $html . "<div class='pinterest'><a target='_blank' href='http://pinterest.com/pin/create/button/?url=" . $url . "&description=" . $title . "'>Pinterest</a></div>";
    $html = $html . "<div class='clear'></div></div>";
    return $html;
  }

  public function html()
  {
    $product_title   = get_the_title();
    $product_url  = get_permalink();
    $product_img  = wp_get_attachment_url(get_post_thumbnail_id());
    $http_prefix = "http:";
    $full_url = $http_prefix . $product_url;
    $full_image_url = $http_prefix . $product_img;

    $facebook_url   = 'https://www.facebook.com/sharer/sharer.php?u=' . $full_url;
    $twitter_url  = 'https://twitter.com/intent/tweet?status=' . rawurlencode($product_title) . '+' . $full_url;
    $pinterest_url  = 'https://pinterest.com/pin/create/bookmarklet/?media=' . $full_image_url . '&url=' . $full_url . '&is_video=false&description=' . rawurlencode($product_title);
?>
    <div class="prv-social-share">
      <h5 class="prv-social-share__title">Paylaş</h5>
      <ul>
        <li class="prv-social-share__item prv-social-share__twitter"><a href="<?php echo esc_url($twitter_url); ?>" target="_blank" rel="noopener noreferrer"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
        <li class="prv-social-share__item prv-social-share__facebook"><a href="<?php echo esc_url($facebook_url); ?>" target="_blank" rel="noopener noreferrer"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
        <li class="prv-social-share__item prv-social-share__pinterest"><a href="<?php echo esc_url($pinterest_url); ?>" target="_blank" rel="noopener noreferrer"><i class="fa fa-pinterest" aria-hidden="true"></i></a></li>
        <li class="prv-social-share__item prv-social-share__whatsapp"><a href=><i class="fa fa-whatsapp" aria-hidden="true"></i></a></li>
      </ul>
    </div>
<?php
  }
}


new Share();

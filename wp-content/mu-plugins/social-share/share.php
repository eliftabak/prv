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

  public function html()
  {
    $product_title   = get_the_title();
    $product_url  = get_permalink();
    $product_img  = wp_get_attachment_url(get_post_thumbnail_id());

    $facebook_url   = 'https://www.facebook.com/sharer/sharer.php?u=' . rawurlencode($product_url);
    $twitter_url  = 'https://twitter.com/intent/tweet?text=' . rawurlencode($product_title) . ' ' . rawurlencode($product_url);
    $pinterest_url  = 'https://pinterest.com/pin/create/bookmarklet/?media=' . rawurlencode($product_img) . '&url=' . rawurlencode($product_url) . '&is_video=false&description=' . rawurlencode($product_title);
    $whatsapp_url = 'whatsapp://send?text=' . rawurlencode($product_url);
?>
    <div class="prv-social-share">
      <h5 class="prv-social-share__title">Paylaş</h5>
      <ul>
        <li class="prv-social-share__item prv-social-share__twitter"><a href="<?php echo esc_url($twitter_url); ?>" target="_blank" rel="noopener noreferrer"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
        <li class="prv-social-share__item prv-social-share__facebook"><a href="<?php echo esc_url($facebook_url); ?>" target="_blank" rel="noopener noreferrer"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
        <li class="prv-social-share__item prv-social-share__pinterest"><a href="<?php echo esc_url($pinterest_url); ?>" target="_blank" rel="noopener noreferrer"><i class="fa fa-pinterest" aria-hidden="true"></i></a></li>
        <li class="prv-social-share__item prv-social-share__whatsapp"><a href="<?php echo esc_url($whatsapp_url); ?>" target="_blank" rel="noopener noreferrer" data-action="share/whatsapp/share"><i class="fa fa-whatsapp" aria-hidden="true"></i></a></li>
      </ul>
    </div>
<?php
  }
}
new Share();

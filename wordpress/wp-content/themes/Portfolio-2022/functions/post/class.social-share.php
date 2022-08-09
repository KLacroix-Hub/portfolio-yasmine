<?php

class Social_Share{

  public $titre_share;
  public $link_share;
  public $image_share;
  public $content_share;
  public $message;
  public $facebook_app_id;

  public function __construct($params) {

    $this->titre_share = $params->titre_share;
    $this->link_share = $params->link_share;
    $this->image_share = $params->image_share;
    $this->content_share = $params->content_share;

    if(strlen($this->content_share) > 64){
        $this->content_share  = substr($this->content_share, 0, 64);
        $this->content_share  = substr($this->content_share, 0, strrpos($this->content_share," "))." ...";
    } 

    $this->facebook_app_id = '1473279029643133';

  }

  public static function construct_with_post($post_id, $message) {

    $titre_share        = get_the_title($post_id);
    $link_share         = get_permalink($post_id);
    $image_share        = wp_get_attachment_url( get_post_thumbnail_id($post_id) );
    $content_share      = strip_tags( get_field('page_subtitle', $post_id) );
    if(strlen($content_share) > 64){
        $content_share  = substr($content_share, 0, 64);
        $content_share  = substr($content_share, 0, strrpos($content_share," "))." ...";
    } 

    return new Social_Share((Object)[

      'titre_share' => $titre_share,
      'link_share' => $link_share,
      'content_share' => $content_share,

    ]);

  }

  public function show_facebook() { ?>
    
    <div id="fb-root"></div>
    <script>(function(d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) return;
      js = d.createElement(s); js.id = id;
      js.src = "//connect.facebook.net/fr_FR/sdk.js#xfbml=1&version=v2.9&appId=234559506591632";
      fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>
    <!-- <div class="fb-share-button" data-href="<?php get_permalink(); ?>" data-layout="button_count"> -->
        <a class="rs-link rs-fb" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo addslashes($this->link_share); ?>&src=sdkpreparse"><span class="fab fa-facebook-f title-m"></span></a>
    <!-- </div> -->

  <?php }

  public function show_email($message) { ?>

    <a class="rs-link rs-mail" target="_blank" href="mailto:?subject='<?php echo $this->titre_share; ?>'&body=<?php echo $message; ?>"><span class="far fa-envelope title-m"></span></a>

  <?php }

  public function show_whatsapp() { ?>

    <a class="rs-link rs-whatsapp" target="_blank" href="whatsapp://send?text=<?php echo addslashes($this->link_share); ?>" data-action="share/whatsapp/share"><span class="fab fa-whatsapp title-m"></span></a>

  <?php }

  public function show_messager() { ?>

     <a class="rs-link rs-messenger" target="_blank" href="fb-messenger://share/?link=<?php echo addslashes($this->link_share); ?>&app_id=<?php echo $this->facebook_app_id; ?>"><span class="fab fa-facebook-messenger title-m"></span></a>

  <?php }

  public function show_twitter() { ?>

     <a class="rs-link rs-twitter" target="_blank" href="http://twitter.com/intent/tweet?text=<?php echo addslashes($this->titre_share).' : '.addslashes($this->content_share); ?>&url=<?php echo addslashes($this->link_share); ?>"><span class="fa fa-twitter"></span></a>

  <?php }

  public function show_google_plus() { ?>

    <a class="rs-link rs-gplus" target="_blank" href="https://plus.google.com/share?url=<?php echo addslashes($this->link_share); ?>" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;"><span class="fa fa-google-plus"></span></a>

  <?php }

  public function show_pinterest() { ?>

     <a class="rs-link rs-pint pinterest" target="_blank" href="http://pinterest.com/pin/create/button/?url=<?php echo addslashes($this->link_share); ?>&media<?php echo addslashes($this->image_share); ?>&description=<?php echo addslashes($this->titre_share); ?>" class="pin-it-button" count-layout="horizontal"><span class="fa fa-pinterest"></span></a>

  <?php }
  
  public function show_linkedin() { ?>
    
    <a class="rs-link rs-linkedin" target="_blank" href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo addslashes($this->link_share); ?>&source=delacouraujardin"><span class="fa fa-linkedin"></span></a>

  <?php }

}

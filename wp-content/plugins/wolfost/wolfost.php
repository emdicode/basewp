<?php
/**
 * Plugin Name: Generate Posts
 * Description: Create Post Demo
 * Version: 1.0.0
 * Author: TuanNDA
 * Author Uri: https://aioneto.cyou
 * Text Domain: base
 */

require_once('vendor/autoload.php');
require_once(ABSPATH . 'wp-admin/includes/image.php');

class Wolfost {
  public function __construct () {
    add_action('admin_menu', array($this, 'adminMenu'));
  }

  public function adminMenu () {
    add_submenu_page('tools.php', 'Post Demo', 'Post Demo', 'manage_options', 'wolfost_demo', array(
      $this,
      'adminLayout'
    ));
  }

  public function adminLayout () {
    if (isset($_POST['submit-post'])) {
      $catId = $_POST['cat_id'] ?: '';
      if ($catId > 0) {
        $this->insertPosts($catId);
      }
    }

    if (isset($_POST['submit-category'])) {
      $this->insertCategories();
    }
    ?>
    <div class="wrap">
      <h2><?php _e('Create Post demo', 'base') ?></h2>
      <form id="base_post_demo" method="post">
        <?php wp_dropdown_categories(array(
          'hide_empty' => 0,
          'name' => 'cat_id',
          'id' => 'categories',
          'hierarchical' => true,
          'show_option_none' => __('None'),
        )); ?>
        <input type="submit" value="Create Post demo" name="submit-post" class="button button-primary"/>
      </form>

      <h2><?php _e('Create Category demo', 'base') ?></h2>
      <form id="base_category_demo" method="post">
        <?php wp_dropdown_categories(array(
          'hide_empty' => 0,
          'name' => 'parent',
          'id' => 'parent',
          'hierarchical' => true,
          'show_option_none' => __('None'),
        )); ?>
        <input type="submit" value="Create Category demo" name="submit-category" class="button button-primary"/>
      </form>
    </div>
    <?php
  }

  public function insertCategories () {
    for ($i = 0; $i < 10; $i++) {
      $faker = new Faker\Generator();
      $faker->addProvider(new Faker\Provider\en_US\Person($faker));
      $faker->addProvider(new Faker\Provider\en_US\Address($faker));
      $faker->addProvider(new Faker\Provider\en_US\PhoneNumber($faker));
      $faker->addProvider(new Faker\Provider\en_US\Company($faker));
      $faker->addProvider(new Faker\Provider\Lorem($faker));
      $faker->addProvider(new Faker\Provider\Internet($faker));
      $parent = $_POST['parent'] ?: '';
      wp_insert_category([
        'taxonomy' => 'category',
        'cat_name' => ucfirst($faker->words(3, true)),
        'category_description' => $faker->text(140),
        'category_parent' => $parent,
      ]);
    }
  }

  public function insertPosts ($cat_id) {
    $images = [
      'adeolu-eletu-211916-unsplash.jpg',
      'aleks-dorohovich-26-unsplash.jpg',
      'alice-donovan-rouse-139182-unsplash.jpg',
      'alvin-mahmudov-244470-unsplash.jpg',
      'alvin-mahmudov-766463-unsplash.jpg',
      'an_vision-765564-unsplash.jpg',
      'andreas-fidler-403605-unsplash.jpg',
      'annie-spratt-210740-unsplash.jpg',
      'annie-spratt-251226-unsplash.jpg',
      'aziz-acharki-416318-unsplash.jpg',
      'becca-tapert-357529-unsplash.jpg',
      'becca-tapert-357541-unsplash.jpg',
      'ben-rosett-10613-unsplash.jpg',
      'brigitte-tohm-329291-unsplash.jpg',
      'charisse-kenion-495825-unsplash.jpg',
      'charisse-kenion-502616-unsplash.jpg',
      'charisse-kenion-502626-unsplash.jpg',
      'charisse-kenion-517654-unsplash.jpg',
      'chris-charles-1303004-unsplash.jpg',
      'christiana-rivers-222360-unsplash.jpg',
      'christiana-rivers-258740-unsplash.jpg',
      'christopher-burns-437755-unsplash.jpg',
      'christopher-gower-289516-unsplash.jpg',
      'david-lezcano-592965-unsplash.jpg',
      'david-nicolai-1152895-unsplash.jpg',
      'elli-o-212646-unsplash.jpg',
      'everton-vila-139333-unsplash.jpg',
      'ewan-robertson-208022-unsplash.jpg',
      'ewan-robertson-208059-unsplash.jpg',
      'feliperizo-co-heart-made-359787-unsplash.jpg',
      'filip-zrnzevic-270927-unsplash.jpg',
      'filipe-almeida-255155-unsplash.jpg',
      'freestocks-org-132631-unsplash.jpg',
      'freestocks-org-191995-unsplash.jpg',
      'freestocks-org-526352-unsplash.jpg',
      'gabby-orcutt-78650-unsplash.jpg',
      'giulia-bertelli-104575-unsplash.jpg',
      'guillaume-de-germain-303020-unsplash.jpg',
      'hipster-mum-236831-unsplash.jpg',
      'hipster-mum-236832-unsplash.jpg',
      'humphrey-muleba-1131653-unsplash.jpg',
      'igor-son-285029-unsplash.jpg',
      'ioana-casapu-278513-unsplash.jpg',
      'ivan-cabanas-145921-unsplash.jpg',
      'jake-thacker-113197-unsplash.jpg',
      'jason-briscoe-152940-unsplash.jpg',
      'joanna-nix-378111-unsplash.jpg',
      'joao-silas-114302-unsplash.jpg',
      'jon-tyson-558052-unsplash.jpg',
      'jon-tyson-712829-unsplash.jpg',
      'jonas-vincent-2717-unsplash.jpg',
      'jorgen-haland-130138-unsplash.jpg',
      'katie-treadway-176471-unsplash.jpg',
      'kelly-sikkema-72695-unsplash.jpg',
      'kenny-luo-1155594-unsplash.jpg',
      'kenny-luo-547038-unsplash.jpg',
      'kenny-luo-768476-unsplash.jpg',
      'kristine-weilert-316176-unsplash.jpg',
      'linh-nguyen-164-unsplash.jpg',
      'maliha-mannan-63635-unsplash.jpg',
      'mari-lezhava-418317-unsplash.jpg',
      'mike-ackerman-313942-unsplash.jpg',
      'mike-kenneally-45621-unsplash.jpg',
      'miroslava-196730-unsplash.jpg',
      'nathan-dumlao-576647-unsplash.jpg',
      'nathan-mcbride-462758-unsplash.jpg',
      'naveen-kumar-43156-unsplash.jpg',
      'nick-hillier-215633-unsplash.jpg',
      'nicole-honeywill-1285867-unsplash.jpg',
      'nicole-honeywill-1285872-unsplash.jpg',
      'offscreen-magazine-258450-unsplash.jpg',
      'plush-design-studio-503284-unsplash.jpg',
      'priscilla-du-preez-105714-unsplash.jpg',
      'priscilla-du-preez-228134-unsplash.jpg',
      'qearl-hu-592320-unsplash.jpg',
      'rawpixel-250087-unsplash.jpg',
      'rhema-kallianpur-471933-unsplash.jpg',
      'rizky-subagja-738320-unsplash.jpg',
      'roman-kraft-421410-unsplash.jpg',
      'rucksack-magazine-652864-unsplash.jpg',
      'sarah-rudolph-76844-unsplash.jpg',
      'shardayyy-photography-113795-unsplash.jpg',
      'sidharth-bhatia-131092-unsplash.jpg',
      'simon-hattinga-verschure-5243-unsplash.jpg',
      'stil-243534-unsplash.jpg',
      'stil-326687-unsplash.jpg',
      'stil-479015-unsplash.jpg',
      'stil-564530-unsplash.jpg',
      'suhyeon-choi-190623-unsplash.jpg',
      'thought-catalog-1000321-unsplash.jpg',
      'thought-catalog-580669-unsplash.jpg',
      'tim-bish-560004-unsplash.jpg',
      'toa-heftiba-214333-unsplash.jpg',
      'true-agency-804529-unsplash.jpg',
      'wilson-sanchez-1801-unsplash.jpg',
      'yasin-hosgor-459761-unsplash.jpg',
      'yiqun-tang-712459-unsplash.jpg',
      'daoudi-aissa-738272-unsplash',
      'gonzalo-arnaiz-129020-unsplash',
      'indra-sebeloue-1386674-unsplash',
    ];
    $faker = Faker\Factory::create();
    $faker->addProvider(new Faker\Provider\Lorem($faker));
    $numbers = range(0, 99);
    shuffle($numbers);
    for ($i = 0; $i < 99; $i++) {
      $image_id = array_pop($numbers);
      $post = array();
      $post['post_category'] = array($cat_id);
      $post['post_status'] = 'publish';
      $post['post_type'] = 'post';
      $post['post_title'] = ucfirst($faker->words(10, true));
      $post['post_content'] = $faker->paragraphs(10, true);
      $post_id = wp_insert_post($post);
      $imageUrl = home_url('/demo/') . $images[$image_id];
      //Featured Image
      $image_name = basename(parse_url($imageUrl, PHP_URL_PATH));
      $upload_dir = wp_upload_dir();
      $image_data = file_get_contents($imageUrl);
      $unique_file_name = wp_unique_filename($upload_dir['path'], $image_name);
      $file_name = basename($unique_file_name);
      if (wp_mkdir_p($upload_dir['path'])) {
        $file = $upload_dir['path'] . '/' . $file_name;
      } else {
        $file = $upload_dir['basedir'] . '/' . $file_name;
      }
      file_put_contents($file, $image_data);
      $wp_filetype = wp_check_filetype($file_name, null);
      $attachment = array(
        'post_mime_type' => $wp_filetype['type'],
        'post_title' => sanitize_file_name($file_name),
        'post_content' => '',
        'post_status' => 'inherit'
      );
      $attach_id = wp_insert_attachment($attachment, $file);
      $attach_data = wp_generate_attachment_metadata($attach_id, $file);
      wp_update_attachment_metadata($attach_id, $attach_data);
      set_post_thumbnail($post_id, $attach_id);
    }
  }
}

new Wolfost();

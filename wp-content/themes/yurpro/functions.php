
<?php
class EX {

    /**
     * 初期設定
     */
    public static function init() 
    {
        // 公開ページ上部にログインバーのせいで変な空白ができるので消す。
        add_filter( 'show_admin_bar', '__return_false' );
        
        // メニュー機能をサポート
        add_theme_support('menus');

        // カスタム投稿タイプを追加
        EX::add_custom_post_type();
        
        // カスタムフィールドに登録されたJavascriptが読み込まれるようにする
        EX::enable_custom_field_js();
        
        // ショートコードの登録
        EX::add_shortcode();
    }
    
    /* カスタム投稿タイプを追加 */
    public static function add_custom_post_type() {
        $exampleSupports = [
          'title',
          'editor',
          'thumbnail',
          'revisions',
          'custom-fields',
        ];

        // add post type
        register_post_type( 'simple',
          array(
            'label' => 'シンプル',
            'public' => true,
            'has_archive' => true,
            'menu_position' => 5,
            'rewrite'  => true,
            'supports' => $exampleSupports
          )
        );
        
        // カテゴリを設定できるようにする。
        register_taxonomy(
          'simple_category',
          'simple',
          array(
            'label' => 'カテゴリ',
            'labels' => array(
              'all_items' => 'カテゴリ一覧',
              'add_new_item' => '新規カテゴリを追加'
            ),
            'hierarchical' => true
          )
        );        
        
        // カスタム投稿のリンクをslugではなくid指定の形にする
        add_filter( 'post_type_link', function($link, $post){
            if ( 'simple' === $post->post_type ) {
              return home_url( '/archives/simple/' . $post->ID );
            } else {
              return $link;
            }
        }, 1, 2 );
 
        add_filter( 'rewrite_rules_array', function($rules){
          $new_rules = array( 
            'archives/simple/([0-9]+)/?$' => 'index.php?post_type=simple&p=$matches[1]',
          );

          return $new_rules + $rules;
        });
        
        // PresenPressにもカテゴリを設定できるようにする。
        register_taxonomy(
          'presenpress_category',
          'presenpress',
          array(
            'label' => 'カテゴリ',
            'labels' => array(
              'all_items' => 'カテゴリ一覧',
              'add_new_item' => '新規カテゴリを追加'
            ),
            'hierarchical' => true
          )
        );             
    }
    
    /* カスタムフィールドの値からJavascriptを読み込む処理を有効かする */
    public static function enable_custom_field_js() {
        add_action( 'wp_enqueue_scripts', function(){
            if (!is_singular()) {
                return;
            }
            
            $post = get_post();
            $js_list = get_post_meta($post->ID, "javascript");

            foreach($js_list as $js) {
                wp_enqueue_script( $js, EX::get_assets_link(). $js, array( 'jquery' ) );
            }
        } );  
    }
    
    /* ページのタイプを文字列で取得する */
    public static function get_page_type() {
        if(is_front_page() || is_home()) {
            return "home";
        } elseif (is_single()) {
            return "single";
        } elseif (is_tag()) {
            return "tag";
        } elseif (is_category()) {
            return "category";
        } else {
            return "default";
        }
    }
    
    /* ページのタイトルを取得する */
    public static function get_page_title() {
        if(is_front_page() || is_home()) {
            return get_bloginfo("name");
        } else {
            return wp_title("", false);
        }
    }
    
    /**
     * 新着記事リストデータを取得する。
     * index.phpに表示する記事の取得を想定した実装。
     */
    public static function get_new_posts() {
        global $wpdb;
        
        $query  = "SELECT ID FROM $wpdb->posts ";
        $query .= "WHERE post_type = 'post' AND post_status='publish' ";
        $query .= "ORDER BY post_date DESC LIMIT 10";

        return $wpdb->get_results( $query );
    }    
    
    /**
     * ショートコードを登録する。
     */
    private static function add_shortcode()
    {
        // リンクタグを生成するショートコード
        // How to use.
        // [link url={text} title={text} outside={0 or 1]
        // [link "url" "title" "outside"]
        add_shortcode("link", function($args) 
        {
            // パラメーター
            extract(shortcode_atts(array(
                "url"       => "",
                "title"     => "",
                "outside"   => 1,
            ), $args));
            
            
            if(isset($args[0])) $url     = $args[0];
            if(isset($args[1])) $title   = $args[1];
            if(isset($args[2])) $outside = $args[2];
            
            if(empty($title)) {
                $title = $url;
            }
                
            $blank = "";
            if($outside != 0){
                $blank = " target='_blank'";
            }

            $text = "<a href='$url' title='$title' $blank>$title</a>";
            return $text;
        });
        
        // カテゴリページへのリンクを生成する
        // How to use.
        // [cate {slug}]
        add_shortcode("cate", function($args) {
            $obj = get_category_by_slug($args[0]);
            $url = get_category_link($obj);
            $text = "<a href='$url'>$obj->name</a>";
            return $text;
        });
        
        // WordPressの投稿に対するリンクを生成する
        // How to use.
        // [post id={投稿のID} title="表示するテキスト" outside="新しくウィンドウを開くか"]
        add_shortcode("post", function($args) 
        {
            extract(shortcode_atts(array(
                "id"      => 0,
                "title"   => null,
                "outside" => false,
            ), $args));
            
            $url   = post_permalink($id);
            
            if(is_null($title)) {
                $title = get_the_title($id);    
            }

            $blank = "";
            if($outside == true) {
                $blank = " target='_blank'";
            }

            return "<a href='$url' title='$title'$blank>$title</a>";
        });
        
        // 画像リンクを生成する(内部サイトのみ)
        // How to use.
        // [image src={画像パス、/以下のパス} title={画像タイトル} w={幅}]
        add_shortcode("image", function($args)
        {
            extract(shortcode_atts(array(
                "src"    => "",
                "title"  => "画像",
                "w"      => "95",
                "div"    => 1,
            ), $args));
            
            $url = (wp_upload_dir()['baseurl']);
            
            $images = explode(",", $src);
            $text = "";
            
            if($div){ $text .= "<div class='images'>"; }
            
            foreach($images as $img) {
                $text .= "<a href='$url.$img' title='$title'><img src='$url.$img' alt='$title' style='width:$w%'></a>";
            }
            
            if($div) { $text .= "</div>"; }
            return $text;
            
            
            //return "<a href='$url' title='$title'><img src='$url' style='width:30%;' alt='$title'></a>";
        });
        
        // インラインフレームを生成する
        // How to use.
        // [frame id={投稿のID} link={リンクを表示するかどうか}]
        add_shortcode("frame", function($args)
        {
            extract(shortcode_atts(array(
                "id"    => 0,
                "link"  => 1,
             ), $args));
            
            $src   = post_permalink($id);
  
            $text  = "<div class='frame'>";
            $text .= "<iframe src='$src'></iframe>";
            $text .= "</div>";
            
            if($link != 0){
                $text .= "<div style='text-align:right'><a href='$src' target='_blank'>別ウィンドウで開く</a></div>";
            }
            return $text;
        });
     
        // tableのthを複数作成する
        // How to use.
        // [ths "title,width" "title:width" ....]
        add_shortcode("ths", function($args)
        {
            foreach($args as $arg) {
                
                list($value, $width) = explode(",", $arg);
                
                $text .= "<th";
                if(!is_null($width)) {
                    $text .= " style='width:$width%'";
                }
                $text .= ">$value</th>";
            }
            return $text;
        });  
        
        // tableのtdを複数生成する
        // How to use.
        // [tds "title" "title" ....]
        add_shortcode("tds", function($args){
            foreach($args as $arg) {
                $text .= "<td>$arg</td>";
            }
            return $text;
        });                
    }
    
    /* アセットフォルダのURLを取得する */
    public static function get_assets_link(){
        return get_template_directory_uri() . "/assets/";
    }

    /**
     * カスタムフィールドに指定されたjavascriptを読み込むタグを出力
     */
    public static function the_load_meta_js($post, $key) {
        $js = get_post_meta($post->ID, $key);
        
        // JS要素がないなら何もしない。
        if(empty($js)) {
            return;
        }
        
        //　JSを読み込むタグを生成
        $text = "";
        foreach($js as $file) {
            $src = EX::get_assets_link() . $file . "?" . date("YmdHid");
            $text .= "<script src='$src'></script>";
        }
        echo $text;
    }
    
    /**
     * カスタムフィールドに指定されたscriptを読み込むタグを出力
     */
    public static function the_load_meta_script($post, $key) {
        $data = get_post_meta($post->ID, $key);
        
        // JS要素がないなら何もしない。
        if(empty($data)) {
            return;
        }
        
        //　JSを読み込むタグを生成
        $text = "<script>";
        foreach($data as $script) {
            $text .= $script;
        }
        $text = "</script>";
        echo $text;
    }
    
    /**
     * カスタムフィールドに指定されたscriptを読み込むタグを出力
     */
    public static function the_load_meta_css($post, $key) {
        $data = get_post_meta($post->ID, $key);
        
        // JS要素がないなら何もしない。
        if(empty($data)) {
            return;
        }
        
        //　JSを読み込むタグを生成
        $text = "";
        foreach($data as $css) {
            $url = EX::get_assets_link() . $css . "?" . date("YmdHis");
            $text .= "<link rel='stylesheet' type='text/css' href='$url'>";
        }
        
        echo $text;
    }      
}

// 初期設定を行う。
EX::init();
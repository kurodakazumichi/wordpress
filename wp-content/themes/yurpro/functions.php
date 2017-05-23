
<?php
class EX {

    /**
     * 初期設定
     */
    public static function init() {
        add_theme_support('menus');

        add_filter( 'show_admin_bar', '__return_false' );

        add_theme_support('post-thumbnails');

       
        EX::add_sc_hoge();

    }
    
    /**
    * CSSを読み込むlinkタグを出力する関数
    */
    public static function load_css($css, $timestamp = true)
    {
        $url = get_template_directory_uri() . $css;

        if ($timestamp)
        {
            $url .= "?" . filemtime(get_stylesheet_directory() . $css);
        }

        echo '<link rel="stylesheet" type="text/css" href="' . $url . '">';
    }    
    
    /* ページのタイプを文字列で取得する */
    public static function get_page_type()
    {
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
    
    public static function add_sc_code()
    {
        add_shortcode("code", function($args, $content = null)
        {
            
            
            $text ="
                <pre class='lang:default decode:true ' >
                $content
                </pre>
            ";
            
            return $text;
        });
    }
    
    public static function add_sc_hoge()
    {
        add_shortcode("hoge", function(){
        $text ="
            aaaaa
        ";
            return $text;
        });
    }
    
    /**
     * 新着記事リストデータを取得する。
     * index.phpに表示する記事の取得を想定した実装。
     */
    public static function get_new_posts() 
    {
        global $wpdb;
        
        $query  = "SELECT ID FROM $wpdb->posts ";
        $query .= "WHERE post_type = 'post' AND post_status='publish' ";
        $query .= "ORDER BY post_date DESC LIMIT 10";

        return $wpdb->get_results( $query );
    }

}

// 初期設定を行う。
EX::init();


// 元からあるテンプレートタグを上書きできる。
//add_filter( 'get_search_form', 'my_search_form' );
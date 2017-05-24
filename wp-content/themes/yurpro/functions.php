
<?php
class EX {

    /**
     * 初期設定
     */
    public static function init() 
    {
        add_theme_support('menus');

        // 公開ページ上部にログインバーのせいで変な空白ができるので消す。
        add_filter( 'show_admin_bar', '__return_false' );

        add_theme_support('post-thumbnails');

        // ショートコードの登録
        EX::add_shortcode();
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
    
    /**
     * ショートコードを登録する。
     */
    private static function add_shortcode()
    {
        add_shortcode("link", function($args){
            $text = "<a href='$args[1]' title='$args[0]' target='_blank'>$args[0]</a>";
            return $text;
        });
        
        add_shortcode("post", function($args) {
            extract(shortcode_atts(array(
                "id"    => 0,
                "title" => null,
            ), $args));
            
            $url   = post_permalink($id);
            
            if(is_null($title)) {
                $title = get_the_title($id);    
            }

            return "<a href='$url' title='$title'>$title</a>";
        });
        
        add_shortcode("image", function($args){
            extract(shortcode_atts(array(
                "src"    => "",
                "title" => "画像",
            ), $args));
            
            $url = (wp_upload_dir()['baseurl']) . $src;
            
            return "<a href='$url' title='$title'><img src='$url' style='width:30%;' alt='$title'></a>";
            
            
        });
        
        add_shortcode("frame", function($args){
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
     
        add_shortcode("ths", function($args){
           
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
        
        add_shortcode("tds", function($args){
            foreach($args as $arg) {
                $text .= "<td>$arg</td>";
            }
            return $text;
        });                
    }
}

// 初期設定を行う。
EX::init();


// 元からあるテンプレートタグを上書きできる。
//add_filter( 'get_search_form', 'my_search_form' );
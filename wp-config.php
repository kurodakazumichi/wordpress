<?php
/**
 * WordPress の基本設定
 *
 * このファイルは、インストール時に wp-config.php 作成ウィザードが利用します。
 * ウィザードを介さずにこのファイルを "wp-config.php" という名前でコピーして
 * 直接編集して値を入力してもかまいません。
 *
 * このファイルは、以下の設定を含みます。
 *
 * * MySQL 設定
 * * 秘密鍵
 * * データベーステーブル接頭辞
 * * ABSPATH
 *
 * @link http://wpdocs.osdn.jp/wp-config.php_%E3%81%AE%E7%B7%A8%E9%9B%86
 *
 * @package WordPress
 */

// 注意:
// Windows の "メモ帳" でこのファイルを編集しないでください !
// 問題なく使えるテキストエディタ
// (http://wpdocs.osdn.jp/%E7%94%A8%E8%AA%9E%E9%9B%86#.E3.83.86.E3.82.AD.E3.82.B9.E3.83.88.E3.82.A8.E3.83.87.E3.82.A3.E3.82.BF 参照)
// を使用し、必ず UTF-8 の BOM なし (UTF-8N) で保存してください。

// ** MySQL 設定 - この情報はホスティング先から入手してください。 ** //
/** WordPress のためのデータベース名 */
define('DB_NAME', 'wpdb');

/** MySQL データベースのユーザー名 */
define('DB_USER', 'wpadmin');

/** MySQL データベースのパスワード */
define('DB_PASSWORD', 'wpadmin');

/** MySQL のホスト名 */
define('DB_HOST', 'localhost');

/** データベースのテーブルを作成する際のデータベースの文字セット */
define('DB_CHARSET', 'utf8');

/** データベースの照合順序 (ほとんどの場合変更する必要はありません) */
define('DB_COLLATE', '');

/**#@+
 * 認証用ユニークキー
 *
 * それぞれを異なるユニーク (一意) な文字列に変更してください。
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org の秘密鍵サービス} で自動生成することもできます。
 * 後でいつでも変更して、既存のすべての cookie を無効にできます。これにより、すべてのユーザーを強制的に再ログインさせることになります。
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         ' b]( Xf!Fg~`pz{Lp)<zH1QU[JH+=H>VD&2PQ3f-}_Pm]2knRrWh>&bVjUx&W`e+');
define('SECURE_AUTH_KEY',  '=6|+5Q*7jX{ygt1G4vz|b$pKx9azoZvMP?BdB#=mwFf`G3g9-fjj4su< )b@/3`;');
define('LOGGED_IN_KEY',    ':w`AH@X<+.uH_y@Un+5OH%i^o vWxAjHOii50eHw0>g/aD^DF$k(;yun|TmnIBhd');
define('NONCE_KEY',        'jbXp|7??d^iX5D+RD&yW<Wqji;FEleF%FZLzII?tj8]sK=rK$mi=e5|LAqbZ|f?+');
define('AUTH_SALT',        'S3>hh%AK*AWRLQ;-Y,R78I;(f;GbUt4+FLIB>DLIy2}OKC*Wef)yCt~5bld?ex^v');
define('SECURE_AUTH_SALT', 'aa?hQ-IH-{nN&;}]S(^|i+@Fn!fJB+{jPDi^zkw1R?jYNqNPDP|5ZcSC2B}c(vGB');
define('LOGGED_IN_SALT',   'Ny|@eVH}GHzVkR(h-U=UyOai*J0b|ukF8H7s#__+1]k*Ri#)L~}wrY-4Q#+,xHY1');
define('NONCE_SALT',       'G*A%~z{`d$pj)p} Hln$4EYE!Y9c#P4rb5{JCwj<V?;2QZ:N2O*R]u0|/>l+Ogrp');
/**#@-*/

/**
 * WordPress データベーステーブルの接頭辞
 *
 * それぞれにユニーク (一意) な接頭辞を与えることで一つのデータベースに複数の WordPress を
 * インストールすることができます。半角英数字と下線のみを使用してください。
 */
$table_prefix  = 'wp_';

/**
 * 開発者へ: WordPress デバッグモード
 *
 * この値を true にすると、開発中に注意 (notice) を表示します。
 * テーマおよびプラグインの開発者には、その開発環境においてこの WP_DEBUG を使用することを強く推奨します。
 *
 * その他のデバッグに利用できる定数については Codex をご覧ください。
 *
 * @link http://wpdocs.osdn.jp/WordPress%E3%81%A7%E3%81%AE%E3%83%87%E3%83%90%E3%83%83%E3%82%B0
 */
define('WP_DEBUG', false);

/* 編集が必要なのはここまでです ! WordPress でブログをお楽しみください。 */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');

/** 独自のデバッグ機能を有効にする場合はDEVELOPをtrueに設定します。 */
define("DEVELOP", false);
define ('SAVEQUERIES', DEVELOP);
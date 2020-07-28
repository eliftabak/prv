<?php

define('WP_TEMP_NAME', "temp");
define('WP_TEMP_DIR', dirname(__FILE__) . '/wp-content/' . WP_TEMP_NAME . '/');
define('WP_PRV_THEME_DEBUG', false);

/**
 * WordPress için taban ayar dosyası.
 *
 * Bu dosya şu ayarları içerir: MySQL ayarları, tablo öneki,
 * gizli anahtaralr ve ABSPATH. Daha fazla bilgi için
 * {@link https://codex.wordpress.org/Editing_wp-config.php wp-config.php düzenleme}
 * yardım sayfasına göz atabilirsiniz. MySQL ayarlarınızı servis sağlayıcınızdan edinebilirsiniz.
 *
 * Bu dosya kurulum sırasında wp-config.php dosyasının oluşturulabilmesi için
 * kullanılır. İsterseniz bu dosyayı kopyalayıp, ismini "wp-config.php" olarak değiştirip,
 * değerleri girerek de kullanabilirsiniz.
 *
 * @package WordPress
 */

// ** MySQL ayarları - Bu bilgileri sunucunuzdan alabilirsiniz ** //
/** WordPress için kullanılacak veritabanının adı */
define('DB_NAME', 'pruvaakadb');

/** MySQL veritabanı kullanıcısı */
define('DB_USER', 'root');

/** MySQL veritabanı parolası */
define('DB_PASSWORD', '');

/** MySQL sunucusu */
define('DB_HOST', 'localhost');

/** Yaratılacak tablolar için veritabanı karakter seti. */
define('DB_CHARSET', 'utf8');

/** Veritabanı karşılaştırma tipi. Herhangi bir şüpheniz varsa bu değeri değiştirmeyin. */
define('DB_COLLATE', '');

/**#@+
 * Eşsiz doğrulama anahtarları.
 *
 * Her anahtar farklı bir karakter kümesi olmalı!
 * {@link http://api.wordpress.org/secret-key/1.1/salt WordPress.org secret-key service} servisini kullanarak yaratabilirsiniz.
 * Çerezleri geçersiz kılmak için istediğiniz zaman bu değerleri değiştirebilirsiniz. Bu tüm kullanıcıların tekrar giriş yapmasını gerektirecektir.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '1d,wRC/njm+>SH@c+O760nT+EJwAK0&|$Kv?v%$WVy 2iMcP)QR?~yitSPtE41)=');
define('SECURE_AUTH_KEY',  '}6Fv[{|wDu3&Ssja8dXw5=5q)K|yeo8]%{FM{ :&d+!K4O0eRb#Aotbw9sS,9pjZ');
define('LOGGED_IN_KEY',    'Bzm#&q|w[Tikxfg&Ihs2J|4)%g,:fS-^BF3XIw`):rj|lc:ju#:?s,B:5V4S-dDe');
define('NONCE_KEY',        'ks.qoOB7S{ !y%zdxZ&!Mc24p%NahaM&26>v[OY4dF/HRCzZx[JuE49{|^i/Y~Ux');
define('AUTH_SALT',        't36nsE|#Ftg~N*^MwP0EOuxiZ,dEzm(cm7hys Jt#iKl2CU;s5pq4=-GH^& Hdl,');
define('SECURE_AUTH_SALT', 'T0obZ{:Uj:-l|Q<sjF^%M+}&`EK,R,!9ZZobQJcYsv|^d4G}XL5ZfO[KWmX,9-Zr');
define('LOGGED_IN_SALT',   '9q;?[|2Uo47|iQC#v[//ci9.=Y.*L=,H0+TQ4+<Fv44toW)Tyk:ze|G%D3sL(4~_');
define('NONCE_SALT',       '7u:+n}!O+`Nkotx65BZ/?-_-J%ADfBhc ;ZFDPoxk6v3q9v}~1wdXx!8z2[wgE1c');
/**#@-*/

/**
 * WordPress veritabanı tablo ön eki.
 *
 * Tüm kurulumlara ayrı bir önek vererek bir veritabanına birden fazla kurulum yapabilirsiniz.
 * Sadece rakamlar, harfler ve alt çizgi lütfen.
 */
$table_prefix = 'wp_';

/**
 * Geliştiriciler için: WordPress hata ayıklama modu.
 *
 * Bu değeri "true" yaparak geliştirme sırasında hataların ekrana basılmasını sağlayabilirsiniz.
 * Tema ve eklenti geliştiricilerinin geliştirme aşamasında WP_DEBUG
 * kullanmalarını önemle tavsiye ederiz.
 */
define('WP_DEBUG', true);

/* Hepsi bu kadar. Mutlu bloglamalar! */

/** WordPress dizini için mutlak yol. */
if (!defined('ABSPATH'))
	define('ABSPATH', dirname(__FILE__) . '/');

/** WordPress değişkenlerini ve yollarını kurar. */
require_once(ABSPATH . 'wp-settings.php');

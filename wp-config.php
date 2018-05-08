<?php
/**
 * La configuration de base de votre installation WordPress.
 *
 * Ce fichier contient les réglages de configuration suivants : réglages MySQL,
 * préfixe de table, clés secrètes, langue utilisée, et ABSPATH.
 * Vous pouvez en savoir plus à leur sujet en allant sur
 * {@link http://codex.wordpress.org/fr:Modifier_wp-config.php Modifier
 * wp-config.php}. C’est votre hébergeur qui doit vous donner vos
 * codes MySQL.
 *
 * Ce fichier est utilisé par le script de création de wp-config.php pendant
 * le processus d’installation. Vous n’avez pas à utiliser le site web, vous
 * pouvez simplement renommer ce fichier en "wp-config.php" et remplir les
 * valeurs.
 *
 * @package WordPress
 */

// ** Réglages MySQL - Votre hébergeur doit vous fournir ces informations. ** //
/** Nom de la base de données de WordPress. */
define('DB_NAME', 'wordpress');

/** Utilisateur de la base de données MySQL. */
define('DB_USER', 'root');

/** Mot de passe de la base de données MySQL. */
define('DB_PASSWORD', 'root');

/** Adresse de l’hébergement MySQL. */
define('DB_HOST', 'localhost');

/** Jeu de caractères à utiliser par la base de données lors de la création des tables. */
define('DB_CHARSET', 'utf8mb4');

/** Type de collation de la base de données.
  * N’y touchez que si vous savez ce que vous faites.
  */
define('DB_COLLATE', '');

/**#@+
 * Clés uniques d’authentification et salage.
 *
 * Remplacez les valeurs par défaut par des phrases uniques !
 * Vous pouvez générer des phrases aléatoires en utilisant
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ le service de clefs secrètes de WordPress.org}.
 * Vous pouvez modifier ces phrases à n’importe quel moment, afin d’invalider tous les cookies existants.
 * Cela forcera également tous les utilisateurs à se reconnecter.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'PDq#sSv$x:2|)$2 n4i_~M5`GHX i^2V.mkGI9DmP/F^UADsGpD%/ik`kOKB-xf+');
define('SECURE_AUTH_KEY',  '#TS>`N0btW$2n8.=]3=]CMDX01<FtM--neN?CT{,:]32A7*b_}lI&d~e;/U$&D3l');
define('LOGGED_IN_KEY',    '-4=ya|!*(z>8}5jqnXea-=(_pF!B@e.HrH/w6Gkft|ad?{A0];wXJPXkw4Pn$adD');
define('NONCE_KEY',        'hji[3*K^Fr`C;XR7}BVUja;PX-u+z*y?l5bQ^_7D!D`>f)Y.=2[%xZ8QHthRLAsz');
define('AUTH_SALT',        'lD1lFhc3];~!joIP5Hj52c,*ln<tpq5nyKL5+]hbnXbbQKVqef+$$J.}2(,)B%6x');
define('SECURE_AUTH_SALT', 'uIlce,b7IhO4aje-}|n$XlYdMscy13!5AeZOjfJMxf[5q~%[qgf0P,p}4i,gsY(H');
define('LOGGED_IN_SALT',   '3+JINzp{OkbV~NK*Tda^aaPaW%AI8G}D*r:/Ou2@[cb2UPDoH%]0-zFqR%C3A{|Z');
define('NONCE_SALT',       'jP(WT%r7f/+t8}XCwt,J2znW7+Y,2M 4[L@In6P oI.jZe`O0~EzX* Cz;s|{nY1');
/**#@-*/

/**
 * Préfixe de base de données pour les tables de WordPress.
 *
 * Vous pouvez installer plusieurs WordPress sur une seule base de données
 * si vous leur donnez chacune un préfixe unique.
 * N’utilisez que des chiffres, des lettres non-accentuées, et des caractères soulignés !
 */
$table_prefix  = 'wp_';

/**
 * Pour les développeurs : le mode déboguage de WordPress.
 *
 * En passant la valeur suivante à "true", vous activez l’affichage des
 * notifications d’erreurs pendant vos essais.
 * Il est fortemment recommandé que les développeurs d’extensions et
 * de thèmes se servent de WP_DEBUG dans leur environnement de
 * développement.
 *
 * Pour plus d’information sur les autres constantes qui peuvent être utilisées
 * pour le déboguage, rendez-vous sur le Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* C’est tout, ne touchez pas à ce qui suit ! */

/** Chemin absolu vers le dossier de WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Réglage des variables de WordPress et de ses fichiers inclus. */
require_once(ABSPATH . 'wp-settings.php');

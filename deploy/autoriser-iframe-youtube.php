<?php
/**
 * Plugin Name: Autoriser les iframes YouTube (Fox LMS)
 * Description: Autorise la balise <iframe> (YouTube/Vimeo) dans les contenus filtrés par wp_kses_post, notamment la description des cours Fox LMS qui la supprimait à l'enregistrement et à l'affichage.
 * Version: 1.0
 * Author: Frédéric LE GUEN
 *
 * Installation : déposer ce fichier dans wp-content/mu-plugins/
 * (créer le dossier mu-plugins s'il n'existe pas — un « must-use plugin »
 * est actif immédiatement, sans activation dans l'admin).
 */

if (!defined('ABSPATH')) {
    exit;
}

add_filter('wp_kses_allowed_html', function ($tags, $context) {
    if ('post' === $context) {
        $tags['iframe'] = array(
            'src'             => true,
            'title'           => true,
            'width'           => true,
            'height'          => true,
            'frameborder'     => true,
            'allow'           => true,
            'allowfullscreen' => true,
            'referrerpolicy'  => true,
            'loading'         => true,
            'style'           => true,
            'class'           => true,
        );
    }

    return $tags;
}, 10, 2);

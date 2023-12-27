<?php
add_action('wp_enqueue_scripts', 'theme_enqueue_styles');
function theme_enqueue_styles()
{
    wp_enqueue_style('parent-style', get_template_directory_uri() . '/style.css');
    wp_enqueue_style('theme-style', get_stylesheet_directory_uri() . '/css/theme.css', array(), filemtime(get_stylesheet_directory() . '/css/theme.css'));
}

function personnaliser_menu_navigation($items, $args) {     // Fonction nommé "personnaliser_un_menu_navigation, paramètre : items (elements du menu et arguments) 
    
    if (is_user_logged_in()) {                              // Si l'utilisateur est connecté au site                           
        
        $menu_id = 7;                                       //ID du menu sélectionné trouvable dans le back office (URL)             

        $menu_object = wp_get_nav_menu_object($args->menu); //Cette partie permet de récupérer l'ID du menu


        // Si l'objet du menu est trouvé et son ID correspond à celui spécifié
        if ($menu_object && $menu_object->term_id == $menu_id) {
            // Crée le lien "Admin" avec une classe 
            $admin_link = '<li class="menu-item hfe-menu-item"><a href="http://localhost:8888/Planty/wp-admin/" class="hfe-menu-item">Admin</a></li>';
            // Permet de trouvez la position de la fin de Nous rencontrer dans la liste des éléments du menu
            $end_position_nous_rencontrer = strpos($items, '</li>');
            // Insérez l'élément "Admin" après "Nous rencontrer la fonction permet de remplacer une chaîne par une autre (0 signifie 
            $items = substr_replace($items, $admin_link, $end_position_nous_rencontrer, 0);                         // qu'aucun caractère ne dois être remplacé 
        }
    }

    return $items; //on retourne la chaîne modifié
}

// Hooks filtre 
add_filter('wp_nav_menu_items', 'personnaliser_menu_navigation', 10, 2); // 10 priorité du filtre et 2 c'est le nombre d'arguments accepté ($args et $items)



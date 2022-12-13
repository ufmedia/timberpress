<?php
/**
 * Enqueue theme assets.
 */
function horizon_enqueue_scripts()
{
    $theme = wp_get_theme();

    wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap', null, null);
    wp_enqueue_script('jquery', null, null, null, true);
    wp_enqueue_style('horizon-styles', horizon_asset('style-index.css'), null, null);
    wp_enqueue_script('horizon-scripts', horizon_asset('index.js'), array('jquery'), $theme->get('Version'), false);
    wp_localize_script('horizon-scripts', 'horizonAjax', array('ajaxurl' => admin_url('admin-ajax.php'), 'nonce' => wp_create_nonce('ajax-nonce')));
}

add_action('wp_enqueue_scripts', 'horizon_enqueue_scripts');

/**
 * Get asset path.
 *
 * @param string  $path Path to asset.
 *
 * @return string
 */
function horizon_asset($path)
{
    if (wp_get_environment_type() === 'production') {
        return get_stylesheet_directory_uri() . '/public/build/' . $path;
    }

    return add_query_arg('time', time(),  get_stylesheet_directory_uri() . '/public/build/' . $path);
}

function horizon_register_menus()
{
    register_nav_menu('main-menu', __('Main Menu'));
    
}
add_action('init', 'horizon_register_menus');
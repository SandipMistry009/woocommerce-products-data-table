<?php
/*
Plugin Name: Woocommere Products Data Table
Plugin URI: http://www.itsoulinfotech.com
Description: Woocommerce products data table
Author: Sandip Mistry
Version: 1.0.0
Author URI: http://www.itsoulinfotech.com
*/

class WPDocs_EB_EbtechModules {

    public static function init() {
        add_action( 'admin_enqueue_scripts', array( __CLASS__, 'adminAssets' ) );
        add_action( 'admin_menu', array( __CLASS__, 'adminMenu' ) );
    }

    public static function adminMenu() {
        add_menu_page(
            __( 'Woo Products Menu', 'woo-prodcts-data-table' ),
            __( 'Products', 'woo-prodcts-data-table' ),
            'manage_options',
            'woo-products',
            array( __CLASS__, 'menuPage' ),
            'dashicons-tagcloud',
            6
        );
    }

    public static function menuPage() {
        if ( is_file( plugin_dir_path( __FILE__ ) . 'includes/layout.php' ) ) {
            include_once plugin_dir_path( __FILE__ ) . 'includes/layout.php';
        }
    }


    public static function adminAssets() {
        if ( isset( $_GET['page'] ) && ! empty( $_GET['page'] ) && 'woo-products' === $_GET['page'] ) {
            wp_enqueue_style('datatable-css','https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css');
            wp_enqueue_style('woocommerce-products-data-table-css', plugins_url('woocommerce-products-data-table.css', __FILE__));
            wp_enqueue_script('datatable-js','https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js');
            wp_enqueue_script('woocommerce-products-data-table-js', plugins_url('woocommerce-products-data-table.js', __FILE__));

        }
    }
}


include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
if ( is_plugin_active( 'woocommerce/woocommerce.php') ):

WPDocs_EB_EbtechModules::init();

else:

    function sample_admin_notice__error() {
    $class = 'notice notice-error';
    $message = __( 'Hey! WooCommerce is required!.', 'itsoulinfotech' );

    printf( '<div class="%1$s"><p>%2$s</p></div>', esc_attr( $class ), esc_html( $message ) ); 
    }
    add_action( 'admin_notices', 'sample_admin_notice__error' );

endif;
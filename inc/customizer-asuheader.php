<?php
/**
 * asu-wordpress-web-standards-theme Theme Customizer
 *
 * @author Global Insititue of Sustainability
 * @author Ivan Montiel
 *
 * @package asu-wordpress-web-standards
 */


/**
 * Sanitizer that does nothing
 */
function wordpress_asu_sanitize_nothing( $data ) {
  return $data;
}

/**
 * Sanitizer that checks if the data is an url
 */
function wordpress_asu_sanitize_url( $data ) {
  // TODO check that $data is an email or url
  return $data;
}

/**
 * Sanitizer that checks if the data is an email or url
 */
function wordpress_asu_sanitize_email_or_url( $data ) {
  // TODO check that $data is an email or url
  return $data;
}

/**
 * Sanitizer that checks if the data is a phone number
 */
function wordpress_asu_sanitize_phone( $data ) {
  // TODO check that $data is a phone number
  return $data;
}

/**
 * Custom theme manager.  Special settings for the theme
 * get defined here.
 */
function wordpress_asu_customize_register( $wp_customize ) {
  
  //  =============================
  //  =============================
  //  =      ASU Brand Panel      =
  //  =============================
  //  =============================

  $wp_customize->add_panel(
      'wordpress_asu_theme_panel' ,
      array(
        'title'      => __( 'ASU Branding Elements','asu_wordpress' ),
        'priority'   => 1,
      )
  );


  // ======================================
  // ======================================
  // = Global Header Items                =
  // ======================================
  // ======================================

  $wp_customize->add_section(
      'wordpress_asu_theme_section_subsite_settings',
      array(
        'title'      => __( 'Global Header','asu_wordpress' ),
        'priority'   => 10,
        'panel' => 'wordpress_asu_theme_panel',
      )
  );

  //  =============================
  //  = Is Subsite                =
  //  =============================
  $wp_customize->add_setting(
      'wordpress_asu_theme_options[parent]',
      array(
        'default'           => '',
        'capability'        => 'edit_theme_options',
        'type'              => 'option',
        'sanitize_callback' => 'wordpress_asu_sanitize_nothing',
      )
  );

  $wp_customize->add_control(
      new WP_Customize_Control(
          $wp_customize,
          'subsite',
          array(
            'label'      => __( 'Does this site have a parent?', 'asu_wordpress' ),
            'section'    => 'wordpress_asu_theme_section_subsite_settings',
            'settings'   => 'wordpress_asu_theme_options[parent]',
            'type'       => 'checkbox',
          )
      )
  );

  //  =============================
  //  = Parent Name               =
  //  =============================
  $wp_customize->add_setting(
      'wordpress_asu_theme_options[parent_site_name]',
      array(
        'default'           => '',
        'capability'        => 'edit_theme_options',
        'type'              => 'option',
        'sanitize_callback' => 'wordpress_asu_sanitize_nothing',
      )
  );

  $wp_customize->add_control(
      new WP_Customize_Control(
          $wp_customize,
          'parent_blog_name',
          array(
            'label'      => __( 'Parent Site Name', 'asu_wordpress' ),
            'section'    => 'wordpress_asu_theme_section_subsite_settings',
            'settings'   => 'wordpress_asu_theme_options[parent_site_name]',
          )
      )
  );

  //  =============================
  //  = Parent URL                =
  //  =============================
  $wp_customize->add_setting(
      'wordpress_asu_theme_options[parent_url]',
      array(
        'default'           => '',
        'capability'        => 'edit_theme_options',
        'type'              => 'option',
        'sanitize_callback' => 'wordpress_asu_sanitize_url',
      )
  );

  $wp_customize->add_control(
      new WP_Customize_Control(
          $wp_customize,
          'parent_blog_id',
          array(
            'label'      => __( 'Parent Site URL', 'asu_wordpress' ),
            'section'    => 'wordpress_asu_theme_section_subsite_settings',
            'settings'   => 'wordpress_asu_theme_options[parent_url]'
          )
      )
  );
}
add_action( 'customize_register', 'wordpress_asu_customize_register' );
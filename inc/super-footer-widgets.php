<?php
// ASU Super Footer Widgets.
// Uses Carbon Fields for widget definition.
// Uses FA5 classes and SVG images for icon language.

// ===============================================
// Carbon Fields: Super Footer Branded Logo
// ===============================================
use Carbon_Fields\Widget;
use Carbon_Fields\Field;

class ASUSuperFooterEndorsedLogo extends Widget {
    // Register widget function. Must have the same name as the class
    function __construct() {
        $this->setup( 'asu-super-footer-endorsed-logo', 'ASU Endorsed Logo Widget', 'Displays an ASU endorsed logo and related textual content recommended by the ASU Brand Standards ', array(
            Field::make( 'select', 'logo-image', 'Endorsed Logo' )
                ->add_options( array(
                    '' => 'No logo required.',
                    'ked' => 'ASU KED',
                    'engineering' => 'ASU Engineering',
                    'sustainability' => 'ASU Sustainability',
                    'library' => 'ASU Library',
                ) )->set_default_value( 'blank' ),
            Field::make( 'textarea', 'logo-summary', 'Summary (Accepts HTML)' )->set_help_text('Markup includes opening and closing paragraph tags.'),
            Field::make( 'textarea', 'logo-parent-org', 'Parent Organization (Accepts HTML)' )->set_help_text('Markup includes opening and closing paragraph tags.'),
            Field::make( 'text', 'logo-contact', 'Contact Link (Full URL or Mailto)' ),
            Field::make( 'text', 'logo-phone', 'Phone Number' ),
            Field::make( 'text', 'logo-fax', 'Fax Number' ),
            Field::make( 'text', 'logo-contribute', 'Contribute Button URL' ),
        ) );
    }
    // Called when rendering the widget in the front-end
    function front_end( $args, $instance ) {
        switch ($instance['logo-image']) {
            case 'ked':
                $logourl='https://research.asu.edu';
                $logosrc='asu_enterprisedevelopment_horiz_rgb_white_150ppi_1.png';
                $logoalt='ASU endorsed logo: Enterprise Knowledge Development';
                break;
            case 'engineering':
                $logourl='https://engineering.asu.edu';
                $logosrc='asu_fultonengineering_horiz_rgb_white_150ppi.png';
                $logoalt='ASU endorsed logo: Ira A. Fulton Schools of Engineering.';
                break;
            case 'sustainability':
                $logourl='https://sustainability.asu.edu';
                $logosrc='asu_sustainability_master_rgb_digital_final_102816_horiz_rgb_white_150ppi.png';
                $logoalt='ASU endorsed logo: Julie Ann Wrigley Global Institute of Sustainability';
                break;
            case 'library':
                $logourl='https://lib.asu.edu';
                $logosrc='asu_library_horiz_rgb_white_150ppi_0.png';
                $logoalt='ASU Library (endorsed logo)';
                break;
            default:
                $logourl='';
                $logosrc='';
                $logoalt='';
                break;
        }
        
        if (! empty($instance['logo-image'])) {
            echo '<div><a class="footer-logo-link" href="' . $logourl . '">';
            echo '<img class="footer-logo" src="' . get_stylesheet_directory_uri() . '/assets/endorsed-logos/' . $logosrc . '" alt="' . $logoalt . '">';
            echo '</a></div>';
        }

        if (! empty($instance['logo-summary'])) {
            echo '<p>' . $instance['logo-summary'] . '</p>';
        }
        
        if (! empty($instance['logo-parent-org'])) {
            echo '<p>' . $instance['logo-parent-org'] . '</p>';
        }
        
        if (! empty($instance['logo-contact'])) {
            echo '<p class="contact-link"><a href="' . $instance['logo-contact'] . '" target="_blank">Contact Us</a></p>';
        }
        
        if (! empty($instance['logo-phone'])) {
            echo '<p class="phone-link"><i class="fas fa-phone" data-fa-transform="flip-h"></i>Phone: ' . $instance['logo-phone'] . '</p>';
        }
        
        if (! empty($instance['logo-fax'])) {
            echo '<p class="phone-link"><i class="fas fa-fax"></i>Fax: ' . $instance['logo-fax'] . '</p>';
        }
        
        if (! empty($instance['logo-contribute'])) {
            echo '<p>';
            echo '<a class="btn btn-primary contribute" href="' . $instance['logo-contribute'] . '" target="_blank">Contribute</a>';
            echo '</p>';
        }
    }
}

class ASUSuperFooterSocialMedia extends Widget {
    // Register widget function. Must have the same name as the class
    function __construct() {
        $this->setup( 'asu-super-footer-social-media', 'ASU Social Media Icons Widget', 'Adds a row of social media icons as recommended by the ASU Brand Standard. Intended to go immediately below the ASU Endorsed Logo Widget.  ', array(
            Field::make( 'text', 'sm-facebook', 'Facebook' ),
            Field::make( 'text', 'sm-twitter', 'Twitter' ),
            Field::make( 'text', 'sm-linkedin', 'LinkedIn' ),
            Field::make( 'text', 'sm-youtube', 'YouTube' ),
            Field::make( 'text', 'sm-vimeo', 'Vimeo' ),
            Field::make( 'text', 'sm-instagram', 'Instagram' ),
            Field::make( 'text', 'sm-flickr', 'Flickr' ),
            Field::make( 'text', 'sm-pinterest', 'Pinterest' ),
            Field::make( 'text', 'sm-snapchat', 'Snapchat' ),
            Field::make( 'text', 'sm-googleplus', 'Google Plus' ),
            Field::make( 'text', 'sm-github', 'GitHub' ),
            Field::make( 'text', 'sm-twitch', 'Twitch' ),
            Field::make( 'text', 'sm-rss', 'RSS' ),
            Field::make( 'text', 'sm-wordpress', 'Login URL (WordPress)' ),
            Field::make( 'text', 'sm-contribute', 'Contribute Button URL' ),
        ) );
    }

    // Called when rendering the widget in the front-end
    function front_end( $args, $instance ) {
        $channel = array(
            'sm-facebook' => 'fab fa-facebook-square', 
            'sm-twitter' => 'fab fa-twitter-square', 
            'sm-linkedin' => 'fab fa-linkedin',
            'sm-youtube' => 'fab fa-youtube-square',
            'sm-vimeo' => 'fab fa-vimeo', 
            'sm-instagram' => 'fab fa-instagram', 
            'sm-flickr' => 'fab fa-flickr', 
            'sm-pinterest' => 'fab fa-pinterest-square', 
            'sm-snapchat' => 'fab fa-snapchat-square', 
            'sm-googleplus' => 'fab fa-google-plus-square', 
            'sm-github' => 'fab fa-github-square', 
            'sm-twitch' => 'fab fa-twitch',
            'sm-rss' => 'fas fa-rss-square', 
            'sm-wordpress' => 'fab fa-wordpress'
        );

        $iconlist = '';

        foreach ($channel as $key => $value) {
            if (! empty($instance[$key])) {
                $iconlist .= '<li><a href="'. $instance[$key] . '" target="_blank"><i class="' . $value . '"></i></a></li>';
            }
        }

        echo '<ul class="social-icons">';
        echo $iconlist;
        echo '</ul>';
        
        if (! empty($instance['sm-contribute'])) {
            echo '<p>';
            echo '<a class="btn btn-primary contribute" href="' . $instance['sm-contribute'] . '" target="_blank">Contribute</a>';
            echo '</p>';
        }
    }
}

function asufse_load_footer_widgets() {
    register_widget( 'ASUSuperFooterEndorsedLogo' );
    register_widget( 'ASUSuperFooterSocialMedia' );
}

add_action( 'widgets_init', 'asufse_load_footer_widgets' );
/**
 * Script to duplicate the contents of the main menu of the website into the ASU Header's mobile menu.
 * Requires jQuery.
 *
 * @summary   Script to duplicate the contents of the main menu of the website into the ASU Header's mobile menu.
 *
 * @since     ASUDivi 2.1
 */

jQuery(document).ready(function(){
    var asu_mobile_button = jQuery('#asu_mobile_button');

    asu_mobile_button.on( "click", function(){
        var asu_universal_nav_new_ul = jQuery('#asu_universal_nav_new > ul');
        if (asu_universal_nav_new_ul.hasClass('pitchfork-menu-added')){
            return false;
        }

        jQuery( jQuery('#main-menu.navbar-nav > li').get().reverse() ).each(function(  ) {
            var anchor = '';
            var item = '';

            var top_level_menu = jQuery( this );

            var next_level_menu = top_level_menu.find('ul.dropdown-menu');
            var next_level_items = '';
            if (next_level_menu){
                next_level_menu.find('li').each(function(  ) {
                    var next_level_anchor = jQuery( this ).children('a');
                    var next_level_item = '<li class="cb"><a href="' + next_level_anchor.attr('href') + '">' + next_level_anchor.text() + '</a></li>'
                    next_level_items += next_level_item;
                });
            }

            anchor = top_level_menu.children('a');
            if (anchor.text() !== 'home'){
                item += '<li class="tlb">';
                item += '<div class="text"><a href="' + anchor.attr('href') + '">' + anchor.text() + '</a></div>'; // href="' + anchor.attr('href') + '"
                if (next_level_items.length){
                    item += '<div class="icn f-sort-down asu-icn"></div>';
                }
                item += '</li>';

                if (next_level_items.length){
                    item += '<li class="clb closed">';
                    item += '<ul>';
                    item += next_level_items;
                    item += '</ul>';
                    item += '</li>'
                }

                asu_universal_nav_new_ul.prepend( item );
            }

        });
        asu_universal_nav_new_ul.addClass('pitchfork-menu-added');
    });
    
    // This might be the fastest way to trigger the dropdown for top-level-menus as well as the arrows.
    jQuery( '#asu_nav_menu a[href="#"]').on('click', function() {
    });

    jQuery( 'body' ).on( 'click', '.asu-icn', function() {
        var navigation_item = jQuery( this );
        var parent_menu_list_item = jQuery( this ).parents('.tlb');
        if ( navigation_item.hasClass('f-sort-down') ){
            var child_menu_list_item = parent_menu_list_item.next('.closed');
            child_menu_list_item.removeClass('closed').addClass('opened');
            navigation_item.removeClass('f-sort-down').addClass('f-sort-up');
        }else if ( navigation_item.hasClass('f-sort-up') ) {
            var child_menu_list_item = parent_menu_list_item.next('.opened');
            child_menu_list_item.removeClass('opened').addClass('closed');
            navigation_item.removeClass('f-sort-up').addClass('f-sort-down');
        }
    });

    // jQuery( '.et_pb_button' ).each(function(  ) {
    //     jQuery( this ).removeClass('et_pb_button');
    //     jQuery( this ).addClass('btn btn-primary');
    // });
});
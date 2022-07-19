<?php

/** Setup Library for Wordpress
 * @SETUP_1 : Add the lazy loading library in the footer of the site.
 * @SETUP_2 : Add the latest version of jQuery.
 * @SETUP_3 : Replace DATA-SRC with SRC.
 * @SETUP_4 : Smart deferring of JS files.
 * 
 * Tel: @Peymanseo 
 * InstaGram: @Peymanseomag 
 * Github: github.com/peymanseo 
 * Linkdin: linkedin.com/in/peymanseo
 */

    /** @SETUP_1
     * Add the lazy loading library in the footer of the site.
     * SITE: http://jquery.eisbehr.de/lazy/
     * ===========  CDN  ===========
     * http://jquery.eisbehr.de/lazy/#docs
     */
        ?>
        <!-- Src: link Library Lazy Load Jquery  -->
        <script type="text/javascript" src="jquery.lazy.min.js"></script>

        <!-- Sample One. Function call for All images.-->
        <script>$(function() {$('img').Lazy();});</script>

        <!-- Sample Two. Function call for specific images.-->
        <script>$(function() {$('.lazy').Lazy();});</script>
        <?php

    /** @SETUP_2 
     * Add the latest version of jQuery.
     * SITE: https://jquery.com/download/
     * ===========  CDN  ===========
     * https://developers.google.com/speed/libraries#jquery
     * Note: You should not put defer for jQuery file.
     */
        // An example of adding a jQuery file to the site header
        function peymanseo_load_assets(){

            // Sample One. Load the file on your site
            wp_register_script( 'JqueryNew.peymanseo' , 'domain.com/jquery.js', array(), null, false);
            wp_enqueue_script( 'JqueryNew.peymanseo' );

            // Sample Two. Load the file on CDN Google
            wp_register_script( 'JqueryNew.peymanseo' , 'https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js', array(), null, false);
            wp_enqueue_script( 'JqueryNew.peymanseo' );
            
        }

        add_action('wp_enqueue_scripts', 'peymanseo_load_assets');

    /** @SETUP_3 
     * Replace DATA-SRC with SRC.
     */
        
        function peymanseo_data_src_replace( $html_peymanseo ) {

            if ( ! is_admin() ) {
                
                $html_peymanseo = preg_replace( '/<img(.*?)src=/is', '<img$1data-src=', $html_peymanseo );
            }

            return $html_peymanseo;
        }

        function peymanseo_data_src_replace_start() {

            ob_start( 'peymanseo_data_src_replace');

        }

        add_filter( 'wp_head', 'peymanseo_data_src_replace_start');

    /** @SETUP_4 
     * Smart deferring of JS files.
     */

        function peymanseo_defer_JS( $html_peymanseo ) {

            if ( ! is_admin() ) {

                $html_peymanseo = str_replace( "></script>", " defer></script>", $html_peymanseo );
                
            }

            return $html_peymanseo;
        }
        function peymanseo_defer_JS_start() {

            ob_start( 'peymanseo_defer_JS');

        }

        add_filter( 'wp_head', 'peymanseo_defer_JS_start' , 99);
# Run jQuery Lazy in Wordpress
Guide to setting up a lazy loader with the jQuery Lazy library in WordPress.

## Installation
#### Step 1: Refer to the `footer.php` file and place the following code before the `</body>`:
```bash
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery.lazy/1.7.9/jquery.lazy.min.js"></script>
```
If you have placed the files on your site, call it like this:
```bash
<script type="text/javascript" src="https://domain.com/wp-content/themes/{name-theme}/assets/js/jquery.lazy.min.js"></script>
```
Note: In the src section, you must enter the path of the jQuery Lazy library file on your site.

#### Step 2: Now, after the call library, put exactly one of the following codes.

 Sample One. Function call for All images.
```bash
<script type="text/javascript"> $(function() {$('img').Lazy();}); </script>
```
Sample Two. Function call for specific images with class .lazy
```bash
<script type="text/javascript"> $(function() {$('.lazy').Lazy();}); </script>
```
The library is installed on the site, now you need to prepare the site for the library.

## Add jQuery library on the site
Refer to the site template `function.php` file and put the following code at the end of the `function.php` file.

#### If you can access the file via CDN, use the following command.
```bash
// Sample Two. Load the file on CDN Google
function peymanseo_load_assets(){
  wp_register_script( 'JqueryNew.peymanseo' , 'https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js', array(), null, false);
  wp_enqueue_script( 'JqueryNew.peymanseo' );
}
add_action('wp_enqueue_scripts', 'peymanseo_load_assets');
``` 
#### If you want to call the file from your site, use the following command.
```bash
// Sample One. Load the file on your site
function peymanseo_load_assets(){
  wp_register_script( 'JqueryNew.peymanseo' , 'https://domain.com/wp-content/themes/{name-theme}/assets/js/jquery.js', array(), null, false);
  wp_enqueue_script( 'JqueryNew.peymanseo' );
}
add_action('wp_enqueue_scripts', 'peymanseo_load_assets');
```
Note: In the URL field, you must enter the path of the jQuery Lazy library file on your site.

## Replace DATA-SRC with SRC
Again, put the following code at the end of the function.php file to replace SRC with DATA-SRC.
```bash
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
```
The work is done.

# Description
Using the code below, we enabled lazy jQuery library and replaced data-src with src for images in WordPress. Now, using these codes, the lazy library creates a base64 link for images in the src attribute, and when the user approaches the new image, the base64 image link changes to the original image link, and the data_src attribute is removed. Now the image upload request is sent and the image is uploaded.

For more information, refer to the comments in the `Activating jQuery Lazy in WordPress.php`.

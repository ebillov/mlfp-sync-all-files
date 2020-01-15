<?php

//Exit if accessed directly.
defined('ABSPATH') or exit;

?>
<style>
label {
    display: block;
    font-weight: 600;
    margin-bottom: 10px;
}
label span.description {
    font-weight: normal;
    margin-top: 10px;
    display: block;
}
hr {
    margin: 15px 0;
}
.disabled_element {
    pointer-events: none;
    opacity: 0.5;
}
</style>
<div class="wrap">
    <h2>Sync All FTP Files</h2>
    <p>Sync all files that are uploaded from the FTP or cPanel file manager. This will add the files to the Media Library.</p>
    <hr>
    <form method="post">
        <label>
            Directory To Sync
            <input style="width: 100%; margin-top: 10px;" type="text" name="dir_sync" value="<?php echo $this->get_sync_path(); ?>" autocomplete="off"/><br>
            <span class="description">Leave empty to default to <?php echo ABSPATH . 'wp-content/uploads'; ?></span>
        </label>
        <input class="button button-primary" type="submit" name="submit_dir_sync" value="Save Path Sync Settings"/>
    </form>
    <hr>
    <p><b>NOTE:</b> This will attempt to sync all the files from the directory path: <b><?php echo $this->get_sync_path(); ?></b></p>
    <a href="#" id="sync_all_files" class="button button-primary">Sync All Files</a>
</div>
<script>
jQuery(function(){
    jQuery('a#sync_all_files').click(function(e){
        e.preventDefault();

        //Define the element
        var button = jQuery(this);
        //Disable the button
        
        button.addClass('disabled_element');

        //Begin ajax request
        jQuery.ajax({
            url: '<?php echo admin_url( 'admin-ajax.php' ); ?>',
            dataType: 'json',
            data: [
                { name: 'action', value: 'sync_all_files' },
                { name: 'sync_all', value: true }
            ],
            type: 'post',
            error: function(error){
                console.log(error);
                button.removeClass('disabled_element');
            },
            success: function(data){
                console.log(data);
                button.removeClass('disabled_element');
            }
        });

    });
});
</script>
var base_url = '/~asg4/songs/index.php';

$(document).ready(function() {
    $('#form_song_data').submit(function() { // catch the form's submit event
        $.ajax({ // create an AJAX call...
            data: $(this).serialize(), // get the form data
            type: 'POST',
            url: "<?php echo site_url('music/update_metadata'); ?>",
            success: function(response) { // on success..
                alert(response);
                $('#song_tags').html(response); // update the DIV
            },
            error: function(response) {
                alert('fail');
            },
            //"<?php echo base_url(); ?>/music/update_metadata"
        });
        return false; // cancel original event to prevent form submitting
    });
});

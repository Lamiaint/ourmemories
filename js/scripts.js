// tinymce.init({ selector: 'textarea' });

$(document).ready(function() {
    // summernote add_post_index.php
    $('#summernote').summernote({
        height: 200
    });



    //emoji sidebart
    $('#e_comments').emojioneArea({
        pickerPosition: "top"
    });


    //emoji post
    $('#p_comments').emojioneArea({
        pickerPosition: "top"
    });






});
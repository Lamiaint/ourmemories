$(document).ready(function() {
    $('#summernote').summernote({
        height: 200
    });

    $('#selectAllBoxes').click(function(event) {
        if (this.checked) {
            $('.checkBoxes').each(function() {
                this.checked = true;

            })

        } else {
            this.checked = false;

        }

    })
});
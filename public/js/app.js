$('.pop').ready(function() {
    const previewImages = document.querySelectorAll('.preview-image');
    const modalImage = document.querySelector('.modal-body .imagepreview');

    previewImages.forEach(image => {
        image.addEventListener('click', function(event) {
            event.stopPropagation();
            const imageUrl = this.getAttribute('src');
            modalImage.setAttribute('src', imageUrl);
            $('#imagemodal').modal('show');
            });
        });
    });

    const waveButtons = document.querySelectorAll('.wave-effect');

    waveButtons.forEach((button) => {
        button.addEventListener('mouseenter', () => {
            button.style.animationPlayState = 'paused';
        });

        button.addEventListener('mouseleave', () => {
            button.style.animationPlayState = 'running';
        });
    });
    
    $(document).ready(function() {
        let fileInputCount = 1;

        $(".add_item_btn").click(function(e) {
            e.preventDefault();
            $("#show_item").append('<div class="row mt-2">' +
                '<div class="col-8">' +
                '<input type="file" class="form-control input-file-now-custom" name="images[]" multiple>' +
                '</div>' +
                '<div class="col-3">' +
                '<button class="btn btn-danger remove_item_button">Hapus</button>' +
                '</div>' +
                '</div>');

            fileInputCount++;
        });

        $(document).on('click', '.remove_item_button', function(e){
            e.preventDefault();
            let row_item = $(this).parent().parent();
            $(row_item).remove();
        });
    });

    flatpickr(".datepicker", {
        dateFormat: "d-m-Y",
        allowInput: true,
    });
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

    const cmInput = document.getElementById('cmInput');
    const warningMessage = document.getElementById('warningMessage');

    cmInput.addEventListener('change', function () {
        const enteredValue = this.value;

        if (enteredValue.length === 8 && !isNaN(enteredValue)) {
            warningMessage.textContent = '';
        } else {
            warningMessage.textContent = 'Masukkan No. Rekam Medis yang sesuai';
        }
    });

    
    function formatNumber(input) {
        // Remove any non-digit characters from the input
        const cleanedInput = input.replace(/\D/g, '');
        const warningTanggal = document.getElementById('errorKunjungan');
        const kosong = "";

        // If the input is exactly 8 digits
        if (cleanedInput.length === 8) {
            // Split the input into two parts: the first two digits and the rest
            const day = cleanedInput.substring(0, 2);
            const month = cleanedInput.substring(2, 4);
            const year = cleanedInput.substring(4);

            // Check if the first two digits are within a valid date range (01-31)
            if (parseInt(day) >= 1 && parseInt(day) <= 31) {
                warningTanggal.textContent = '';
                return `${day}/${month}/${year}`;
            } if (parseInt(day) >= 32){
                warningTanggal.textContent = 'Isi tanggal dengan benar.';
                return  kosong;
            } else {
                return kosong;
            }
        }

        // If the input is less than 8 digits, pad with leading zeros up to 8 digits
        if (cleanedInput.length == 8 && cleanedInput.length == 7) {
            const paddedInput = cleanedInput.padStart(8, '0');
            return formatNumber(paddedInput);
        } if(cleanedInput.length <= 6) {
            warningTanggal.textContent = 'Isi tanggal dengan benar.';
            return kosong;
        }

        // If the input is not exactly 8 digits or doesn't meet the condition, replace any non-digit characters with "/"
        return cleanedInput.replace(/\D/g, '/');
    }

    // Get the input element
    const numberInput = document.getElementById('kunjunganInput');

    // Add event listener to the input field using the 'change' event
    numberInput.addEventListener('change', function () {
        // Get the entered value from the input field
        const enteredValue = numberInput.value;

        // Call the formatNumber function to format the input
        const formattedValue = formatNumber(enteredValue);

        // Update the input field value with the formatted output
        numberInput.value = formattedValue;
    });
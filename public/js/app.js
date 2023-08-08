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
        const apiUrlBase = "https://uts-ws.nlm.nih.gov/rest/search/current";
        const limitResults = 10;
        let typingTimeout;
        const ranapToggle = $('.toggle-ranap');
        const rajalToggle = $('.toggle-rajal');
        const igdToggle = $('.toggle-igd');

        function appendFileInput(containerId) {
            $(containerId).append(
                '<div class="row mt-2">' +
                '<div class="col-8">' +
                '<input type="file" class="form-control input-file-now-custom" name="images[]" multiple>' +
                '</div>' +
                '<div class="col-3">' +
                '<button class="btn btn-danger remove_item_button"><i class="fa fa-trash" style="font-size: 16px;"></i></button>' +
                '</div>' +
                '</div>'
            );
        }

            $(".add_item_btn").click(function(e) {
                e.preventDefault();
                let containerId = $(this).closest('.m-2').attr('id');
                appendFileInput(`#${containerId}`);

                fileInputCount++;
            });

        $(document).on('click', '.remove_item_button', function(e){
            e.preventDefault();
            let row_item = $(this).parent().parent();
            $(row_item).remove();
        });

        function fetchDiagnosaList(searchTerm) {
            const apiUrl = `${apiUrlBase}?apiKey=${apiKey}&string=${searchTerm}&sabs=SNOMEDCT_US&returnIdType=code`;
            console.log(apiUrl);
            $.ajax({
              url: apiUrl,
              method: "GET",
              success: function (data) {
                const diagnosaResults = $("#diagnosaResults");
                diagnosaResults.empty();
          
                if (data.result.results.length > 0) {
                  for (let i = 0; i < Math.min(data.result.results.length, limitResults); i++) {
                    const item = data.result.results[i];
                    const diagnosaItem = $("<a>", {
                      href: "#",
                      class: "list-group-item list-group-item-action",
                      text: item.name,
                      "data-sctid": item.ui,
                    });
                    diagnosaResults.append(diagnosaItem);
                  }
                  diagnosaResults.show();
                } else {
                  diagnosaResults.hide();
                }
              },
              error: function () {
                  const diagnosaResults = $("#diagnosaResults");
                  diagnosaResults.hide();
                },
            });
          }
          
          $("#diagnosaInput").on("input", function () {
              const searchTerm = $(this).val();
              if (searchTerm === '') {
                $("#sctidInput").val('');
                $("#diagnosaResults").hide();
              } else {
                clearTimeout(typingTimeout);
          
                typingTimeout = setTimeout(function () {
                  const inputOffset = $(this).offset();
                  const inputWidth = $(this).outerWidth();
                  const inputHeight = $(this).outerHeight();
          
                  fetchDiagnosaList(searchTerm);
                }.bind(this), 500);
              }
            });
  
          $(document).on("click", ".diagnosa-results .list-group-item-action", function () {
            const selectedDiagnosa = $(this).text();
            const selectedSCTID = $(this).data('sctid');
            $("#diagnosaInput").val(selectedDiagnosa);
            $("#sctidInput").val(selectedSCTID);
            $("#diagnosaResults").hide();
          });

          $(document).on('change', '#cmInput', function (e) {
            e.preventDefault();
            const enteredValue = $(this).val();

            const warningMessage = $('#warningMessage');

            if (enteredValue.length === 8 && !isNaN(enteredValue)) {
                warningMessage.text('');
            } else {
                warningMessage.text('Masukkan No. Rekam Medis yang sesuai');
            }
        });

        function formatNumber(input) {
            const cleanedInput = input.replace(/\D/g, '');
            const warningTanggal = document.getElementById('errorKunjungan');
            const kosong = "";
    
            if (cleanedInput.length === 8) {
                const day = cleanedInput.substring(0, 2);
                const month = cleanedInput.substring(2, 4);
                const year = cleanedInput.substring(4);
    
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
    
            if (cleanedInput.length == 8 && cleanedInput.length == 7) {
                const paddedInput = cleanedInput.padStart(8, '0');
                return formatNumber(paddedInput);
            } if(cleanedInput.length <= 6) {
                warningTanggal.textContent = 'Isi tanggal dengan benar.';
                return kosong;
            }
    
            return cleanedInput.replace(/\D/g, '/');
        }

        $(document).on('change', '#diagnosaInput', function () {
            const diagnosaInputValue = $(this).val();
            const sctidInput = $('#sctidInput');

            if (diagnosaInputValue !== ''){
                sctidInput.val('');
            }
        });

        $(document).on('change', '#kunjunganInput', function () {
            const enteredValue = $(this).val();

            const formattedValue = formatNumber(enteredValue);

            $(this).val(formattedValue);
        });

        $('#pelayananSelect').on('change', function () {
            const selectedValue = $(this).val();

            const ranapValue = selectedValue === 'Rawat Inap' ? 'block' : 'none';
            const rajalValue = selectedValue === 'Rawat Jalan' ? 'block' : 'none';
            const igdValue = selectedValue === 'IGD' ? 'block' : 'none';

            rajalToggle.css('display', rajalValue);
            ranapToggle.css('display', ranapValue);
            igdToggle.css('display', igdValue);
        });

    });
<script>
    let clubs;

    const addScore = () => {
        var x = 2

        var wrapper = $(".score_wrap");

        var add_button = $("#buttonAddScore");

        $(add_button).click(function(e) {
            e.preventDefault();

            x++;

            let options = '';

            for (let i = 0; i < clubs.length; i++) {
                options = options + `
                    <option value="${clubs[i].id}">${clubs[i].name}</option>
                `
            }

            $(wrapper).append(`
                <div class="row clone mb-3">
                    <div class="col-3 form-group">
                        <label for="club_1${x}">Klub 1</label>
                        <select name="club_1[]" id="club_1${x}" class="form-control">
                            <option value="" selected disabled>Pilih Klub 1</option>
                            ${options}
                        </select>
                    </div>
                    <div class="col-3 form-group">
                        <label for="club_2${x}">Klub 2</label>
                        <select name="club_2[]" id="club_2${x}" class="form-control">
                            <option value="" selected disabled>Pilih Klub 2</option>
                            ${options}
                        </select>
                    </div>
                    <div class="col-3 form-group">
                        <label for="score_1${x}">Score 1</label>
                        <input type="number" id="score_1${x}" class="form-control" value="0" name="score_1[]"
                            min="0" autocomplete="off">
                    </div>
                    <div class="col-2 form-group">
                        <label for="score_2${x}">Score 2</label>
                        <input type="number" id="score_2${x}" name="score_2[]" class="form-control" value="0"
                            min="0" autocomplete="off">
                    </div>
                    <div class="col-1 form-group">
                        <label></label>
                        <span class="remove_score input-group-text" style="color: #fff; background-color: red; cursor: pointer;">x</span>
                    </div>
                </div>
            `);
        });


        $(wrapper).on("click", ".remove_score", function(e) {
            e.preventDefault();
            $(this).parent('div').parent('div').remove();
            x--;
        });
    }

    $(function() {
        // SECTION set CSRF token
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        });
        // !SECTION set CSRF token
        $.ajax({
            type: "get",
            url: "/clubs/get",
            dataType: "json",
            success: function(response) {
                clubs = response
            }
        });

        addScore()
        // SECTION submit add
        $('#submit').click(function(e) {
            e.preventDefault();

            var formData = $('#form').serialize();

            Swal.fire({
                title: 'Please Wait!',
                showConfirmButton: false,
                allowOutsideClick: false,
                willOpen: () => {
                    Swal.showLoading()
                },
            });

            $.ajax({
                type: "POST",
                url: "/scores",
                data: formData,
                dataType: "json",
                success: function(data) {
                    swal.close();

                    if (data.status) {
                        Swal.fire(
                            'Success!',
                            data.msg,
                            'success'
                        )

                        $('#form').trigger("reset");
                        $('#create_score_wrap').html('');
                    } else {
                        Swal.fire(
                            'Error!',
                            data.msg,
                            'warning'
                        )
                    }
                }
            });
        });
        // !SECTION submit add
    });
</script>

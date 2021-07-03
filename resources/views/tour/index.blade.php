<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Industrial Games 29 Tour Fakultas</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
        <link rel="icon" href="{{ asset('assets/img/icon.png')}}">
    </head>

    <body>
        <div class="container">
            <div class="header">
                <div>Selamat Datang di Website Tour Fakultas Teknik</div>
            </div>

            <div class="map">
                <div><div class="map-child"><img src="{{asset('assets/img/map-teknik.jpg')}}"></div></div>
                <div><div class="map-child"><img src="{{asset('assets/img/map-teaching.jpg')}}"></div></div>
            </div>

            <div class="photo-controller">
                <div class="control">
                    <div class="pilih-lokasi">Pilih Lokasi</div>
                    <select name="" class="selectbox" id="select-location">
                        <option value="" selected disabled>-- Pilih Lokasi --</option>
                        @foreach ($regions as $region) 
                            <option value="{{ $region->id }}" class="option">{{ $region->nama }}</option>
                        @endforeach
                        
                    </select>
                </div>

                <div class="gallery">
                    <div class="gallery-slide" id="gallery-slide">
                        
                    </div>
                </div>
            </div>
        </div>

        <script>
            $(document).ready(function() {
                $('.gallery').hide();
            });

            $(document).on('change', '#select-location', function() {
                $('.gallery').show();
                $('#gallery-slide').html("<img src='../assets/img/loading.gif' style='border: 0; margin: auto'>");
                setTimeout(getPhoto, 1500);
            });

            function getPhoto() {
                $.ajax({
                    type: 'POST',
                    url: '{{ route("selectTourPage") }}',
                    data: {
                        '_token': '<?php echo csrf_token() ?>',
                        'id': $('#select-location').val()
                    },
                    success: function(data) {
                        $('#gallery-slide').html("");
                        $.each(data.photo_list, function(index, value) {
                            var location = "assets/img/" + value.folder + "/" + value.file;
                            $('#gallery-slide').append("<img src='../" + location + "'>");
                        });

                        $('#gallery-slide').append("<div style='visibility: hidden;' class='yey'>&nbsp;&nbsp;&nbsp;&nbsp;</div>");
                    }
                });
            }

            document.addEventListener('contextmenu', event => event.preventDefault());
            document.onkeydown = function (e) {
                if(e.keyCode == 123) { return false; }
                if(e.ctrlKey && e.shiftKey && e.keyCode == 73){ return false; }
                if(e.ctrlKey && e.shiftKey && e.keyCode == 74) { return false; }
                if(e.ctrlKey && e.keyCode == 85) { return false; }
            }
        </script>
    </body>
</html>
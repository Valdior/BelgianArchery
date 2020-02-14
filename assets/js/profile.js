import '../css/profile.scss';
import $ from 'jquery';

$(document).ready(function () {
    let imgSrc = $('#imgProfile').attr('src');
    function readURL(input) {

        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#imgProfile').attr('src', e.target.result);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
    $('#btnChangePicture').on('click', function () {
        console.debug('btnChangePicture');
        // document.getElementById('profilePicture').click();
        if (!$('#btnChangePicture').hasClass('changing')) {
            $('#profilePicture').click();
        }
        else {
            // change
        }
        console.debug('btnChangePicture stop');
    });
    $('#profilePicture').on('change', function () {
        readURL(this);
        $('#btnChangePicture').addClass('changing');
        $('#btnChangePicture').attr('value', 'Confirm');
        $('#btnDiscard').removeClass('d-none');
        // $('#imgProfile').attr('src', '');
    });
    $('#btnDiscard').on('click', function () {
        // if ($('#btnDiscard').hasClass('d-none')) {
        $('#btnChangePicture').removeClass('changing');
        $('#btnChangePicture').attr('value', 'Change');
        $('#btnDiscard').addClass('d-none');
        $('#imgProfile').attr('src', imgSrc);
        $('#profilePicture').val('');
        // }
    });
});
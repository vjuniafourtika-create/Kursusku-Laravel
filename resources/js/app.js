
import 'bootstrap';
import $ from 'jquery';

window.$ = window.jQuery = $;

// Ajax untuk menampilkan ketersediaan kursus
$(document).ready(function () {
    $('#course_id').on('change', function () {
        const courseId = $(this).val();
        const availability = $('#availability');

        if (!courseId) {
            availability.addClass('d-none').text('');
            return;
        }

        availability
            .removeClass('d-none alert-danger alert-success')
            .addClass('alert-info')
            .text('Memuat informasi kursus...');

        $.ajax({
            url: `/courses/${courseId}/availability`,
            method: 'GET',
            dataType: 'json',

            success: function (data) {
                availability
                    .removeClass('alert-info alert-danger')
                    .addClass('alert-success')
                    .text(
                        `${data.course}: tersisa ${data.remaining} kursi.`
                    );
            },

            error: function () {
                availability
                    .removeClass('alert-info alert-success')
                    .addClass('alert-danger')
                    .text('Informasi kursus gagal dimuat.');
            }
        });
    });
});

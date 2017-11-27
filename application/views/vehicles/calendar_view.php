<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<link rel="stylesheet" href="<?= base_url('assets/css/calendar.css') ?>"/>

<div id="calendar-html-output">
    <?= $calendar ?>
</div>

<script>
    $(document).ready(function(){
        $(document).on("click", '.prev', function(event) {
            var month =  $(this).data("prev-month");
            var year =  $(this).data("prev-year");
            getCalendar(month,year);
        });
        $(document).on("click", '.next', function(event) {
            var month =  $(this).data("next-month");
            var year =  $(this).data("next-year");
            getCalendar(month,year);
        });
        $(document).on("blur", '#currentYear', function(event) {
            var month =  $('#currentMonth').text();
            var year = $('#currentYear').text();
            getCalendar(month,year);
        });
    });

    function getCalendar(month,year){
        $("#body-overlay").show();
        $.ajax({
            url: "/vehicles/ajax_get_calendar/<?= $id ?>",
            type: "POST",
            data:'month='+month+'&year='+year,
            success: function(response){
                $("#calendar-html-output").fadeOut('fast').promise().done(function () {
                    $(this).html(response).fadeIn('fast');
                });
            },
            error: function(){}
        });
    }
</script>
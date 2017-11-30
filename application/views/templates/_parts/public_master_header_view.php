<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title><?php echo $page_title;?></title>
    <meta name="description" value="<?php echo $page_description;?>" />
    <?php echo $before_closing_head;?>
</head>
<body>

<?php if (!empty($alert)) : ?>
    <script>
        $(document).ready(function () {
            $('body').append('<?= $alert; ?>');
            $('#alert_box').fadeIn().delay(5000).fadeOut();

            $('#close_alert').click(function(e) {
                $(this).closest('#alert_box').stop().fadeOut();
            });
        });
    </script>
<?php endif; ?>
<?php
include("../../header.php");
$curr_ctrl = $_SESSION['home_ctrl'];
?>
    <script>
        var curr_ctrl = '<?php print ($curr_ctrl!="")?$curr_ctrl:"basic_info";?>';
        $(function() {
            $('.ctrl_link').click(function(){
                $('.ctrl_link').removeClass('curr');
                $(this).addClass('curr');
            });

            //$('#content_panel').html('<div class="loading cover"></div>').load('home_control.php?ctrl='+curr_ctrl);
        });

        function ctrl_info(e){
            $('#ctrl').val(e);
            $('#content_panel').html('<div class="loading cover"></div>').load('home_control.php?ctrl='+e);
        }
    </script>

<?php
include("../../public_content.php");
include("../../footer.php");
?>
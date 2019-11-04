<?php
include("../../header.php");
include_once("config.php");
?>
    <table id="content_holder" class="ctrl_content" border="0" cellpadding="0" cellspacing="0">
        <tr valign="top">
            <td>
                <?php //include('park_control_tab_1.php');?>
            </td>
        </tr>
    </table>

    <script>
        var act_tab = '<?php print $_COOKIE['order_tab'];?>';
        var ctrl_id = '';
        ctrl_action = '';
        var post_url = 'order_manage.php';
        var curr_tab_panel = '';
        var company_sort_arr = new Array;
        var curr_page = 1,
            page_span = 5;

        $(function() {
            if(act_tab==''){
                document.cookie = 'order_tab=1';
                $('#tab_panel_1').show();
                curr_tab_panel = '#tab_panel_1';
            }
            else{
                $('.tab').removeClass('curr');
                $('#tab_'+act_tab).addClass('curr');
                $('#tab_panel_'+act_tab).show();
                curr_tab_panel = '#tab_panel_'+act_tab;
            }
        });
    </script>

<?php
include("../../public_content.php");
include("../../footer.php");
?>
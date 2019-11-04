</div>

<!--TO TOP-->
<div class="float" id="to_top">
    <a class="link" href="#top"></a>
</div>

<div id="alert_panel" class="overlay">
    <table border="0" cellpadding="0" cellspacing="0">
        <tr>
            <td valign="middle" align="center" class="alert_holder"></td>
        </tr>
    </table>
</div>

</body>
</html>

<script>
    function show_alert(msg,type){
        if(msg!=''){
            var msg_str = '',
                btn_str = '';
            switch(type){
                case 'load':
                    msg_str = '<div class="loading"><i></i>'+msg+'</div>';
                    break;
                case 'reload':
                    msg_str = '<p>'+msg+'</p>';
                    btn_str = '<p><button class="ctrl_btn active" onclick="window.location.reload();">确定</button></p>';
                    break;
                case 'close':
                    msg_str = '<p>'+msg+'</p>';
                    btn_str = '<p><button class="ctrl_btn active" onclick="$(\'#alert_panel\').hide();">确定</button></p>';
                    break;
                default:
                    msg_str = '<p>'+msg+'</p>';
                    btn_str = '<p><button class="ctrl_btn active" onclick="document.cookie=\'response=;path=./\';$(\'.overlay\').hide().setOverlay();">确定</button></p>';
            }

            $('#alert_panel .alert_holder').html(msg_str+btn_str);
            if(!$('#alert_panel').is(':visible'))$('#alert_panel').show().setOverlay();
        }
    }

    //审核后改变点数
    //type => ep,pr
    //audit => 0,1,2
    function changeAuditCount(type,audit){
        var all_count = $('#all_count').text(),
            ep_count = $('#ep_count').text(),
            pr_count = $('#pr_count').text();

        if(type == "pr"){
            //console.log(111);
            if(audit != 0){
                //console.log(222);
                pr_count--;
                all_count--;
                if(pr_count == "" || pr_count == 0){
                    $('#all_count').text(all_count);
                    $('#pr_count').text(pr_count);
                    $('#pr_count').hide();
                }else{
                    $('#all_count').text(all_count);
                    $('#pr_count').text(pr_count);
                }
                if(all_count == "" || all_count == 0){
                    $('#pr_count').text(pr_count);
                    $('#all_count').text(all_count);
                    $('#all_count').hide();
                }
            }else{
                //console.log(333);
                if(all_count == 0 || pr_count == 0){
                    all_count++;
                    pr_count++;
                    $('#all_count').text(all_count);
                    $('#pr_count').text(pr_count);
                    $('#pr_count').show();
                    $('#all_count').show();
                }else{
                    all_count++;
                    pr_count++;
                    $('#all_count').text(all_count);
                    $('#pr_count').text(pr_count);
                }
            }
        }
        if(type == "ep"){
            //console.log(111);
            if(audit != 0){
                //console.log(222);
                ep_count--;
                all_count--;
                if(ep_count == "" || ep_count == 0){
                    $('#all_count').text(all_count);
                    $('#ep_count').text(ep_count);
                    $('#ep_count').hide();
                }else{
                    $('#all_count').text(all_count);
                    $('#ep_count').text(ep_count);
                }
                if(all_count == "" || all_count == 0){
                    $('#ep_count').text(ep_count);
                    $('#all_count').text(all_count);
                    $('#all_count').hide();
                }
            }else{
                //console.log(333);
                if(all_count == 0 || ep_count == 0){
                    all_count++;
                    ep_count++;
                    $('#all_count').text(all_count);
                    $('#ep_count').text(ep_count);
                    $('#ep_count').show();
                    $('#all_count').show();
                }else{
                    all_count++;
                    ep_count++;
                    $('#all_count').text(all_count);
                    $('#ep_count').text(ep_count);
                }
            }
        }
        //console.log("总数:"+all_count+"ep:"+ep_count+"pr:"+pr_count);
    }
</script>

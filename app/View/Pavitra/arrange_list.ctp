<style>
    .left-block{
        width:48%;display:inline-block;float:left;margin:1%;
    } 
    .left-block select{width:100%}
    .left-block div{
        width: 100%;
        text-align: center;
        color: rgb(0, 0, 0);
        border-top-left-radius: 10px;
        border-top-right-radius: 10px;
        padding: 1.5%;
        background: transparent linear-gradient(rgb(215, 228, 255), rgb(137, 168, 236)) repeat scroll 0% 0%;
    }
    .btn-action{
        -moz-box-shadow: inset 0px 1px 0px 0px #1444D1;
        -webkit-box-shadow: inset 0px 1px 0px 0px #1444D1;
        box-shadow: inset 0px 1px 0px 0px #1444D1;
        background: #5197ff !important;
        background: -moz-linear-gradient(to bottom, #fff 0%,#a1bfff 100%) !important;
        background: -webkit-linear-gradient(to bottom, #fff 0%,#a1bfff 100%) !important;
        background: -o-linear-gradient(to bottom, #fff 0%,#a1bfff 100%)!important;
        background: -ms-linear-gradient(to bottom, #fff 0%,#a1bfff 100%)!important;
        background: linear-gradient(to bottom, #fff 0%,#a1bfff 100%)!important;
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#fff', endColorstr='#a1bfff',GradientType=0 ) !important;
        border-radius:7px;
        border: 1px solid #0c51ab;
        display: inline-block;
        cursor: pointer;
        color: #332E2E;
        font-family: Arial;
        font-size: 14px;
        text-decoration: none;
        width: 80px;}
    .middle-block{width:100%;margin:1%;}
    .inner-block{text-align: right;width: 55%;display: inline-block;}
    .inner-block2{text-align: right;width: 43%;display: inline-block;}
    .legend_title{width:15%;}
</style>
<Div>
    <?php echo $this->Form->create('arrange_list', array('url' => array('controller' => 'Pavitras', 'action' => 'save_arrange_list'))); ?>
    <table>
        <tr>
            <td class="col-xs-6"></td>
            <td class="col-xs-5"></td>
            <td><input  type="submit" name="Save" id="save" value="Save" class="btn btn-sm logbutton2"></td>
            <td class="col-xs-1"><input  type="button" name="caste_hm_exit" id="caste_hm_exit" value="Clear" class="btn btn-sm logbutton2"></td>
        </tr>
    </table>
    <fieldset class="myfieldset">
        <legend><div class="legend_title">Personal Details</div></legend>
        <div width="100%">

            <div class="left-block">
                <div> Applied Vacancy Post</div>
                <select name="selectfrom" id="select-from" multiple size="5">
                    <?php $j=1;for ($i = 0; $i < count($all_pref_list); $i++,$j++) { ?>
                        <option value="<?php echo trim(trim($check[$i][0]['edn_level']) . "-" . trim($check[$i][0]['applied_post']) . "-" . trim($check[$i]['0']['applied_medium']) . "-" . trim($check[$i][0]['sanstha_id']) . "-" . trim($check[$i][0]['applied_sub']) . "-" . trim($check[$i][0]['appl_id']) . "-" . trim($check[$i][0]['aid_type']) . "-" . trim($check[$i][0]['appl_categ'])); ?>"><?php echo $j.")"; ?><?php echo trim($check[$i][0]['sanstha_name']) . "/" . trim($check[$i][0]['post_desc']) . "/" . trim($check[$i][0]['medinstr_desc']) ?></option>
                    <?php } ?>
                </select>

            </div>
            <div class="left-block">
                <div> Applied Vacancy Post</div>
                <select name="selectto[]" id="select-to" multiple size="5">
                </select>
            </div>
        </div>
        <div class="middle-block">
            <div class="inner-block">    
                <a href="JavaScript:void(0);" id="btn-add" class="btn btn-sm btn-action">Add &raquo;</a>
                <a href="JavaScript:void(0);" id="btn-remove" class="btn btn-sm btn-action">&laquo; Remove</a>
            </div>
            <div class="inner-block2">
                <!--<a href="JavaScript:void(0);" id="select_all">select all</a>-->
                <a href="JavaScript:void(0);" id="btn-up" class="btn btn-sm btn-action">Up</a>
                <a href="JavaScript:void(0);" id="btn-down" class="btn btn-sm btn-action">Down</a>
            </div>
        </div>

    </fieldset>
</Div>
<script>
    $(document).ready(function() {
        $('#btn-add').click(function() {
            $('#select-from option:selected').each(function() {
                $('#select-to').append("<option value='" + $.trim($(this).val()) + "'>" + $.trim($(this).text()) + "</option>");
                $(this).remove();
            });
        });
        $('#btn-remove').click(function() {
            $('#select-to option:selected').each(function() {
                $('#select-from').append("<option value='" + $.trim($(this).val()) + "'>" + $.trim($(this).text()) + "</option>");
                $(this).remove();
            });
        });
        $('#btn-up').bind('click', function() {
            $('#select-to option:selected').each(function() {
                var newPos = $('#select-to option').index(this) - 1;
                if (newPos > -1) {
                    $('#select-to option').eq(newPos).before("<option value='" + $.trim($(this).val()) + "' selected='selected'>" + $.trim($(this).text()) + "</option>");
                    $(this).remove();
                }
            });
        });
        $('#btn-down').bind('click', function() {
            var countOptions = $('#select-to option').size();
            $('#select-to option:selected').each(function() {
                var newPos = $('#select-to option').index(this) + 1;
                if (newPos < countOptions) {
                    $('#select-to option').eq(newPos).after("<option value='" + $.trim($(this).val()) + "' selected='selected'>" + $.trim($(this).text()) + "</option>");
                    $(this).remove();
                }
            });
        });
        $('#save').click(function() {
            $('#select-to option').prop('selected', true);
        });
    });
</script>
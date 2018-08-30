<form>
    <fieldset>
        <select name="selectfrom" id="select-from" multiple size="5">
            <?php for ($i = 0; $i < count($all_pref_list); $i++) { ?>
                <option value="<?php echo trim($check[$i]['ApplicantPreferences']['appl_id']) . "-" . trim($check[$i]['ApplicantPreferences']['edn_level']) . "-" . trim($check[$i]['ApplicantPreferences']['applied_post']) . "-" . trim($check[$i]['ApplicantPreferences']['applied_medium']) . "-" . trim($check[$i]['ApplicantPreferences']['sanstha_id']) . "-" . trim($check[$i]['ApplicantPreferences']['applied_sub']) ?>"><?php echo trim($check[$i]['ApplicantPreferences']['sanstha_id']) ?></option>
            <?php } ?>
        </select>
        <a href="JavaScript:void(0);" id="btn-add">Add &raquo;</a>
        <a href="JavaScript:void(0);" id="btn-remove">&laquo; Remove</a>
        <select name="selectto" id="select-to" multiple size="5">
            <?php for ($i = 0; $i < count($all_pref_list); $i++) { ?>
                <option value="<?php echo trim($check[$i]['ApplicantPreferences']['appl_id']) . "-" . trim($check[$i]['ApplicantPreferences']['edn_level']) . "-" . trim($check[$i]['ApplicantPreferences']['applied_post']) . "-" . trim($check[$i]['ApplicantPreferences']['applied_medium']) . "-" . trim($check[$i]['ApplicantPreferences']['sanstha_id']) . "-" . trim($check[$i]['ApplicantPreferences']['applied_sub']) ?>"><?php echo trim($check[$i]['ApplicantPreferences']['sanstha_id']) ?></option>
            <?php } ?>
        </select>
        <a href="JavaScript:void(0);" id="btn-up">Up</a>
        <a href="JavaScript:void(0);" id="btn-down">Down</a>
    </fieldset>
</form>
<script>
    $(document).ready(function() {
        $('#btn-add').click(function() {
            $('#select-from option:selected').each(function() {
                $('#select-to').append("<option value='" + $(this).val() + "'>" + $(this).text() + "</option>");
                $(this).remove();
            });
        });
        $('#btn-remove').click(function() {
            $('#select-to option:selected').each(function() {
                $('#select-from').append("<option value='" + $(this).val() + "'>" + $(this).text() + "</option>");
                $(this).remove();
            });
        });
        $('#btn-up').bind('click', function() {
            $('#select-to option:selected').each(function() {
                var newPos = $('#select-to option').index(this) - 1;
                if (newPos > -1) {
                    $('#select-to option').eq(newPos).before("<option value='" + $(this).val() + "' selected='selected'>" + $(this).text() + "</option>");
                    $(this).remove();
                }
            });
        });
        $('#btn-down').bind('click', function() {
            var countOptions = $('#select-to option').size();
            $('#select-to option:selected').each(function() {
                var newPos = $('#select-to option').index(this) + 1;
                if (newPos < countOptions) {
                    $('#select-to option').eq(newPos).after("<option value='" + $(this).val() + "' selected='selected'>" + $(this).text() + "</option>");
                    $(this).remove();
                }
            });
        });
    });
</script>
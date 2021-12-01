var focusTable = function(tableName) {
    console.log(tableName);
    return;
    jQuery.ajax({
        type: "POST",
        url: 'index.php',
        dataType: 'json',
        data: { functionname: 'loadTable', arguments: tableName },

        success: function(obj, textstatus) {
            if (!('error' in obj)) {
                yourVariable = obj.result;
            } else {
                console.log(obj.error);
            }
        }
    });
};
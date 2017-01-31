$(document).ready(function() {

    $(".btnDeleteAll").on('click', function() {

        var strValue = "0";
        $.each($("input[type='checkbox']:checked"), function() {
            // console.log($(this).val());
            strValue += $(this).val() + "&MultiId[]=";
        });

        var strUrl = 'Delete.php?MultiId[]=';
        var strIds = strUrl + strValue;
        // console.log(strIds);

        if ($("input:checkbox:checked").length > 0) {
            $(".btnDeleteAll").attr("href", strIds);
            // console.log("yes checked");
        } else {
            // console.log("not checked");
            alert("Please select at least one Record to Delete");
        }

    });

    $('#selectall').click(function(e) {
        $('[name="case"]').prop('checked', this.checked);
    });

    // Click on another checkbox can affect the select all checkbox
    $('[name="case"]').click(function(e) {
        if ($('[name="case"]:checked').length == $('[name="case"]').length || !this.checked)
            $('#selectall').prop('checked', this.checked);
    });

    $(".txtSearch").on('input', function() {
        var searchText = $('.txtSearch').val();
        var searchUrl = 'ViewData.php?searchQuery=';
        var searchQuery = searchUrl + searchText;
        // console.log(searchQuery);
        $(".btnSearch").attr("href", searchQuery);
    });
    //select row option
});

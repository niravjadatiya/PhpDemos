$(document).ready(function() {
    // $(".disabled").on('click', function(e) {
    //     e.preventDefault();
    //     alert("No Page Found");
    // });
    // $('.sortIcon').text('▲▼');
    //
    // if (window.location.href.indexOf('ASC') > -1) {
    //     if (window.location.href.indexOf('id') > -1) {
    //         $('.ID').text('▲');
    //     }
    //     if (window.location.href.indexOf('firstname') > -1) {
    //         $('.firstname').text('▲');
    //     }
    //     if (window.location.href.indexOf('username') > -1) {
    //         $('.username').text('▲');
    //     }
    //     if (window.location.href.indexOf('mobileno') > -1) {
    //         $('.mobileno').text('▲');
    //     }
    //     if (window.location.href.indexOf('email') > -1) {
    //         $('.email').text('▲');
    //     }
    //     if (window.location.href.indexOf('birthDate') > -1) {
    //         $('.birthDate').text('▲');
    //     }
    //
    // } else if (window.location.href.indexOf('DESC') > -1) {
    //
    //     if (window.location.href.indexOf('id') > -1) {
    //         $('.ID').text('▼');
    //     }
    //     if (window.location.href.indexOf('firstname') > -1) {
    //         $('.firstname').text('▼');
    //     }
    //     if (window.location.href.indexOf('username') > -1) {
    //         $('.username').text('▼');
    //     }
    //     if (window.location.href.indexOf('mobileno') > -1) {
    //         $('.mobileno').text('▼');
    //     }
    //     if (window.location.href.indexOf('email') > -1) {
    //         $('.email').text('▼');
    //     }
    //     if (window.location.href.indexOf('birthDate') > -1) {
    //         $('.birthDate').text('▼');
    //     }
    // }
    // $(".btnDeleteAll").on('click', function() {
    //
    //     var strValue = "0";
    //     $.each($("input[type='checkbox']:checked"), function() {
    //         // console.log($(this).val());
    //         strValue += $(this).val() + "&MultiId[]=";
    //     });
    //
    //     var strUrl = 'Delete.php?MultiId[]=';
    //     var strIds = strUrl + strValue;
    //     // console.log(strIds);
    //
    //     if ($("input:checkbox:checked").length > 0) {
    //         $(".btnDeleteAll").attr("href", strIds);
    //         // console.log("yes checked");
    //     } else {
    //         // console.log("not checked");
    //         alert("Please select at least one Record to Delete");
    //     }
    //
    // });
    //
    // $('#selectall').click(function(e) {
    //     $('[name="case"]').prop('checked', this.checked);
    // });
    //
    // // Click on another checkbox can affect the select all checkbox
    // $('[name="case"]').click(function(e) {
    //     if ($('[name="case"]:checked').length == $('[name="case"]').length || !this.checked)
    //         $('#selectall').prop('checked', this.checked);
    // });
    //
    // $(".txtSearch").on('input', function() {
    //     var searchText = $('.txtSearch').val();
    //     var searchUrl = 'OptimizeViewData.php?searchQuery=';
    //     var searchQuery = searchUrl + searchText;
    //     // console.log(searchQuery);
    //     $(".btnSearch").attr("href", searchQuery);
    // });
    //
    // //select row option
    //
    // if (window.location.href.indexOf('Rows=10') > -1) {
    //     $('#single').val(10);
    // }
    // if (window.location.href.indexOf('Rows=20') > -1) {
    //     $('#single').val(20);
    // }
    // if (window.location.href.indexOf('Rows=50') > -1) {
    //     $('#single').val(50);
    // }
    // if (window.location.href.indexOf('Rows=100') > -1) {
    //     $('#single').val(100);
    // }
    // $("#single").on('click', function() {
    //     // console.log($("#single").val());
    //     $('form').submit();
    // });
    // ////////////////////////////////////////////////////////////////
    // function getAllUrlParams(url) {
    //
    //     // get query string from url (optional) or window
    //     var queryString = url ? url.split('?')[1] : window.location.search.slice(1);
    //
    //     // we'll store the parameters here
    //     var obj = {};
    //
    //     // if query string exists
    //     if (queryString) {
    //
    //         // stuff after # is not part of query string, so get rid of it
    //         queryString = queryString.split('#')[0];
    //
    //         // split our query string into its component parts
    //         var arr = queryString.split('&');
    //
    //         for (var i = 0; i < arr.length; i++) {
    //             // separate the keys and the values
    //             var a = arr[i].split('=');
    //
    //             // in case params look like: list[]=thing1&list[]=thing2
    //             var paramNum = undefined;
    //             var paramName = a[0].replace(/\[\d*\]/, function(v) {
    //                 paramNum = v.slice(1, -1);
    //                 return '';
    //             });
    //
    //             // set parameter value (use 'true' if empty)
    //             var paramValue = typeof(a[1]) === 'undefined' ? true : a[1];
    //
    //             // (optional) keep case consistent
    //             paramName = paramName.toLowerCase();
    //             paramValue = paramValue.toLowerCase();
    //             // console.log(paramName);
    //             // if parameter name already exists
    //             if (obj[paramName]) {
    //                 // convert value to array (if still string)
    //                 if (typeof obj[paramName] === 'string') {
    //                     obj[paramName] = [obj[paramName]];
    //                 }
    //                 // if no array index number specified...
    //                 if (typeof paramNum === 'undefined') {
    //                     // put the value on the end of the array
    //                     obj[paramName].push(paramValue);
    //                 }
    //                 // if array index number specified...
    //                 else {
    //                     // put the value at that index number
    //                     obj[paramName][paramNum] = paramValue;
    //                 }
    //             }
    //             // if param name doesn't exist yet, set it
    //             else {
    //                 obj[paramName] = paramValue;
    //             }
    //         }
    //     }
    //
    //     return obj;
    // }
    // console.log(window.location.href);
    // getAllUrlParams(window.location.href);
    // // console.log("field : " + getAllUrlParams().field);
    // // console.log("rows : " + getAllUrlParams().rows);
    // // console.log("sorting : " + getAllUrlParams().sorting);
    // // console.log("page : " + getAllUrlParams().page);
    // // console.log("searchQuery : " + getAllUrlParams().searchquery);
    //
    //
    // // setting default values
    // // i am using turnery (condition ) ? if true here : else here
    // // var ternary = false;
    // // check = (ternary) ? 'true' : 'false';
    // // console.log(check); //returns false if ternary is set to false
    //
    // var sorting = (getAllUrlParams().sorting) ? getAllUrlParams().sorting : 'ASC';
    // console.log(sorting);
    //
    // var field = (getAllUrlParams().field) ? getAllUrlParams().field : 'id';
    // console.log(field);
    //
    // var rows = (getAllUrlParams().rows) ? getAllUrlParams().rows : '10';
    // console.log(rows);
    //
    // var page = (getAllUrlParams().page) ? getAllUrlParams().page : '1';
    // console.log(page);
    //
    // var searchquery = (getAllUrlParams().searchquery) ? getAllUrlParams().searchquery : '';
    // console.log(searchquery);
    //
    // $('<a>', {
    //     text:'Test' ,
    //     title: 'Blah',
    //     href: 'OptimizeViewData.php?sorting=' + sorting + "&field=" + field + "&Rows=" + rows + "&page=" + page ,
    //     click: function() {
    //         BlahFunc(options.rowId);
    //         return false;
    //     }
    // }).appendTo('body');
    //
    //
    //
    //
    //

});

<html>
<head>
  <link rel="stylesheet" href="/support/DataTable/media/css/jquery.dataTables.min.css">
  <link rel="stylesheet" href="/support/jquery-ui.css">
<script src="/support/jquery.min.js"></script>
<script src="/support/DataTable/media/js/jquery.dataTables.min.js"></script>
<script src="/support/jquery-ui.js"></script>
<script>
$(document).ready( function ()
{
    var table=$('#table_id').DataTable(
    {
      ajax   : {
                  url:"test.php",
                  dataSrc:''
                },
      columns:[ {data: null},
                {data: "id"},
                {data: "fname"},
                {data: "mobile"},
                {data: "email"},
              ],
    "columnDefs":[{  "targets": 0,
                      "data": null,
                      "defaultContent": "<input type=checkbox>",
                },
                  {   "targets": 5,
                      "defaultContent": "<button class='delthis'>Delete</button>",

                  },
                  {   "targets": 6,
                      "defaultContent": "<button class='editthis'>Edit</button>"
                  },]
    });

    $('#table_id tbody').on( 'click','tr', function () {
        table.$("tr.selected").removeClass("selected");
        table.$($("input:checked").closest("tr")).addClass("selected ");
   });

   $('#table_id tbody').on('click','.delthis', function () {
     table.row($(this).parent()).remove().draw(false);
   });

   $('#table_id tbody').on('click','.editthis', function () {
         var data =table.row($(this).parent()).data().id;
         $.ajax({url:"test.php?edit="+data,success:function(result){
               var val=jQuery.parseJSON(result);
               $("#id").text(val[0].id);
               $("#name").val(val[0].fname);
               $("#mobile").val(val[0].mobile);
               $("#email").val(val[0].email);
               $('#dialog').dialog('open');
         }});
   });

   $('#button').click(function ()
   {
       var data =table.rows('.selected').data();
       var chk=$('input:checked');
       var delval=[];
       for(i=0;i<chk.length;i++)
       {
            delval[i]=data[i].id;
            table.row($(chk[i]).parent().parent()).remove().draw(false);
       }
       $.ajax({url:"test.php?del="+delval});
   });

   $("#dialog").dialog({
      modal: true,
      autoOpen: false,
      title: "Edit record",
      width: 300,
   });

   $("#chkall").click(function(){
        $("input:checkbox").each(function(){this.checked=true;});
        table.$($("input:checked").closest("tr")).addClass("selected ");
   });
   $("#unchkall").click(function(){
        $("input:checkbox").each(function(){this.checked=false;});
        table.$($("input:checkbox").closest("tr")).removeClass("selected ");
   });

   $("#update").click(function(){
         var id=$("#id").text();
         var name=$("#name").val();
         var mobile=$("#mobile").val();
         var email=$("#email").val();
         $.ajax({url:"test.php?update=1&id="+id+"&name="+name+"&email="+email+"&mobile="+mobile,success:function(){}});
         table.ajax.reload();
   });
});
</script>
</head>
<body>
  <input type="button" id="button" value="delete selected record"><br><br>
  <table id="table_id" class="display">
      <thead>
          <tr>
            <th>check</th>
              <th>id</th>
              <th>name</th>
              <th>mobile</th>
              <th>email</th>
              <th></th>
              <th></th>
          </tr>
      </thead>
  </table>
  <button id="chkall">check all</button><button id="unchkall">uncheck all</button>
  <div id="dialog" style="display: none" align="center">
        <table>
        <tr>
            <td>Id:</td>
            <td><span id="id"></span></td>
        </tr>
        <tr>
            <td>name:</td>
            <td><input type="text" name="name" id="name" onkeypress="return chkalpha(event);"></td>
            <td><font color="red"><span id="errname"></span></font></td>
        </tr>
        <tr>
            <td>email:</td>
            <td><input type="text" id="email" name="email" name="email" onblur="chkemail()"></td>
            <td><font color="red"><span id="erremail"></span></font></td>
        </tr>
        <tr>
            <td>mobile:</td>
            <td><input type="text" id="mobile" name="mobile" maxlength="10"  onblur="chkmobile();" onkeypress="return chkdigit(event);"></td>
            <td><font color="red"><span id="errmobile"></span></font></td>
        </tr>
        </table>
        <input type="button" value="update" id="update">
  </div>
</body>
</html>

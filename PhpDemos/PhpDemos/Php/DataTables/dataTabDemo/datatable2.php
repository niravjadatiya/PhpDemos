 <html>
<head>
  <link rel="stylesheet" href="/support/DataTable/media/css/jquery.dataTables.css">
  <link rel="stylesheet" href="/support/select2.min.css">
  <link rel="stylesheet" href="/support/jquery-ui.css">
<script src="/support/jquery.min.js"></script>
<script src="/support/DataTable/media/js/jquery.dataTables.min.js"></script>
<script src="/support/select2/dist/js/select2.full.min.js"></script>
<script src="/support/jquery-ui.js"></script>
<script>
$(document).ready( function ()
{
    var table=$('#table').DataTable(
    {
        processing     : true,
        serverSide     : true,
        dom            :'<"ctoollength"><"ctoolsearch">tip',//<"ctoollength">
        ajaxSource     :"test2.php",
        lengthMenu     : [[5, 7, 10, -1 ],[5, 7, 10, "All"]],
        displayLength  : 10,
        rowId          : 'id',
        sorting        :[1,"asc"],
        columns        :[
                            null,
                            {data:"id"},
                            {data:"fname"},
                            {data:"mobile"},
                            {data:"email"},
                        ],
        "columnDefs"   :[{  "targets":[0,5,6],
                            "orderable": false,
                            "searchable":false,
                            "data":null,
                        },{
                            "targets": 0,
                            "className": "dt-center",
                            "render": function ( data, type, full, meta ) {
                                  return "<input type=checkbox id='"+data['id']+"' class='checkthis'>";  },
                        },{
                            "targets": 5,
                            "defaultContent": "<button class='delthis'>Delete</button>",
                        },{
                            "targets": 6,
                            "render": function ( data, type, full, meta ) {
                                      return "<button id='"+data['id']+"' name='"+data['fname']+
                                          "' mobile='"+data['mobile']+"' email='"+data['email']+
                                          "' class='editthis'>Edit</button>"}
                        },],
    });

//-------------------------------------------------------custom tool search
    $(".ctoolsearch").html("<select  id='searchselect'>"+
        "<option value='all'>All</option>"+
        "<option value='0'>id</option>"+
        "<option value='1'>name</option>"+
        "<option value='2'>mobile</option>"+
        "<option value='3'>email</option>"+
        "</select> "+
        "<input type='text' placeholder='Search' id='sdata'>"
    );

//-----------------------------------------------------------custom entry length
    $(".ctoollength").html("Show <select placeholder='lkdsj' class='clength'></select> Entries");

    $(".clength").select2({
          data: [],
          width:70,
          placeholder:"10",
          query: function (query)
            {data = {results: [ { id:query.term, text: query.term},
                                { id: 5 , text: "5" },
                                { id: 10, text: "10"},
                                { id: 20, text: "20"},
                                { id: -1, text: "All"},
                              ]};
                  query.callback(data);
            },
    });
    $(".clength").on("select2:close", function(e) {
          var data = $('.select2-selection__rendered').text();
          $(".clength").empty();
          $(".clength").html("<option value='0'>"+data+"</option>");
          if(data=="All")
            data=-1;
          table.page.len(data).draw(false);
    });

//---------------------------------------------------------select row by checkbox
    $('#table,#checkall').on( 'change','.checkthis', function (){
        if(this.checked)
        $(this).closest('tr').addClass("selected ");
        else
        $(this).closest('tr').removeClass("selected ");
   });

//------------------------------------------------------check/uncheck all rows
   $("#checkall").click(function(){
       if(this.checked){
             $("input:checkbox").not(this).each(function(){this.checked=true;});
             table.$($("input:checked").closest("tr")).addClass("selected ");
       }else{
             $("input:checkbox").not(this).each(function(){this.checked=false;});
             table.$($("input:checkbox").closest("tr")).removeClass("selected ");
       }
   });

//---------------------------------------------------------delete single record
   $('#table tbody').on('click','.delthis',function(){
       var id=$(this).closest('tr').attr('id');
       $.fn.update('delData='+ id);
   });

//--------------------------------------------------------delete multiple rows
    $('#button').click(function (){
        var chk=$('input[class="checkthis"]:checked');
        $('#checkall').prop('checked', false);
        var delval=[];
        for(i=0;i<chk.length;i++)
        {
             delval[i]=chk[i].id;
        }
        console.log(delval);
        $.fn.update('delData='+delval);
    });

//----------------------------------------------------------edit record
   $('#table tbody').on('click','.editthis', function () {
         var data =$(this);
         $("#id").text(data.attr('id'));
         $("#name").val(data.attr('name'));
         $("#mobile").val(data.attr('mobile'));
         $("#email").val(data.attr('email'));
         $('#dialog').dialog('open');
   });

   //---------------------------------------------------modal dialog
   $("#dialog").dialog({
       modal: true,
       autoOpen: false,
       title: "Edit record",
       width: 400,
   });

//-------------------------------------------------------update record
  $("#update").click(function(){
    var data=[];
        data[0]=$("#id").text();
        data[1]=$("#name").val();
        data[2]=$("#mobile").val();
        data[3]=$("#email").val();
        $.fn.update('update='+data[0]+'&name='+data[1]+'&mobile='+data[2]+'&email='+data[3]);
        table.draw(false);
        $('#dialog').dialog('close');
  });

//-------------------------------------------------------RECORD modification function
   $.fn.update=function (id) {
       $.ajax({
           url: "update.php?"+id,
           success: function()
           {table.draw(false);}
       });
   };

//-------------------------------------------------custom SEARCH
   $("#sdata").on('keyup',function(){
            var colno=$("#searchselect").val();
            var svalue=$("#sdata").val()
            if(colno=="all")
              table.search(svalue).draw(false);
            else
              table.columns(colno).search(svalue).draw(false);
   });
});
</script>
<style>
.ctoolsearch
{
  float:right;
}
.ctoollength
{
  float:left;
}
</style>
</head>
<body>
  <input type="button" id="button" value="delete selected record">
  <!-- <button id="chkall">check all</button><button id="unchkall">uncheck all</button> -->
  <br><br>
  <table id="table" class="display">
      <thead>
          <tr>
            <!-- <th>check</th> -->
              <th><input type="checkbox" id="checkall"></th>
              <th>id</th>
              <th>name</th>
              <th>mobile</th>
              <th>email</th>
              <th></th>
              <th></th>
          </tr>
      </thead>
  </table>
  <input type="hidden" id="deldata">
  <input type="hidden" id="updatedata">
  <div id="dialog" style="display:none" align="center">
        <table>
        <tr><td>Id:</td>
            <td><span id="id"></span></td>
        </tr>
        <tr><td>name:</td>
            <td><input type="text" name="name" id="name" ></td>
            <td><font color="red"><span id="errname"></span></font></td>
        </tr>
        <tr><td>email:</td>
            <td><input type="text" id="email" name="email" name="email" ></td>
            <td><font color="red"><span id="erremail"></span></font></td>
        </tr>
        <tr><td>mobile:</td>
            <td><input type="text" id="mobile" name="mobile" maxlength="10"  ></td>
            <td><font color="red"><span id="errmobile"></span></font></td>
        </tr>
        </table>
        <input type="button" value="update" id="update">
  </div>
</body>
</html>

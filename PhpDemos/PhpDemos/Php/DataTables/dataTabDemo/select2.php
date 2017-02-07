<head>
  <title>Select2</title>
<link rel="stylesheet" href="/support/select2.min.css">
<script src="/support/jquery.min.js"></script>
<script src="/support/select2/dist/js/select2.full.min.js"></script>

<script type="text/javascript">
$(document).ready(function()
{
      $.ajax({url: "test.php", success:function(result)
      {
            var arr = jQuery.parseJSON(result);
            for(i=0;i<arr.length;i++)
            {
                  $(".select222").append("<option>"+arr[i].country_name+"</option>");
            }
      }});

      function matchStart (term, text)
      {
          if (text.toUpperCase().indexOf(term.toUpperCase()) == 0) {
            return true;
          }
          return false;
      }

      $.fn.select2.amd.require(['select2/compat/matcher'], function (oldMatcher)
      {
          $(".select222").select2({
                matcher: oldMatcher(matchStart)
          })
      });
});
</script>
</head>
<h2>Select2 demo</h2>
<select style="width:300px" class="select222">
</select>

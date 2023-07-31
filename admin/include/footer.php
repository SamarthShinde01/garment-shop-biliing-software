</div>
</div>


<script src="../assets/js/foot.js"></script>
<script src="../assets/js/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>
<script src="../assets/js/bootstrap.bundle.min.js"></script>
<script src="../assets/js/datatables/jquery.dataTables.min.js"></script>
<script src="../assets/js/datatables/dataTables.buttons.min.js"></script>
<script src="../assets/js/datatables/jszip.min.js"></script>
<script src="../assets/js/datatables/pdfmake.min.js"></script>
<script src="../assets/js/datatables/vfs_fonts.js"></script>
<script src="../assets/js/datatables/buttons.html5.min.js"></script>
<script src="../assets/js/index.global.min.js"></script>
<script src="../assets/js/main.js"></script>
<script src="../assets/js/states.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.4/js/buttons.print.min.js"></script>
<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


<script>
  $("body").on("click", ".remove", function() {
    $(this).parents(".control-group").remove();
  });

  $(".add-more").on('click', function() {
    var html = $(".copy").html();
    $(".after-add-more").after(html);
    show_no();
  });

  $("body").on("click", ".remove", function() {
    $(this).parents(".control-group").remove();
    show_no();
  });


  function show_no() {
    var row_cnt = 0;
    $(".sr_no").each(function() {
      row_cnt++;
      $(this).html(row_cnt);
    });
  }
</script>

<script>
  $('#cate1').select2({
    dropdownParent: $('#exampleModal')
  });
</script>

<script>
  $(document).ready(function() {
    $('#input1').select2();
  });
</script>
<script>
  $(document).ready(function() {
    $('#input2').select2();
  });
</script>

<script>
  $(document).ready(function() {
    $('#sup').select2();
  });
</script>

<script>
  $(document).ready(function() {
    $('#sele_prod').select2();
  });
</script>


<script>
  $('#inputState').select2({
    dropdownParent: $('#exampleModal')
  });
</script>
<script>
  $('#inputDistrict').select2({
    dropdownParent: $('#exampleModal')
  });
</script>
<!-- end for supplier page -->

<!-- start select2 for edit page -->

<script>
  $(document).ready(function() {
    $('#inputState2').select2();
  });
</script>

<script>
  $(document).ready(function() {
    $('#inputDistrict2').select2();
  });
</script>
<!-- end for supplier page -->


</body>

</html>
<!-- Bootstrap core JavaScript-->
<script src="<?php echo base_url('assets/vendor/jquery/jquery.min.js') ?>"></script>
<script src="<?php echo base_url('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>

<!-- Core plugin JavaScript-->
<script src="<?php echo base_url('assets/vendor/jquery-easing/jquery.easing.min.js') ?>"></script>

<!-- Custom scripts for all pages-->
<script src="<?php echo base_url('assets/js/sb-admin-2.min.js') ?>"></script>

<!-- Page level plugins -->
<script src="<?php echo base_url('assets/vendor/chart.js/Chart.min.js') ?>"></script>

<!-- Page level custom scripts -->
<script src="<?php echo base_url('assets/js/demo/chart-area-demo.js') ?>"></script>
<script src="<?php echo base_url('assets/js/demo/chart-pie-demo.js') ?>"></script>
<script src="<?php echo base_url('assets/js/demo/chart-bar-demo.js') ?>"></script>

<!-- Page level plugins -->
<script src="<?php echo base_url('assets/vendor/datatables/jquery.dataTables.min.js') ?>"></script>
<script src="<?php echo base_url('assets/vendor/datatables/dataTables.bootstrap4.min.js') ?>"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap4.min.js"></script>

<!-- Page level custom scripts -->
<script src="<?php echo base_url('assets/js/demo/datatables-demo.js') ?>"></script>

<!-- DATEPICKER -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.21.0/moment.min.js" type="text/javascript"></script>
<script src="<?php echo base_url('assets/bootstrap-datepicker/build/js/bootstrap-datetimepicker.min.js') ?>"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/locale/id.js"></script>

<!-- INPUTMASK -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>

<!-- SELECTPICKER -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/i18n/defaults-*.min.js"></script>


<script type="text/javascript">
  $('.selectpicker').selectpicker();
  $(function () {
      var
          $table = $('#tree-table'),
          rows = $table.find('tr');

      rows.each(function (index, row) {
          var
              $row = $(row),
              level = $row.data('level'),
              id = $row.data('id'),
              $columnName = $row.find('td[data-column="name"]'),
              children = $table.find('tr[data-parent="' + id + '"]');

          if (children.length) {
              var expander = $columnName.prepend('' +
                  '<span class="treegrid-expander fa fa-chevron-right"></span>' +
                  '');

              children.hide();

              expander.on('click', function (e) {
                  var $target = $(e.target);
                  if ($target.hasClass('fa-chevron-right')) {
                      $target
                          .removeClass('fa-chevron-right')
                          .addClass('fa-chevron-down');

                      children.show();
                  } else {
                      $target
                          .removeClass('fa-chevron-down')
                          .addClass('fa-chevron-right');

                      reverseHide($table, $row);
                  }
              });
          }

          $columnName.prepend('' +
              '<span class="treegrid-indent" style="width:' + 15 * level + 'px"></span>' +
              '');
      });

      // Reverse hide all elements
      reverseHide = function (table, element) {
          var
              $element = $(element),
              id = $element.data('id'),
              children = table.find('tr[data-parent="' + id + '"]');

          if (children.length) {
              children.each(function (i, e) {
                  reverseHide(table, e);
              });

              $element
                  /*.find('.fa-chevron-down')
                  .removeClass('fa-chevron-down')
                  .addClass('fa-chevron-right');*/

              children.hide();
          }
      };
  });

  $('.telpkantor').mask('(000)0000000');
  $('.nowh').mask('62000000000000');
  $('.notelp').mask('000000000000');
	$('[data-toggle="tooltip"]').tooltip();
	$('#example').DataTable({
		'language':{
        'url': '//cdn.datatables.net/plug-ins/1.10.19/i18n/Indonesian.json'
      },
      responsive: true
	});

	function deleteConfirm(url){
    $('#btn-delete').attr('href', url);
    $('#deleteModal').modal();
  }

  $('#datetimepicker1').datetimepicker({
    format: 'YYYY/MM/DD',
    locale: 'id'
  });

  function bacaGambar(input){
    if (input.files && input.files[0]) {
      var reader = new FileReader();
      reader.onload = function(e){
        $('#gambarpreview').attr('src', e.target.result);
      }
      reader.readAsDataURL(input.files[0]);
    }
  }
  
  $(".custom-file-input").on("change", function() {
    var fileName = $(this).val().split("\\").pop();
    $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
  });

  $("#gambarpreview1").change(function(){
    bacaGambar(this);
  });

  function tandaPemisahTitik(b){
      var _minus = false;
      if (b<0) _minus = true;
      b = b.toString();
      b=b.replace(".","");
      b=b.replace("-","");
      c = "";
      panjang = b.length;
      j = 0;
      for (i = panjang; i > 0; i--)
      {
        j = j + 1;
        if (((j % 3) == 1) && (j != 1))
        {
          c = b.substr(i-1,1) + "." + c;
        }
        else
        {
        c = b.substr(i-1,1) + c;
        }
      }
      if (_minus) c = "-" + c ;
      return c;
    }

    function numbersonly(ini, e){
      if (e.keyCode>=49)
      {
        if(e.keyCode<=57)
        {
        a = ini.value.toString().replace(".","");
        b = a.replace(/[^\d]/g,"");
        b = (b=="0")?String.fromCharCode(e.keyCode):b + String.fromCharCode(e.keyCode);
        ini.value = tandaPemisahTitik(b);
        return false;
        }
        else if(e.keyCode<=105)
        {
          if(e.keyCode>=96)
          {
            //e.keycode = e.keycode - 47;
            a = ini.value.toString().replace(".","");
            b = a.replace(/[^\d]/g,"");
            b = (b=="0")?String.fromCharCode(e.keyCode-48):b + String.fromCharCode(e.keyCode-48);
            ini.value = tandaPemisahTitik(b);
            //alert(e.keycode);
            return false;
          }
          else
          {
            return false;
          }
        }
        else
        {
          return false;
        }
      }
      else if (e.keyCode==48)
      {
        a = ini.value.replace(".","") + String.fromCharCode(e.keyCode);
        b = a.replace(/[^\d]/g,"");
        if (parseFloat(b)!=0)
        {
          ini.value = tandaPemisahTitik(b);
          return false;
        }
        else
        {
          return false;
        }
      }
      else if (e.keyCode==95)
      {
        a = ini.value.replace(".","") + String.fromCharCode(e.keyCode-48);
        b = a.replace(/[^\d]/g,"");
        if (parseFloat(b)!=0)
        {
          ini.value = tandaPemisahTitik(b);
          return false;
        }
        else
        {
          return false;
        }
      }
      else if (e.keyCode==8 || e.keycode==46)
      {
        a = ini.value.replace(".","");
        b = a.replace(/[^\d]/g,"");
        b = b.substr(0,b.length -1);
        if (tandaPemisahTitik(b)!="")
        {
          ini.value = tandaPemisahTitik(b);
        }
        else
        {
          ini.value = "";
        }

        return false;
      }
      else if (e.keyCode==9)
      {
        return true;
      }
      else if (e.keyCode==17)
      {
        return true;
      }
      else
      {
        //alert (e.keyCode);
        return false;
      }

    }
</script>
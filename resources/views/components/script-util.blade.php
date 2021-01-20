<script>
<!-- ============ START MESSAGING ============= -->
    //message component mandatory
    function messageMandatory(){
        $(document).Toasts('create', {
            class: 'bg-warning',
            title: 'Information',
            body: '<b>Yang bertandakan * tidak boleh dikosongkan</b>'
          })
    }

    //show modal loading page
    function showModalLoading(){
        $('#modalLoading').modal('show');
    }

    //close modal loading page
    function hideModalLoading(){
        $("#modalLoading").removeClass("show");
        $(".modal-backdrop").remove();
        $("#modalLoading").modal('hide');
        $('#modalLoading').hide();
    }
<!-- ============ END MESSAGING ============= -->


<!-- ============ START FORMAT ============= -->
    // number format
    function number_format(num){
         stringNum = num.toString();
         stringNum = stringNum.split("");
         c = 0;
         if (stringNum.length>3) {
           for (i=stringNum.length; i>-1; i--) {
             if ( (c==3) && ((stringNum.length-i)!=stringNum.length) ) {
               stringNum.splice(i, 0, ",");
               c=0;
             }
             c++
           }
           return stringNum;
         }
         return num;
    }

    // select 2
    $('.select2').select2();

    //Datemask dd/mm/yyyy
    $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' });

    // datepicker month
    $('#datemonth').datetimepicker({
        viewMode: "months",
        format : 'MM',
        ignoreReadonly: true,
        allowInputToggle: true
    });

     // datepicker yearsmonth
    $('#dateyear').datetimepicker({
       viewMode: 'years',
       format: 'YYYY',
       ignoreReadonly: true,
       allowInputToggle: true
    });

      // datepicker yearsmonth
    $('#dateyearmonth').datetimepicker({
        viewMode: 'years',
        format: 'YYYYMM',
        ignoreReadonly: true,
        allowInputToggle: true
    });

     //datepicker format DD-MMM-YY
    $('#datepicker').datetimepicker({
       defaultDate:new Date(),
       format : "DD-MMM-YY",
       ignoreReadonly: true,
       allowInputToggle: true
    });

    //datepicker format YYYYMMDD
    $('#datepicker2').datetimepicker({
       defaultDate:new Date(),
       format : "YYYYMMDD",
       ignoreReadonly: true,
       allowInputToggle: true
    });
    //datepicker format YYYYMMDD
    $('#datepicker3').datetimepicker({
       defaultDate:new Date(),
       format : "YYYYMMDD",
       ignoreReadonly: true,
       allowInputToggle: true
    });

    //datepicker range date
    $('#reservation').daterangepicker()

    //datepicker range date format
    $('#reservationdate').datetimepicker({
        format: 'L'
    });

    //datepickertime range datetime
    $('#timepicker').datetimepicker({
      format: 'LT'
    });

    //datepickertime range datetime format
    $('#reservationtime').daterangepicker({
        timePicker: true,
        timePickerIncrement: 30,
        locale: {
          format: 'MM/DD/YYYY hh:mm A'
        }
    });

    //datepickertime button
    $('#daterange-btn').daterangepicker(
      {
        ranges   : {
          'Today'       : [moment(), moment()],
          'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
          'Last 30 Days': [moment().subtract(29, 'days'), moment()],
          'This Month'  : [moment().startOf('month'), moment().endOf('month')],
          'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        startDate: moment().subtract(29, 'days'),
        endDate  : moment()
      },
      function (start, end) {
        $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
      }
    );
<!-- ============ END FORMAT ============= -->
</script>

    <!-- REQUIRED JS SCRIPTS -->

    <!-- jQuery 2.1.4 -->
    <script src="{{ asset('/plugins/jQuery/jQuery-2.1.4.min.js') }}"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="{{ asset('/js/bootstrap.min.js') }}" type="text/javascript"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('/js/app.min.js') }}" type="text/javascript"></script>

    <!-- Optionally, you can add Slimscroll and FastClick plugins.
          Both of these plugins are recommended to enhance the
          user experience. Slimscroll is required when using the
          fixed layout. -->

    <!-- DATA TABES SCRIPT -->
    <script src="{{ URL::to('/') }}/plugins/datatables/jquery.dataTables.min.js" type="text/javascript"></script>
    <script src="{{ URL::to('/') }}/plugins/datatables/dataTables.bootstrap.min.js" type="text/javascript"></script>
    <!-- SlimScroll -->
    <script src="{{ URL::to('/') }}/plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
    <!-- FastClick -->
    <script src="{{ URL::to('/') }}/plugins/fastclick/fastclick.min.js" type="text/javascript"></script>
    <!-- PACE -->
	<script src="{{ URL::to('/') }}/plugins/pace/pace.js"></script>
    <!-- iCheck 1.0.1 -->
    <script src="{{ URL::to('/') }}/plugins/iCheck/icheck.min.js" type="text/javascript"></script>
    <!-- Custom Select -->
    <script src="{{ URL::to('/') }}/js/bootstrap-select.min.js" type="text/javascript"></script>
    <!-- Date Range Picker -->
    <script src="{{ URL::to('/') }}/plugins/daterangepicker/moment.min.js" type="text/javascript"></script>
    <script src="{{ URL::to('/') }}/plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
        
    <script type="text/javascript" src="{{asset('plugins/jQueryValidate/jquery.validate.min.js')}}"></script>
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    <!--<scrript src="{{ asset('/plugins/datepicker/bootstrap-datepicker.js') }}"></script>-->
    <script type="text/javascript">var URL = '{{url()}}';</script>
    
    <!--soh-->
<!--     <scrript src="{{ asset('/plugins/test/jquery/jquery-1.8.3.min.js') }}"></script>
     <scrript src="{{ asset('/plugins/test/bootstrap/js/bootstrap.min.js') }}"></script>
     <scrript src="{{ asset('/plugins/test/js/bootstrap-datetimepicker.js') }}"></script>
     <scrript src="{{ asset('/plugins/test/js/locales/bootstrap-datetimepicker.fr.js') }}"></script>-->
<!--   <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js"></script>-->
    
    <!--<script type="text/javascript" src="./jquery/jquery-1.8.3.min.js" charset="UTF-8"></script>-->
<!--<script type="text/javascript" src="./bootstrap/js/bootstrap.min.js"></script>-->
<!--<script type="text/javascript" src="../js/bootstrap-datetimepicker.js" charset="UTF-8"></script>-->
<!--<script type="text/javascript" src="../js/locales/bootstrap-datetimepicker.fr.js" charset="UTF-8"></script>-->
    
    <!--soh-->
    
    
    <!-- CK Editor -->
    <script src="{{ URL::to('/') }}/plugins/ckeditor/ckeditor.js" type="text/javascript"></script>.
    
    <!-- AdminLTE for demo purposes -->
    <script src="{{ URL::to('/') }}/plugins/adminlte/demo.js" type="text/javascript"></script>
    <script src="{{ URL::to('/') }}/plugins/adminlte/custom.js" type="text/javascript"></script>
    <!-- page script -->
    <script type="text/javascript">
      $(function () {
          $('#example2').DataTable({
	          "paging": false,
	          "lengthChange": false,
	          "ordering": false,
	          "info": false,
	          "bFilter": false,
          });
        
          //Flat red color scheme for iCheck
          $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
	          checkboxClass: 'icheckbox_flat-green',
	          radioClass: 'iradio_flat-green'
          });
          
          if ($('#textEditor1').length > 0) {
             CKEDITOR.replace('textEditor1', {
                    allowedContent: true
                });
            }
          if ($('#textEditor2').length > 0) {
             CKEDITOR.replace('textEditor2', {
                    allowedContent: true
                });
            }
          if ($('#textEditor3').length > 0) {
             CKEDITOR.replace('textEditor3', {
                    allowedContent: true
                });
            }
          if ($('#textEditor4').length > 0) {
             CKEDITOR.replace('textEditor4', {
                    allowedContent: true
                });
            }
        
          if ($('#textEditor5').length > 0) {
             CKEDITOR.replace('textEditor5', {
                    allowedContent: true
                });
            }
        
          if ($('#textEditor6').length > 0) {
             CKEDITOR.replace('textEditor6', {
                    allowedContent: true
                });
            }
          if ($('#textEditor7').length > 0) {
             CKEDITOR.replace('textEditor7', {
                    allowedContent: true
                });
            }
        
          if ($('#textEditor8').length > 0) {
             CKEDITOR.replace('textEditor8', {
                    allowedContent: true
                });
            }
        
          if ($('#textEditor9').length > 0) {
             CKEDITOR.replace('textEditor9', {
                    allowedContent: true
                });
            }
          if ($('#textEditor10').length > 0) {
             CKEDITOR.replace('textEditor10', {
                    allowedContent: true
                });
            }
        
          if ($('#textEditor11').length > 0) {
             CKEDITOR.replace('textEditor11', {
                    allowedContent: true
                });
            }
        
          if ($('#textEditor12').length > 0) {
             CKEDITOR.replace('textEditor12', {
                    allowedContent: true
                });
            }
        
          if ($('#textEditor13').length > 0) {
             CKEDITOR.replace('textEditor13', {
                    allowedContent: true
                });
            }
          if ($('#textEditor14').length > 0) {
             CKEDITOR.replace('textEditor14', {
                    allowedContent: true
                });
            }
        
          if ($('#textEditor15').length > 0) {
             CKEDITOR.replace('textEditor15', {
                    allowedContent: true
                });
            }
          if ($('#textEditor16').length > 0) {
             CKEDITOR.replace('textEditor16', {
                    allowedContent: true
                });
            }
          if ($('#textEditor17').length > 0) {
             CKEDITOR.replace('textEditor17', {
                    allowedContent: true
                });
            }
        
          if ($('#textEditor18').length > 0) {
             CKEDITOR.replace('textEditor18', {
                    allowedContent: true
                });
            }
        
          if ($('#textEditor19').length > 0) {
             CKEDITOR.replace('textEditor19', {
                    allowedContent: true
                });
            }
        
          if ($('#textEditor20').length > 0) {
             CKEDITOR.replace('textEditor20', {
                    allowedContent: true
                });
            }
        
          if ($('#textEditor21').length > 0) {
             CKEDITOR.replace('textEditor21', {
                    allowedContent: true
                });
            }
        
          if ($('#textEditor22').length > 0) {
             CKEDITOR.replace('textEditor22', {
                    allowedContent: true
                });
            }
        
     
          if ($('#textEditor23').length > 0) {
             CKEDITOR.replace('textEditor23', {
                    allowedContent: true
                });
            }
        
     
          if ($('#textEditor24').length > 0) {
             CKEDITOR.replace('textEditor24', {
                    allowedContent: true
                });
            }
	
          if ($('#textEditor25').length > 0) {
             CKEDITOR.replace('textEditor25', {
                    allowedContent: true
                });
            }
	
          if ($('#textEditor26').length > 0) {
             CKEDITOR.replace('textEditor26', {
                    allowedContent: true
                });
            }
	
	
          if ($('#textEditor27').length > 0) {
             CKEDITOR.replace('textEditor27', {
                    allowedContent: true
                });
            }
		
		 if ($('#textEditor28').length > 0) {
             CKEDITOR.replace('textEditor28', {
                    allowedContent: true
                });
            }
	
      });
//      $( function() {
//    $( "#datepicker" ).datepicker();
//  } );
    </script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>

<script type="text/javascript">
	var reactSettings = {};
	reactSettings.laravelRoutes = {!! $laravelRoutes !!}; // Defined in ReactRoutesViewComposer so react knows what laravels routes are

	$(function(){
		// Update all file upload buttons so they are nice a styled
		// $(":file").filestyle({
		// 	input: false,
		// 	buttonText: "Upload",
		// 	buttonName: "btn-default",
		// 	iconName: "glyphicon-upload"
		// });
	});
</script>

<script src="{{ url('js/common.min.js') }}"></script>
{{-- <script src="{{ url('js/react.min.js') }}"></script> --}}

@yield('custom-footer-js')
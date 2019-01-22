<script type="text/javascript">	
	$(document).ready(function(){
		setInterval(refresh, 2000);
	});

	function refresh(){
		if (!$("strong").is("#new"))
		$.ajax({
				type: "POST",
				url: "classes/ajax.php",
				data: { action: 'refreshAdminSound', countOrders: %countOrders%, countCallbacks: %countCallbacks%},
				cache: false,
				success: function(responce){ $('div[name="new"]').html(responce); }
		});
		if ($("strong").is("#new"))
		$.ajax({
				type: "POST",
				url: "classes/ajax.php",
				data: { action: 'refreshAdminNoSound', countOrders: %countOrders%, countCallbacks: %countCallbacks%},
				cache: false,
				success: function(responce){ $('div[name="new"]').html(responce); }
		});
	};
</script>
<script type="text/javascript">	
	$(document).ready(function(){
		setInterval(refresh, 2000);
	});

	function refresh(){
		if (!$("strong").is("#new"))
		$.ajax({
				type: "POST",
				url: "classes/ajax.php",
				data: { action: 'refreshCourierSound', id: %id%, countOrders: %countOrders%},
				cache: false,
				success: function(responce){ $('div[name="new"]').html(responce); }
		});
		if ($("strong").is("#new"))
		$.ajax({
				type: "POST",
				url: "classes/ajax.php",
				data: { action: 'refreshCourierNoSound', id: %id%, countOrders: %countOrders%},
				cache: false,
				success: function(responce){ $('div[name="new"]').html(responce); }
		});
	};
</script>
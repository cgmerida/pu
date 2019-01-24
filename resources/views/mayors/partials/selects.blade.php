<script>
    $(function() {
			$('select[name=department_id]').change(function() {
				var url = `/departments/${$(this).val()}/municipalities`;
				$.get(url, function(data) {
					var select = $('select[name=municipality_id]');
					select.empty();
					$.each(data,function(key, value) {
						select.append(`<option value='${value.id}'>${value.name}</option>`);
					});
				});
			});
		});
</script>
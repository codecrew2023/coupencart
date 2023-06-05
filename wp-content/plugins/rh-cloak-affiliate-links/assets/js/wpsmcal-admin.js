(function($){
	if($('.wpsmcal-group-inputs').length == 1){
		var inputKey = $('.wpsmcal-group-input').length;
		$("#wpsmcal_add_fields").on('click', function(e) {
			var groupedRow = '<tr class="wpsmcal-group-input"><td><input type="text" value="" name="wpsmcal_rewrites[rewrite_fields]['+inputKey+'][checkdomain]" /></td><td><input type="text" value="" name="wpsmcal_rewrites[rewrite_fields]['+inputKey+'][afftag]" /></td><td><input type="text" value="" name="wpsmcal_rewrites[rewrite_fields]['+inputKey+'][affstring]" /></td><td><input type="number" value="100" name="wpsmcal_rewrites[rewrite_fields]['+inputKey+'][random]" min="0" max="100" step="10" />%</td><td><input type="radio" value="yes" name="wpsmcal_rewrites[rewrite_fields]['+inputKey+'][aff_move]" />&nbsp;Yes&nbsp;&nbsp;<input type="radio" value="no" name="wpsmcal_rewrites[rewrite_fields]['+inputKey+'][aff_move]" checked="checked" />&nbsp;No</td></tr><tr class="wpsmcal-group-roles"><td colspan="5">';
			$.each( rolesArray, function( role, roleName ) {
				groupedRow += '<label for="wpsmcal_rewrites[rewrite_fields]['+inputKey+'][roles_rewrite]['+role+']">'+roleName+'</label>:&nbsp;<input type="hidden" name="wpsmcal_rewrites[rewrite_fields]['+inputKey+'][roles_rewrite]['+role+']" value="0" /><input type="checkbox" name="wpsmcal_rewrites[rewrite_fields]['+inputKey+'][roles_rewrite]['+role+']" value="1" />&nbsp;';
			});
			groupedRow += '</td></tr>';
			$(".wpsmcal-group-inputs").append(groupedRow);
			inputKey++;
			e.preventDefault();
		});
		
		$('#domains_list').on('change', function() {
			var checkdomains = $('.wpsmcal-group-inputs .checkdomain');
			var checkdomain = this.value;
			if(checkdomain == ''){
				$('tr.wpsmcal-group-input').show();
				$('tr.wpsmcal-group-roles').show();				
			}else{
				$(checkdomains).each(function(indx, element){
					if(checkdomain != this.value){
						$(element).parents('tr.wpsmcal-group-input').hide();
						$(element).parents('tr.wpsmcal-group-input').next().hide();
					}else{
						$(element).parents('tr.wpsmcal-group-input').show();
						$(element).parents('tr.wpsmcal-group-input').next().show();
					}
				});				
			}
		});
		
		$('#afftags_list').on('change', function() {
			var afftags = $('.wpsmcal-group-inputs .afftag');
			var afftag = this.value;
			if(afftag == ''){
				$('tr.wpsmcal-group-input').show();
				$('tr.wpsmcal-group-roles').show();				
			}else{
				$(afftags).each(function(indx, element){
					if(afftag != this.value){
						$(element).parents('tr.wpsmcal-group-input').hide();
						$(element).parents('tr.wpsmcal-group-input').next().hide();
					}else{
						$(element).parents('tr.wpsmcal-group-input').show();
						$(element).parents('tr.wpsmcal-group-input').next().show();
					}
				});				
			}
		});
	}

	$('#wpsmcal-import-submit').on( 'click', function(e){
		e.preventDefault();
		var exportVal = $('#wpsmcal-import-field').val();
		if( exportVal.length > 2 && isJSON(exportVal) ){
			$.ajax({
				type: 'POST',
				url: translation.ajax_url,
				dataType: 'json',
				data: {
					'action' : 'wpsmcal_import',
					'nonce' : translation.nonce,
					'data' : JSON.parse($('#wpsmcal-import-field').val())
				},
				success: function(response) {
					if (response.success) {
						$('#wpsmcal-import-note').text(translation.importSuccess);
						setTimeout( function() {
							location.reload();
						}, 2000 );
					} else {
						$('#wpsmcal-import-note').text(translation.importErrorData);
					}
				},
				error: function(xhr, str) {
					alert('Error: ' + xhr.responseCode);
				}
			});
		} else {
			$('#wpsmcal-import-note').text(translation.importNotValid);
		}
	});

	$('#wpsmcal-export-submit').on( 'click', function(e){
		e.preventDefault();
		$.ajax({
			type: 'POST',
			url: translation.ajax_url,
			data: {
				'action': 'wpsmcal_export',
			 	'nonce' : translation.nonce,
			},
			success: function(response) {
				if (response.success) {
					$('#wpsmcal-export-field').text(response.data);
				} else {
					$('#wpsmcal-export-note').text(translation.exportErrorData);
				}
				
			},
			error: function(xhr, str) {
				alert('Error: ' + xhr.responseCode);
			}
		});
	});

	ResModalShow = function(ID,actionID){
		var action, header;
		var modal = $('#modal_content');
		var modalCont = modal.find('>*');
		
		if(actionID){
			action = 'display_posts';
			header = translation.headerPosts;
		}else{
			action = 'display_users';
			header = translation.headerUsers;
		}
		var data = {
			 'action': action,
			 'id': ID,
			 'nonce' : translation.nonce,
		};		
		tb_show(header, '/?TB_inline&inlineId=modal_content&width=600&height=400');
		modalCont.html(translation.loader);
		$.ajax({
			type: 'POST',
			url: translation.ajax_url,
			data: data,
			success: function(response) {
				modalCont.html(response);
				$(".tabs-menu").on("click", "li:not(.current)", function() {
					var tabcontainer = $(this).closest(".tabs"); 
					$(this).addClass("current").siblings().removeClass("current"); 
					tabcontainer.find(".tabs-item").hide().eq($(this).index()).show();
				}); 
				$(".tabs-menu li:first-child").trigger("click");
			},
			error: function(xhr, str) {
				alert('Error: ' + xhr.responseCode);
			}
		});
		return false;
	}

})(jQuery);

function isJSON( str ) {
    try {
        return ( JSON.parse(str) && !!str );
    } catch ( e ) {
        return false;
    }
}

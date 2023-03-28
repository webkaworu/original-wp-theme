/* global ajaxurl */
// import 'bootstrap';
import * as bootstrap from 'bootstrap';
import openUpload from './mediauploader.js';

(function ($) {
	$(document).on('click', '.select_btn', function () {
		openUpload(this);
	});

	$(document).on('click', '.clear_btn', function () {
		var parent = $(this).parents('.mediaupload');
		var input = parent.find('[type="hidden"]');
		var box = parent.find('.img_box');
		input.val('');
		box.empty().addClass('noselect');
	});

	var limit = 6;

	$(document).on('click', '.add_box .add_btn', function () {
		var parent = $(this).parents('.add_box');
		var add_to = parent.prevAll('.add_to');
		var add_length = add_to.length;
		var max = ($(this).data('limit')) ? $(this).data('limit') : limit;
		if (!$(this).hasClass('no_limit')) {
			if (add_length > (max - 1)) {
				alert('追加できるのは' + max + '個までです。');
				return;
			}
		}
		var clone = add_to.eq(0).clone(true);
		clone.find('.add_title_num').text(add_length + 1);
		clone.find('[name]').each(function () {
			var name = $(this).attr('name').replace(/(.*)(\[)([0-9])(\])/g, '$1[' + add_length + ']');
			$(this).val('').attr('name', name);
			$(this).find('.mediaupload .img_box').empty();
		});
		clone.find('.mediaupload .img_box').addClass('noselect').empty();
		clone.find(':checked').prop('checked', false);
		clone.insertBefore(parent);
		parent.find('.delete_btn').removeClass('d-none');
	});

	$(document).on('click', '.add_box .delete_btn', function () {
		var parent = $(this).parents('.add_box');
		var add_to = parent.prevAll('.add_to');
		var add_length = add_to.length;
		if (add_length > 1) {
			parent.prev('.add_to').remove();
			if (add_length == 2) {
				$(this).addClass('d-none');
			}
		}
	});

	$('.add_box .delete_btn').each(function () {
		var parent = $(this).parents('.add_box');
		var add_to = parent.prevAll('.add_to');
		var add_length = add_to.length;
		if (add_length > 1) {
			$(this).removeClass('d-none');
		}
	});

	var updateSortNo = function () {
		$('#custom_sortable').find('.postbox').each(function (a, b) {
			$(b).find('.add_title_num').text(a + 1);
			var field = $(b).find('[name]');
			if (field.length) {
				field.each(function (key, element) {
					var name = $(element).attr('name').replace(/\[\d\]/, '[' + a + ']');
					$(element).attr('name', name);
				});
			}
		});
	};

	$('#custom_sortable').sortable({
		axis  : 'y',
		update: function () {
			updateSortNo();
		}
	});

	$(document).on('click', '.handle-order-higher,.handle-order-lower,.handle-box-delete', function () {
		var postbox = $(this).closest('.postbox');
		var postboxes = $('#custom_sortable').find('.postbox');
		var index = postboxes.index(postbox);
		if ($(this).hasClass('handle-order-higher')) {
			if (index < 1) {
				return;
			}
			postboxes.eq(index - 1).insertAfter(postbox);
		}
		if ($(this).hasClass('handle-order-lower')) {
			if (index > (postboxes.length - 2)) {
				return;
			}
			postboxes.eq(index + 1).after(postbox);
		}
		if ($(this).hasClass('handle-box-delete')) {
			if (postboxes.length < 2) {
				var input = postbox.find('[name]');
				var exclusion = ['radio', 'checkbox'];
				input.each(function (a, b) {
					if (exclusion.indexOf(b.type) === -1) {
						b.value = '';
					}
				});
				postbox.find(':checked').prop('checked', false);
				postbox.find(':selected').prop('selected', false);
				postbox.find('.img_box').empty().addClass('noselect');
				postbox.find('.contents_select_box').empty();
				return;
			}
			postbox.remove();
		}
		updateSortNo();
	});
	$(document).on('click', '.add_box .handle-box-add', function () {
		var postboxes = $('#custom_sortable').find('.postbox');
		if (postboxes.length > 7){
			alert('追加できるのは8個までです。');
			return;
		}
		$.ajax({
			url : ajaxurl,
			type: 'GET',
			data: { index: postboxes.length, action: 'get_top_contents_field' }
		}).done(function (res) {
			postboxes.last().after(res.replace('contents_select_box collapse', 'contents_select_box'));
			var newbox = $('#custom_sortable').find('.postbox').last();
			newbox.find('.handle-collapse-toggle').remove();
		});
	});

	$(document).on('change', '.contents_select', function () {
		var value = $(this).val();
		var box = $(this).nextAll('.contents_select_box');
		var postbox = $(this).closest('.postbox');
		var postboxes = $('#custom_sortable').find('.postbox');
		var index = postboxes.index(postbox);
		if (value == '') {
			box.empty();
			return;
		}
		$.ajax({
			url : ajaxurl,
			type: 'GET',
			data: { index: index, type: value, action: 'get_top_contents_type' }
		}).done(function (res) {
			box.html(res);
			box.find('.add-color-picker-number-field').wpColorPicker();
		});
	});

	$('.add-color-picker-number-field').wpColorPicker();

	$('#topContentsPreview').on('hidden.bs.modal', function () {
		$(this).find('.modal-body').html('<div class="spinner-border text-info position-absolute top-0 start-0 bottom-0 end-0 m-auto"></div>');
	});
	$('#topContentsPreview').on('shown.bs.modal', function () {
		var forms = $('#theme_settings_form');
		var query = forms.serialize();
		$.ajax({
			url : ajaxurl,
			type: 'POST',
			data: { setting: query, action: 'get_top_contents_preview' }
		}).done(function (res) {
			var iframe = '<iframe src="' + ajaxurl + '?action=get_top_contents_preview&setting=' + query + '" srcdoc="' + res.replace('"', '&quot;').replace('&', '&amp;') + '" allowfullscreen></iframe>';
			$('#topContentsPreview').find('.modal-body').html(iframe);
		}).fail(function () {
			alert('プレビューを取得できませんでした。');
			$('#topContentsPreview').modal('hide');
		});
	});
	$('#importModal').on('shown.bs.modal', function () {
		$.ajax({
			url : ajaxurl,
			type: 'POST',
			data: { action: 'set_demo_import' }
		}).done(function (res) {
			if (res === 'success') {
				setTimeout(function () {
					const modal = new bootstrap.Modal('#successModal');
					modal.show();
					$('#importModal').modal('hide');
				}, 4000);
			} else {
				setTimeout(function () {
					const modal = new bootstrap.Modal('#errorModal');
					modal.show();
					$('#importModal').modal('hide');
				}, 4000);
			}
		}).fail(function () {
			setTimeout(function () {
				const modal = new bootstrap.Modal('#errorModal');
				modal.show();
				$('#importModal').modal('hide');
			}, 4000);
		});
	});

})(jQuery);

const topContents = document.querySelectorAll('.top_contents_meta');
if (topContents.length) {
	for (let topContent of topContents) {
		const collapsible = topContent.querySelector('.collapse');
		const button = topContent.querySelector('.handle-collapse-toggle');
		if (collapsible != null){
			collapsible.addEventListener('show.bs.collapse', function () {
				button.innerHTML = '<span class="dashicons dashicons-minus"></span>';
			});
			collapsible.addEventListener('hidden.bs.collapse', function () {
				button.innerHTML = '<span class="dashicons dashicons-plus-alt2"></span>';
			});
		}
	}
}

const contactUrlBox = document.getElementById('contact_url_box');
if (contactUrlBox != null){
	const bsCollapse = new bootstrap.Collapse(contactUrlBox, {
		toggle: false
	});
	const settingContacts = document.querySelectorAll('[name="custom_wrt_data[setting][contact]"]');
	for (let settingContact of settingContacts) {
		settingContact.addEventListener('change', function () {
			const checked = document.querySelector('[name="custom_wrt_data[setting][contact]"]:checked');
			if (checked.value == 'set'){
				bsCollapse.show();
			} else {
				bsCollapse.hide();
			}
		});
	}
}

const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
tooltipTriggerList.map(function (tooltipTriggerEl) {
	return new bootstrap.Tooltip(tooltipTriggerEl);
});

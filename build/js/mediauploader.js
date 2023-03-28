// キャッシュを格納
var setMedia = [];
/******************************************************
				GETの値を取得する
*******************************************************/
// function getParam(type) {
// 	var url   = location.href;
// 	var parameters    = url.split('?');
// 	if (parameters.length < 1){ return; }
// 	var params   = parameters[1].split('&');
// 	var paramsArray = [];
// 	for ( var i = 0; i < params.length; i++ ) {
// 		var neet = params[i].split('=');
// 		paramsArray.push(neet[0]);
// 		paramsArray[neet[0]] = neet[1];
// 	}
// 	var categoryKey = paramsArray[type];
// 	return categoryKey;
// }

/******************************************************
				カスタム投稿別にメディアの種類を変える
*******************************************************/
// function postTypelibrary(){
// 	var posttype=getParam('post_type');
// 	var lib = 'image';
// 	if (posttype==undefined){ return lib; }
// 	switch ( posttype ) {
// 	case 'app':
// 	default:
// 		lib =  'image';
// 		break;

// 	}
// 	return lib;
// }

/******************************************************
				投稿にメディアアップローダーを作成
*******************************************************/
function mediaUpload(type) {
	var attributes = {
		title : 'ファイルを選択',
		frame : 'select',
		button: {
			text: '決定'
		},
		/* 選択できる画像は 1 つだけにする */
		multiple: false
	};
	if (type) {
		attributes['library'] = { type: type };
	}
	var custom_uploader = wp.media(attributes);
	return custom_uploader;
}

/******************************************************
				メディアアップローダーを開く
*******************************************************/
export default function openUpload(btn) {
	if (!btn) { return; }

	var type = (btn.getAttribute('data-type')) ? btn.getAttribute('data-type') : '';
	var parent = btn.closest('.mediaupload');
	var input = parent.querySelector('[type="hidden"]');
	var box = parent.querySelector('.img_box');
	var buttons = document.querySelectorAll(btn.type);
	buttons = Array.from(buttons);
	var targetId = 'target_' + buttons.indexOf(btn);
	// キャッシュを表示する
	if (setMedia[targetId]) {
		setMedia[targetId].open();
		return;
	}

	setMedia[targetId] = mediaUpload(type);
	setMedia[targetId].on('select', function () {
		var attachments = setMedia[targetId].state().get('selection');
		/* file の中に選択された画像の各種情報が入っている */
		attachments.each(function (file) {
			if (type != '' && type != file.attributes.type) {
				alert('アップロードできない形式です。');
				return;
			}
			input.value = '';
			box.innerHTML = '';

			input.value = file.id;

			// /* プレビュー用に選択されたサムネイル画像を表示 */
			if (file.attributes.type == 'image') {
				var image = file.attributes.url;
				if (btn.getAttribute('data-size') && file.attributes.sizes[btn.getAttribute('data-size')]) {
					image = file.attributes.sizes[btn.getAttribute('data-size')].url;
				}
				box.innerHTML = '<img src="' + image + '" alt="サムネイル画像" class="img-fluid">';
				box.classList.remove('noselect');
			} else if (file.attributes.type == 'video') {
				box.innerHTML = '<img src="' + file.attributes.icon + '" alt="サムネイル画像" width="24" class="img-fluid mr-1"><span>' + file.attributes.filename + '</span>';
			} else {
				box.innerHTML = '<img src="' + file.attributes.icon + '" alt="サムネイル画像" width="24" class="img-fluid mr-1"><span>' + file.attributes.filename + '</span>';
			}
		});
	});
	setMedia[targetId].open();
}

import { Button, Placeholder, ExternalLink } from '@wordpress/components';
import { BlockIcon } from '@wordpress/block-editor';

const EmbedPlaceholder = ( {
	value,
	onSubmit,
	onChange,
	cannotEmbed,
	fallback,
	tryAgain,
} ) => {
	return (
		<Placeholder
			icon={ <BlockIcon icon="location-alt" showColors /> }
			label="Google Map"
			className="wp-block-embed custom_meta_box"
			instructions="サイトに表示したいグーグルマップのiframeを貼り付けます。"
		>
			<form onSubmit={ onSubmit }>
				<div className="d-flex w-100">
					<textarea
						className="form-control"
						placeholder="グーグルマップの埋め込みコードをここに入力してください。"
						rows="3"
						onChange={ onChange }
					>{ value || '' }</textarea>
					<Button variant="primary" className="is-primary align-self-center ms-3" type="submit">
						埋め込み
					</Button>
				</div>
			</form>
			{ cannotEmbed && (
				<div className="components-placeholder__error">
					<div className="components-placeholder__instructions">
						このコンテンツを埋め込むことができません。
					</div>
					<Button variant="secondary" onClick={ tryAgain }>
						もう一度
					</Button>
				</div>
			) }
		</Placeholder>
	);
};

export default EmbedPlaceholder;

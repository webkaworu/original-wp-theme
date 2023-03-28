import { useBlockProps } from '@wordpress/block-editor';

export default function save( { attributes, className } ) {
	const { iframe } = attributes;

	if ( ! iframe ) {
		return null;
	}

	return (
		<div { ...useBlockProps.save( { className: className } ) }>
			<div className="ggmap" dangerouslySetInnerHTML={{__html: iframe}} />
		</div>
	);
}

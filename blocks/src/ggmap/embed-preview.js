import { Component } from '@wordpress/element';

class EmbedPreview extends Component {
	constructor() {
		super( ...arguments );
		this.hideOverlay = this.hideOverlay.bind( this );
		this.state = {
			interactive: false,
		};
	}

	static getDerivedStateFromProps( nextProps, state ) {
		if ( ! nextProps.isSelected && state.interactive ) {
			return { interactive: false };
		}

		return null;
	}

	hideOverlay() {
		this.setState( { interactive: true } );
	}

	render() {
		const {
			iframe
		} = this.props;
		const { interactive } = this.state;

		return (
			<div className="wp-block-embed__wrapper">
				<div className="ggmap" dangerouslySetInnerHTML={{__html: iframe}} />
				{ ! interactive && (
					<div
						className="block-library-embed__interactive-overlay"
						onMouseUp={ this.hideOverlay }
					/>
				) }
			</div>
		);
	}
}

export default EmbedPreview;


// const EmbedPreview = ( {
// 	iframe
// } ) => {
// 	return (
// 		<div className="ggmap" dangerouslySetInnerHTML={{__html: iframe}} />
// 	);
// };

// export default EmbedPreview;

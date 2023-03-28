import EmbedPlaceholder from './embed-placeholder';
import EmbedPreview from './embed-preview';

import { useState } from '@wordpress/element';
import { useBlockProps, BlockControls } from '@wordpress/block-editor';
import { Button, Toolbar } from '@wordpress/components';
import { View } from '@wordpress/primitives';

const EmbedEdit = ( props ) => {

	const [isEditMode, setEditMode] = useState(true);

	const {
		attributes: { iframe, previewable },
		setAttributes,
		isSelected,
	} = props;

	const onChangePreviewable = ( newPreviewable ) => {
    setAttributes( { previewable: newPreviewable === undefined ? false : newPreviewable } )
  };
	const setIframe = ( newIframe ) => {
    setAttributes( { iframe: newIframe === undefined ? '' : newIframe } )
  };

	const getBlockControls = () => {
    return (
      <BlockControls>
        <Toolbar>
          <Button
            label="Edit"
            icon="edit"
            className="my-custom-button"
            onClick={() => onChangePreviewable(!previewable)}
          />
        </Toolbar>
      </BlockControls>
    );
  }

	const blockProps = useBlockProps();

	if( !previewable ){

		return (
				<View { ...blockProps }>
					<EmbedPlaceholder
						onSubmit={ ( event ) => {
							if ( event ) {
								event.preventDefault();
							}
							onChangePreviewable(true);
							setAttributes( { iframe } );
						} }
						value={ iframe }
						onChange={ ( event ) => setIframe( event.target.value ) }
					/>
				</View>
		);

	}

	return (
		[
			getBlockControls(),
			<View { ...blockProps }>
				<EmbedPreview
					iframe = { iframe }
					isSelected={ isSelected }
				/>
			</View>
		]
	);
};

export default EmbedEdit;

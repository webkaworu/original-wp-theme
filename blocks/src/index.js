/**
 * WordPress dependencies
 */
import {
	registerBlockType
} from '@wordpress/blocks';

/**
 * Internal dependencies
 */
import * as ggmap from './ggmap';
import * as faq from './faq';
/**
 * Function to register an individual block.
 *
 * @param {Object} block The block to be registered.
 *
 */
const registerBlock = ( block ) => {
	if ( !block ) {
		return;
	}
	const { metadata, settings, name } = block;
	registerBlockType( { name, ...metadata }, settings );
};

export const __experimentalGetCoreBlocks = () => [
	ggmap,
	faq
];

export const registerCoreBlocks = (
	blocks = __experimentalGetCoreBlocks()
) => {
	blocks.forEach( registerBlock );
};

registerCoreBlocks();

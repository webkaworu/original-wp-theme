import metadata from './block.json';
import edit from './edit';
import save from './save';

const { name } = metadata;

export { metadata, name };

export const settings = {
	icon   : 'location-alt',
	example: {},
	edit,
	save
};

// registerBlockType( 'theme-origin/google-map', {
// 	title      : 'Google Map',
// 	icon       : 'location-alt',
// 	category   : 'theme-origin',
// 	description: 'グーグルマップを埋め込みます。',
// 	keywords   : ['グーグル', 'マップ', 'google', 'map'],
// 	supports   : { align: ['center', 'wide', 'full'] },
// 	attributes : {
// 		iframe: {
// 			type: 'string'
// 		},
// 		previewable: {
// 			type   : 'boolean',
// 			default: false
// 		},
// 		align: {
// 			default: 'center'
// 		}
// 	},
// 	edit,
// 	save
// });

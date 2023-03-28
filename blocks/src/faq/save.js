import {
	InnerBlocks,
	RichText,
	getColorClassName,
	getFontSizeClass,
	useBlockProps,
} from '@wordpress/block-editor';
import classnames from 'classnames';

export default function save({ attributes }) {
	const {
		question,
		questionLabel,
		answerLabel,
		questionColor,
		answerColor,
		backgroundColor,
		textColor,
		borderColor,
		fontSize,
	} = attributes;

	const questionClass = getColorClassName( 'question-color', questionColor );
	const answerClass = getColorClassName( 'answer-color', answerColor );
	const backgroundClass = getColorClassName( 'background-color', backgroundColor );
	const textClass = getColorClassName( 'color', textColor );
	const borderClass = getColorClassName( 'border-color', borderColor );
	const fontSizeClass = getFontSizeClass( fontSize );

	const className = classnames( {
		'faq-wrap': true,
		'blank-box': true,
		'block-box': true,
		'has-question-color': questionColor,
		'has-answer-color': answerColor,
		'has-text-color': textColor,
		'has-background': backgroundColor,
		'has-border-color': borderColor,
		[ questionClass ]: questionClass,
		[ answerClass ]: answerClass,
		[ textClass ]: textClass,
		[ backgroundClass ]: backgroundClass,
		[ borderClass ]: borderClass,
		[ fontSizeClass ]: fontSizeClass,
	} );

	const blockProps = useBlockProps.save({
		className: className,
	});

	return (
		<div { ...blockProps }>
			<div className="card faq_card">
				<h2 className="card-header">
					<a className="card-link" href="#">
						<span className="title">
							<RichText.Content value={ question } />
						</span>
						<span className="icon"></span>
					</a>
				</h2>
				<div className="collapse">
					<div className="card-body">
						<div className="answer_text">
							<InnerBlocks.Content />
						</div>
					</div>
				</div>
			</div>
		</div>
	);
}

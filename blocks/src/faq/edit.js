
import {
  InnerBlocks,
  RichText,
  useBlockProps,
} from '@wordpress/block-editor';
import { Fragment } from '@wordpress/element';
import classnames from 'classnames';

export function FAQEdit( props ) {
  // console.log(props);
  const {
    className,
    setAttributes,
  } = props;

  const {
    question,
    questionLabel,
    answerLabel,
  } = props.attributes;

  const classes = classnames(className, {
    'faq-wrap': true,
    'blank-box': true,
    'block-box': true
  });

  const blockProps = useBlockProps({
    className: classes,
  });

  return (
    <Fragment>

      <div { ...blockProps }>
        <dl className="faq">
          <dt
            className="faq-question faq-item"
          >
            <div
              className="faq-question-label faq-item-label"
            >
              { questionLabel }
            </div>
            <div
              className="faq-question-content faq-item-content"
            >
              <RichText
                tagName="div"
                className="faq-question-content"
                placeholder='質問を入力してください…'
                value={ question }
                multiline={ false }
                onChange={(value) => setAttributes({ question: value })}
              />
            </div>
          </dt>
          <dd className="faq-answer faq-item">
            <div
              className="faq-answer-label faq-item-label"
            >
              { answerLabel }
            </div>
            <div
              className="faq-answer-content faq-item-content"
            >
              <InnerBlocks />
            </div>
          </dd>
        </dl>
      </div>

    </Fragment>
  );
}

export default FAQEdit;

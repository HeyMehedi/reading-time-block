import { 
	Placeholder, 
	Button, 
	Modal, 
	TextControl,
	PanelBody,
	SelectControl,
	ToggleControl
} from '@wordpress/components';

import { useState, Fragment } from '@wordpress/element';
import { useBlockProps, InspectorControls, InnerBlocks } from '@wordpress/block-editor';
import { __ } from '@wordpress/i18n';

export default function Edit( { attributes, isSelected, setAttributes } ) {
	const blockProps = useBlockProps();
	return (
		<div { ...blockProps }>

			{  attributes.before_text ? 
				attributes.before_text
			: '' } 2 mins {  attributes.after_text ? 
				attributes.after_text
			: '' }
			
			<InspectorControls>

				<PanelBody title={ __( 'General', 'directorist' ) } initialOpen={ true }>

					<TextControl
						placeholder={ __( 'Words Per Min', 'directorist' ) }
						type='number'
						value={ attributes.words_per_min }
						onChange={ newState => setAttributes( { words_per_min: newState } ) }
					/>

					<TextControl
						placeholder={ __( 'Reading time: ', 'directorist' ) }
						type='text'
						value={ attributes.before_text }
						onChange={ newState => setAttributes( { before_text: newState } ) }
					/>

					<TextControl
						placeholder={ __( ' read', 'directorist' ) }
						type='text'
						value={ attributes.after_text }
						onChange={ newState => setAttributes( { after_text: newState } ) }
					/>

					<TextControl
						placeholder={ __( 'div', 'directorist' ) }
						type='text'
						value={ attributes.wrapper_tag }
						onChange={ newState => setAttributes( { wrapper_tag: newState } ) }
					/>

				</PanelBody>
			</InspectorControls>
		</div>
	);
}

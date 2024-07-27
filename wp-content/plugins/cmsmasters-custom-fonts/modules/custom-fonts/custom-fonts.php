<?php
/**
 * @package 	WordPress Plugin
 * @subpackage 	CMSMasters Custom Fonts
 * @version		1.0.1
 * 
 * Custom Fonts
 * Created by CMSMasters
 * 
 */


namespace CmsmastersCustomFonts\Modules\Custom_Fonts;


class Custom_Fonts {
	public function __construct() {
		$this->actions();
	}
	
	/**
	 * Register action and filter hooks
	 */
	protected function actions() {
		add_filter( 'wp_check_filetype_and_ext', array( $this, 'filter_wp_check_filetype_and_ext' ), 10, 4 );
		add_filter( 'upload_mimes', array( $this, 'upload_mimes' ) );
		add_action( 'add_meta_boxes_' . Fonts_Manager::CPT, array( $this, 'add_meta_box' ) );
		add_action( 'save_post_' . Fonts_Manager::CPT, array( $this, 'save_post_meta' ), 10, 3 );
	}
	
	/**
	 * Check filetype and ext for upload files
	 *
	 * @param $data, $file, $filename, $mimes
	 *
	 * @return array
	 */
	public function filter_wp_check_filetype_and_ext( $data, $file, $filename, $mimes ) {
		if ( !empty( $data['ext'] ) && !empty( $data['type'] ) ) {
			return $data;
		}
		
		
		$registered_file_types = $this->get_file_types();
		
		$filetype = wp_check_filetype( $filename, $mimes );
		
		
		if ( !isset( $registered_file_types[$filetype['ext']] ) ) {
			return $data;
		}
		
		
		return array(
			'ext' 				=> $filetype['ext'],
			'type' 				=> $filetype['type'],
			'proper_filename' 	=> $data['proper_filename'],
		);
	}
	
	/**
	 * Get allowed file types
	 *
	 * @param $data, $file, $filename, $mimes
	 *
	 * @return array
	 */
	private function get_file_types() {
		return array(
			'woff' 		=> 'font/woff|application/font-woff|application/x-font-woff|application/octet-stream',
			'woff2' 	=> 'font/woff2|application/octet-stream|font/x-woff2',
			'ttf' 		=> 'application/x-font-ttf|application/octet-stream|font/ttf',
			'svg' 		=> 'image/svg+xml|application/octet-stream|image/x-svg+xml',
			'eot' 		=> 'application/vnd.ms-fontobject|application/octet-stream|application/x-vnd.ms-fontobject',
		);
	}
	
	/**
	 * Filter allowed mimes
	 *
	 * @param $mine_types
	 *
	 * @return array
	 */
	public function upload_mimes( $mine_types ) {
		if ( current_user_can( 'manage_options' ) ) {
			foreach ( $this->get_file_types() as $type => $mine ) {
				if ( !isset( $mine_types[$type] ) ) {
					$mine_types[$type] = $mine;
				}
			}
		}
		
		
		return $mine_types;
	}
	
	/**
	 * Add meta box for font post type
	 */
	public function add_meta_box() {
		add_meta_box(
			'cmsmasters-custom-font-metabox',
			esc_html__( 'Manage Your Font Files', 'cmsmasters-custom-fonts' ),
			array( $this, 'render_metabox_fields' ),
			Fonts_Manager::CPT,
			'normal',
			'default'
		);
	}
	
	/**
	 * Render meta box fields for font post type
	 *
	 * @param $post
	 *
	 * @show font post type meta fields
	 */
	public function render_metabox_fields( $post ) {
		wp_enqueue_media();
		
		
		$fields = array(
			array(
				'id' 			=> 'open_div',
				'field_type' 	=> 'html_tag',
				'label' 		=> false,
				'tag' 			=> 'div',
				'attributes' 	=> array(
					'class' => 'repeater-content-top',
				),
			),
			array(
				'id' 				=> 'font_weight',
				'field_type' 		=> 'select',
				'label' 			=> esc_html__( 'Weight', 'cmsmasters-custom-fonts' ) . ':',
				'extra_attributes' 	=> array(
					'class' => 'font_weight',
				),
				'options' 			=> array(
					'normal' => esc_html__( 'Normal', 'cmsmasters-custom-fonts' ),
					'bold' 	=> esc_html__( 'Bold', 'cmsmasters-custom-fonts' ),
					'100' 	=> '100',
					'200' 	=> '200',
					'300' 	=> '300',
					'400' 	=> '400',
					'500' 	=> '500',
					'600' 	=> '600',
					'700' 	=> '700',
					'800' 	=> '800',
					'900' 	=> '900',
				),
			),
			array(
				'id' 				=> 'font_style',
				'field_type' 		=> 'select',
				'label' 			=> esc_html__( 'Style', 'cmsmasters-custom-fonts' ) . ':',
				'extra_attributes' 	=> array(
					'class' => 'font_style',
				),
				'options' 			=> array(
					'normal' 	=> esc_html__( 'Normal', 'cmsmasters-custom-fonts' ),
					'italic' 	=> esc_html__( 'Italic', 'cmsmasters-custom-fonts' ),
					'oblique' 	=> esc_html__( 'Oblique', 'cmsmasters-custom-fonts' ),
				),
			),
			array(
				'id' 			=> 'preview_label',
				'field_type' 	=> 'html',
				'label' 		=> false,
				'raw_html' 		=> sprintf( '<div class="inline-preview">%s</div>', esc_html__( 'The quick brown fox jumps over the lazy dog.', 'cmsmasters-custom-fonts' ) ),
			),
			array(
				'id' 			=> 'toolbar',
				'field_type' 	=> 'toolbar',
				'label' 		=> false,
			),
			array(
				'id' 			=> 'close_div',
				'field_type' 	=> 'html_tag',
				'label' 		=> false,
				'tag' 			=> 'div',
				'close' 		=> true,
			),
			array(
				'id' 			=> 'open_div',
				'field_type' 	=> 'html_tag',
				'label' 		=> false,
				'tag' 			=> 'div',
				'attributes' 	=> array(
					'class' => 'repeater-content-bottom',
				),
			),
		);
		
		
		foreach ( $this->get_file_types() as $type => $mine ) {
			$fields[] = array(
				'id' 				=> $type,
				'field_type' 		=> 'file',
				'mine' 				=> str_replace( '|', ',', $mine ),
				'ext' 				=> $type,
				'label' 			=> sprintf( esc_html__( '%s File', 'cmsmasters-custom-fonts' ), strtoupper( $type ) ),
				'box_title' 		=> sprintf( esc_html__( 'Upload font .%s file', 'cmsmasters-custom-fonts' ), $type ),
				'box_action' 		=> sprintf( esc_html__( 'Select .%s file', 'cmsmasters-custom-fonts' ), $type ),
				'preview_anchor' 	=> 'none',
				'description' 		=> $this->get_file_type_description( $type ),
			);
		}
		
		
		$fields[] = array(
			'id' 			=> 'close_div',
			'field_type' 	=> 'html_tag',
			'label' 		=> false,
			'tag' 			=> 'div',
			'close' 		=> true,
		);
		
		
		$font_data = get_post_meta( $post->ID, Fonts_Manager::FONT_META_KEY, true );
		
		
		$repeater = array(
			'fields' 		=> $fields,
			'id' 			=> 'font_face',
			'label' 		=> false,
			'add_label' 	=> esc_html__( 'Add Font Variation', 'cmsmasters-custom-fonts' ),
			'toggle_title' 	=> esc_html__( 'Edit', 'cmsmasters-custom-fonts' ),
			'remove_title' 	=> esc_html__( 'Delete', 'cmsmasters-custom-fonts' ),
			'field_type' 	=> 'repeater',
			'row_label' 	=> array(
				'default' 	=> 'Settings',
				'selector' 	=> '.font_weight',
			),
			'saved' => $font_data,
		);
		
		
		$this->print_metabox( array($repeater) );
		
		
		printf( '<style>%s</style>', get_post_meta( $post->ID, Fonts_Manager::FONT_FACE_META_KEY, true ) );
	}
	
	/**
	 * Displays a wrapper for meta fields and launches the output of meta fields.
	 *
	 * @param $fields
	 */
	public function print_metabox( $fields ) {
		?>
		<div class="cmsmasters-custom-font-metabox-content">
			<?php
			foreach ( $fields as $field ) {
				echo $this->get_metabox_field_html( $field, $field['saved'] );
			}
			?>
		</div>
		<?php
	}
	
	/**
	 * Gets field types and processes them.
	 *
	 * @param $field, $saved
	 *
	 * @return field rows
	 */
	public function get_metabox_field_html( $field, $saved ) {
		$html = '';
		
		
		switch ( $field['field_type'] ) {
			case 'html':
				$html = $this->get_html_field( $field );
				
				return $html;
				
				break;
			case 'html_tag':
				$html = $this->get_html_tag( $field );
				
				return $html;
				
				break;
			case 'toolbar':
				$html = $this->get_repeater_tools( $field );
				
				break;
			case 'input':
				$html = $this->get_input_field( $field );
				
				break;
			case 'select':
				$html = $this->get_select_field( $field, $saved );
				
				break;
			case 'textarea':
				$html = $this->get_textarea_field( $field, $saved );
				
				break;
			case 'file':
				$html = $this->get_file_field( $field, $saved );
				
				break;
			case 'repeater':
				$html = $this->get_repeater_field( $field, $saved );
				
				break;
			default:
				$method = 'get_' . $field['field_type'] . 'field';
				
				if ( method_exists( $this, $method ) ) {
					$html = call_user_func( array( $this, $method ), $field, $saved );
				}
				
				break;
		}
		
		
		return $this->get_field_row( $field, $html );
	}
	
	/**
	 * Gets label for field
	 *
	 * @param $field
	 *
	 * @return HTML which contains label
	 */
	public function get_field_label( $field ) {
		if ( !isset( $field['label'] ) || false === $field['label'] ) {
			return '';
		}
		
		
		$id = $field['id'];
		
		if ( 'file' === $field['field_type'] ) {
			$id .= $field['field_type'];
		}
		
		
		return '<p class="cmsmasters-field-label"><label for="' . esc_attr( $id ) . '">' . $field['label'] . '</label></p>';
	}
	
	/**
	 * Gets input field
	 *
	 * @param $attributes
	 *
	 * @return input tag with attributes
	 */
	public function get_input_field( $attributes ) {
		$input = '<input ' . $this->get_attribute_string( $attributes ) . '>';
		
		
		return $input;
	}
	
	/**
	 * Gets attributes for fields tags
	 *
	 * @param $attributes, $field
	 *
	 * @return string
	 */
	public function get_attribute_string( $attributes, $field = array() ) {
		if ( isset( $field['extra_attributes'] ) && is_array( $field['extra_attributes'] ) ) {
			$attributes = array_merge( $attributes, $field['extra_attributes'] );
		}
		
		
		$attributes_array = array();
		
		foreach ( $attributes as $name => $value ) {
			$attributes_array[] = sprintf( '%s="%s"', $name, esc_attr( $value ) );
		}
		
		
		return implode( ' ', $attributes_array );
	}
	
	/**
	 * Gets select field with attributes
	 *
	 * @param $field, $selected
	 *
	 * @return HTML
	 */
	public function get_select_field( $field, $selected = '' ) {
		$input = '<select ';
		$input .= $this->get_attribute_string( array(
			'name' 	=> $field['id'],
			'id' 	=> $field['id'],
		), $field );
		$input .= '>' . "\n";
		
		
		foreach ( $field['options'] as $value => $label ) {
			$input .= '<option value="' . $value . '" ' . selected( $selected, $value, false ) . '>' . esc_attr( $label ) . '</option>' . PHP_EOL;
		}
		
		
		return $input . '</select>';
	}
	
	/**
	 * Gets textarea field with attributes
	 *
	 * @param $field, $html
	 *
	 * @return HTML
	 */
	public function get_textarea_field( $field, $html ) {
		$input = '<textarea ';
		$input .= $this->get_attribute_string( array(
			'name' 	=> $field['id'],
			'id' 	=> $field['id'],
		), $field );
		
		$input .= '>' . esc_textarea( $html ) . '</textarea>';
		
		
		return $input;
	}
	
	/**
	 * Gets file field with attributes
	 *
	 * @param $field, $saved
	 *
	 * @return HTML
	 */
	public function get_file_field( $field, $saved ) {
		$value = array(
			'id' 	=> '',
			'url' 	=> '',
		);
		
		
		if ( isset( $saved['id'] ) && isset( $saved['url'] ) ) {
			$value = $saved;
		}
		
		
		$html = '<ul></ul>';
		$html .= $this->get_input_field(
			array(
				'type' 		=> 'hidden',
				'name' 		=> $field['id'] . '[id]',
				'value' 	=> $value['id'],
			)
		);
		
		$html .= $this->get_input_field(
			array(
				'type' 			=> 'text',
				'name' 			=> $field['id'] . '[url]',
				'value' 		=> $value['url'],
				'placeholder' 	=> $field['description'],
				'class' 		=> 'cmsmasters-field-input',
			)
		);
		
		$html .= $this->get_input_field(
			array(
				'type' 					=> 'button',
				'class' 				=> 'button cmsmasters-custom-fonts-button cmsmasters-upload-btn',
				'name' 					=> $field['id'],
				'id' 					=> $field['id'],
				'value' 				=> '',
				'data-preview_anchor' 	=> isset( $field['preview_anchor'] ) ? $field['preview_anchor'] : 'none',
				'data-mime_type' 		=> isset( $field['mine'] ) ? $field['mine'] : '',
				'data-ext' 				=> isset( $field['ext'] ) ? $field['ext'] : '',
				'data-upload_text' 		=> esc_html__( 'Upload', 'cmsmasters-custom-fonts' ),
				'data-remove_text' 		=> esc_html__( 'Delete', 'cmsmasters-custom-fonts' ),
				'data-box_title' 		=> isset( $field['box_title']) ? $field['box_title'] : '',
				'data-box_action' 		=> isset( $field['box_action']) ? $field['box_action'] : '',
			)
		);
		
		
		return $html;
	}
	
	/**
	 * Gets html field
	 *
	 * @param $field
	 *
	 * @return HTML
	 */
	public function get_html_field( $field ) {
		return $field['raw_html'];
	}
	
	/**
	 * Gets repeater field
	 *
	 * @param $field, $saved
	 *
	 * @return HTML
	 */
	public function get_repeater_field( $field, $saved ) {
		$id = $field['id'];
		
		$js_id = 'repeater_' . dechex( rand() );
		
		$add_label = isset( $field['add_label'] ) ? $field['add_label'] : esc_html__( 'Add item', 'cmsmasters-custom-fonts' );
		
		$row_label = isset( $field['row_label'] ) ? $field['row_label'] : esc_html__( 'Row', 'cmsmasters-custom-fonts' );
		
		$row_label_html_args = array(
			'id' 		=> 'row_label_' . $js_id,
			'class' 	=> 'repeater-title hidden',
		);
		
		
		if ( is_array( $row_label ) ) {
			$label = $row_label['default'];
			
			$row_label_html_args['data-default'] = $row_label['default'];
			
			$row_label_html_args['data-selector'] = $row_label['selector'];
		} else {
			$label = $row_label;
			
			$row_label_html_args['data-default'] = $row_label;
		}
		
		
		$row_label_html = '<span ' . $this->get_attribute_string( $row_label_html_args ) . '>' . $label . '</span>';
		ob_start();
		?>
		<script type="text/template" id="<?php echo esc_attr( $js_id . '_block' ); ?>">
			<div class="repeater-block block-visible">
				<?php
				echo $row_label_html;
				echo $this->get_repeater_tools( $field );
				?>
				<div class="repeater-content form-table">
					<?php
					foreach ( $field['fields'] as $sub_field ) {
						$sub_field['real_id'] = $id;
						$sub_field['id'] = $id . '[__counter__][' . $sub_field['id'] . ']';
						
						echo $this->get_metabox_field_html( $sub_field, '' );
					}
					?>
				</div>
			</div>
		</script>
		<?php
		$counter = 0;
		
		$row_label_html_args['class'] = 'repeater-title';
		
		$row_label_html = '<span ' . $this->get_attribute_string( $row_label_html_args ) . '>' . $label . '</span>';
		
		
		if ( is_array( $saved ) && count( $saved ) > 0 ) {
			foreach ( (array) $saved as $key => $item ) {
				echo '<div class="repeater-block">' . 
					$row_label_html . 
					$this->get_repeater_tools( $field ) . 
					'<div class="repeater-content hidden form-table">';
					
					foreach ( $field['fields'] as $sub_field ) {
						$default = isset( $sub_field['default'] ) ? $sub_field['default'] : '';
						
						$item_meta = isset( $item[$sub_field['id']] ) ? $item[$sub_field['id']] : $default;
						
						$sub_field['real_id'] = $sub_field['id'];
						
						$sub_field['id'] = $id . '[' . $counter . '][' . $sub_field['id'] . ']';
						
						echo $this->get_metabox_field_html( $sub_field, $item_meta );
					}
					
					echo '</div>' . 
				'</div>';
				
				
				$counter++;
			}
		}
		
		
		echo '<input type="button" class="button cmsmasters-custom-fonts-button add-repeater-row" value="' . esc_attr( $add_label ) . '" data-template-id="' . $js_id . '_block">';
		
		
		return ob_get_clean();
	}
	
	/**
	 * Gets html tag field
	 *
	 * @param $field
	 *
	 * @return HTML
	 */
	private function get_html_tag( $field ) {
		$tag = isset( $field['tag'] ) ? $field['tag'] : 'div';
		
		if ( isset( $field['close'] ) && true === $field['close'] ) {
			return '</' . $tag . '>';
		}
		
		return '<' . $tag . ' ' . $this->get_attribute_string( $field['attributes'] ) . '>';
	}
	
	/**
	 * Gets tools for repeater field
	 *
	 * @param $field
	 *
	 * @return HTML
	 */
	private function get_repeater_tools( $field ) {
		return '<span class="cmsmasters-repeater-tool-btn close-repeater-row dashicons-no-alt" title="' . esc_attr__( 'Close', 'cmsmasters-custom-fonts' ) . '"></span>
		<span class="cmsmasters-repeater-tool-btn toggle-repeater-row dashicons-edit" title="' . esc_attr__( 'Edit', 'cmsmasters-custom-fonts' ) . '"></span>
		<span class="cmsmasters-repeater-tool-btn remove-repeater-row dashicons-trash" data-confirm="' . esc_attr__( 'Are you sure?', 'cmsmasters-custom-fonts' ) . '" title="' . esc_attr__( 'Delete', 'cmsmasters-custom-fonts' ) . '"></span>';
	}
	
	/**
	 * Gets wrapper for fields
	 *
	 * @param $field, $field_html
	 *
	 * @return HTML
	 */
	public function get_field_row( $field, $field_html ) {
		$description = '';
		
		$css_id = isset( $field['id'] ) ? ' ' . $field['id'] : '';

		if ( isset( $field['real_id'] ) ) {
			$css_id = ' ' . $field['real_id'];
		}

		$css_id .= ' cmsmasters-field-' . $field['field_type'];

		return '<div class="cmsmasters-field' . $css_id . '">' . $this->get_field_label( $field ) . $field_html . $description . '</div>';
	}
	
	/**
	 * Filters a sanitized text field string
	 *
	 * @param $data
	 *
	 * @return sanitized $data
	 */
	public function sanitize_text_field_recursive( $data ) {
		if ( is_array( $data ) ) {
			foreach ( $data as $key => $value ) {
				$data[ $key ] = $this->sanitize_text_field_recursive( $value );
			}

			return $data;
		}

		return sanitize_text_field( $data );
	}
	
	/**
	 * Save font post type metadata
	 *
	 * @param $post_id, $post, $update
	 */
	public function save_post_meta( $post_id, $post, $update ) {
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return $post_id;
		}
		
		
		if ( !current_user_can( 'edit_post', $post_id ) ) {
			return $post_id;
		}
		
		
		if ( !isset( $_POST['font_face'] ) || !is_array( $_POST['font_face'] ) ) {
			return;
		}
		
		
		$font_face = array();
		
		foreach ( $_POST['font_face'] as $font_data ) {
			$font_face[] = $this->sanitize_text_field_recursive( $font_data );
		}
		
		
		update_post_meta( $post_id, Fonts_Manager::FONT_META_KEY, $font_face );
		
		update_post_meta( $post_id, Fonts_Manager::FONT_FACE_META_KEY, $this->generate_font_face( $post_id ) );
	}
	
	/**
	 * Generate font-face rule for metadata
	 *
	 * @param $post_id
	 *
	 * @return string
	 */
	public function generate_font_face( $post_id ) {
		$saved = get_post_meta( $post_id, Fonts_Manager::FONT_META_KEY, true );
		
		
		if ( !is_array( $saved ) ) {
			return false;
		}
		
		
		$font_family = get_the_title( $post_id );
		
		$font_face = '';
		
		
		foreach ( $saved as $font_data ) {
			$font_face .= $this->get_font_face_from_data( $font_family, $font_data ) . PHP_EOL;
		}
		
		
		return $font_face;
	}
	
	/**
	 * Get font-face rule from data
	 *
	 * @param $font_family, $data
	 *
	 * @return string
	 */
	public function get_font_face_from_data( $font_family, $data ) {
		$src = array();
		
		foreach ( array('eot', 'woff2', 'woff', 'ttf', 'svg') as $type ) {
			if ( !isset( $data[$type] ) || !isset( $data[$type]['url'] ) || empty( $data[$type]['url'] ) ) {
				continue;
			}
			
			
			if ( 'svg' === $type ) {
				$data[$type]['url'] .= '#' . str_replace( ' ', '', $font_family );
			}
			
			
			$src[] = $this->get_font_src_per_type( $type, $data[$type]['url'] );
		}
		
		
		$font_face = '@font-face {' . PHP_EOL;
		$font_face .= "\tfont-family: '" . $font_family . "';" . PHP_EOL;
		$font_face .= "\tfont-style: " . $data['font_style'] . ';' . PHP_EOL;
		$font_face .= "\tfont-weight: " . $data['font_weight'] . ';' . PHP_EOL;
		
		
		if ( isset( $data['eot'] ) && isset( $data['eot']['url'] ) && !empty( $data['eot']['url'] ) ) {
			$font_face .= "\tsrc: url('" . esc_attr($data['eot']['url']) . "');" . PHP_EOL;
		}
		
		
		$font_face .= "\tsrc: " . implode( ',' . PHP_EOL . "\t\t", $src ) . ';' . PHP_EOL . '}';
		
		
		return $font_face;
	}
	
	/**
	 * Get font src per type
	 *
	 * @param $type, $url
	 *
	 * @return string
	 */
	private function get_font_src_per_type( $type, $url ) {
		$src = 'url(\'' . esc_attr( $url ) . '\') ';
		
		
		switch ( $type ) {
			case 'woff':
			case 'woff2':
			case 'svg':
				$src .= 'format(\'' . $type . '\')';
				
				break;
			case 'ttf':
				$src .= 'format(\'truetype\')';
				
				break;
			case 'eot':
				$src = 'url(\'' . esc_attr( $url ) . '?#iefix\') format(\'embedded-opentype\')';
				
				break;
		}
		
		
		return $src;
	}
	
	/**
	 * Get descriptions for files types
	 *
	 * @return string
	 */
	private function get_file_type_description( $file_type ) {
		$descriptions = array(
			'woff' 		=> esc_html__( 'Web Open Font Format, used by all modern browsers', 'cmsmasters-custom-fonts' ),
			'woff2' 	=> esc_html__( 'Web Open Font Format 2, used by newest versions of all modern browsers (excerpt Edge)', 'cmsmasters-custom-fonts' ),
			'ttf' 		=> esc_html__( 'TrueType font, used by all older versions of browsers', 'cmsmasters-custom-fonts' ),
			'svg' 		=> esc_html__( 'Scalable Vector Graphics font, used by iOS and Safari', 'cmsmasters-custom-fonts' ),
			'eot' 		=> esc_html__( 'Embedded OpenType font, used by IE6+', 'cmsmasters-custom-fonts' ),
		);
		
		
		return isset( $descriptions[$file_type] ) ? $descriptions[$file_type] : '';
	}
}

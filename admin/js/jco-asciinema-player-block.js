const {registerBlockType} = wp.blocks; //Blocks API
const {createElement} = wp.element; //React.createElement
const {__} = wp.i18n; //translation functions
const {InspectorControls} = wp.blockEditor;
const {TextControl,SelectControl} = wp.components;
const {ServerSideRender} = wp.editor;
const {withSelect} = wp.data;
const {compose} = wp.compose;

registerBlockType( 'jco-asciinema-player/asciinema-block', {
	title: __( 'Asciinema Player' ), // Block title.
	category:  __( 'embed' ),
  icon: 'format-video',
  attributes:  {
    id: {
      default: 1,
      type: 'string',
    },
    posts: {
      type: 'array',
      default: []
    },
    className: {
      type: 'string',
      default: ''
    }
  },
	//display the edit interface + preview
  edit(props){
    const attributes =  props.attributes;
    const setAttributes =  props.setAttributes;


    const AsciinemasDropdown = withSelect( (select, props) => {
        return {
        posts: select( 'core' ).getEntityRecords( 'postType', 'jco_asciinema_post' )
        }
      })(( props ) => {
        var options = [];
        if( props.posts ) {
          options.push( {value: 0, label: 'Choose an Asciinema:' } );
          props.posts.forEach((post) => {
            options.push( {value: post.id, label:post.title.rendered});
          });
      } else {
        options.push( {value: 0, label: 'Loading...'});
      }
      return createElement(SelectControl, {
        label: __('Choose an Asciinema'),
        options: options,
        onChange: changeId,
        value: attributes.id
      })
    })

    function changeId(id){
      setAttributes({id});
    }
    if ( attributes.id == '1' ) {
      return createElement('div', {}, [
        createElement( 'div', {}, 'Select an Asciinema to Display.'),
        createElement(AsciinemasDropdown),
        createElement( InspectorControls, {},
          [
            createElement(AsciinemasDropdown),
          ],
        ),
      ]);
    }
    return createElement('div', {}, [
			//Preview a block with a PHP render callback
      createElement( ServerSideRender, {
				block: 'jco-asciinema-player/asciinema-block',
				attributes: attributes
			} ),
			//Block inspector
			createElement( InspectorControls, {},
				[
          createElement(AsciinemasDropdown)
				]
			)
		] )
	},
	save(){
		return null;//save has to exist. This all we need
	}
});

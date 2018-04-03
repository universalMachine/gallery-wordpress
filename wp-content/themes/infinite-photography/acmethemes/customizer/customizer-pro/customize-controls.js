( function( api ) {

	// Extends our custom "infinite-photography" section.
	api.sectionConstructor['infinite-photography'] = api.Section.extend( {

		// No events for this type of section.
		attachEvents: function () {},

		// Always make the section active.
		isContextuallyActive: function () {
			return true;
		}
	} );

} )( wp.customize );
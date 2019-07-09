/**
 * File navigation.js.
 *
 * Handles toggling the navigation menu for small screens and enables TAB key
 * navigation support for dropdown menus.
 */
( function() {
	var container, current, header, iconOpen, iconClose, button, searchContainer, searchToggle, menu, links, i, len;

	container = document.getElementById( 'site-navigation' );
	searchContainer = document.getElementById( 'search-container' );
	header    = document.getElementById( 'masthead' );
	if ( ! container ) {
		return;
	}

	button = container.getElementsByTagName( 'button' )[0];
	if ( 'undefined' === typeof button ) {
		return;
	}
	searchToggle = searchContainer.getElementsByTagName( 'button' )[0];
	if ( 'undefined' === typeof button ) {
		return;
	}
	menu = container.getElementsByTagName( 'ul' )[0];

	// Hide menu toggle button if menu is empty and return early.
	if ( 'undefined' === typeof menu ) {
		button.style.display = 'none';
		return;
	}

	if ( -1 === menu.className.indexOf( 'nav-menu' ) ) {
		menu.className += ' nav-menu';
	}

	button.onclick = function() {
		if ( -1 !== container.className.indexOf( 'toggled' ) ) {
			container.className = container.className.replace( ' toggled', '' );
			header.className = header.className.replace( ' toggled', '' );
			button.setAttribute( 'aria-expanded', 'false' );
		} else {
			container.className += ' toggled';
			header.className += ' toggled';
			button.setAttribute( 'aria-expanded', 'true' );
		}
	};

	searchToggle.onclick = function() {
		if ( -1 !== searchContainer.className.indexOf( 'toggled' ) ) {
			searchContainer.className = searchContainer.className.replace( ' toggled', '' );
			searchToggle.setAttribute( 'aria-expanded', 'false' );
		} else {
			searchContainer.className += ' toggled';
			searchToggle.setAttribute( 'aria-expanded', 'true' );
			var focusable = searchContainer.querySelectorAll( 'button, input' );
			var first     = focusable[0];
			var last      = focusable[focusable.length - 1];
			searchContainer.addEventListener('keydown', function(e) {
			if (e.key === 'Tab' || e.keyCode === 9 ) {
				if ( e.shiftKey ) /* shift + tab */ {
					if (document.activeElement === first && 'true' === searchToggle.getAttribute( 'aria-expanded' ) ) {
						last.focus();
						e.preventDefault();
					}
				} else /* tab */ {
					if (document.activeElement === last) {
						first.focus();
						e.preventDefault();
					}
				}
			}
			});
		}
	};

	// Get current menu item.
	current = menu.getElementsByClassName( 'current-menu-item' )[0];
	if ( 'undefined' !== typeof current ) {
		link = current.getElementsByTagName( 'a' )[0];
		link.setAttribute( 'aria-current', 'page' );
	}

	// Get all the link elements within the menu.
	links    = menu.getElementsByTagName( 'a' );

	// Each time a menu link is focused or blurred, toggle focus.
	for ( i = 0, len = links.length; i < len; i++ ) {
		links[i].addEventListener( 'focus', toggleFocus, true );
		links[i].addEventListener( 'blur', toggleFocus, true );
	}

	/**
	 * Sets scrolled class when featured post scrolls out of view.
	 */
	function setScroll() {
		var home = document.getElementsByTagName( 'body' )[0];
		var hasClass = ( ( -1 === home.className.indexOf( 'scrolled' ) ) ) ? false : true;
		// Only execute on home page.
		if ( -1 !== home.className.indexOf( 'home' ) ) {
			if ( ! hasClass && ( window.innerHeight - window.scrollY <= header.offsetHeight ) ) {
				home.className += ' scrolled';
			} else if ( hasClass && ( window.innerHeight - window.scrollY >= header.offsetHeight ) ) {
				home.className = home.className.replace( ' scrolled', '' );
			}
		}
	}

	window.onscroll = function( e ) {
		setScroll();
	}

	/**
	 * Sets or removes .focus class on an element.
	 */
	function toggleFocus() {
		var self = this;

		// Move up through the ancestors of the current link until we hit .nav-menu.
		while ( -1 === self.className.indexOf( 'nav-menu' ) ) {

			// On li elements toggle the class .focus.
			if ( 'li' === self.tagName.toLowerCase() ) {
				if ( -1 !== self.className.indexOf( 'focus' ) ) {
					self.className = self.className.replace( ' focus', '' );
				} else {
					self.className += ' focus';
				}
			}

			self = self.parentElement;
		}
	}

	/**
	 * Toggles `focus` class to allow submenu access on tablets.
	 */
	( function( container ) {
		var touchStartFn, i,
			parentLink = container.querySelectorAll( '.menu-item-has-children > a, .page_item_has_children > a' );

		if ( 'ontouchstart' in window ) {
			touchStartFn = function( e ) {
				var menuItem = this.parentNode, i;

				if ( ! menuItem.classList.contains( 'focus' ) ) {
					e.preventDefault();
					for ( i = 0; i < menuItem.parentNode.children.length; ++i ) {
						if ( menuItem === menuItem.parentNode.children[i] ) {
							continue;
						}
						menuItem.parentNode.children[i].classList.remove( 'focus' );
					}
					menuItem.classList.add( 'focus' );
				} else {
					menuItem.classList.remove( 'focus' );
				}
			};

			for ( i = 0; i < parentLink.length; ++i ) {
				parentLink[i].addEventListener( 'touchstart', touchStartFn, false );
			}
		}
	}( container ) );
} )();

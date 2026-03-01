/**
 * Open the WooCommerce mini-cart drawer after an item is added to the cart.
 *
 * The Product Collection block uses the Store API (not jQuery AJAX), so the
 * classic "added_to_cart" event never fires. Instead, we watch the mini-cart
 * badge for count changes via MutationObserver and click the button to open
 * the drawer.
 */
(function () {
	var badge = document.querySelector('.wc-block-mini-cart__badge');
	if (!badge) return;

	var observer = new MutationObserver(function () {
		var btn = document.querySelector('.wc-block-mini-cart__button');
		if (btn && !btn.disabled) {
			btn.click();
		}
	});

	observer.observe(badge, { childList: true, characterData: true, subtree: true });
})();

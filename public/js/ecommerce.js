/*productClick : function (product) {
	ga('ec:addProduct', {
		'id': product.code,
		'name': product.name,
		'category': product.category[0].name,
		'brand': 'Spetema',
	});

	ga('ec:setAction', 'click', {list: 'Search Results'});

	// Send click with an event, then send user to product page.
	ga('send', 'event', 'UX', 'click', 'Results', {
		hitCallback: function() {
			console.log("product clicked")
		}
	});

}
productDetails : function (product) {
	ga('ec:addProduct', {
		'id': product.code,
		'name': product.name,
		'category': product.category[0].name,
		'brand': 'Spetema'
	});

	ga('ec:setAction', 'detail');
	ga('send', 'pageview');
	//facebook event
	fbq('track', 'ViewContent');
}*/

var cart_add = function(item) {

    ga('ec:addProduct', { 'id': item.code, 'name': item.name, 'category': item.category, 'price': item.price, 'quantity': item.qty });

    ga('ec:setAction', 'add');

    ga('send', 'event', 'UX', 'click', 'add to cart');

    fbq('track', 'AddToCart');

}

var cart_del = function (item) {

    ga('ec:addProduct', { 'id': item.product.code, 'name': item.product.name, 'category': item.product.category[0].name, 'price': item.product.price, 'quantity': item.qty });

    ga('ec:setAction', 'remove');

    ga('send', 'event', 'UX', 'click', 'remove from cart');

};
var cart_init = function (cart) {

    for(var i = 0; i < cart.items.length; i++) {

        var item = cart.items[i];

        ga('ec:addProduct', { 'id': item.product.code, 'name': item.product.name, 'category': item.product.category[0].name, 'price': item.product.price, 'quantity': item.qty });

    }

    fbq('track', 'InitiateCheckout');

};

var cart_payment = function (order, cart) {

    //this.init(cart);

    ga('ec:setAction','checkout', {
        'step': 1,            // A value of 1 indicates this action is first checkout step.
        'option': order.paymentMethod      // Used to specify additional info about a checkout stage, e.g. payment method.
    });

    ga('send', 'pageview');

    fbq('track', 'AddPaymentInfo');

};

var cart_shipping = function (order, cart) {

    //this.init(cart);

    ga('ec:setAction', 'checkout_option', { 'step': 2, 'option': order.deliveryMethod });

    ga('ec:setAction','checkout', { 'step': 2 });

    ga('send', 'pageview');     // Pageview for shipping.html

    ga('send', 'event', 'Checkout', 'Option', { hitCallback: function() {

            console.log("shipping sent")

        } });

};

var cart_transaction = function (order, cart) {

    //this.init(cart);

    // Transaction level information is provided via an actionFieldObject.
    ga('ec:setAction', 'purchase', { 'id': order.orderId, 'affiliation': 'Coffee Mall - Online', 'revenue': cart.grandTotal, 'shipping': cart.deliveryTax });

    ga('send', 'pageview');     // Send transaction data with initial pageview.

    fbq('track', 'Purchase', { value: Number(cart.grandTotal / 1.955).toFixed(2), currency: 'EUR' });

};
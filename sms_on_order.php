<?php
/*
Plugin Name: Ecommerce SMS Alert
Plugin URI:  https://sabinkhanal.com.np
Description: This plugin enables SMS on order status change.
Version:     1.0
Author:      Sabin Khanal
Author URI:  https://sabinkhanal.com.np
License:     GPL2 etc
License URI: GPL

Copyright YEAR PLUGIN_AUTHOR_NAME (email : your email address)
(Plugin Name) is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or
any later version.

(Plugin Name) is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with (Plugin Name). If not, see (http://link to your plugin license).
 */

function new_order($order_id)
{
    if (!$order_id) {
        return;
    }

    $API_URL = 'https://sms.aakashsms.com/sms/v3/send';
    $SMS_TOKEN = ''; //YOUR SMS TOKEN
    $PHONE = ""; //YOUR PHONE NUMBER

    $response = wp_remote_post($API_URL, array(
        'method' => 'POST',
        'timeout' => 45,
        'redirection' => 5,
        'httpversion' => '1.0',
        'blocking' => true,
        'headers' => array(),
        'body' => array(
            'auth_token' => $SMS_TOKEN,
            'to' => "$PHONE",
            'text' => "You have received a new order with order ID $order_id.Please check your dashboard.",
        ),
        'cookies' => array(),
    )
    );

}
add_action('woocommerce_thankyou', 'new_order', 10, 1);

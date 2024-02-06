<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'home/index';
$route['404_override'] = '';

$route['home'] = 'home/index';
$route['shop'] = 'shop/index';
$route['store'] = 'store/index';
$route['member'] = 'member/index';
$route['message'] = 'message/index';
$route['promotion'] = 'promotion/index';
$route['condition'] = 'condition/index';
$route['wishlist'] = 'wishlist/index';
$route['store/registration'] = 'store/registration/index';


$route['product'] = 'product/index';
$route['product/(:num)'] = 'product/index/$1';
$route['product/(:num)/(:num)'] = 'product/index/$1/$2';
$route['product/(:num)/(:num)/(:num)'] = 'product/index/$1/$2/$3';

$route['news'] = 'news/index';
$route['news/(:any)'] = 'news/index/$1';
$route['news/(:num)/(:any)'] = 'news/index/$1/$2';
$route['news/(:num)/(:any)/(:num)'] = 'news/index/$1/$2/$3';


$route['store/partner/(:num)'] = 'store/partner/index/$1';

$route['faq'] = 'faq/index/$1';
$route['user'] = 'user/index/$1';
$route['cart'] = 'cart/index/$1';
$route['contact'] = 'contact/index/$1';


$route['(:any)'] = 'shop/market_product/$1'; // รายการสินค้า
$route['(:any)/(:num)'] = 'shop/market_product/$1/$2'; // รายการสินค้า หมวดหมู่หลัก
$route['(:any)/(:num)/(:num)'] = 'shop/market_product/$1/$2/$3'; // รายการสินค้า หมวดหมู่ย่อย

$route['(:any)/สถานที่ส่งสินค้า'] = 'shop/market_place/$1';
$route['(:any)/รีวิวร้านค้า'] = 'shop/market_review/$1';
$route['(:any)/เกี่ยวกับเรา'] = 'shop/market_about/$1';

$route['(:any)/products/(:any)/(:num)/(:any)'] = 'shop/productDetail/$1/$2/$3/$4'; // รายละเอียดสินค้า

//$route['shop/product/(:num)/(:any)'] = 'shop/products/index/$1';

$route['store/products/(:num)'] = 'store/products/index/$1';
$route['shop/category/(:num)/(:any)'] = 'shop/category/index/$1/$2';

$route['shop/(:num)'] = 'shop/index/$1';

$route['translate_uri_dashes'] = FALSE;



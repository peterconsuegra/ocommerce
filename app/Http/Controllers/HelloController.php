<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use View;
use Illuminate\Support\Facades\Redirect;
use Log;

//add
use DB;
use Illuminate\Support\Facades\Config;

class HelloController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
	
	public function __construct()
	{
	     $this->middleware('auth.wp');
		 
   		$public_path = base_path();
   		$app_route = explode("/", $public_path);
   		$app_route = $app_route[array_key_last($app_route)];
   		$app_route = "/$app_route";
		 
  		 View::share(compact('app_route'));
	}
		
	public function wordpress_plus_laravel_examples(){
		
		return view('wordpress_plus_laravel_examples');
	}
	
	public function list_users(){
		
		$blogusers = get_users( array( 'fields' => array( 'display_name','user_email','ID') ) );
		return view('list_users',compact('blogusers'));
	}
	
	public function list_posts(){
		
		return view('list_posts');
	}
	
	public function list_products(){
		
		
	    $args = array(
	        'post_type'      => 'product',
	        'posts_per_page' => 10,
	       // 'product_cat'    => 'hoodies'
	    );

	    $products = new \WP_Query( $args );
		
		return view('list_products',compact('products'));
	}
	
	public function list_orders(){
		
		$users = get_users( array( 'fields' => array( 'display_name','user_email','ID') ) );
		
		return view('list_orders',compact('users'));
	}
	
	public function edit_posts(){
		
		return view('edit_posts');
	}
	
	public function edit_post(Request $request){
		$post_id = $request->get('post_id'); 
		$post = get_post( $post_id );
		return view('edit_post',compact('post'));
	}
	
	public function update_post(Request $request){
		
		$post_id = $request->input('post_id');
		$post_content = $request->input('post_content'); 
		$post_title = $request->input('post_title'); 
		
		wp_update_post(
			array (
				'ID'            => $post_id,
				'post_content'     => $post_content,
				'post_title' => $post_title
			)
		);
		
		return Redirect::to('/edit_posts');
	}
	
	public function ocommerce_orders(){
	
	//add
	/*
	$orders = $results = DB::select("select
    p.ID as order_id,
    p.post_date,
    max( CASE WHEN pm.meta_key = '_billing_email' and p.ID = pm.post_id THEN pm.meta_value END ) as billing_email,
    max( CASE WHEN pm.meta_key = '_billing_first_name' and p.ID = pm.post_id THEN pm.meta_value END ) as _billing_first_name,
    max( CASE WHEN pm.meta_key = '_billing_last_name' and p.ID = pm.post_id THEN pm.meta_value END ) as _billing_last_name,
    max( CASE WHEN pm.meta_key = '_billing_address_1' and p.ID = pm.post_id THEN pm.meta_value END ) as _billing_address_1,
    max( CASE WHEN pm.meta_key = '_billing_address_2' and p.ID = pm.post_id THEN pm.meta_value END ) as _billing_address_2,
    max( CASE WHEN pm.meta_key = '_billing_city' and p.ID = pm.post_id THEN pm.meta_value END ) as _billing_city,
    max( CASE WHEN pm.meta_key = '_billing_state' and p.ID = pm.post_id THEN pm.meta_value END ) as _billing_state,
    max( CASE WHEN pm.meta_key = '_billing_postcode' and p.ID = pm.post_id THEN pm.meta_value END ) as _billing_postcode,
    max( CASE WHEN pm.meta_key = '_shipping_first_name' and p.ID = pm.post_id THEN pm.meta_value END ) as _shipping_first_name,
    max( CASE WHEN pm.meta_key = '_shipping_last_name' and p.ID = pm.post_id THEN pm.meta_value END ) as _shipping_last_name,
    max( CASE WHEN pm.meta_key = '_shipping_address_1' and p.ID = pm.post_id THEN pm.meta_value END ) as _shipping_address_1,
    max( CASE WHEN pm.meta_key = '_shipping_address_2' and p.ID = pm.post_id THEN pm.meta_value END ) as _shipping_address_2,
    max( CASE WHEN pm.meta_key = '_shipping_city' and p.ID = pm.post_id THEN pm.meta_value END ) as _shipping_city,
    max( CASE WHEN pm.meta_key = '_shipping_state' and p.ID = pm.post_id THEN pm.meta_value END ) as _shipping_state,
    max( CASE WHEN pm.meta_key = '_shipping_postcode' and p.ID = pm.post_id THEN pm.meta_value END ) as _shipping_postcode,
    max( CASE WHEN pm.meta_key = '_order_total' and p.ID = pm.post_id THEN pm.meta_value END ) as order_total,
    max( CASE WHEN pm.meta_key = '_order_tax' and p.ID = pm.post_id THEN pm.meta_value END ) as order_tax,
    max( CASE WHEN pm.meta_key = '_paid_date' and p.ID = pm.post_id THEN pm.meta_value END ) as paid_date,
	max( CASE WHEN pm.meta_key = '_customer_user' and p.ID = pm.post_id THEN pm.meta_value END ) as customer_user,
	
    ( select group_concat( order_item_name separator '|' ) from wp_woocommerce_order_items where order_id = p.ID ) as order_items
	from
    	wp_posts p 
    	join wp_postmeta pm on p.ID = pm.post_id 
   	 	join wp_woocommerce_order_items oi on p.ID = oi.order_id
	where
    	p.post_type = 'shop_order' and
    	p.post_date BETWEEN '2022-10-01' AND '2022-12-31' and
   	 	p.post_status = 'wc-completed'
	group by
    p.ID");
	
	Log::info($orders);
	
	
	
	
	*/
	
	$db_config = Config::get('database.connections.'.Config::get('database.default'));

	$mysqli = new \mysqli($db_config["host"], $db_config["username"], $db_config["password"], $db_config["database"]);

	if ($mysqli->connect_errno) {
	    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
	}
	
	$query = "select
    p.ID as order_id,
    p.post_date,
    max( CASE WHEN pm.meta_key = '_billing_email' and p.ID = pm.post_id THEN pm.meta_value END ) as billing_email,
    max( CASE WHEN pm.meta_key = '_billing_first_name' and p.ID = pm.post_id THEN pm.meta_value END ) as _billing_first_name,
    max( CASE WHEN pm.meta_key = '_billing_last_name' and p.ID = pm.post_id THEN pm.meta_value END ) as _billing_last_name,
    max( CASE WHEN pm.meta_key = '_billing_address_1' and p.ID = pm.post_id THEN pm.meta_value END ) as _billing_address_1,
    max( CASE WHEN pm.meta_key = '_billing_address_2' and p.ID = pm.post_id THEN pm.meta_value END ) as _billing_address_2,
    max( CASE WHEN pm.meta_key = '_billing_city' and p.ID = pm.post_id THEN pm.meta_value END ) as _billing_city,
    max( CASE WHEN pm.meta_key = '_billing_state' and p.ID = pm.post_id THEN pm.meta_value END ) as _billing_state,
    max( CASE WHEN pm.meta_key = '_billing_postcode' and p.ID = pm.post_id THEN pm.meta_value END ) as _billing_postcode,
    max( CASE WHEN pm.meta_key = '_shipping_first_name' and p.ID = pm.post_id THEN pm.meta_value END ) as _shipping_first_name,
    max( CASE WHEN pm.meta_key = '_shipping_last_name' and p.ID = pm.post_id THEN pm.meta_value END ) as _shipping_last_name,
    max( CASE WHEN pm.meta_key = '_shipping_address_1' and p.ID = pm.post_id THEN pm.meta_value END ) as _shipping_address_1,
    max( CASE WHEN pm.meta_key = '_shipping_address_2' and p.ID = pm.post_id THEN pm.meta_value END ) as _shipping_address_2,
    max( CASE WHEN pm.meta_key = '_shipping_city' and p.ID = pm.post_id THEN pm.meta_value END ) as _shipping_city,
    max( CASE WHEN pm.meta_key = '_shipping_state' and p.ID = pm.post_id THEN pm.meta_value END ) as _shipping_state,
    max( CASE WHEN pm.meta_key = '_shipping_postcode' and p.ID = pm.post_id THEN pm.meta_value END ) as _shipping_postcode,
    max( CASE WHEN pm.meta_key = '_order_total' and p.ID = pm.post_id THEN pm.meta_value END ) as order_total,
    max( CASE WHEN pm.meta_key = '_order_tax' and p.ID = pm.post_id THEN pm.meta_value END ) as order_tax,
    max( CASE WHEN pm.meta_key = '_paid_date' and p.ID = pm.post_id THEN pm.meta_value END ) as paid_date,
	max( CASE WHEN pm.meta_key = '_customer_user' and p.ID = pm.post_id THEN pm.meta_value END ) as customer_user,
	
    ( select group_concat( order_item_name separator '|' ) from wp_woocommerce_order_items where order_id = p.ID ) as order_items
	from
    	wp_posts p 
    	join wp_postmeta pm on p.ID = pm.post_id 
   	 	join wp_woocommerce_order_items oi on p.ID = oi.order_id
	where
    	p.post_type = 'shop_order' and
    	p.post_date BETWEEN '2022-10-01' AND '2022-12-31' and
   	 	p.post_status = 'wc-completed'
	group by
    p.ID";
	
	$result = $mysqli->query($query);

	
	
	return view('ocommerce_orders',compact('result'));
	
	}

   
}

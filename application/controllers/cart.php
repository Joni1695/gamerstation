<?php
	class Cart extends CI_Controller{
		public $paypal_data = '';
		public $tax;
		public $shipping;
		public $total = 0;
		public $grand_total;
		public $adress,$adress2,$city,$zipcode,$state;

		//Cart Index
		public function index(){
			//Load View
			$data['mainContent'] = 'cart';
			$this->load->view('main', $data);
		}

		//Add To Cart
		public function add(){
			//Item Data
			$data = array(
					'id' => $this->input->post('item_number'),
					'qty' => $this->input->post('qty'),
					'price' => $this->input->post('price'),
					'name' => $this->input->post('title')
			);

			//Insert Into Cart
			$this->cart->insert($data);

			redirect('main');
		}

		//Update Cart
		public function update($in_cart = null){
			$data = $_POST;
			$this->cart->update($data);

			//Show Cart Page
			redirect('cart','refresh');
		}

		//Porcess Form
		public function process(){
			if(empty($this->input->get('token')) && empty($this->input->get('PayerID'))){
				if($_POST){
					foreach($this->input->post('item_name') as $key => $value){

						$item_id = $this->input->post('item_code')[$key];
						$product = $this->Product_model->get_product($item_id);

						//Assign Data To Paypal
						$this->paypal_data .= '&L_PAYMENTREQUEST_0_NAME'.$key.'='.urlencode($product->title);
						$this->paypal_data .= '&L_PAYMENTREQUEST_0_NUMBER'.$key.'='.urlencode($item_id);
						$this->paypal_data .= '&L_PAYMENTREQUEST_0_AMT'.$key.'='.urlencode($product->price);
						$this->paypal_data .= '&L_PAYMENTREQUEST_0_QTY'.$key.'='.urlencode($this->input->post('item_qty')[$key]);

						//Price x Quantity
						$subtotal = ($product->price * $this->input->post('item_qty')[$key]);
						$this->total = $this->total + $subtotal;

						$paypal_product['items'][] = array(
							'itm_name'	 => $product->title,
							'itm_price'  => $product->price,
							'itm_code' 	 => $item_id,
							'itm_qty' 	 => $this->input->post('item_qty')[$key]
						);

					}
					$_SESSION['city']=$this->input->post('city');
					$_SESSION['state']=$this->input->post('state');
					$_SESSION['adress']=$this->input->post('adress');
					$_SESSION['adress2']=$this->input->post('adress2');
					$_SESSION['zipcode']=$this->input->post('zipcode');
					//Get Grand Total
					$this->grand_total = $this->total;

					//Create Array of Costs
					$paypal_product['assets'] = array(
							'grand_total'   => $this->total
					);

					//Session Array For Later
					$_SESSION["paypal_products"] = $paypal_product;

					//Send Paypal Params
					$padata = '&RETURNURL='.urlencode($this->config->item('paypal_return_url')).
							  '&CANCELURL='.urlencode($this->config->item('paypal_cancel_url')).
							  '&PAYMENTREQUEST_0_PAYMENTACTION='.urlencode("SALE").
					$this->paypal_data.
							'&NOSHIPPING=1'.
							'&PAYMENTREQUEST_0_ITEMAMT='. urlencode($this->total).
							'&PAYMENTREQUEST_0_AMT='.urlencode($this->grand_total).
							'&PAYMENTREQUEST_0_CURRENCYCODE='.urlencode($this->config->item('paypal_currency_code')).
							'&CARTBORDERCOLOR=FFFFFF'.
							'&ALLOWNOTE=0';

					//Execute "SetExpressCheckout"
					$httpParsedResponseAr = $this->paypal->PPHttpPost('SetExpressCheckout', $padata, $this->config->item('paypal_api_username'), $this->config->item('paypal_api_password'), $this->config->item('paypal_api_signature'),$this->config->item('paypal_mode'));

					//Respond according to message we receive from Paypal
					if("SUCCESS" == strtoupper($httpParsedResponseAr["ACK"]) || "SUCESSWITHWARNING" == strtoupper($httpParsedResponseAr['ACK'])){
						//Redirect user to paypal store with Token received
						$paypalurl ='https://www.'.$this->config->item('paypal_mode').'.paypal.com/cgi-bin/webscr?cmd=_express-checkout&token='.$httpParsedResponseAr["TOKEN"];
						header('Location: '.$paypalurl);

					}else{
						//Show error message
						print_r($httpParsedResponseAr);
						die(urldecode($httpParsedResponseAr["L_LONGMESSAGE0"]));
					}
				}
			}
			else{
				//Paypal redirects back to this page using ReturnURL. We should receive TOKEN and Payer ID
				$token = $this->input->get('token');
				$payer_id = $this->input->get('PayerID');
					//Get session info
				$paypal_product = $_SESSION["paypal_products"];
				$this->paypal_data = '';
				$total_price = 0;
					//Loop Through Session Array
				foreach($paypal_product['items'] as $key => $item){
					$this->paypal_data .= '&L_PAYMENTREQUEST_0_QTY'.$key.'='.urlencode($item['itm_qty']);
					$this->paypal_data .= '&L_PAYMENTREQUEST_0_AMT'.$key.'='.urlencode($item['itm_price']);
					$this->paypal_data .= '&L_PAYMENTREQUEST_0_NAME'.$key.'='.urlencode($item['itm_name']);
					$this->paypal_data .= '&L_PAYMENTREQUEST_0_NUMBER'.$key.'='.urlencode($item['itm_code']);
						//Get subtotal
					$subtotal = ($item['itm_price'] * $item['itm_qty']);
						//Get Total
					$total_price = ($total_price + $subtotal);
				}

				$grand_price =$total_price;

				$padata = '&TOKEN='.urlencode($token).
				'&PAYERID='.urlencode($payer_id).
				'&PAYMENTREQUEST_0_PAYMENTACTION='.urlencode("SALE").
				$this->paypal_data.
				'&PAYMENTREQUEST_0_ITEMAMT='.urlencode($total_price).
				'&PAYMENTREQUEST_0_AMT='.urlencode($grand_price).
				'&PAYMENTREQUEST_0_CURRENCYCODE='.urlencode($this->config->item('paypal_currency_code'));
				$httpParsedResponseAr = $this->paypal->PPHttpPost('DoExpressCheckoutPayment', $padata, $this->config->item('paypal_api_username'), $this->config->item('paypal_api_password'), $this->config->item('paypal_api_signature'), $this->config->item('paypal_mode'));
				if("SUCCESS"== strtoupper($httpParsedResponseAr["ACK"]) || "SUCCESSWITHWARNING" == strtoupper($httpParsedResponseAr["ACK"]) || "SUCESSWITHWARNING" == strtoupper($httpParsedResponseAr['ACK'])){

					$paypal_product = $_SESSION["paypal_products"];

					foreach($paypal_product['items'] as $key => $item){
						$order_data = array(
							'product_id' 	 => $item['itm_code'],
							'user_id' 		 => $this->session->userdata('user_id'),
							'transaction_id' => urldecode($httpParsedResponseAr["PAYMENTINFO_0_TRANSACTIONID"]),
							'qty' 			 => $item['itm_qty'],
							'price' 		 => $subtotal,
							'adress' 		 => $_SESSION['adress'],
							'adress2' 		 => $_SESSION['adress2'],
							'city'		 	 => $_SESSION['city'],
							'state'		 	 => $_SESSION['state'],
							'zipcode'		 => $_SESSION['zipcode'],
						);
						//Add Order Data
						$this->Product_model->add_order($order_data);
					}
					unset($_SESSION['adress']);
					unset($_SESSION['adress2']);
					unset($_SESSION['city']);
					unset($_SESSION['state']);
					unset($_SESSION['zipcode']);
					$this->cart->destroy();

					$this->session->set_flashdata('successpurchase','Thank you for your purchase!');
					redirect('main');
				} else {
					die($httpParsedResponseAr["L_LONGMESSAGE0"]);
					echo '<pre>';
					print_r($httpParsedResponseAr);
					echo '</pre>';
				}
			}
	}
	public function cancel(){
			redirect('main');
	}
}
?>

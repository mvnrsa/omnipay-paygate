<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Order;
use Log;
use Omnipay\Omnipay;

class PaymentController extends Controller
{
    public function pay($id)
	{
		$order = Order::find($id);

		$amount = request()->amount ?? $order->balance;

		return view('frontend.pay',['order'=>$order, 'amount'=>$amount]);
	}

	public function redirect(string $id, string $method)
	{
		$gateway = $this->createAndConfigGateway($id, $method);
		$response = $gateway->purchase($this->prepareData($id, $method))->send();

		// Process response
		if ($response->isRedirect())
			$response->redirect();
		elseif ($response->isSuccessful())
			$this->processSuccessResponse($id, $method, $response);	// Will only happen for on-site methods
		else
			abort(500,$response->getMessage());
	}

	public function returnPage(string $id, string $method, Request $request)
	{
		$order = Order::find($id);

		return redirect(route('frontend.orders.show',['order'=>$order->id]));
	}

	private function createAndConfigGateway($order_id, $method)
	{
		$gateway_name = config("payment_gateways.$method.gateway",$method);
		$gateway = Omnipay::create($gateway_name);
		$gateway->setTestMode(config('payment_gateways.payments_test_mode',false));

		// Set options using setter=>value pairs in config
		$config = config("payment_gateways.$method.setters",[]);
		foreach ($config as $setter => $value)
			$gateway->$setter($value);

		// Return and [notify] url
		$gateway->setReturnUrl(route('payment.returnPage',['id'=>$order_id, 'method'=>$method]));
		if (method_exists($gateway,'setNotifyUrl'))
			$gateway->setNotifyUrl(route('payment.itn',['id'=>$order_id, 'method'=>$method]));

		return $gateway;
	}

	private function prepareData($id, $method)
	{
		$order = Order::findOrFail($id);
		$contact = User::findOrFail($order->customer_id);

		$data = [
		            'currency'	=> $order->currency_id,
		            'reference'	=> $order->reference,
					'amount'	=> request()->amount ?? $order->balance,
		            'userId'	=> $contact->id,
		            'userName'	=> $contact->full_name,
		            'userEmail'	=> $contact->email,
		            'userPhone'	=> $contact->phone_mobile,
				];

		session()->put("omnipay-data-$method-$id",$data);	// So we can use it later in completePurchase

		return $data;
	}

	private function processSuccessResponse($id, $method, $response)
	{
		// TODO
		dd($id, $response);
	}
}

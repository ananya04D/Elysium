<?php

namespace App\Livewire;

use App\Models\Order;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;
use Stripe\Checkout\Session;
use Stripe\Stripe;

#[Title('Success - Elysium')]
class SuccessPage extends Component
{
    #[Url]
    public $session_id;

    public function render()
    {
        // Retrieve the latest order for the current user
        $latest_order = Order::with('address')->where('user_id', auth()->user()->id)->latest()->first();

        // Check if the latest order exists
        if ($latest_order) {
            // Check if the payment method is COD (Cash on Delivery)
            if ($latest_order->payment_method == 'cod') {
                // Directly set the payment status to 'paid' for COD orders
                $latest_order->payment_status = 'paid';
                $latest_order->save();
            } 
            // Check if a Stripe session ID is present
            elseif ($this->session_id) {
                Stripe::setApiKey(env('STRIPE_SECRET'));
                
                // Retrieve the Stripe session information
                $session_info = Session::retrieve($this->session_id);

                // Update the payment status based on the Stripe session
                if ($session_info->payment_status == 'paid') {
                    $latest_order->payment_status = 'paid';
                } else {
                    $latest_order->payment_status = 'failed';
                }
                
                // Save the updated order status
                $latest_order->save();

                // Redirect to cancel page if payment failed
                if ($latest_order->payment_status == 'failed') {
                    return redirect()->route('cancel');
                }
            }
        }

        // Pass the latest order to the view
        return view('livewire.success-page', [
            'order' => $latest_order,
        ]);
    }
}

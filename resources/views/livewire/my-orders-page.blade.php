<div class="w-full max-w-[85rem] py-10 px-4 sm:px-6 lg:px-8 mx-auto">
  <h1 class="text-4xl font-bold text-slate-500">My Orders</h1>
  <div class="flex flex-col bg-white p-5 rounded mt-4 shadow-lg">
    <div class="-m-1.5 overflow-x-auto">
      <div class="p-1.5 min-w-full inline-block align-middle">
        <div class="overflow-hidden">
          <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
            <thead>
              <tr>
                <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Order</th>
                <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Date</th>
                <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Order Status</th>
                <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Payment Status</th>
                <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Order Amount</th>
                <th scope="col" class="px-6 py-3 text-end text-xs font-medium text-gray-500 uppercase">Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($orders as $order)
              @php
                $status = '';
                $payment_status = '';
                if($order->status == 'new') {
                  $status = '<span class="py-1 px-3 rounded text-white shadow bg-blue-500 w-24 inline-block text-center">New</span>';
                } elseif($order->status == 'processing') {
                  $status = '<span class="py-1 px-3 rounded text-white shadow bg-yellow-500 w-24 inline-block text-center">Processing</span>';
                } elseif($order->status == 'shipped') {
                  $status = '<span class="py-1 px-3 rounded text-white shadow bg-lime-400 w-24 inline-block text-center">Shipped</span>';
                } elseif($order->status == 'delivered') {
                  $status = '<span class="py-1 px-3 rounded text-white shadow bg-green-700 w-24 inline-block text-center">Delivered</span>';
                } elseif($order->status == 'canceled') {
                  $status = '<span class="py-1 px-3 rounded text-white shadow bg-red-500 w-24 inline-block text-center">Cancelled</span>';
                } else {
                  $status = '<span class="py-1 px-3 rounded text-white shadow bg-gray-500 w-24 inline-block text-center">Unknown</span>';
                }

                if($order->payment_status == 'pending') {
                  $payment_status = '<span class="py-1 px-3 rounded text-white shadow bg-blue-500 w-24 inline-block text-center">Pending</span>';
                } elseif($order->payment_status == 'paid') {
                  $payment_status = '<span class="py-1 px-3 rounded text-white shadow bg-green-500 w-24 inline-block text-center">Paid</span>';
                } elseif($order->payment_status == 'failed') {
                  $payment_status = '<span class="py-1 px-3 rounded text-white shadow bg-red-500 w-24 inline-block text-center">Failed</span>';
                } else {
                  $payment_status = '<span class="py-1 px-3 rounded text-white shadow bg-gray-500 w-24 inline-block text-center">Unknown</span>';
                }
              @endphp

              <tr class="odd:bg-white even:bg-gray-100 dark:odd:bg-slate-900 dark:even:bg-slate-800" wire:key='{{ $order->id }}'>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-gray-200">{{ $order->id }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200">{{ $order->created_at->format('d-m-Y') }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200">{!! $status !!}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200">{!! $payment_status !!}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200">{{ Number::currency($order->grand_total, 'INR') }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-end text-sm font-medium">
                  <a href="/my-orders/{{ $order->id }}" class="bg-slate-600 text-white py-2 px-4 rounded-md hover:bg-slate-500">View Details</a>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
      {{ $orders->links() }}
    </div>
  </div>
</div>

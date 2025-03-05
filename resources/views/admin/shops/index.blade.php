<x-layouts.app title="Shops">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <div class="flex justify-between items-center">
                <div>
                    <flux:heading size="xl">Shops</flux:heading>
                    <flux:subheading>List of all shops registered with us.</flux:subheading>
                </div>
                <flux:button icon="plus-circle" href="{{ route('shops.create') }}" class="justify-end">New Shop</flux:button>
            </div>

        <flux:badge color="emerald"><flux:icon.sparkles variant="mini" class="mr-2"/> Replace with Flux Pro table</flux:badge>
        <table class="min-w-full divide-y divide-gray-200">
            <thead>
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Latitude</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Longitude</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Is Open</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Store Type</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Max Delivery Distance</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach ($shops as $shop)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $shop->name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $shop->latitude }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $shop->longitude }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $shop->is_open ? 'Yes' : 'No' }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $shop->store_type }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $shop->max_delivery_distance }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-layouts.app>

<x-layouts.app title="Shops">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <div class="flex justify-between items-center">
            <div>
                <flux:heading size="xl">Add Shop</flux:heading>
                <flux:subheading>Create a new shop</flux:subheading>
            </div>
        </div>

        <flux:badge color="emerald"><flux:icon.sparkles variant="mini" class="mr-2"/> Replace with Livewire component for live validation</flux:badge>

        <form action="{{ route('shops.store') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <flux:input label="Name" name="name" id="name" type="text" value="{{ old('name') }}" required />
            </div>

            <div>
                <flux:input label="Latitude" name="latitude" id="latitude" type="text" value="{{ old('latitude') }}" required />
            </div>

            <div>
                <flux:input label="Longitude" name="longitude" id="longitude" type="text" value="{{ old('longitude') }}" required />
            </div>

            <div>
                <flux:select label="Is Open" name="is_open" id="is_open" required>
                    <option value="1" {{ old('is_open') == '1' ? 'selected' : '' }}>Yes</option>
                    <option value="0" {{ old('is_open') == '0' ? 'selected' : '' }}>No</option>
                </flux:select>
            </div>

            <div>
                <flux:select label="Store Type" name="store_type" id="store_type" required>
                    <option value="Shop" {{ old('store_type') == 'shop' ? 'selected' : '' }}>Shop</option>
                    <option value="Takeaway" {{ old('store_type') == 'takeaway' ? 'selected' : '' }}>Takeaway</option>
                    <option value="Restaurant" {{ old('store_type') == 'restaurant' ? 'selected' : '' }}>Restaurant</option>
                </flux:select>
            </div>

            <div>
                <flux:input label="Max Delivery Distance" name="max_delivery_distance" id="max_delivery_distance" type="number" value="{{ old('max_delivery_distance') }}" required />
                <p class="text-sm ml-4 mt-2">Distance in kilometers</p>
            </div>

            <div class="flex justify-end">
                <flux:button type="submit" icon="plus-circle" class="justify-end">Create Shop</flux:button>
            </div>
        </form>
    </div>
</x-layouts.app>

<x-filament::page class="p-6">

    @php
        $users = App\Models\User::all();
        $products = App\Models\Product::all();
    @endphp

    <!-- User Selection and Add Product Button in One Row -->
    <div class="flex items-center mb-4">
        <div class="mr-2">
            <x-filament::input.wrapper>
                <x-filament::input.select wire:model="selectedUser" id="user-select" style="width:400px;"
                    class="inline-flex items-center justify-center px-3 py-1 text-sm text-black bg-orange-600 border border-transparent rounded-md shadow-sm hover:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500">
                    <option value="" disabled selected>Select a user</option>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </x-filament::input.select>
            </x-filament::input.wrapper>
        </div>
    </div>

    <div>
        <x-filament::button id="add-product-button">Add Product</x-filament::button>
    </div>

    <!-- Products List -->
    <div class="mb-4">
        <table id="product-table" class="w-full mt-2 text-left border border-gray-300">
            <thead>
                <tr>
                    <th class="p-2 border">Product</th>
                    <th class="p-2 border">Quantity</th>
                    <th class="p-2 border">Subtotal</th>
                    <th class="p-2 border">Action</th>
                </tr>
            </thead>
            <tbody>
                <!-- Products will be appended or updated here -->
            </tbody>
        </table>
        <p class="mt-2 font-bold">Total: $<span id="total-amount">0.00</span></p>
    </div>

    <div id="product-modal" class="fixed inset-0 flex items-center justify-center hidden bg-black bg-opacity-50">
        <div class="p-4 bg-white rounded shadow">
            <span class="float-right text-xl cursor-pointer close">&times;</span>
            <h2 class="text-lg font-semibold">Add Product</h2>
            <x-filament::input.wrapper class="mt-3">
                <x-filament::input.select id="product-select"
                    class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-500">
                    <option value="" data-price="0">Select a product</option>
                    @foreach ($products as $product)
                        <option value="{{ $product->name }}" data-price="{{ $product->price }}">{{ $product->name }} -
                            ${{ $product->price }}</option>
                    @endforeach
                </x-filament::input.select>
            </x-filament::input.wrapper>
            <label for="quantity-input" class="block mt-6 text-sm font-medium text-gray-700">Quantity:</label>
            <input type="number" id="quantity-input" min="1" value="1"
                class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-500">
            <x-filament::button id="confirm-add-button" class="mt-6">Add</x-filament::button>
        </div>
    </div>

    <!-- Create Order Button -->
    <div class="mt-4">
        <x-filament::button id="create-order-button">Create Order</x-filament::button>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const addProductButton = document.getElementById('add-product-button');
            const modal = document.getElementById('product-modal');
            const closeModal = modal.querySelector('.close');
            const confirmAddButton = document.getElementById('confirm-add-button');
            const productSelect = document.getElementById('product-select');
            const quantityInput = document.getElementById('quantity-input');
            const productTableBody = document.querySelector('#product-table tbody');
            const totalAmountElement = document.getElementById('total-amount');

            let totalAmount = 0;

            addProductButton.onclick = function() {
                modal.classList.remove('hidden');
            }

            closeModal.onclick = function() {
                modal.classList.add('hidden');
            }

            window.onclick = function(event) {
                if (event.target === modal) {
                    modal.classList.add('hidden');
                }
            }

            confirmAddButton.onclick = function() {
                const selectedProduct = productSelect.options[productSelect.selectedIndex];
                const quantity = parseInt(quantityInput.value);
                const price = parseFloat(selectedProduct.getAttribute('data-price'));

                if (selectedProduct.value && quantity > 0) {
                    // Check if the product already exists in the table
                    const existingRow = productTableBody.querySelector(
                        `[data-product-name="${selectedProduct.value}"]`);
                    if (existingRow) {
                        // Update the existing row
                        const existingQuantityElement = existingRow.querySelector('.product-quantity');
                        const existingSubtotalElement = existingRow.querySelector('.product-subtotal');
                        const currentQuantity = parseInt(existingQuantityElement.innerText);
                        const newQuantity = currentQuantity + quantity;
                        const newSubtotal = newQuantity * price;

                        existingQuantityElement.innerText = newQuantity;
                        existingSubtotalElement.innerText = `$${newSubtotal.toFixed(2)}`;

                        totalAmount += quantity * price; // Update the total amount
                    } else {
                        // Add a new row if the product doesn't exist in the table
                        const subtotal = price * quantity;
                        totalAmount += subtotal;

                        const row = document.createElement('tr');
                        row.setAttribute('data-product-name', selectedProduct
                            .value); // Set a data attribute to identify the product
                        row.innerHTML = `
                            <td class="p-2 border">${selectedProduct.value}</td>
                            <td class="p-2 border product-quantity">${quantity}</td>
                            <td class="p-2 border product-subtotal">$${subtotal.toFixed(2)}</td>
                            <td class="p-2 border">
                                <button class="delete-product-button text-red-600 hover:text-red-800">Delete</button>
                            </td>
                        `;
                        productTableBody.appendChild(row);

                        // Add event listener for delete button
                        row.querySelector('.delete-product-button').onclick = function() {
                            productTableBody.removeChild(row);
                            totalAmount -= subtotal;
                            totalAmountElement.innerText = totalAmount.toFixed(2);
                        };
                    }

                    totalAmountElement.innerText = totalAmount.toFixed(2);
                    modal.classList.add('hidden');
                    productSelect.value = '';
                    quantityInput.value = 1;
                } else {
                    alert('Please select a product and enter a valid quantity.');
                }
            }

            document.getElementById('create-order-button').onclick = function() {


                alert('Order created successfully!');
                // Add your order creation logic here
            }
        });
    </script>
</x-filament::page>

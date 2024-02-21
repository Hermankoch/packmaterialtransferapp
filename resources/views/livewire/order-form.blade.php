<div class="card m-3 bg-body-tertiary">
    <div class="card-header">
        <h4 class="card-title">Transfer Form</h4>
    </div>
    <form class="m-3" wire:submit.prevent="submitOrder">
        <div class="mb-3">
            <label class="form-label fw-bold">Date</label>
            <input type="date" class="form-control-sm" wire:model="date">
            @error('date') <span class="error text-danger">{{ $message }}</span> @enderror
        </div>


        <div class="row mb-3">
            <div class="col">
                <label class="form-label fw-bold">From Warehouse</label>
                <select class="form-select" wire:model="fromWarehouse">
                    <option value="">Select Warehouse</option>
                    @foreach($warehouses as $warehouse)
                        <option value="{{ $warehouse->id }}">{{ $warehouse->name }}</option>
                    @endforeach
                </select>
                @error('fromWarehouse') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>

            <div class="col">
                <label class="form-label fw-bold">To Warehouse</label>
                <select class="form-select" wire:model="toWarehouse">
                    <option value="">Select Warehouse</option>
                    @foreach($warehouses as $warehouse)
                        <option value="{{ $warehouse->id }}">{{ $warehouse->name }}</option>
                    @endforeach
                </select>
                @error('toWarehouse') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
        </div>


        <div class="row mb-3">
            <div class="col">
                <label class="form-label fw-bold">DN/CA REF NR</label>
                <input type="text" class="form-control" wire:model="deliveryNote">
                @error('deliveryNote') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="col">
                <label class="form-label fw-bold">Collected By</label>
                <input type="text" class="form-control" wire:model="collectedBy">
                @error('collectedBy') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
        </div>


        <hr>

        <h5 class="text-body-emphasis text-center">Product Details</h5>
        @foreach($productLines as $index => $line)
            <div class="row mb-3 align-items-end">
                <div class="col">
                    <label class="form-label fw-bold">Product Description</label>
                    <select class="form-select product-select" wire:model="productLines.{{ $index }}.product_id" data-index="{{ $index }}">
                        <option value="">Select Product</option>
                        @foreach($products as $product)
                            <option value="{{ $product->id }}">{{ $product->description }}</option>
                        @endforeach
                    </select>
                    @error('productLines.'.$index.'.product_id') <span class="error text-danger">{{ $message }}</span> @enderror
                </div>

                <div class="col">
                    <label class="form-label fw-bold">Quantity</label>
                    <input type="text" class="form-control" wire:model="productLines.{{ $index }}.quantity">
                    @error('productLines.'.$index.'.quantity') <span class="error text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="col">
                    <label class="form-label fw-bold">Total</label>
                    <input type="text" class="form-control" wire:model="productLines.{{ $index }}.total">
                    @error('productLines.'.$index.'.total') <span class="error text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="col">
                    <label class="form-label fw-bold">Batch Reference</label>
                    <input type="text" class="form-control" wire:model="productLines.{{ $index }}.batch">
                    @error('productLines.'.$index.'.batch') <span class="error text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="col-auto">
                    <button class="btn btn-danger" wire:click.prevent="removeProductLine({{ $index }})"><i class="fa-solid fa-trash"></i></button>
                </div>
            </div>
        @endforeach
        <div class="text-center">
            <button class="btn btn-success fs-4 py-1 px-3" wire:click.prevent="addProductLine">
                <i class="fa-solid fa-plus-square"></i>
            </button>
        </div>
        <div class="mt-3" style="text-align: end">
            <button class="btn btn-primary fs-3 py-1 px-3" type="submit">
                Submit <i class="fa-solid fa-save"></i>
            </button>
        </div>
    </form>
</div>

@push('scripts')
    <script>
        "use strict"
         window.addEventListener('load', function () {
             initializeSelect2();
             setupSelectEvents();

         });

        window.addEventListener('productLineAdded', function() {
            setTimeout(function() {
                initializeSelect2();
                setupSelectEvents();
            }, 200);
        });

        window.addEventListener('rendered', function() {
           console.log('updated');
        });

        Livewire.on('rendered', function() {
            console.log('updated');
        });


        function initializeSelect2() {
            $('.product-select').each(function() {
                if ($(this).data('select2')) {
                    $(this).select2('destroy');
                }
                $(this).select2();
            });
        }

        function setupSelectEvents() {
            $('.product-select').off('change').on('change', function () {
                let productId = $(this).val();
                let index = $(this).data('index');

                Livewire.dispatch('productSelected', {index, productId});
            });
        }

    </script>
@endpush






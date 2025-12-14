<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Transaction
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto bg-white p-6 rounded shadow">

            <form action="{{ route('transactions.update', $transaction->id) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- DESCRIPTION -->
                <div class="mb-4">
                    <label class="block font-semibold mb-1">Description</label>
                    <input type="text" 
                           name="description" 
                           value="{{ $transaction->description }}"
                           class="w-full p-2 border rounded"
                           required>
                </div>

                <!-- AMOUNT -->
                <div class="mb-4">
                    <label class="block font-semibold mb-1">Amount</label>
                    <input type="number" 
                           name="amount" 
                           step="0.01"
                           value="{{ $transaction->amount }}"
                           class="w-full p-2 border rounded"
                           required>
                </div>

                <!-- CATEGORY -->
                <div class="mb-4">
                    <label class="block font-semibold mb-1">Category</label>
                    <input type="text"
                           name="category"
                           value="{{ $transaction->category }}"
                           class="w-full p-2 border rounded"
                           required>
                </div>

                <!-- TYPE -->
                <div class="mb-4">
                    <label class="block font-semibold mb-1">Type</label>
                    <select name="type" class="w-full p-2 border rounded" required>
                        <option value="income" {{ $transaction->type == 'income' ? 'selected' : '' }}>Income</option>
                        <option value="expense" {{ $transaction->type == 'expense' ? 'selected' : '' }}>Expense</option>
                    </select>
                </div>

                <!-- BUTTONS -->
                <div class="flex gap-3">
                    <button class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
                        Update
                    </button>

                    <a href="{{ route('dashboard') }}"
                       class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded">
                        Cancel
                    </a>
                </div>

            </form>

        </div>
    </div>
</x-app-layout>

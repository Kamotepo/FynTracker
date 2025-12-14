<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-4">
        <!-- FULL WIDTH CONTAINER -->
        <div class="w-full px-4">

            <!-- SUCCESS MESSAGE -->
            @if (session('success'))
                <div class="mb-4 p-4 bg-green-500 text-white rounded">
                    {{ session('success') }}
                </div>
            @endif

            <!-- MONTHLY BUDGET -->
            <div class="bg-white p-4 rounded shadow mb-6">
                <h3 class="text-lg font-bold mb-4">Monthly Budget</h3>

                <form method="POST" action="{{ route('budget.update') }}" class="flex flex-col sm:flex-row gap-3">
                    @csrf

                    <input type="number" step="0.01" name="budget"
                        class="border p-2 rounded w-full sm:w-48"
                        value="{{ $budget }}" placeholder="Set monthly budget">

                    <button class="bg-blue-600 text-white px-4 py-2 rounded w-full sm:w-auto">
                        Save Budget
                    </button>
                </form>

                <div class="mt-4 text-sm">
                    <p><strong>Total Expenses This Month:</strong> ₱{{ number_format($monthlyExpenses, 2) }}</p>

                    <p class="mt-1">
                        <strong>Remaining Before Limit:</strong>
                        <span class="{{ $remaining < 0 ? 'text-red-600' : 'text-green-600' }}">
                            ₱{{ number_format($remaining, 2) }}
                        </span>
                    </p>

                    @if ($remaining < 0)
                        <div class="bg-red-500 text-white p-2 rounded mt-2 text-sm">
                            ⚠ You exceeded your monthly budget!
                        </div>
                    @endif
                </div>
            </div>

            <!-- ADD TRANSACTION -->
            <div class="bg-white p-4 rounded shadow mb-8">
                <h3 class="text-lg font-bold mb-4">Add Transaction</h3>

                <form method="POST" action="{{ route('transactions.store') }}">
                    @csrf

                    <div class="mb-4">
                        <label>Description</label>
                        <input type="text" name="description" class="w-full p-2 border rounded" required>
                    </div>

                    <div class="mb-4">
                        <label>Amount</label>
                        <input type="number" name="amount" step="0.01" class="w-full p-2 border rounded" required>
                    </div>

                    <div class="mb-4">
                        <label>Category</label>
                        <select name="category" class="w-full p-2 border rounded">
                            <option value="Food">Food</option>
                            <option value="Transportation">Transportation</option>
                            <option value="Shopping">Shopping</option>
                            <option value="Bills">Bills</option>
                            <option value="Salary">Salary</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label>Type</label>
                        <select name="type" class="w-full p-2 border rounded">
                            <option value="income">Income</option>
                            <option value="expense">Expense</option>
                        </select>
                    </div>

                    <!-- UPDATED BUTTON (NOW VISIBLE) -->
                    <button class="bg-blue-300 hover:bg-blue-400 text-black font-semibold px-4 py-2 rounded w-full border border-blue-700">
                        Add Transaction
                    </button>
                </form>
            </div>

            <!-- MONTHLY HISTORY -->
            <div class="bg-white p-4 rounded shadow mb-6">
                <h3 class="text-lg font-bold mb-4">Monthly History</h3>

                @if($monthlyHistory->isEmpty())
                    <p class="text-sm text-gray-500">No history available.</p>
                @else
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm border-collapse">
                            <thead>
                                <tr class="border-b">
                                    <th class="p-2 text-left">Month</th>
                                    <th class="p-2 text-left">Income</th>
                                    <th class="p-2 text-left">Expenses</th>
                                    <th class="p-2 text-left">Net</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($monthlyHistory as $m)
                                    <tr class="border-b">
                                        <td class="p-2">
                                            {{ \Carbon\Carbon::create($m->year, $m->month)->format('F Y') }}
                                        </td>
                                        <td class="p-2 text-green-600">
                                            ₱{{ number_format($m->income, 2) }}
                                        </td>
                                        <td class="p-2 text-red-600">
                                            ₱{{ number_format($m->expenses, 2) }}
                                        </td>
                                        <td class="p-2 font-semibold">
                                            ₱{{ number_format($m->income - $m->expenses, 2) }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>

            <!-- TRANSACTION TABLE -->
            <div class="bg-white p-4 rounded shadow overflow-x-auto">
                <h3 class="text-lg font-bold mb-4">Transaction History</h3>

                <table class="w-full border-collapse text-sm table-fixed">
                    <thead>
                        <tr class="border-b">
                            <th class="p-2 w-1/4 text-left">Description</th>
                            <th class="p-2 w-1/5 text-left">Category</th>
                            <th class="p-2 w-1/6 text-left">Type</th>
                            <th class="p-2 w-1/6 text-left">Amount</th>
                            <th class="p-2 w-1/4 text-left">Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($transactions as $t)
                        <tr class="border-b">
                            <td class="p-2 break-words">{{ $t->description }}</td>
                            <td class="p-2">{{ $t->category }}</td>
                            <td class="p-2 capitalize">{{ $t->type }}</td>
                            <td class="p-2">₱{{ number_format($t->amount, 2) }}</td>

                            <td class="p-2">
                                <div class="flex flex-col sm:flex-row gap-2">
                                    <a href="{{ route('transactions.edit', $t->id) }}"
                                        class="bg-yellow-500 text-black px-3 py-1 rounded text-center">
                                        Edit
                                    </a>

                                    <form action="{{ route('transactions.destroy', $t->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="bg-red-500 text-black px-3 py-1 rounded w-full sm:w-auto">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>

        </div>
    </div>
</x-app-layout>

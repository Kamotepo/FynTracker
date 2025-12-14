<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200">
            Monthly History
        </h2>
    </x-slot>

    <div class="p-6 flex justify-center">
        <div class="w-full max-w-4xl">
            <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-6">

                @if ($monthlyHistory->isEmpty())
                    <p class="text-gray-500 text-center">
                        No monthly data available yet.
                    </p>
                @else
                    <div class="overflow-x-auto flex justify-center">
                        <table class="min-w-[600px] bg-white text-gray-800 border border-gray-300 rounded-lg">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="px-4 py-2 border text-left">Month</th>
                                    <th class="px-4 py-2 border text-right">Income</th>
                                    <th class="px-4 py-2 border text-right">Expenses</th>
                                    <th class="px-4 py-2 border text-right">Balance</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($monthlyHistory as $row)
                                    @php
                                        $balance = $row->income - $row->expenses;
                                        $monthName = \Carbon\Carbon::create()->month($row->month)->format('F');
                                    @endphp

                                    <tr class="hover:bg-gray-50">
                                        <td class="px-4 py-2 border">
                                            {{ $monthName }} {{ $row->year }}
                                        </td>
                                        <td class="px-4 py-2 border text-right text-green-600">
                                            ₱{{ number_format($row->income, 2) }}
                                        </td>
                                        <td class="px-4 py-2 border text-right text-red-600">
                                            ₱{{ number_format($row->expenses, 2) }}
                                        </td>
                                        <td class="px-4 py-2 border text-right font-semibold">
                                            ₱{{ number_format($balance, 2) }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif

            </div>
        </div>
    </div>
</x-app-layout>

<?php

namespace App\Livewire;

use App\Models\Client;
use App\Models\PurchaseOrder;
use App\Models\Sale;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Livewire\Component;

class SalesReports extends Component
{

    public ?Collection $categories = null;
    public ?Collection $clients = null;
    public ?Collection $products = null;

    public ?Collection $sales = null;
    public ?Collection $purchases = null;
    public ?Collection $prev_sales = null;
    public ?Collection $prev_purchases = null;
    public ?Collection $transactions = null;

    public string $reportType = 'month';

    public $startDate;
    public $endDate;

    public $daysDifference;

    public $previousStartDate;
    public $previousEndDate;

    public $data = [];

    protected $listeners = [
        
    ];

    public array $reportFormErrors = [];

    public function render()
    {
        return view('livewire.sales-reports');
    }

    public function mount()
    {
        $this->reportFormErrors = [];
        $this->resetDateInputs();
        $this->generateReport();
    }

    /**
     * @param string $newType
     * @return void
     */
    public function updatedReportType($newType)
    {
        $this->resetDateInputs();
    }


    private function resetDateInputs()
    {
        switch($this->reportType)
        {
            case 'yesterday':
                $this->startDate = Carbon::yesterday()->startOfDay();
                $this->endDate = Carbon::yesterday()->endOfDay();
                break;
            case 'week':
                $this->startDate = Carbon::now()->startOfWeek();
                $this->endDate = Carbon::now()->endOfWeek();
                break;
            case 'month':
                $this->startDate = Carbon::now()->startOfMonth();
                $this->endDate = Carbon::now()->endOfMonth();
                break;
            case 'year':
                $this->startDate = Carbon::now()->startOfYear();
                $this->endDate = Carbon::now()->endOfYear();
                break;
            default:
                break;
        }

        // Calculate the number of days between the start and end dates
        $this->daysDifference = $this->endDate?->diffInDays($this->startDate);

        // Set the previous start and end dates
        if($this->reportType === 'year') {
            $this->previousStartDate = $this->startDate->copy()->startOfYear()->subYearNoOverflow();
            $this->previousEndDate = $this->endDate->copy()->startOfYear()->subYearNoOverflow()->endOfYear();
        }
        elseif($this->reportType === 'month') {
            $this->previousStartDate = $this->startDate->copy()->startOfMonth()->subMonthsNoOverflow();
            $this->previousEndDate = $this->endDate->copy()->startOfMonth()->subMonthsNoOverflow()->endOfMonth();
        }
        else {
            $this->previousStartDate = $this->startDate?->copy()->subDays($this->daysDifference + 1);
            $this->previousEndDate = $this->endDate?->copy()->subDays($this->daysDifference + 1);
        }

        //'dd/mm/yyyy' format for the frontend datepicker
        $startRange = $this->startDate ? Carbon::parse($this->startDate)->format('d/m/Y') : null;
        $endRange = $this->endDate ? Carbon::parse($this->endDate)->format('d/m/Y') : null;
        
        $this->dispatch('updateDateRange', startRange: $startRange, endRange: $endRange);
    }

    public function generateReport()
    {
        // Fetch sales
        $this->sales = Sale::query()->whereBetween('created_at', [$this->startDate?->copy()?->startOfDay(), $this->endDate?->copy()?->endOfDay()])->get();
        $this->prev_sales = Sale::query()->whereBetween('created_at', [$this->previousStartDate?->copy()?->startOfDay(), $this->previousEndDate?->copy()?->endOfDay()])->get();

        // Fetch transactions
        $this->transactions = Transaction::query()->whereBetween('created_at', [$this->startDate?->copy()?->startOfDay(), $this->endDate?->copy()?->endOfDay()])->get();

        // Fetch purchases
        $this->purchases = PurchaseOrder::query()->whereBetween('created_at', [$this->startDate?->copy()?->startOfDay(), $this->endDate?->copy()?->endOfDay()])->get();
        $this->prev_purchases = Sale::query()->whereBetween('created_at', [$this->previousStartDate?->copy()?->startOfDay(), $this->previousEndDate?->copy()?->endOfDay()])->get();

        $this->prepareData();
        
        $this->dispatch('updateData', data: $this->data);
    }

    public function prepareData()
    {
        if ($this->reportType === 'custom') {
            $periodName = 'Period';
        } elseif($this->reportType === 'yesterday') {
            $periodName = 'Day';
        } else {
            $periodName = ucfirst($this->reportType);
        }

        if ($this->daysDifference <= 2) {
            $groupFormat = 'Y-m-d H';
        } elseif ($this->daysDifference > 100) {
            $groupFormat = 'Y-m';
        } else {
            $groupFormat = 'Y-m-d';
        }

        $totalSalesGrouped = $this->sales->groupBy(function ($item) use ($groupFormat) {
            return Carbon::parse($item['created_at'])->format($groupFormat);
        });

        $totalPrevSalesGrouped = $this->prev_sales->groupBy(function ($item) use ($groupFormat) {
            return Carbon::parse($item['created_at'])->format($groupFormat);
        });

        $totalPurchasesGrouped = $this->purchases->groupBy(function ($item) use ($groupFormat) {
            return Carbon::parse($item['created_at'])->format($groupFormat);
        });

        $totalPrevPurchasesGrouped = $this->prev_purchases->groupBy(function ($item) use ($groupFormat) {
            return Carbon::parse($item['created_at'])->format($groupFormat);
        });

        $salesCardChartData = $totalSalesGrouped->map(function ($items) {
            return $items->sum('total_amount');
        });
        

        $purchaseCardChartData = $totalPurchasesGrouped->map(function ($items) {
            return $items->sum('total_amount');
        });

        $profitCardChartData = $salesCardChartData->map(function ($salesAmount, $period) use ($purchaseCardChartData) {
            $purchaseAmount = $purchaseCardChartData[$period] ?? 0;
            return $salesAmount - $purchaseAmount;
        });

        $totalSales = $this->sales->sum('total_amount');
        $prev_totalSales = $this->prev_sales->sum('total_amount');
        $diffPercentage = $this->calculatePercentageDifference($prev_totalSales, $totalSales);

        $totalPurchase = $this->purchases->sum('total_amount');
        $prev_totalPurchase = $this->prev_purchases->sum('total_amount');
        $diffPurchasePercentage = $this->calculatePercentageDifference($prev_totalPurchase, $totalPurchase);

        $profit = $totalSales - $totalPurchase;
        $prev_profit = $prev_totalSales - $prev_totalPurchase;
        $diffProfitPercentage = $this->calculatePercentageDifference($prev_profit, $profit);

        $totalTransactions = $this->transactions->sum('amount');

        $topProducts = $this->sales->flatMap(function ($sale) {
            return $sale->saleItems;
        })
        ->groupBy('product_id')
        ->map(function ($items) {
            $product = $items->first()->product;
            $currentPeriodValue = $items->sum(function ($item) {
                return $item->quantity * $item->price;
            });
            $currentPeriodCount = $items->sum('quantity');

            $previousPeriodItems = $this->prev_sales->flatMap(function ($sale) use ($product) {
                return $sale->saleItems->where('product_id', $product->id);
            });
            $previousPeriodValue = $previousPeriodItems->sum(function ($item) {
                return $item->quantity * $item->price;
            });

            return [
                'product_name' => $product->name,
                'value_this_period' => $currentPeriodValue,
                'this_period_count' => $currentPeriodCount,
                'value_previous_period' => $previousPeriodValue
            ];
        })
        ->sortByDesc('value_this_period')
        ->take(10)
        ->values();
        // Format top products for Chart
        $topProductsForChart = collect($topProducts)->map(function ($product) use($periodName) {
            return [
                'x' => $product['product_name'],
                'y' => round($product['value_this_period'], 2),
                'goals' => [
                    [
                        'name' => 'Previous ' . $periodName,
                        'value' => round($product['value_previous_period'], 2),
                        'strokeWidth' => 2,
                        'strokeDashArray' => 2,
                        'strokeColor' => '#775DD0'
                    ]
                ]
            ];
        })->values()->toArray();

        $categoryData = $this->sales->flatMap(function ($sale) {
            return $sale->saleItems;
        })
        ->groupBy(function ($item) {
            return $item->product->category->name;
        })
        ->map(function ($items, $category) use ($totalSales) {
            $categoryTotal = $items->sum(function ($item) {
                return $item->quantity * $item->price;
            });
            $percentage = $totalSales > 0 ? ($categoryTotal / $totalSales) * 100 : 0;
            return [
                'category' => $category,
                'percentage' => round($percentage, 2)
            ];
        })
        ->sortByDesc('percentage')
        ->values();

        $paymentMethods = [
            'cash' => ['name' => 'Cash', 'value' => 0.00],
            'card' => ['name' => 'Credit Card', 'value' => 0.00],
            'wallet' => ['name' => 'Wallet', 'value' => 0.00],
            'others' => ['name' => 'Other', 'value' => 0.00],
        ];

        $this->sales->each(function ($sale) use (&$paymentMethods) {
            $method = strtolower($sale->payment_method);
            if (isset($paymentMethods[$method])) {
                $paymentMethods[$method]['value'] += $sale->total_amount;
            } else {
                $paymentMethods['others']['value'] += $sale->total_amount;
            }
        });
        foreach ($paymentMethods as &$method) {
            $method['value'] = round($method['value'], 2);
        }

        $clients = Client::whereBetween('created_at', [$this->startDate, $this->endDate])->count();
        $newClients = Client::whereBetween('created_at', [$this->startDate, $this->endDate])
            ->count();
        $prevClients = Client::whereBetween('created_at', [$this->previousStartDate, $this->previousEndDate])->count();
        $clientsGrowth = $this->calculatePercentageDifference($prevClients, $clients);

        $sumPrev  = $totalPrevSalesGrouped->map(function ($items) {
            return $items->sum('total_amount');
        });
        if ($this->daysDifference <= 1) {
            $prevSalesCollection = $sumPrev->mapWithKeys(function ($value, $key) {
                $parts = explode(' ', $key);
                if (count($parts) == 2) {
                    $hour = $parts[1];
                } else {
                    $hour = '00';
                }
                return [$hour => $value];
            });
            $salesCollection = $salesCardChartData->mapWithKeys(function ($value, $key) {
                $parts = explode(' ', $key);
                if (count($parts) == 2) {
                    $hour = $parts[1];
                } else {
                    $hour = '00';
                }
                return [$hour => $value];
            });

            $allHours = Collection::times(24, function ($hour) {
                return str_pad($hour - 1, 2, '0', STR_PAD_LEFT);
            });

            $prevSalesCollection = $allHours->mapWithKeys(function ($hour) use ($prevSalesCollection) {
                return [$hour => $prevSalesCollection->get($hour, 0)];
            });    
            $salesCollection = $allHours->mapWithKeys(function ($hour) use ($salesCollection) {
                return [$hour => $salesCollection->get($hour, 0)];
            });    
        } elseif ($this->daysDifference < 31) {
            $originalPrevSalesCollection = $totalPrevSalesGrouped->map(function ($items) {
                return $items->sum('total_amount');
            });
        
            $firstDate_prev = Carbon::parse(array_key_first($originalPrevSalesCollection->toArray()));
            $firstDate = Carbon::parse(array_key_first($salesCardChartData->toArray()));
            
            if($this->reportType === 'week'){
                $referenceDate_prev = !$originalPrevSalesCollection->isEmpty()
                    ? Carbon::parse(array_key_first($originalPrevSalesCollection->toArray()))
                    : Carbon::today();

                $referenceDate = !$salesCardChartData->isEmpty()
                    ? Carbon::parse(array_key_first($salesCardChartData->toArray()))
                    : Carbon::today();

                $startOfWeek_prev = $referenceDate_prev->copy()->startOfWeek();
                $endOfWeek_prev = $referenceDate_prev->copy()->endOfWeek();
                $startOfWeek = $referenceDate->copy()->startOfWeek();
                $endOfWeek = $referenceDate->copy()->endOfWeek();

                $allDays_prev = collect($startOfWeek_prev->toPeriod($endOfWeek_prev))->map(function ($date) {
                    return $date->format('d M');
                });
                $allDays = collect($startOfWeek->toPeriod($endOfWeek))->map(function ($date) {
                    return $date->format('d M');
                });
            }else{
                $allDays_prev = collect(range(1, $firstDate_prev->daysInMonth))->map(function ($day) use ($firstDate_prev) {
                    return $firstDate_prev->copy()->setDay($day)->format('d M');
                });
                $allDays = collect(range(1, $firstDate->daysInMonth))->map(function ($day) use ($firstDate) {
                    return $firstDate->copy()->setDay($day)->format('d M');
                });
            }
            $prevSalesCollection = $allDays_prev->mapWithKeys(function ($day) use ($originalPrevSalesCollection) {
                $salesDate = Carbon::parse($day)->format('Y-m-d');
                $sales = $originalPrevSalesCollection->get($salesDate, 0);
                return [$day => $sales];
            });
            $salesCollection = $allDays->mapWithKeys(function ($day) use ($salesCardChartData) {
                $salesDate = Carbon::parse($day)->format('Y-m-d');
                $sales = $salesCardChartData->get($salesDate, 0);
                return [$day => $sales];
            });
        } else {            
            $prevSalesCollection = $totalPrevSalesGrouped->map(function ($items) {
                return $items->sum('total_amount');
            });

            if($this->reportType === 'year'){
                $allMonths = collect(['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']);
            }
            else{
                // TODO:For custom range
                $allMonths = collect(['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']);
            }

            $prevSalesCollection = $allMonths->mapWithKeys(function ($month) use ($prevSalesCollection) {
                $sales = $prevSalesCollection->first(function ($value, $key) use ($month) {
                    return Carbon::parse($key)->format('M') === $month;
                }, 0);
                return [$month => $sales];
            });

            $salesCollection = $salesCardChartData;

            $salesCollection = $allMonths->mapWithKeys(function ($month) use ($salesCollection) {
                $sales = $salesCollection->first(function ($value, $key) use ($month) {
                    return Carbon::parse($key)->format('M') === $month;
                }, 0);
                return [$month => $sales];
            });
        }

        $this->data['salesCard'] = [
            'chartData' => $salesCardChartData->values()->toArray(),
            'count' => $this->sales->count(),
            'total' => $totalSales,
            'diff' => $diffPercentage
        ];

        $this->data['purchaseCard'] = [
            'chartData' => $purchaseCardChartData->values()->toArray(),
            'total' => $totalPurchase
        ];

        $this->data['profitCard'] = [
            'chartData' => $profitCardChartData->values()->toArray(),
            'total' => $profit
        ];

        $this->data['transactionsCard'] = [
            'total' => $totalTransactions
        ];

        $this->data['topProducts'] = [
            'chartData' => [[
                'name' => 'This ' . $periodName,
                'data' => $topProductsForChart
            ]],
            'chartLegend' => ['This '.$periodName , 'Previous '.$periodName]
        ];

        $this->data['categoryAnalysis'] = [
            'chartData' => $categoryData->pluck('percentage')->toArray(),
            'chartLabels' => $categoryData->pluck('category')->toArray(),
        ];

        $this->data['paymentMethods'] = $paymentMethods;

        $this->data['clientStats'] = [
            'clients' => '',
            'new' => $newClients,
            'growth' => $clientsGrowth,
            'period' => $periodName
        ];

        $this->data['salesGraph'] = [
            'chartDataCurrent' => $salesCollection->values()->toArray(),
            'chartDataPrevious' => $prevSalesCollection->values()->toArray(),
            'x-axis' => $salesCollection->keys()->toArray(),
            'period' => $periodName
        ];

        $this->data['earning'] = [
            'totalSales' => $totalSales,
            'diffSalesPercentage' => $diffPercentage,
            'count' => $this->sales->count(),
            'totalPurchase' => $totalPurchase,
            'diffPurchasePercentage' => $diffPurchasePercentage,
            'profit' => $profit,
            'diffProfitPercentage' => $diffProfitPercentage
        ];
    }

    public function calculatePercentageDifference($firstNumber, $secondNumber)
    {
        if ($firstNumber == 0) {
            if ($secondNumber == 0) {
                return ['value' => 0, 'state' => 'no_change'];
            }
            return ['value' => 100, 'state' => 'increasing'];
        }
    
        $difference = abs(($secondNumber - $firstNumber) / $firstNumber * 100);
        
        $difference = round($difference, 2);
    
        if ($secondNumber >= $firstNumber) {
            return ['value' => $difference, 'state' => 'increasing'];
        } else {
            return ['value' => $difference, 'state' => 'decreasing'];
        }
    }

    public function mergeAndFill(Collection $collection1, Collection $collection2)
    {
        $allDates = $collection1->keys()->merge($collection2->keys())->unique()->sort();

        $result1 = $allDates->mapWithKeys(function ($date) use ($collection1) {
            return [$date => $collection1->get($date, 0)];
        });

        $result2 = $allDates->mapWithKeys(function ($date) use ($collection2) {
            return [$date => $collection2->get($date, 0)];
        });

        return [$result1, $result2];
    }

}

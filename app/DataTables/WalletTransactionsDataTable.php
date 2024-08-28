<?php

namespace App\DataTables\Admin;

use App\Enums\WalletTransactionStatus;
use App\Models\Store;
use App\Models\WalletTransaction;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class WalletTransactionsDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->setRowId('id')
            ->editColumn("id", '{{$id}}')
            ->editColumn("store_id", function (WalletTransaction $walletTransactions) {
                return $walletTransactions->store->name;
            })
            ->editColumn("name", function (WalletTransaction $walletTransactions) {
                return $walletTransactions->name;
            })
            ->editColumn("amount", function (WalletTransaction $walletTransactions) {
                return
                    '<span class="m-0">'.$walletTransactions->amount.'<strong class="text-muted ms-2">EGP</strong></span>'
                ;
            })
            ->editColumn("status", function (WalletTransaction $walletTransactions) {
                $type = match ($walletTransactions->status){
                    WalletTransactionStatus::pending->value => "warning",
                    WalletTransactionStatus::successful->value => "success",
                    WalletTransactionStatus::failed->value => "danger",
                };

                return getBadgeColumn(WalletTransactionStatus::tryFrom($walletTransactions->status)?->getName() , $type);
            })
            ->editColumn("created_at", function(WalletTransaction $walletTransaction){
                return
                    '<span class="text-truncate d-flex lh-1">'.Carbon::parse($walletTransaction->created_at)->toFormattedDateString().'</span>
                    <small class="text-muted">'.Carbon::parse($walletTransaction->created_at)->toTimeString().'</small>';
            })
            ->editColumn("action", "admin.wallet-transactions.datatables_actions")
            ->rawColumns(["action", "status", "created_at", "commission", "amount"]);
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(WalletTransaction $model)
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('wallet-transactions-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->stateSave()
            ->dom('<"card-header flex-column flex-md-row"<"head-label text-center"><"dt-action-buttons text-end pt-3 pt-md-0"B>><"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6 d-flex justify-content-center justify-content-md-end"f>>t<"row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>')
            ->lengthMenu([5, 15, 20, 30, 50, 100, 1000])
            ->selectStyleMulti()
            ->selectSelector(".dt-checkboxes")
            ->selectAddClassName("")
            ->languageSearch("")
            ->languageSearchPlaceholder(__("search"))
            ->addTableClass("border-top table-striped")
            ->addAction(['printable' => false])
            ->responsive($this->getResponsiveOptions())
            ->autoWidth(false)
            ->buttons($this->getButtons());
    }

    private function getExportBtns(): array
    {
        return [
            [
                "extend" => "print",
                "text" => '<i class="bx bx-printer me-1"></i>Print',
                "className" => "dropdown-item",
            ],
            [
                "extend" => "csv",
                "text" => '<i class="bx bx-file me-1"></i>Csv',
                "className" => "dropdown-item",
            ],
            [
                "extend" => "excel",
                "text" => '<i class="bx bxs-file-export me-1"></i>Excel',
                "className" => "dropdown-item",
            ],
            [
                "extend" => "pdf",
                "text" => '<i class="bx bxs-file-pdf me-1"></i>Pdf',
                "className" => "dropdown-item",
            ],
            [
                "extend" => "copy",
                "text" => '<i class="bx bx-copy me-1"></i>Copy',
                "className" => "dropdown-item",
            ]
        ];
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('')
                ->responsivePriority(2)
                ->searchable(false)
                ->orderable(false)
                ->className("control")
                ->content("")
                ->printable(false)
                ->exportable(false),
            Column::make([
                "orderable" => false,
                "searchable" => false,
                "responsivePriority" => 3,
                "content" => '',
                "data" => "id",
                "checkboxes" => ["selectRow" => true, "selectAllRender" => '<input type="checkbox" class="form-check-input">'],
            ])
                ->exportable(false)
                ->printable(false)
                ->render('`<input type="checkbox" class="dt-checkboxes form-check-input">`'),
            Column::make('id'),
            Column::make('store_id'),
            Column::make('name'),
            Column::make('amount'),
            Column::make('status'),
            Column::make('created_at'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'wallet_transactions_' . date('YmdHis');
    }

    private function getResponsiveOptions(): string
    {
        return <<<JS
                        {
                            details: {
                                display: $.fn.dataTable.Responsive.display.modal({
                                    header: function (e) {
                                        return "Details of " + e.data().full_name
                                    }
                                }),
                                type: "column",
                                renderer: function (e, t, a) {
                                    a = $.map(a, function (e, t) {
                                        return "" !== e.title ? '<tr data-dt-row="' + e.rowIndex + '" data-dt-column="' + e.columnIndex + '"><td>' + e.title + ":</td> <td>" + e.data + "</td></tr>" : ""
                                    }).join("");
                                    return !!a && $('<table class="table"/><tbody />').append(a)
                                }
                            }
                        }
             JS;
    }

    private function getButtons(): array
    {
        return [
            Button::make('collection')
                ->text('<i class="bx bx-export me-sm-1"></i> <span class="d-none d-sm-inline-block">' . __('Export') . '</span>')
                ->addClass("btn btn-label-primary dropdown-toggle me-2")
                ->buttons($this->getExportBtns()),

            Button::make('reload')->className("btn btn-label-secondary me-2"),

            Button::make('colvis')
                ->text("<i class='fa fa-eye'></i> " . __('Show/Hide'))
                ->className("btn btn-label-secondary me-2"),
        ];
    }
}

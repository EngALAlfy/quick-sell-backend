<?php

namespace App\DataTables;

use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class StockDataTable extends DataTable
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
            ->editColumn('id', '{{$id}}')
            ->editColumn('enable_stock', function (Product $product) {
                return getBooleanColumn($product , "enable_stock");
            })
            ->editColumn('alert_quantity', function (Product $product) {
                if($product->alert_quantity > 0){
                    return $product->alert_quantity;
                }

                return getBadgeColumn(__('Unlimited') , "dark");
            })
            ->editColumn('created_at', function (Product $product) {
                return
                    '<span class="text-truncate d-flex lh-1">' . Carbon::parse($product->created_at)->toFormattedDateString() . '</span>
                    <small class="text-muted">' . Carbon::parse($product->created_at)->toTimeString() . '</small>';
            })
            ->editColumn('action', 'dashboard.stocks.datatables_actions')
            ->rawColumns(['enable_stock' , 'alert_quantity' , 'action', 'created_at']);
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Product $model): QueryBuilder
    {
        return $model->latest()->with("transactions")->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('stocks-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->stateSave()
            ->dom('<"card-header flex-column flex-md-row"<"head-label text-center"><"dt-action-buttons text-end pt-3 pt-md-0"B>><"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6 d-flex justify-content-center justify-content-md-end"f>>t<"row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>')
            ->lengthMenu([10, 20, 30, 50, 100, 1000])
            ->selectStyleMulti()
            ->pageLength(20)
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
            Column::make('name'),
            Column::make('enable_stock'),
            Column::make('stock_quantity'),
            Column::make('alert_quantity'),
            Column::make('created_at'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'stocks_' . date('YmdHis');
    }

    private function getResponsiveOptions(): string
    {
        return <<<JS
                        {
                            details: {
                                display: $.fn.dataTable.Responsive.display.modal({
                                    header: function (e) {
                                        return "Details of Stock ID " + e.data().id
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
        $userId = auth()->id();
        $ajax_action_type = settings("ajax_action_type_for_$userId" , "modal");
        return [
            Button::make('collection')
                ->text('<i class="bx bx-export me-sm-1"></i> <span class="d-none d-sm-inline-block">' . __('Export') .'</span>')
                ->addClass("btn btn-label-primary dropdown-toggle me-2")
                ->buttons($this->getExportBtns()),

            Button::make('reload')->className("btn btn-label-secondary me-2"),

            Button::make('colvis')
                ->text("<i class='fa fa-eye'></i> " . __('Show/Hide'))
                ->className("btn btn-label-secondary me-2"),

            Button::make("create")
                ->text('<i class="bx bx-plus me-sm-1"></i> <span class="d-none d-sm-inline-block">Add New Stock</span>')
                ->addClass("ajax-btn")
                ->addClass("create-new btn btn-primary")
                ->action("")
                ->attr(["data-href" => route("dashboard.stocks.create"),"data-html-classes" => "modal-sm" , "data-html-type" => $ajax_action_type, "data-html-title" => __("Add new stock")])
        ];
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
}

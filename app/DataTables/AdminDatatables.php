<?php

namespace App\DataTables;

use App\Admin;
use Yajra\DataTables\Services\DataTable;

class AdminDatatables extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables($query)
            ->addColumn('checkbox', 'admin.admins.btn.checkbox')
            ->addColumn('edit', 'admin.admins.btn.edit')
            ->addColumn('delete', 'admin.admins.btn.delete')
            ->rawColumns([
                'edit',
                'delete',
                'checkbox',
            ]);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */

     public static function lang(){
        $langJson = [
            'sProcessing' => trans('admin.sProcessing'),
            "sLengthMenu" =>trans('admin.sLengthMenu'),
            "sZeroRecords"=> "No se encontraron resultados",
            "sEmptyTable"=>"Ningún dato disponible en esta tabla",
            "sInfo"=>trans('admin.sInfo'),
            "sInfoEmpty"=>trans('admin.sSearch'),
            "sInfoFiltered"=> "(filtrado de un total de _MAX_ registros)",
            "sInfoPostFix"=> "",
            "sSearch"=> trans('admin.sSearch'),
            "sUrl"=> "",
            "sInfoThousands"=> ",",
            "sLoadingRecords"=> "Cargando...",
            "oPaginate" =>[
                "sFirst"=> "Primero",
                "sLast"=> "Último",
                "sNext"=> trans('admin.sNext'),
                "sPrevious"=> trans('admin.sPrevious')
            ],
            "oAria" =>[
                "sSortAscending"=> ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending"=> ": Activar para ordenar la columna de manera descendente"
            ],
    ];
    return $langJson;
     }
    public function query()
    {
        return Admin::query();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    //->addAction(['width' => '80px'])
                    //->parameters($this->getBuilderParameters());
                    ->parameters([
                        'dom' => 'Blfrtip',
                        'lengthMenu' => [[10, 25, 50, 100, -1], [10, 25, 50, 'All Record']],
                        'buttons' => [
                            [
                                'text' => '<i class="fa fa-plus"> </i> ' . trans('admin.Create_Admin'),
                                'className' => 'btn btn-info',
                                'action' => "function(){
                                    window.location.href = '".\URL::current()."/create';  
                                }"
                            ],
                            ['extend' => 'print', 'className' => 'btn btn-primary', 'text' => '<i class="fa fa-print"> print page</i>'],
                            ['extend' => 'csv', 'className' => 'btn btn-success', 'text' => '<i class="fa fa-file"> CSV Export </i>'],
                            [
                                'text' => '<i class="fa fa-trash"></i> ' .trans('admin.delete_all'),
                                'className' => 'btn btn-danger delBtn'
                            ],
                            ['extend' => 'reload', 'className' => 'btn btn-default', 'text' => '<i class="fa fa-refresh"> </i>'],
                              
                        ],
                        'initComplete' => "function () {
                            this.api().columns([2, 3]).every(function () {
                                var column = this;
                                var input = document.createElement(\"input\");
                                $(input).appendTo($(column.footer()).empty())
                                .on('keyup', function () {
                                    column.search($(this).val(), false, false, true).draw();
                                });
                            });
                        }",
                        
                        'language' => self::lang(),
                    ]);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            [
                'name'  => 'checkbox',
                'data'  => 'checkbox',
                'title' => '<input type="checkbox" class="check_all" onclick="check_all()">',
                'exportable'=>false,
                'printable'=>false,
                'orderable'=>false,
                'searchable'=>false,
            ],
            [
                'name'  => 'id',
                'data'  => 'id',
                'title' => 'ID',
            ],[
                'name'  => 'name',
                'data'  => 'name',
                'title' => trans('admin.admin_name'),
            ],[
                'name'  => 'email',
                'data'  => 'email',
                'title' => trans('admin.admin_email'),
            ],[
                'name'  => 'created_at',
                'data'  => 'created_at',
                'title' => trans('admin.date'),
            ],[
                'name'  => 'updated_at',
                'data'  => 'updated_at',
                'title' => trans('admin.update'),
            ],[
                'name'  => 'edit',
                'data'  => 'edit',
                'title' => trans('admin.edit'),
                'exportable' => false,
                'printable'  => false,
                'orderable'  => false,
                'searchable' => false,
            ],[
                'name'  => 'delete',
                'data'  => 'delete',
                'title' => trans('admin.delete'),
                'exportable' => false,
                'printable'  => false,
                'orderable'  => false,
                'searchable' => false,
            ],
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'AdminDatatables_' . date('YmdHis');
    }
}

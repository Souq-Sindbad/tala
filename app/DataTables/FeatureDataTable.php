<?php

namespace App\DataTables;

use App\Models\Feature;
use App\Models\MFeature;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class FeatureDataTable extends DataTable
{
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addColumn('name',function ($data){
                return $data->getTranslateName(app()->getLocale());
            })->addColumn('status_name',function ($data){
                if($data->status ==1){
                    return '<span class="badge bg-success">'.__('site.active').'</span>';
                }else{
                    return '<span class="badge bg-danger">'.__('site.blocked').'</span>';
                }
            })
            ->addColumn('action', 'dashboard.features.partials._action')
            ->rawColumns(['action','status_name']);
    }

    public function query(Feature $model)
    {
        $q = $model->newQuery();
        return  $q;
    }


    public function html()
    {
        return $this->builder()
            ->setTableId('table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('Bfrtip')
            ->orderBy(1)
            ->buttons(
                Button::make('print'),
                Button::make('reload')
            );
    }

    protected function getColumns()
    {
        return [
            Column::make('id')->title('#')->data('id')->name('id'),
            Column::make('name')->title(__('site.name'))->data('name')->name('name'),
            Column::make('status_name')->title(__('site.status_name'))->data('status_name')->name('status_name'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->title(__('site.action'))
                ->addClass('text-center')
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Feature_' . date('YmdHis');
    }
}

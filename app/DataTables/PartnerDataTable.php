<?php

namespace App\DataTables;

use App\Models\Partner;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class PartnerDataTable extends DataTable
{
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addColumn('name',function ($data){
                return '<a href="'.$data->url.'">'.$data->getTranslateName(app()->getLocale()).'</a>';
            })->addColumn('image_path',function ($data){
                return '<img src="'.$data->getImageSize(100,100).'" alt="'.$data->getTranslateName(app()->getLocale()).'">';
            })->addColumn('type_name',function ($data){
                return $data->type == 1 ? __('site.company_partners') : __('site.product_partners');
            })->addColumn('status_name',function ($data){
                if($data->status ==1){
                    return '<span class="badge bg-success">'.__('site.active').'</span>';
                }else{
                    return '<span class="badge bg-danger">'.__('site.blocked').'</span>';
                }
            })
            ->addColumn('action', 'dashboard.partners.partials._action')
            ->rawColumns(['action','status_name','name','image_path']);
    }

    public function query(Partner $model)
    {
        return $model->newQuery();
    }

    public function html()
    {
        return $this->builder()
                    ->setTableId('partner-table')
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
            Column::make('type_name')->title(__('site.type_name'))->data('type_name')->name('type_name'),
            Column::make('status_name')->title(__('site.status_name'))->data('status_name')->name('status_name'),
            Column::make('image_path')->title(__('site.image_path'))->data('image_path')->name('image_path'),
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
        return 'Partner_' . date('YmdHis');
    }
}

<?php

namespace App\DataTables;

use App\Models\Project;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ProjectDataTable extends DataTable
{
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addColumn('name',function ($data){
                return $data->getTranslateName(app()->getLocale());
            })->addColumn('short_desc',function ($data){
                return $data->getTranslateShort(app()->getLocale());
            })->addColumn('address',function ($data){
                return $data->getTranslateAddress(app()->getLocale());
            })->addColumn('description',function ($data){
                return $data->getTranslateDesc(app()->getLocale());
            })->addColumn('image_path',function ($data){
                return '<img src="'.$data->getImageSize(100,100).'" alt="'.$data->getTranslateName(app()->getLocale()).'">';
            })->addColumn('status_name',function ($data){
                if($data->status ==1){
                    return '<span class="badge bg-success">'.__('site.active').'</span>';
                }else{
                    return '<span class="badge bg-danger">'.__('site.blocked').'</span>';
                }
            })
            ->addColumn('action', 'dashboard.projects.partials._action')
            ->rawColumns(['action','status_name','image_path']);
    }

    public function query(Project $model)
    {
        return $model->newQuery();
    }

    public function html()
    {
        return $this->builder()
                    ->setTableId('project-table')
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
            Column::make('short_desc')->title(__('site.short_desc'))->data('short_desc')->name('short_desc'),
            Column::make('description')->title(__('site.description'))->data('description')->name('description'),
            Column::make('address')->title(__('site.address'))->data('address')->name('address'),
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

    protected function filename()
    {
        return 'Project_' . date('YmdHis');
    }
}

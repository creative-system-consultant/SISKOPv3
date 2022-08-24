<?php

namespace App\Http\Livewire\Page\Reporting;

use Livewire\Component;
use Rap2hpoutre\FastExcel\FastExcel;
use OpenSpout\Writer\Common\Creator\Style\StyleBuilder;
use OpenSpout\Common\Entity\Style\CellAlignment;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;

class UserReporting extends Component
{
    public $startDate;
    public $endDate;
    public $spData;

    public function mount()
    {
        $this->spData =  "EXEC SISKOP.user_list '$this->startDate','$this->startDate'";
        $this->startDate = now()->format('Y-m-d');;
        $this->endDate = now()->format('Y-m-d');
    }

    public function renderReportExcel()
    {
        foreach( DB::select(
                    $this->spData
                ) as $item) {
                    $data = [
                        'Name'      => $item->name,
                        'IC Number' => $item->name,
                        'Status'    => $item->MARRIED,
                    ];
            yield $data;
        }
    }

    public function generateExcel()
    {
        return response()->streamDownload(function () {
            $header_style = (new StyleBuilder())
                ->setFontBold()
                ->setShouldWrapText(false)
                ->build();
            $rows_style = (new StyleBuilder())
                ->setShouldWrapText(false)
                ->build();
            return (new FastExcel($this->renderReportExcel()))
                ->headerStyle($header_style)
                ->rowsStyle($rows_style)
            ->export('php://output');
            }, sprintf('ListOfUser-%s.xlsx',$this->startDate));
    }

    public function render()
    {
        $data  = DB::select($this->spData);
        $dataCollection = collect($data);

        $perPage = 1;
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $currentPageData = $dataCollection->slice(($currentPage * $perPage) - $perPage, $perPage)->all();
        $finalResultData = new LengthAwarePaginator($currentPageData , count($dataCollection), $perPage);
        $finalResultData->setPath(LengthAwarePaginator::resolveCurrentPath());

        return view('livewire.page.reporting.user-reporting',[
            'result' =>   $finalResultData
        ]
        )->extends('layouts.head');
    }
}

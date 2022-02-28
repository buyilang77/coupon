<?php

namespace App\Exports;

use App\Models\Coupon;
use App\Models\Merchant;
use App\Models\Order;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Sheet;

class OrderTemplateExport implements FromCollection, WithEvents
{
    public function __construct(public Merchant $merchant)
    {
    }

    /**
     * @return Collection
     */
    public function collection(): Collection
    {
        $header = [
            '订单ID',
            '收货人',
            '收货电话',
            '物流公司',
            '物流单号'
        ];
        $condition = [
            'merchant_id' => $this->merchant->id,
            'status'      => 0,
        ];
        $item = Order::where($condition)->orderByDesc('id')->get(['id', 'consignee', 'phone']);
        return new Collection(array_merge([$header], $item->toArray()));
    }

    /**
     * @return array
     */
    public function registerEvents(): array
    {
        Sheet::macro('styleCells', function (Sheet $sheet, string $cellRange, array $style) {
            $sheet->getDelegate()->getStyle($cellRange)->applyFromArray($style);
        });
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $event->sheet->getDelegate()->getStyle('D1:E1')->getFont()->getColor()->setARGB('FFFF0000');
                $event->sheet->getDelegate()->getColumnDimension('A')->setWidth(10);
                $event->sheet->getDelegate()->getColumnDimension('B')->setWidth(20);
                $event->sheet->getDelegate()->getColumnDimension('C')->setWidth(20);
                $event->sheet->getDelegate()->getColumnDimension('D')->setWidth(20);
                $event->sheet->getDelegate()->getColumnDimension('E')->setWidth(20);
            }
        ];
    }
}

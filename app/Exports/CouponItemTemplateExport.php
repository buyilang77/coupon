<?php

namespace App\Exports;

use App\Models\Coupon;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Sheet;

class CouponItemTemplateExport implements FromCollection, WithEvents
{
    public function __construct(public Coupon $coupon)
    {
    }

    /**
    * @return Collection
    */
    public function collection(): Collection
    {
        $header = [
            '兑换码',
            '密码',
        ];
        return new Collection([$header]);
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
                $event->sheet->getDelegate()->getStyle('A1:B1')->getFont()->getColor()->setARGB('FFFF0000');
                $event->sheet->getDelegate()->getColumnDimension('A')->setWidth(20);
                $event->sheet->getDelegate()->getColumnDimension('B')->setWidth(20);
            }
        ];
    }
}

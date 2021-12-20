<?php

namespace App\Exports;

use App\Http\Resources\Merchant\RechargeCardExportResource;
use App\Http\Resources\Merchant\RechargeCardItemResource;
use App\Models\RechargeCard;
use App\Models\RechargeCardItem;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;

class RechargeCardExport implements FromCollection
{
    public function __construct(public RechargeCard $card)
    {
    }

    /**
    * @return Collection
    */
    public function collection(): Collection
    {
        $item = RechargeCardItem::where('recharge_card_id', $this->card->id)->get();
        $itemResource = RechargeCardExportResource::collection($item)->response()->getData();
        $header = [
            '兑换码',
            '密码',
            '可用余额',
            '领取链接',
            '开启状态',
        ];
        return new Collection(array_merge([$header], $itemResource->data));
    }
}

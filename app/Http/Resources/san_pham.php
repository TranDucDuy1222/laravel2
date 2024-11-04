<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class san_pham extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'ten_sp' => $this->ten_sp,
            'gia' => $this->gia,   
            'gia_km' => $this->gia_km, 
            'id_loai' => $this->id_loai, 
            'hinh' => $this->hinh,
            'trang_thai' => $this->trang_thai,
            'danh_muc' => $this->danhMuc->ten_dm,
        ];
    }
}

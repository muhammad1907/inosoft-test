namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MotorResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'mesin' => $this->mesin,
            'tipe_suspensi' => $this->tipe_suspensi,
            'tipe_transmisi' => $this->tipe_transmisi,
            // add other attributes as needed
        ];
    }
}
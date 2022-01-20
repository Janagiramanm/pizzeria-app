<?php
  
namespace App\Exports;
  
use App\Models\Sale;
use Maatwebsite\Excel\Concerns\FromCollection;
use Carbon\Carbon;
  
class ExportReports implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public $user_id, $from_date,$to_date, $month;
    public function collection()
    {

        // echo "comes";exit;
        $this->lastMonth = $this->month ? $this->month : Carbon::now()->subMonth()->month;
        $query = $this->lastMonth;
        $this->month = $this->lastMonth;
        $result =Sale::where('month', $this->lastMonth)->get();
       // echo '<pre>';
        // print_r($result);exit;
        $no = 1;
        $recipes = [];
        $items = [];
        $total_used_price = 0;
        $total_waste_price = 0;
        // $index = $result->firstItem()

        foreach($result as $sales){
            foreach($sales->recipes->recipeIngredients as $ingredients){
                    if(isset($sales->quantity)!='' && isset($ingredients->quantity)!=''){
                        $recipes[$ingredients->rawMaterial->uom][$ingredients->rawMaterial->name]['used_qty'][]= ( (int) $sales->quantity * (int) $ingredients->quantity ) ;
                        $recipes[$ingredients->rawMaterial->uom][$ingredients->rawMaterial->name]['price']= $ingredients->rawMaterial->price;
                        $recipes[$ingredients->rawMaterial->uom][$ingredients->rawMaterial->name]['ppl']= $ingredients->rawMaterial->ppl;
                    }
            }
        }
        // echo "<pre>";
        //print_r($recipes);
        //exit;
        $report = '';
        $report .= '<table class="min-w-full leading-normal">
                        <tr>
                            <th rowspan="2" class="px-5 py-3 border-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider"> 
                                S.No  
                            </th>
                            <th rowspan="2"  class="px-5 py-3 border-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider"> 
                                Item 
                            </th>
                            <th colspan="2" class="px-5 py-3 border-2 border-gray-200 bg-gray-100 text-center text-xs font-semibold text-gray-700 uppercase tracking-wider"> 
                            Used
                            
                            </th>
                            <th colspan="2" class="px-5 py-3 border-2 border-gray-200 bg-gray-100 text-center text-xs font-semibold text-gray-700 uppercase tracking-wider"> 
                            Wastage
                            </th>
                        </tr>
                        <tr>
                                <th class="px-5 py-3 border-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Quantity</th>
                                <th class="px-5 py-3 border-2 border-gray-200 bg-gray-100 text-right text-xs font-semibold text-gray-700 uppercase tracking-wider">Price</th>
                                <th class="px-5 py-3 border-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Quantity</th>
                                <th class="px-5 py-3 border-2 border-gray-200 bg-gray-100 text-right text-xs font-semibold text-gray-700 uppercase tracking-wider">Price</th>
                        </tr>';
        if(!empty($recipes)){
                foreach($recipes as $key => $items){

                        foreach($items as $item => $value){
                                                
                                        $used_qty =  array_sum($value['used_qty']);
                                        $used_price = (int) $value['used_qty'] * (int) $value['price'];
                                        $waste_qty = '';
                                        $waste_price = '';
                                        $ukey =$key;
                                        $wkey =$key;

                                        //echo $item;
                                        
                                        if($value['ppl'] > 0){
                                            $waste_qty = (int) $value['used_qty'] * ( (int) $value['ppl'] / 100);
                                        
                                        }
                                        if($key == 'nos'){
                                                $used_price = ($used_qty * (float) $value['price']);
                                        }
                                        if($used_qty >= 1000 && $key != 'nos'){
                                            $used_qty = $used_qty / 1000 ;
                                            $used_price = $used_qty * (int) $value['price'];
                                            $waste_qty = $used_qty * ( (int) $value['ppl'] / 100);
                                            if($key == 'gms'){
                                                    $ukey = 'Kg';
                                            }
                                            if($key == 'ml'){
                                                $ukey ='Ltr';
                                            }
                                        }
                                        if($waste_qty >= 1 && $key != 'nos'){
                                            if($key == 'gms'){
                                                    $wkey = 'Kg';
                                            }
                                            if($key == 'ml'){
                                                $wkey ='Ltr';
                                            }
                                        }
                                        if($key != 'nos'){
                                                $waste_price = $waste_qty * $value['price'];
                                         }

                                        $total_used_price += (float)$used_price;
                                        $total_waste_price += (float)$waste_price;
                                        $used_qty =  $used_qty."  ". $ukey;
                                        $used_price = number_format((float)$used_price, 2, ".", "");

                                        $report .='<tr>
                                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">'. $no++ .'</td>
                                                    <td class="border px-4 py-2">'.isset($item) ? $item : "" .'</td>
                                                    <td class="border px-4 py-2">ll</td>
                                                    <td class="border px-4 py-2 text-right">'.$used_price.'</td>
                                                    <td class="border px-4 py-2">'. $waste_qty ? $waste_qty."  ". $wkey : "" .'</td>
                                                    <td class="border px-4 py-2 text-right">'.$waste_price ? number_format((float)$waste_price, 2, '.', '') : "".'</td>
                                                </tr>';
                                        
                        }
                }
            }

          
             $report .= '</table>';

            return collect($recipes);

    }
   

}
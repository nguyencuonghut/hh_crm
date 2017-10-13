<?php
namespace App\Repositories\Client;

use App\Models\Client;
use App\Models\ClientType;
use App\Models\Industry;
use App\Models\Invoice;
use App\Models\ProductCategory;
use App\Models\Group;
use App\Models\User;
use DB;
/**
 * Class ClientRepository
 * @package App\Repositories\Client
 */
class ClientRepository implements ClientRepositoryContract
{
    const CREATED = 'created';
    const UPDATED_ASSIGN = 'updated_assign';

    /**
     * @param $id
     * @return mixed
     */
    public function find($id)
    {
        return Client::findOrFail($id);
    }

    /**
     * @return mixed
     */
    public function listAllClients()
    {
        return Client::pluck('name', 'id');
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getInvoices($id)
    {
        $invoice = Client::findOrFail($id)->invoices()->with('invoiceLines')->get();

        return $invoice;
    }

    /**
     * @return int
     */
    public function getAllClientsCount()
    {
        return Client::all()->count();
    }


    /**
     * @param $id
     * @return mixed
     */
    public function totalProducts($id)
    {
        // Count all the Clients that use 100% Hong Ha product
        $hongha_1 = Client::where('product_category_id', 1)
            ->where('user_id', $id)
            ->count();
        $hongha_2 = Client::where('product_category_id', 1)
            ->where('gs_tv_id', $id)
            ->count();
        $hongha_3 = Client::where('product_category_id', 1)
            ->where('gd_vung_id', $id)
            ->count();
        $hongha_4 = Client::where('product_category_id', 1)
            ->where('pgd_id', $id)
            ->count();
        $hongha_5 = Client::where('product_category_id', 1)
            ->where('gd_id', $id)
            ->count();
        $hongha = $hongha_1 + $hongha_2 + $hongha_3 + $hongha_4 + $hongha_5;

        // Count all the Clients that use both Hong Ha + Other company product
        $mix_1 = Client::where('product_category_id', 2)
            ->where('user_id', $id)
            ->count();
        $mix_2 = Client::where('product_category_id', 2)
            ->where('gs_tv_id', $id)
            ->count();
        $mix_3 = Client::where('product_category_id', 2)
            ->where('gd_vung_id', $id)
            ->count();
        $mix_4 = Client::where('product_category_id', 2)
            ->where('pgd_id', $id)
            ->count();
        $mix_5 = Client::where('product_category_id', 2)
            ->where('gd_id', $id)
            ->count();
        $mix = $mix_1 + $mix_2 + $mix_3 + $mix_4 + $mix_5;

        // Count all the Clients that use Other company product
        $other_1 = Client::where('product_category_id', 3)
            ->where('user_id', $id)
            ->count();
        $other_2 = Client::where('product_category_id', 3)
            ->where('gs_tv_id', $id)
            ->count();
        $other_3 = Client::where('product_category_id', 3)
            ->where('gd_vung_id', $id)
            ->count();
        $other_4 = Client::where('product_category_id', 3)
            ->where('pgd_id', $id)
            ->count();
        $other_5 = Client::where('product_category_id', 3)
            ->where('gd_id', $id)
            ->count();
        $other = $other_1 + $other_2 + $other_3 + $other_4 + $other_5;

        return collect([$hongha, $mix, $other]);
    }


    /**
     * @param $id
     * @return mixed
     */
    public function totalGroups($id)
    {
        // Count all the Clients that is Đại lý/Trại tiềm năng
        $hongha_1 = Client::where('group_id', 1)
            ->where('user_id', $id)
            ->count();
        $hongha_2 = Client::where('group_id', 1)
            ->where('gs_tv_id', $id)
            ->count();
        $hongha_3 = Client::where('group_id', 1)
            ->where('gd_vung_id', $id)
            ->count();
        $hongha_4 = Client::where('group_id', 1)
            ->where('pgd_id', $id)
            ->count();
        $hongha_5 = Client::where('group_id', 1)
            ->where('gd_id', $id)
            ->count();
        $hongha = $hongha_1 + $hongha_2 + $hongha_3 + $hongha_4 + $hongha_5;

        // Count all the Clients that is Trại key
        $mix_1 = Client::where('group_id', 2)
            ->where('user_id', $id)
            ->count();
        $mix_2 = Client::where('group_id', 2)
            ->where('gs_tv_id', $id)
            ->count();
        $mix_3 = Client::where('group_id', 2)
            ->where('gd_vung_id', $id)
            ->count();
        $mix_4 = Client::where('group_id', 2)
            ->where('pgd_id', $id)
            ->count();
        $mix_5 = Client::where('group_id', 2)
            ->where('gd_id', $id)
            ->count();
        $mix = $mix_1 + $mix_2 + $mix_3 + $mix_4 + $mix_5;

        // Count all the Clients that is Đại lý/Trại thường
        $other_1 = Client::where('group_id', 3)
            ->where('user_id', $id)
            ->count();
        $other_2 = Client::where('group_id', 3)
            ->where('gs_tv_id', $id)
            ->count();
        $other_3 = Client::where('group_id', 3)
            ->where('gd_vung_id', $id)
            ->count();
        $other_4 = Client::where('group_id', 3)
            ->where('pgd_id', $id)
            ->count();
        $other_5 = Client::where('group_id', 3)
            ->where('gd_id', $id)
            ->count();
        $other = $other_1 + $other_2 + $other_3 + $other_4 + $other_5;

        return collect([$hongha, $mix, $other]);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function totalAnimals($id)
    {
        //Calculate the pig num for each user
        $pig_num_1 = Client::where('user_id', $id)->sum('pig_num');
        $pig_num_2 = Client::where('gs_tv_id', $id)->sum('pig_num');
        $pig_num_3 = Client::where('gd_vung_id', $id)->sum('pig_num');
        $pig_num_4 = Client::where('pgd_id', $id)->sum('pig_num');
        $pig_num_5 = Client::where('gd_id', $id)->sum('pig_num');
        $pig_num = $pig_num_1 + $pig_num_2 + $pig_num_3 +$pig_num_4 +$pig_num_5;

        //Calculate the broiler chicken num for each user
        $broiler_chicken_num_1 = Client::where('user_id', $id)->sum('broiler_chicken_num');
        $broiler_chicken_num_2 = Client::where('gs_tv_id', $id)->sum('broiler_chicken_num');
        $broiler_chicken_num_3 = Client::where('gd_vung_id', $id)->sum('broiler_chicken_num');
        $broiler_chicken_num_4 = Client::where('pgd_id', $id)->sum('broiler_chicken_num');
        $broiler_chicken_num_5 = Client::where('gd_id', $id)->sum('broiler_chicken_num');
        $broiler_chicken_num = $broiler_chicken_num_5 + $broiler_chicken_num_4 + $broiler_chicken_num_3 + $broiler_chicken_num_2 + $broiler_chicken_num_1;

        //Calculate the broiler duck num for each user
        $broiler_duck_num_1 = Client::where('user_id', $id)->sum('broiler_duck_num');
        $broiler_duck_num_2 = Client::where('gs_tv_id', $id)->sum('broiler_duck_num');
        $broiler_duck_num_3 = Client::where('gd_vung_id', $id)->sum('broiler_duck_num');
        $broiler_duck_num_4 = Client::where('pgd_id', $id)->sum('broiler_duck_num');
        $broiler_duck_num_5 = Client::where('gd_id', $id)->sum('broiler_duck_num');
        $broiler_duck_num = $broiler_duck_num_1 + $broiler_duck_num_2 + $broiler_duck_num_3 + $broiler_duck_num_4 + $broiler_duck_num_5;

        //Calculate the quail num for each user
        $quail_num_1 = Client::where('user_id', $id)->sum('quail_num');
        $quail_num_2 = Client::where('gs_tv_id', $id)->sum('quail_num');
        $quail_num_3 = Client::where('gd_vung_id', $id)->sum('quail_num');
        $quail_num_4 = Client::where('pgd_id', $id)->sum('quail_num');
        $quail_num_5 = Client::where('gd_id', $id)->sum('quail_num');
        $quail_num = $quail_num_1 + $quail_num_2 + $quail_num_3 + $quail_num_4 + $quail_num_5;

        //Calculate the aqua num for each user
        $aqua_num_1 = Client::where('user_id', $id)->sum('aqua_num');
        $aqua_num_2 = Client::where('gs_tv_id', $id)->sum('aqua_num');
        $aqua_num_3 = Client::where('gd_vung_id', $id)->sum('aqua_num');
        $aqua_num_4 = Client::where('pgd_id', $id)->sum('aqua_num');
        $aqua_num_5 = Client::where('gd_id', $id)->sum('aqua_num');
        $aqua_num = $aqua_num_1 + $aqua_num_2 + $aqua_num_3 + $aqua_num_4 + $aqua_num_5;

        //Calculate the layer chicken num for each user
        $layer_chicken_num_1 = Client::where('user_id', $id)->sum('layer_chicken_num');
        $layer_chicken_num_2 = Client::where('gs_tv_id', $id)->sum('layer_chicken_num');
        $layer_chicken_num_3 = Client::where('gd_vung_id', $id)->sum('layer_chicken_num');
        $layer_chicken_num_4 = Client::where('pgd_id', $id)->sum('layer_chicken_num');
        $layer_chicken_num_5 = Client::where('gd_id', $id)->sum('layer_chicken_num');
        $layer_chicken_num = $layer_chicken_num_1 + $layer_chicken_num_2 + $layer_chicken_num_3 + $layer_chicken_num_4 + $layer_chicken_num_5;

        //Calculate the layer duck num for each user
        $layer_duck_num_1 = Client::where('user_id', $id)->sum('layer_duck_num');
        $layer_duck_num_2 = Client::where('gs_tv_id', $id)->sum('layer_duck_num');
        $layer_duck_num_3 = Client::where('gd_vung_id', $id)->sum('layer_duck_num');
        $layer_duck_num_4 = Client::where('pgd_id', $id)->sum('layer_duck_num');
        $layer_duck_num_5 = Client::where('gd_id', $id)->sum('layer_duck_num');
        $layer_duck_num = $layer_duck_num_1 + $layer_duck_num_2 +  $layer_duck_num_3 + $layer_duck_num_4 + $layer_duck_num_5;

        //Calculate the cow num for each user
        $cow_num_1 = Client::where('user_id', $id)->sum('cow_num');
        $cow_num_2 = Client::where('gs_tv_id', $id)->sum('cow_num');
        $cow_num_3 = Client::where('gd_vung_id', $id)->sum('cow_num');
        $cow_num_4 = Client::where('pgd_id', $id)->sum('cow_num');
        $cow_num_5 = Client::where('gd_id', $id)->sum('cow_num');
        $cow_num = $cow_num_1 + $cow_num_2 + $cow_num_3 + $cow_num_4 + $cow_num_5;

        return collect([$pig_num,
            $broiler_chicken_num,
            $broiler_duck_num,
            $quail_num,
            $aqua_num,
            $layer_chicken_num,
            $layer_duck_num,
            $cow_num
        ]);
    }


    /**
     * @return int cuongnv
     */
    public function getAllAgentsCount()
    {
        return Client::all()->where('client_type_id', 1)->count();
    }

    public function getAllKeyClientsCount()
    {
        return Client::all()->where('group_id', 2)->count();
    }

    public function getAllCandidateClientsCount()
    {
        return Client::all()->where('group_id', 1)->count();
    }
    public function getAllPigsCount()
    {
        return Client::sum('pig_num');
    }

    public function getAllBroilerChickensCount()
    {
        return Client::sum('broiler_chicken_num');
    }
    public function getAllBroilerDucksCount()
    {
        return Client::sum('broiler_duck_num');
    }
    public function getAllQuailsCount()
    {
        return Client::sum('quail_num');
    }
    public function getAllAquasCount()
    {
        return Client::sum('aqua_num');
    }
    public function getAllLayerChickensCount()
    {
        return Client::sum('layer_chicken_num');
    }
    public function getAllLayerDucksCount()
    {
        return Client::sum('layer_duck_num');
    }
    public function getAllCowsCount()
    {
        return Client::sum('cow_num');
    }
    /**
     * @return int cuongnv
     */
    public function getAllFarmsCount()
    {
        return Client::all()->where('client_type_id', 2)->count();
    }

    /**
     * @return mixed
     */
    public function listAllIndustries()
    {
        return Industry::pluck('name', 'id');
    }

    /**
     * @return mixed cuongnv
     */
    public function listAllClientTypes()
    {
        return ClientType::pluck('name', 'id');
    }

    /**
     * @return mixed cuongnv
     */
    public function listAllProductCategories()
    {
        return ProductCategory::pluck('name', 'id');
    }

    /**
     * @return mixed cuongnv
     */
    public function listAllGroups()
    {
        return Group::pluck('name', 'id');
    }

    /**
     * @param $requestData
     */
    public function create($requestData)
    {
        $client = Client::create($requestData);
        Session()->flash('flash_message', 'Thêm mới khác hàng thành công.');
        event(new \App\Events\ClientAction($client, self::CREATED));
    }

    /**
     * @param $id
     * @param $requestData
     */
    public function update($id, $requestData)
    {
        $client = Client::findOrFail($id);
        $client->fill($requestData->all())->save();
    }

    /**
     * @param $id
     */
    public function destroy($id)
    {
        try {
            $client = Client::findorFail($id);
            $client->delete();
            Session()->flash('flash_message', 'Xóa khách  hàng thành công.');
        } catch (\Illuminate\Database\QueryException $e) {
            Session()->flash('flash_message_warning', 'Khách hàng không có Nhiệm vụ hoặc Chỉ đạo được gán khi xóa.');
        }
    }

    /**
     * @param $id
     * @param $requestData
     */
    public function updateAssign($id, $requestData)
    {
        $client = Client::with('user')->findOrFail($id);
        $client->user_id = $requestData->get('user_assigned_id');
        $client->save();

        event(new \App\Events\ClientAction($client, self::UPDATED_ASSIGN));
    }

    /**
     * @param $requestData
     * @return string
     */
    public function vat($requestData)
    {
        $vat = $requestData->input('vat');

        $country = $requestData->input('country');
        $company_name = $requestData->input('company_name');

        // Strip all other characters than numbers
        $vat = preg_replace('/[^0-9]/', '', $vat);

        function cvrApi($vat)
        {
            if (empty($vat)) {
                // Print error message
                return ('Please insert VAT');
            } else {
                // Start cURL
                $ch = curl_init();

                // Set cURL options
                curl_setopt($ch, CURLOPT_URL, 'http://cvrapi.dk/api?search=' . $vat . '&country=dk');
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch, CURLOPT_USERAGENT, 'Flashpoint');

                // Parse result
                $result = curl_exec($ch);

                // Close connection when done
                curl_close($ch);

                // Return our decoded result
                return json_decode($result, 1);
            }
        }

        $result = cvrApi($vat, 'dk');

        return $result;
    }
}

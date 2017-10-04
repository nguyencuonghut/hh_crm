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

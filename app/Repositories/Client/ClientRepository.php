<?php
namespace App\Repositories\Client;

use App\Models\Client;
use App\Models\ClientType;
use App\Models\Industry;
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
        return Client::all()->where('name', '!=', NULL)->count();
    }


    /**
     * @param $id
     * @return mixed
     */
    public function totalProducts($id)
    {
        $user = User::findorFail($id);
        switch($user->userRole()->first()->role_id) {
            case 2: // Giám đốc: can view all users
                $hongha = Client::where('product_category_id', 1)
                    ->where('gd_id', $id)
                    ->count();
                $mix = Client::where('product_category_id', 2)
                    ->where('gd_id', $id)
                    ->count();
                $other = Client::where('product_category_id', 3)
                    ->where('gd_id', $id)
                    ->count();
                break;
            case 3: // Phó giám đốc: can view all users of his location
                $hongha = Client::where('product_category_id', 1)
                    ->where('pgd_id', $id)
                    ->count();
                $mix = Client::where('product_category_id', 2)
                    ->where('pgd_id', $id)
                    ->count();
                $other = Client::where('product_category_id', 3)
                    ->where('pgd_id', $id)
                    ->count();
                break;
            case 4: // Giám đốc vùng: can view all users of his location
                $hongha = Client::where('product_category_id', 1)
                    ->where('gd_vung_id', $id)
                    ->count();
                $mix = Client::where('product_category_id', 2)
                    ->where('gd_vung_id', $id)
                    ->count();
                $other = Client::where('product_category_id', 3)
                    ->where('gd_vung_id', $id)
                    ->count();
                break;
            case 5: // Trưởng vùng: can view all users of his location
                $hongha = Client::where('product_category_id', 1)
                    ->where('tv_id', $id)
                    ->count();
                $mix = Client::where('product_category_id', 2)
                    ->where('tv_id', $id)
                    ->count();
                $other = Client::where('product_category_id', 3)
                    ->where('tv_id', $id)
                    ->count();
                break;
            case 6: // Giám sát: can view all users of his location
                $hongha = Client::where('product_category_id', 1)
                    ->where('gs_id', $id)
                    ->count();
                $mix = Client::where('product_category_id', 2)
                    ->where('gs_id', $id)
                    ->count();
                $other = Client::where('product_category_id', 3)
                    ->where('gs_id', $id)
                    ->count();
                break;
            case 7: // Nhân viên: can view all users of his location
                $hongha = Client::where('product_category_id', 1)
                    ->where('user_id', $id)
                    ->count();
                $mix = Client::where('product_category_id', 2)
                    ->where('user_id', $id)
                    ->count();
                $other = Client::where('product_category_id', 3)
                    ->where('user_id', $id)
                    ->count();
                break;
            default:
                $hongha = 0;
                $mix = 0;
                $other = 0;
                break;
        }

        return collect([$hongha, $mix, $other]);
    }


    /**
     * @param $id
     * @return mixed
     */
    public function totalGroups($id)
    {
        $user = User::findorFail($id);
        switch($user->userRole()->first()->role_id) {
            case 2: // Giám đốc: can view all users
                $candidate = Client::where('group_id', 1)
                    ->where('gd_id', $id)
                    ->count();
                $key = Client::where('group_id', 2)
                    ->where('gd_id', $id)
                    ->count();
                $normal = Client::where('group_id', 3)
                    ->where('gd_id', $id)
                    ->count();
                break;
            case 3: // Phó giám đốc: can view all users of his location
                $candidate = Client::where('group_id', 1)
                    ->where('pgd_id', $id)
                    ->count();
                $key = Client::where('group_id', 2)
                    ->where('pgd_id', $id)
                    ->count();
                $normal = Client::where('group_id', 3)
                    ->where('pgd_id', $id)
                    ->count();
                break;
            case 4: // Giám đốc vùng: can view all users of his location
                $candidate = Client::where('group_id', 1)
                    ->where('gd_vung_id', $id)
                    ->count();
                $key = Client::where('group_id', 2)
                    ->where('gd_vung_id', $id)
                    ->count();
                $normal = Client::where('group_id', 3)
                    ->where('gd_vung_id', $id)
                    ->count();
                break;
            case 5: // Trưởng vùng: can view all users of his location
                $candidate = Client::where('group_id', 1)
                    ->where('tv_id', $id)
                    ->count();
                $key = Client::where('group_id', 2)
                    ->where('tv_id', $id)
                    ->count();
                $normal = Client::where('group_id', 3)
                    ->where('tv_id', $id)
                    ->count();
                break;
            case 6: // Giám sát: can view all users of his location
                $candidate = Client::where('group_id', 1)
                    ->where('gs_id', $id)
                    ->count();
                $key = Client::where('group_id', 2)
                    ->where('gs_id', $id)
                    ->count();
                $normal = Client::where('group_id', 3)
                    ->where('gs_id', $id)
                    ->count();
                break;
            case 7: // Nhân viên: can view all users of his location
                $candidate = Client::where('group_id', 1)
                    ->where('user_id', $id)
                    ->count();
                $key = Client::where('group_id', 2)
                    ->where('user_id', $id)
                    ->count();
                $normal = Client::where('group_id', 3)
                    ->where('user_id', $id)
                    ->count();
                break;
            default:
                $candidate = 0;
                $key = 0;
                $normal = 0;
                break;
        }

        return collect([$candidate, $key, $normal]);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function totalAnimals($id)
    {
        $user = User::findorFail($id);
        switch($user->userRole()->first()->role_id) {
            case 2: // Giám đốc: can view all users
                $pig_num = Client::where('gd_id', $id)->sum('pig_num');
                $broiler_chicken_num = Client::where('gd_id', $id)->sum('broiler_chicken_num');
                $broiler_duck_num = Client::where('gd_id', $id)->sum('broiler_duck_num');
                $quail_num = Client::where('gd_id', $id)->sum('quail_num');
                $aqua_num = Client::where('gd_id', $id)->sum('aqua_num');
                $layer_chicken_num = Client::where('gd_id', $id)->sum('layer_chicken_num');
                $layer_duck_num = Client::where('gd_id', $id)->sum('layer_duck_num');
                $cow_num = Client::where('gd_id', $id)->sum('cow_num');
                break;
            case 3: // Phó giám đốc: can view all users of his location
                $pig_num = Client::where('pgd_id', $id)->sum('pig_num');
                $broiler_chicken_num = Client::where('pgd_id', $id)->sum('broiler_chicken_num');
                $broiler_duck_num = Client::where('pgd_id', $id)->sum('broiler_duck_num');
                $quail_num = Client::where('pgd_id', $id)->sum('quail_num');
                $aqua_num = Client::where('pgd_id', $id)->sum('aqua_num');
                $layer_chicken_num = Client::where('pgd_id', $id)->sum('layer_chicken_num');
                $layer_duck_num = Client::where('pgd_id', $id)->sum('layer_duck_num');
                $cow_num = Client::where('pgd_id', $id)->sum('cow_num');
                break;
            case 4: // Giám đốc vùng: can view all users of his location
                $pig_num = Client::where('gd_vung_id', $id)->sum('pig_num');
                $broiler_chicken_num = Client::where('gd_vung_id', $id)->sum('broiler_chicken_num');
                $broiler_duck_num = Client::where('gd_vung_id', $id)->sum('broiler_duck_num');
                $quail_num = Client::where('gd_vung_id', $id)->sum('quail_num');
                $aqua_num = Client::where('gd_vung_id', $id)->sum('aqua_num');
                $layer_chicken_num = Client::where('gd_vung_id', $id)->sum('layer_chicken_num');
                $layer_duck_num = Client::where('gd_vung_id', $id)->sum('layer_duck_num');
                $cow_num = Client::where('gd_vung_id', $id)->sum('cow_num');
                break;
            case 5: // Trưởng vùng: can view all users of his location
                $pig_num = Client::where('tv_id', $id)->sum('pig_num');
                $broiler_chicken_num = Client::where('tv_id', $id)->sum('broiler_chicken_num');
                $broiler_duck_num = Client::where('tv_id', $id)->sum('broiler_duck_num');
                $quail_num = Client::where('tv_id', $id)->sum('quail_num');
                $aqua_num = Client::where('tv_id', $id)->sum('aqua_num');
                $layer_chicken_num = Client::where('tv_id', $id)->sum('layer_chicken_num');
                $layer_duck_num = Client::where('tv_id', $id)->sum('layer_duck_num');
                $cow_num = Client::where('tv_id', $id)->sum('cow_num');
                break;
            case 6: // Giám sát: can view all users of his location
                $pig_num = Client::where('gs_id', $id)->sum('pig_num');
                $broiler_chicken_num = Client::where('gs_id', $id)->sum('broiler_chicken_num');
                $broiler_duck_num = Client::where('gs_id', $id)->sum('broiler_duck_num');
                $quail_num = Client::where('gs_id', $id)->sum('quail_num');
                $aqua_num = Client::where('gs_id', $id)->sum('aqua_num');
                $layer_chicken_num = Client::where('gs_id', $id)->sum('layer_chicken_num');
                $layer_duck_num = Client::where('gs_id', $id)->sum('layer_duck_num');
                $cow_num = Client::where('gs_id', $id)->sum('cow_num');
                break;
            case 7: // Nhân viên: can view all users of his location
                $pig_num = Client::where('user_id', $id)->sum('pig_num');
                $broiler_chicken_num = Client::where('user_id', $id)->sum('broiler_chicken_num');
                $broiler_duck_num = Client::where('user_id', $id)->sum('broiler_duck_num');
                $quail_num = Client::where('user_id', $id)->sum('quail_num');
                $aqua_num = Client::where('user_id', $id)->sum('aqua_num');
                $layer_chicken_num = Client::where('user_id', $id)->sum('layer_chicken_num');
                $layer_duck_num = Client::where('user_id', $id)->sum('layer_duck_num');
                $cow_num = Client::where('user_id', $id)->sum('cow_num');
                break;
            default:
                $pig_num = 0;
                $broiler_chicken_num = 0;
                $broiler_duck_num = 0;
                $quail_num = 0;
                $aqua_num = 0;
                $layer_chicken_num = 0;
                $layer_duck_num = 0;
                $cow_num = 0;
                break;
        }
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
     * @param $id
     * @return mixed
     */
    public function totalTypes($id)
    {
        $user = User::findorFail($id);
        switch($user->userRole()->first()->role_id) {
            case 2: // Giám đốc: can view all users
                $agent = Client::where('client_type_id', 1)
                    ->where('gd_id', $id)
                    ->count();
                $farm = Client::where('client_type_id', 2)
                    ->where('gd_id', $id)
                    ->count();
                break;
            case 3: // Phó giám đốc: can view all users of his location
                $agent = Client::where('client_type_id', 1)
                    ->where('pgd_id', $id)
                    ->count();
                $farm = Client::where('client_type_id', 2)
                    ->where('pgd_id', $id)
                    ->count();
                break;
            case 4: // Giám đốc vùng: can view all users of his location
                $agent = Client::where('client_type_id', 1)
                    ->where('gd_vung_id', $id)
                    ->count();
                $farm = Client::where('client_type_id', 2)
                    ->where('gd_vung_id', $id)
                    ->count();
                break;
            case 5: // Trưởng vùng: can view all users of his location
                $agent = Client::where('client_type_id', 1)
                    ->where('tv_id', $id)
                    ->count();
                $farm = Client::where('client_type_id', 2)
                    ->where('tv_id', $id)
                    ->count();
                break;
            case 6: // Giám sát: can view all users of his location
                $agent = Client::where('client_type_id', 1)
                    ->where('gs_id', $id)
                    ->count();
                $farm = Client::where('client_type_id', 2)
                    ->where('gs_id', $id)
                    ->count();
                break;
            case 7: // Nhân viên: can view all users of his location
                $agent = Client::where('client_type_id', 1)
                    ->where('user_id', $id)
                    ->count();
                $farm = Client::where('client_type_id', 2)
                    ->where('user_id', $id)
                    ->count();
                break;
            default:
                $agent = 0;
                $farm = 0;
                break;
        }

        return collect([$agent , $farm]);
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
    /**
     * @return mixed
     */
    public function getAllClientsWithAddr()
    {
        return Client::all()
            ->pluck('nameAndAddr', 'id');
    }
}

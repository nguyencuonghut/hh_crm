<?php
namespace App\Repositories\Client;

interface ClientRepositoryContract
{
    public function find($id);

    public function listAllClients();

    public function getInvoices($id);

    public function getAllClientsCount();

    public function totalProducts($id);

    public function totalGroups($id);

    public function getAllAgentsCount();//cuongnv

    public function getAllFarmsCount();//cuongnv

    public function getAllKeyClientsCount();//cuongnv Tổng số trại key

    public function getAllCandidateClientsCount();//cuongnv Tổng số đại lý/trại tiềm năng

    public function getAllPigsCount();//cuongnv Tổng số lợn

    public function getAllBroilerChickensCount();//cuongnv Tổng số gà thịt

    public function getAllBroilerDucksCount();//cuongnv Tổng số vịt thịt

    public function getAllQuailsCount();//cuongnv Tổng số cút

    public function getAllAquasCount();//cuongnv Tổng số thủy sản

    public function getAllLayerChickensCount();//cuongnv Tổng số gà đẻ

    public function getAllLayerDucksCount();//cuongnv Tổng số vịt đẻ

    public function getAllCowsCount();//cuongnv Tổng số bò

    public function listAllIndustries();

    public function listAllClientTypes();

    public function listAllProductCategories();

    public function listAllGroups();

    public function getAllClientsWithAddr();

    public function create($requestData);

    public function update($id, $requestData);

    public function destroy($id);

    public function vat($requestData);
}

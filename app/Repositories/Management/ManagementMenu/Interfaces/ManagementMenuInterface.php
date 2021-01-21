<?php

/**
 * full-stack-developer
 * @author https://github.com/BayuWidia
 * Jakarta 01-Juli-2020
 */

namespace App\Repositories\Management\ManagementMenu\Interfaces;

interface ManagementMenuInterface {

  public function getDataMenus();

  public function getDataMenusSecond();

  public function getDataMenusThird();

  public function getDataMenusById($id);

  public function getDataMenusSecondById($id);

  public function getDataMenusSecondByIdMasterMenus($id);

  public function getDataMenusThirdById($id);

  public function storeMenus($data);

  public function updateMenus($data, $id);

  public function storeMenusSecond($data);

  public function updateMenusSecond($data, $id);

  public function updateMenusSecondByIdMasterMenu($data, $id);

  public function storeMenusThird($data);

  public function updateMenusThird($data, $id);

  public function updateMenusThirdByIdMenuSecond($data, $id);

}

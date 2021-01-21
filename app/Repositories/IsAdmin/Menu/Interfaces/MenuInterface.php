<?php

namespace App\Repositories\IsAdmin\Menu\Interfaces;

interface MenuInterface {

  public function create(array $attributes);

  public function update(array $attributes, $id);

  public function delete($id);

}

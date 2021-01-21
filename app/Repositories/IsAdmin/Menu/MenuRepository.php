<?php
namespace App\Repositories\IsAdmin\Menu;

use App\Repositories\IsAdmin\Menu\Interfaces\MenuInterface as MenuInterface;
use App\Models\MasterMenus;

class MenuRepository implements MenuInterface {

    public function create(array $attributes)
    {
        $result = MasterMenus::create($attributes);

        return $result;
    }

    public function update(array $attributes, $id)
    {
        $record = MasterMenus::find($id);
        $record->update($attributes);
        return $record;
    }

    public function delete($id)
    {
        $result = MasterMenus::destroy($id);

        return $result;
    }

}

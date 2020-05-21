<?php


namespace App\Models\traits;


trait UserRoles
{
	/**
	 * 判断用户是否拥有某个角色【参数 支持id,name,obj,name|name|name...】
	 *
	 * @param $roles
	 * @return bool
	 */
	public function hasRole($roles)
	{
		if (is_string($roles) && false !== strpos($roles, '|')) {
			$roles = explode('|', $roles);
		}
		if (is_string($roles)) {
			return $this->roles->contains('name', $roles) || $this->roles->contains('guard_name',$roles);
		}
		if (is_int($roles)) {
			return $this->roles->contains('id', $roles);
		}
		if ($roles instanceof Role) {
			return $this->roles->contains('id', $roles->id);
		}
		if (is_array($roles)) {
			foreach ($roles as $role) {
				if ($this->hasRole($role)) {
					return true;
				}
			}
		}
		return false;
	}
}
<x-roles.list :roles="$user->roles" />
<div class="mb-3">
    <x-form-select name="roles" label="Роли" :options="$roles" multiple many-relation /> 
</div>

<div class="mb-3">
    <x-form-input name="code" label="Код ютуба" /> 
</div>
<div class="mb-3">
    <x-form-select name="tags[]" label="Теги" :options="$tags" multiple many-relation /> 
</div>
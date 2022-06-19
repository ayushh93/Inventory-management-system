<?php $dash .= '-- '; ?>
@foreach ($subcategories as $item)
    @if ($item->status == 1)
        <option value="{{ $item->id }}" {{ old('parent_id') == $item->id ? 'selected' : '' }}>
            {{ $dash }}{{ $item->category_name }}</option>
    @endif
    @if (count($item->subcategory))
        @include('admin.category.subCategoryList-option', ['subcategories' => $item->subcategory])
    @endif
@endforeach

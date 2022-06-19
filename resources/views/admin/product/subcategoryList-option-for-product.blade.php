<?php $dash .= '-- '; ?>
@foreach ($subcategories as $item)
    @if ($item->status == 1)
        <option value="{{ $item->id }}" {{ old('category_id') == $item->id ? 'selected' : '' }}>
            {{ $dash }}{{ $item->category_name }}</option>
    @endif
    @if (count($item->subcategory))
        @include('admin.product.subCategoryList-option-for-product', ['subcategories' => $item->subcategory])
    @endif
@endforeach

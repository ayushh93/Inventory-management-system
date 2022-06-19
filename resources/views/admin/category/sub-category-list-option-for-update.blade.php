<?php $dash .= '-- '; ?>
@foreach ($subcategories as $item)
    @if ($category->id != $item->id && $item->status == 1)
        <option value="{{ $item->id }}" @if ($category->parent_id == $item->id) selected @endif
            {{ old('category_id') == $item->id ? 'selected' : '' }}>
            {{ $dash }}{{ $item->category_name }}
        </option>
    @endif
    @if (count($item->subcategory))
        @include('admin.category.sub-category-list-option-for-update', [
            'subcategories' => $item->subcategory,
        ])
    @endif
@endforeach

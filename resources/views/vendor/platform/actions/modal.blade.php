@component($typeForm, get_defined_vars())
    <button
            title ="{{ $myTooltip ??  '' }}"
            type="button"
            {{ $attributes }}
            data-controller="modal-toggle"
            data-action="click->modal-toggle#targetModal"
            data-modal-toggle-title="{{ $modalTitle ?? $title ??  '' }}"
            data-modal-toggle-key="{{ $modal ?? '' }}"
            data-modal-toggle-async="{{ $async }}"
            data-modal-toggle-params='@json($parameters)'
            data-modal-toggle-action="{{ $action }}"
            data-modal-toggle-open="{{ $open }}"
    >

        @isset($icon)
            <x-orchid-icon :path="$icon" class="{{ empty($name) ?: 'm-2'}}"/>
        @endisset
    <span class="text-left align-middle ">
        {!! $name ?? '' !!}
    </span>
       
    </button>
@endcomponent

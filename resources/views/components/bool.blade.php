@switch($bool)
@case(0)
    <span
        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800 py-1">
        NO
    </span>
@break
@case(1)
    <span
        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800 py-1">
        SI
    </span>
@break

@default

@endswitch

<hr style="border:1px solid #e9ecef" >
<div class="p-lg-4 modal-body layout-wrapper text-info">

 
 @if ($description_eu)
 <p class="text-sm text-justify text-gray-500 italic">
     {{$description_eu}}
 </p>
 <hr> 
 @endif
 
 <p class="text-sm text-justify text-gray-500">
     {{$description}}
 </p>

    @csrf
</div>

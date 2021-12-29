<button formaction="{{ url()->current() }}/{{ $notification->id }}/maskNotification"
        type="submit"
        class="btn btn-link text-start p-4">
    @php
        if ($notification->read()) {
            $color_notification ="text-green-600";
        }else{
             
            $color_notification ="  text-red-600";
        }
    @endphp

    <span class="align-self-start text-{{ $notification->data['type'] }} @if($notification->read()) opacity @endif pull-left m-t-sm small">
        <x-orchid-icon path="fa.circle" class="me-2 {{$color_notification}}"/>
           
    </span>

    <span class="w-full @if($notification->read()) opacity-50 @endif  ">
        <span class="w-100 w-b-k w-s-n">{{$notification->data['title'] ?? ''}}</span>
        <small class="text-muted ps-1">/ {{ $notification->created_at->diffForHumans() }} @if($notification->read()) <span class="text-green-600"> ({{__('leída')}}) </span>@endif</small>
        <br>
        <small class="text-muted w-100 w-b-k w-s-n">
            @if ($notification->data['message'])
                @php
                    $message=json_decode($notification->data['message']);
                  

                @endphp
   
                <div class="text-lg  font-medium mt-2">
                   <div class="grid grid-cols-12  place-items-start" >
                        <div class="flex">
                            <x-orchid-icon path="fa.chart-line" class="mr-2 h-8 text-yellow-500"  />
                        
                           <small class="font-normal  " >{{__('Categoría:')}}</small> 
                        </div>
                       
                        <span class="" > {{$message->category->name}}</span>
                          
                       
                    </div>
                    <div class="grid grid-cols-12 place-items-start  mb-2" >
                        <div class="flex">
                            <x-orchid-icon path="fa.layer-group" class="mr-2 h-8 text-yellow-500 "  />
                           
                            <small class="font-normal" >{{__('Código:')}}</small>  
                        </div> 
                            <span class="" >{{$message->code}}</span>
                           
                        
                    </div>
                   
                </div>
               <div class=" p-4 border-1 shadow-sm w-full">
                <div class="text-xl font-medium">
                    {{$message->title}}
                    <div class="grid grid-cols-12 place-items-start  mb-2" >
                        <div class="flex text-base">
                            <x-orchid-icon path="fa.code-branch" class="mr-2 h-8 text-yellow-500 "  />
                           
                            <span class="" >{{__('Versión:')}}</span>  
                        </div> 
                            <span class="" >{{$message->version}}</span>
                           
                        
                    </div>


                </div>
               <div class="text-base ml-4">
                    {{$message->description}}


                </div>
               </div>
                
                
            @endif
            
        
        </small>
    </span>
</button>

@foreach ($getChatUser as $user)
    <li class="clearfix getChatWindows @if(!empty($receiver_id)) @if($receiver_id == $user['user_id']) active @endif @endif" id="{{ $user['user_id'] }}">
        <img src="{{ $user['profile_pic'] }}" alt="avatar">
        <div class="about">
            <div class="name">
                {{ $user['name'] }} 
                @if (!empty($user['messageCount']))
                    <span id="ClearMessage{{ $user['user_id'] }}" style="color: white; background:red; padding:3px 7px;border-radius:4px;">{{ $user['messageCount'] }}</span>
                @endif
            </div>
            <div class="status"> 
                @if (!empty($user['is_online']))
                    <i class="fa fa-circle online"></i> 
                @else
                    <i class="fa fa-circle offline"></i> 
                @endif
                {{ Carbon\Carbon::parse($user['created_date'])->diffForHumans() }} 
            </div>                                            
        </div>
    </li>
@endforeach


{{-- <li class="clearfix active">
    <img src="https://bootdey.com/img/Content/avatar/avatar2.png" alt="avatar">
    <div class="about">
        <div class="name">Aiden Chavez</div>
        <div class="status"> <i class="fa fa-circle online"></i> online </div>
    </div>
</li> --}}

<div class="chat-header clearfix">
    @include('chat._header')
</div>
<div class="chat-history">
    @include('chat._chat')
</div>
<div class="chat-message clearfix">
    <div class="mb-0">
        <form action="" id="submit_message" method="POST" enctype="multipart/form-data">
            <input type="hidden" value="{{ $getReceiver->id }}" name="receiver_id">
            @csrf
            <textarea name="message" required id="ClearMessage" cols="30" rows="5" class="form-control emojionearea"></textarea>   
            <div class="row">
                <div class="col-md-6 hidden-sm">
                    <a href="javascript:void(0);" id="OpenFile" style="margin-top: 10px;" class="btn btn-outline-primary"><i class="fa fa-paperclip"></i></a>
                    <input style="display: none;" type="file" name="file_name" id="file_name">
                    <span id="getFileName"></span>
                </div>
                <div class="col-md-6" style="text-align: right;">
                    <button type="submit" style="margin-top: 10px;" class="btn btn-primary">Send</button>
                </div>
            </div> 
        </form>                             
    </div>
</div>
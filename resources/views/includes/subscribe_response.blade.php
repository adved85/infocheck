@if(session()->get('subscribeResponse') !== null)

<!-- if need some styles add here -->
<style>
    .subs-response {
        display: flex;
    }
</style>





@endif


@isset(session()->get('subscribeResponse')['success'])
<div class="subs-response">
    <div class="alert alert-success alert-dismissible fade show shadow" >
        <button type="button" class="close close-subs-note" data-dismiss="alert" >&times;</button>
        {{ session()->get('subscribeResponse')['success'] }}
    </div>
</div>
@endisset
@isset(session()->get('subscribeResponse')['warning'])
<div class="subs-response">
    <div class="alert alert-warning alert-dismissible fade show shadow" >
        <button type="button" class="close close-subs-note" data-dismiss="alert" >&times;</button>
        {{ session()->get('subscribeResponse')['warning'] }}
    </div>
</div>
@endisset

@isset(session()->get('subscribeResponse')['error'])
<div class="subs-response">
    <div class="alert alert-danger alert-dismissible fade show shadow" >
        <button type="button" class="close close-subs-note" data-dismiss="alert" >&times;</button>
        {{ session()->get('subscribeResponse')['error'] }}
    </div>
</div>
@endisset

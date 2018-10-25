@if(Session::get('output')=='success' )
<script type="text/javascript">
    $().toastmessage('showSuccessToast', "Success  !! Added Successfully...");
</script>
@endif

@if(Session::get('output')=='update' )
<script type="text/javascript">
    $().toastmessage('showSuccessToast', "Success  !! Updated Successfully...");
</script>
@endif

 @if(Session::get('output')=='fail')
 <script type="text/javascript">
     $().toastmessage('showErrorToast', "Something Went Wrong ...");
</script>
@endif

@if(Session::get('output')=='rate' )
<script type="text/javascript">
    $().toastmessage('showSuccessToast', "Success  !! Rated Successfully...");
</script>
@endif

@if(Session::get('output')=='poll' )
<script type="text/javascript">
    $().toastmessage('showSuccessToast', "Success  !! Answer Submitted Successfully...");
</script>
@endif

@if(Session::get('output')=='subscribe' )
<script type="text/javascript">
    $().toastmessage('showSuccessToast', "Success  !! You Are A Subscriber Now...");
</script>
@endif

@if(Session::get('output')=='reference' )
<script type="text/javascript">
    $().toastmessage('showSuccessToast', "Success  !! Reference Code Added Successfully...");
</script>
@endif


@if (count($errors) > 0)
    <div class="alert alert-danger alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        @foreach ($errors->all() as $error)
            <script type="text/javascript">
                 $().toastmessage('showErrorToast', "{{ $error }}");
            </script>
        @endforeach
    </div>
@endif
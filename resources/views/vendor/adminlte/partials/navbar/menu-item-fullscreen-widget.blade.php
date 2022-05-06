<li class="nav-item">
    <a class="nav-link" data-widget="fullscreen" href="#" role="button" rel="tooltip" title="Full Screen">
        <i class="fas fa-expand-arrows-alt"></i>
    </a>
</li>
@section('js')
<script>
$(document).ready(function(){
  $("[rel=tooltip]").tooltip({ placement: 'right'});
});
</script>
@stop
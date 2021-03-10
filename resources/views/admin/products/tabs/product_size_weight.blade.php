@push('js')
<script>
$(document).ready(function() {

        var dataSelect = [
        @foreach(App\Country::all() as $country)
                {
                        "text":"{{ $country->{'country_name_'.lang()} }}",
                        "children":[
                                @foreach($country->malls()->get() as $mall)
                                {
                                "id":{{$mall->id}},
                                "text":"{{ $mall->{'name_'.lang()} }}",
                                @if(check_mall($mall->id, $product->id))
                                "selected":true
                                @endif
                                },
                                @endforeach
                        ],
                },
        @endforeach
         
    ];

    $('.mall_select').select2({data:dataSelect});

});
</script>
@endpush

<div role="tabpanel" class="tab-pane" id="product_size_weight">
        <h3> {{trans('admin.product_size_weight')}} </h3>

        <div class="size-weight">
                <h2 class="text-center">من فضلك قم بأختيار أسم</h2>      
        </div>

<div class="info-data hidden">

        <div class="form-group col-md-4 col-sm-4 col-xs-12">
                {!! Form::label('colors', trans('admin.color_id')) !!}
                {!! Form::select('color_id', App\Color::pluck('name_'.lang(), 'id'), $product->id,
                ['class' => 'form-control', 'placeholder' => trans('admin.color_id')]) !!}
        </div>

        <div class="form-group col-md-4 col-sm-4 col-xs-12">
                {!! Form::label('trade_id', trans('admin.trade_id')) !!}
                {!! Form::select('trade_id', App\TradeMark::pluck('name_'.lang(), 'id'), $product->trade_id,
                ['class' => 'form-control', 'placeholder' => trans('admin.trade_id')]) !!}
        </div>


        <div class="form-group col-md-4 col-sm-4 col-xs-12">
                {!! Form::label('manu_id', trans('admin.manu_id')) !!}
                {!! Form::select('manu_id', App\manufacturers::pluck('name_'.lang(), 'id'), $product->manu_id,
                ['class' => 'form-control', 'placeholder' => trans('admin.manu_id')]) !!}
        </div>
        <div class="clearfix"></div> 
        
        <!-- Start Malls --> 
        <div class="form-group col-md-12 col-sm-12 col-xs-12">
                {!! Form::label('malls', trans('admin.malls')) !!}
                <select name="mall_id[]" class="form-control mall_select" multiple="multiple" style="width:100%">
               
                </select>
        </div>
         <!-- End Malls --> 

        <div class="clearfix"></div>   

</div>
      
</div>
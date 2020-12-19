@extends('layouts.master')

@section('content')
    
  <!-- Marketing messaging and featurettes
  ================================================== -->
  <!-- Wrap the rest of the page in another container to center all the content. -->

  <div class="container marketing">

    <!-- Three columns of text below the carousel -->
    <div class="row">
      
    </div><!-- /.row -->
    <!-- START THE FEATURETTES -->

    <br><br>
        @if (session()->has('success_message'))
            <div class="alert alert-success">
                {{ session()->get('success_message') }}
            </div>
        @endif

        @if( count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

     @if(Cart::instance('default')->count() > 0)
       <h3>{{ Cart::instance('default')->count() }} Item(s) in Cart </h3>
     @else
       <h3>No Item in Cart </h3>
     @endif
     <br>
    <P> <a href="/"><button class="btn btn-info">Continue Shopping</button></a></p>
    <div class="row featurette">
        <div class="col-sm-12 col-md-10 col-md-offset-1">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Quantity</th>
                        <th class="text-center">Price</th>
                        <th> </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach (Cart::content() as $item)
                    <tr>
                        <td class="col-sm-8 col-md-6">
                        <div class="media">
                            <a class="thumbnail pull-left" href="#"> 
                                <img class="media-object" src="{{$item->model->image}}" style="width: 72px; height: 72px;"> 
                            </a>
                            <div class="media-body">
                                <h4 class="media-heading"><a href="#">{{ $item->model->title }}</a></h4>
                            </div>
                        </div></td>
                        <td class="col-sm-1 col-md-1" style="text-align: center">
                            <select class="quantity" data-id="{{ $item->rowId }}" data-productQuantity="{{ $item->model->quantity }}">
                                @for ($i = 1; $i < 5 + 1 ; $i++)
                                    <option {{ $item->qty == $i ? 'selected' : '' }}>{{ $i }}</option>
                                @endfor
                            </select>
                        </td>
                        <td class="col-sm-1 col-md-1 text-center">
                            <strong>{{'$' . number_format($item->subtotal,2) }}</strong>
                        </td>
                        <td class="col-sm-1 col-md-1">
                            <form action="{{ route('cart.destroy', $item->rowId)}}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"> Remove</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                    <tr>
                        <td>   </td>
                        <td><h5>Subtotal</h5></td>
                        <td class="text-right"><h5><strong>{{'$' . number_format(Cart::subtotal(),2) }}</strong></h5></td>
                    </tr>
                    @if(session()->has('coupon'))
                    <tr>
                        <td>  </td>
                        <td>
                            <h6>Discount: ({{ session()->get('coupon')['name'] }})</h6>
                            <span>
                                <form action="{{ route('coupon.destroy') }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                 <button class="btn btn-outline-danger btn-sm">Remove</button>
                                </form>
                            </span>
                        </td>
                        <td class="text-right">
                            <h5><strong> {{'$' . number_format($discount,2) }}</strong></h6>
                        </td>
                    </tr>
                    {{-- <tr>
                        <td>  </td>
                        <td>
                            <h6>New Subtotal </h6>
                        </td>
                        <td class="text-right">
                            <h5><strong> {{'$' .  number_format((float)$newSubtotal, 2, '.', '') }}</strong></h6>
                                
                        </td>
                    </tr> --}}
                    @endif
                    <tr>
                        <td>  
                            @if(! session()->has('coupon'))
                              <div class="input-group col-6">
                                <div class="custom-file">
                                    <form action="{{ route('coupon.store')}}" method="POST"> 
                                    @csrf
                                    <input type="text" name="coupon_code" id="coupon_code" placeholder="Enter Coupon Code" class="form-control">
                                    </div>
                                    <div class="input-group-append">
                                    <button class="btn btn-info" type="submit">Apply</button>
                                    </div>
                                </form>
                                </div>
                            @endif
                            
                        </td>
                        <td><h3>Total</h3></td>
                        {{-- <td class="text-right"><h3><strong>{{ '$' . Cart::total() }}</strong></h3></td> --}}
                        <td class="text-right"><h3><strong>{{'$' . number_format($newTotal,2) }}</strong></h3></td>
                    </tr>
                    <tr>

                        <td>  </td>
                        <td>   </td>
                        <td>
                        <button type="button" class="btn btn-success">
                            Checkout 
                        </button></td>
                    </tr>
                </tbody>
            </table>
            
        </div>
      

    </div>

    <!-- /END THE FEATURETTES -->

  </div><!-- /.container -->
  @push('footer-script')

  <script src="{{ asset('js/app.js')}}"></script>

     <script>
         (function(){
          const classname = document.querySelectorAll('.quantity')

          Array.from(classname).forEach(function(element) {
            element.addEventListener('change', function(){
                const id = element.getAttribute('data-id')
                axios.patch(`/cart/${id}`, {
                   quantity: this.value
                 })
                .then(function (response) {
                    //console.log(response);
                    location.reload();
                   // window.location.href = '{{ route('cart.index') }}'
                })
                .catch(function (error) {
                    console.log(error);
                });
            })

          })
         })();
      
    </script>

  @endpush

  @endsection

<x-user.layout>
    @if(Session::get('cart'))
        <div class="container mt-5">
            <div class="card">
                <div class="card-header">
                    <h2>Shopping cart</h2>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped" style="min-width: 650px;">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Amount</th>
                                <th>Total</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach(Session::get('cart') as $index => $cart)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <a href="{{route('userSingleProduct', $cart['product']->id)}}" class="mr-2">
                                                <img style="height: 150px; object-fit: contain"
                                                     src="{{asset('img/product/' . $cart['product']->image)}}">
                                            </a>
                                            <div>
                                                <h5>{{Str::limit($cart['product']->name, 25)}}</h5>
                                                <h6>{{Str::limit($cart['product']->description, 25)}}</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <h4>&euro; {{number_format($cart['product']->price, 2, ',', '.')}}</h4>
                                    </td>
                                    <td>
                                        <h4>{{$cart['amount']}}</h4>
                                    </td>
                                    <td>
                                        <h4>&euro; {{number_format($cart['amount'] * $cart['product']->price,
                                                                                 2, ',', '.')}}</h4>
                                    </td>
                                    <td>
                                        <form action="{{route('carts.destroy', $index)}}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <input type="text" hidden value="{{$index}}" name="cart_index">
                                            <button style="outline: 0; border: 0; background: transparent; font-size: 20px; cursor: pointer"
                                                    type="submit">
                                                <i class="fa-solid fa-trash text-dark"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-md-between gap-md-0 gap-4 flex-md-row flex-column">
                        <div class="form-group"></div>
                        <div class="">
                            <p>Products: &euro; {{number_format($totalProductsCost, 2, ',', '.')}}</p>
                            <p>Shipping costs: &euro; {{number_format(16.95, 2, ',', '.')}}</p>
                            <h4>Total: &euro; {{number_format($totalProductsCost + 16.95, 2, ',', '.')}}</h4>
                            <a href="{{route('checkout.index')}}" class="btn btn-success mt-2 w-100">Checkout</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    @else
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <h3 class="text-danger text-center">Cart is empty</h3>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
    @endif
</x-user.layout>
